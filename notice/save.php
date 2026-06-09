<?php
// [파일 역할] 관리자 폼에서 보낸 공고 내용을 JSON 파일에 저장하고 첨부파일을 업로드합니다.
$ADMIN_PASSWORD = 'change-this-password'; // [수정 가능][주의] admin.php와 반드시 같은 값으로 변경하세요.
$allowedExt = ['pdf','hwp','hwpx','doc','docx','xls','xlsx','jpg','jpeg','png','zip'];
$maxSize = 20 * 1024 * 1024;
function fail($message) { http_response_code(400); echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p><p><a href="admin.php">돌아가기</a></p>'; exit; }
if (($_POST['password'] ?? '') !== $ADMIN_PASSWORD) { fail('관리자 비밀번호가 올바르지 않습니다.'); }
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
if ($title === '' || $content === '') { fail('제목과 내용을 입력하세요.'); }
$dataDir = __DIR__ . '/data';
$uploadDir = __DIR__ . '/uploads';
if (!is_dir($dataDir)) { mkdir($dataDir, 0755, true); }
if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
$filePath = '';
$fileOriginal = '';
if (!empty($_FILES['attachment']['name'])) {
  if ($_FILES['attachment']['error'] !== UPLOAD_ERR_OK) { fail('첨부파일 업로드 중 오류가 발생했습니다.'); }
  if ($_FILES['attachment']['size'] > $maxSize) { fail('첨부파일은 최대 20MB까지 업로드할 수 있습니다.'); }
  $fileOriginal = basename($_FILES['attachment']['name']);
  $ext = strtolower(pathinfo($fileOriginal, PATHINFO_EXTENSION));
  if (!in_array($ext, $allowedExt, true)) { fail('허용되지 않는 첨부파일 형식입니다.'); }
  $safeName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
  if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadDir . '/' . $safeName)) { fail('첨부파일 저장에 실패했습니다.'); }
  $filePath = 'uploads/' . $safeName;
}
$dataFile = $dataDir . '/notices.json';
if (!file_exists($dataFile)) { file_put_contents($dataFile, '[]'); }
$notices = json_decode(file_get_contents($dataFile), true);
if (!is_array($notices)) { $notices = []; }
$id = date('YmdHis') . '-' . bin2hex(random_bytes(3));
$notices[] = ['id'=>$id, 'title'=>$title, 'content'=>$content, 'created_at'=>date('Y-m-d'), 'file_path'=>$filePath, 'file_original'=>$fileOriginal];
file_put_contents($dataFile, json_encode($notices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
header('Location: view.php?id=' . urlencode($id));
exit;
