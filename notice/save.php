<?php
// 공고 저장 처리: 제목/내용은 필수, 첨부파일은 선택입니다.
$ADMIN_PASSWORD = 'change-this-password';
$allowedExt = ['pdf','hwp','hwpx','doc','docx','xls','xlsx','jpg','jpeg','png','zip'];
$maxSize = 20 * 1024 * 1024;
function fail($message) {
  http_response_code(400);
  echo '<!doctype html><html lang="ko"><head><meta charset="UTF-8"><title>저장 오류</title><link rel="stylesheet" href="../css/style.css"></head><body><main class="section"><div class="container"><h1 class="section-title">공고 저장 오류</h1><p class="notice-empty">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p><p><a class="btn btn-primary" href="admin.php">등록 화면으로 돌아가기</a></p></div></main></body></html>';
  exit;
}
if (($_POST['password'] ?? '') !== $ADMIN_PASSWORD) { fail('관리자 비밀번호가 올바르지 않습니다.'); }
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
if ($title === '') { fail('공고 제목을 입력해 주세요.'); }
if ($content === '') { fail('공고 내용을 입력해 주세요.'); }
$dataDir = __DIR__ . '/data';
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($dataDir) && !mkdir($dataDir, 0755, true)) { fail('data 폴더를 만들 수 없습니다. 서버 권한을 확인해 주세요.'); }
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) { fail('uploads 폴더를 만들 수 없습니다. 서버 권한을 확인해 주세요.'); }
$filePath = '';
$fileOriginal = '';
if (!empty($_FILES['attachment']['name'])) {
  if ($_FILES['attachment']['error'] !== UPLOAD_ERR_OK) { fail('첨부파일 업로드 중 오류가 발생했습니다. 파일을 다시 선택해 주세요.'); }
  if ($_FILES['attachment']['size'] > $maxSize) { fail('첨부파일은 최대 20MB까지 업로드할 수 있습니다.'); }
  $fileOriginal = basename($_FILES['attachment']['name']);
  $ext = strtolower(pathinfo($fileOriginal, PATHINFO_EXTENSION));
  if (!in_array($ext, $allowedExt, true)) { fail('허용되지 않는 첨부파일 형식입니다.'); }
  $safeName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
  if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadDir . '/' . $safeName)) { fail('첨부파일 저장에 실패했습니다. uploads 폴더 권한을 확인해 주세요.'); }
  $filePath = 'uploads/' . $safeName;
}
$dataFile = $dataDir . '/notices.json';
if (!file_exists($dataFile)) { file_put_contents($dataFile, '[]'); }
$notices = json_decode(file_get_contents($dataFile), true);
if (!is_array($notices)) { $notices = []; }
$notices[] = ['id' => date('YmdHis') . '-' . bin2hex(random_bytes(3)), 'title' => $title, 'content' => $content, 'created_at' => date('Y-m-d'), 'file_path' => $filePath, 'file_original' => $fileOriginal];
if (file_put_contents($dataFile, json_encode($notices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX) === false) { fail('공고 데이터를 저장하지 못했습니다. data 폴더 권한을 확인해 주세요.'); }
header('Location: index.php');
exit;
