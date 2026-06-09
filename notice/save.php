<?php
// 공고 저장 처리: notice/admin.php에서 보낸 POST 요청만 저장합니다.
$ADMIN_PASSWORD = 'change-this-password';
$allowedExtensions = ['pdf', 'hwp', 'hwpx', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'zip'];
$maxUploadSize = 20 * 1024 * 1024;

function show_message($message, $statusCode = 400) {
  http_response_code($statusCode);
  echo '<!doctype html><html lang="ko"><head><meta charset="UTF-8"><title>공고 저장 안내</title><link rel="stylesheet" href="../css/style.css?v=20260609"></head><body><main class="section"><div class="container"><h1 class="section-title">공고 저장 안내</h1><p class="notice-empty">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p><p><a class="btn btn-primary" href="admin.php">등록 화면으로 돌아가기</a></p></div></main></body></html>';
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  show_message('공고 저장은 관리자 페이지에서 작성 후 저장해야 합니다.', 405);
}

if (($_POST['password'] ?? '') !== $ADMIN_PASSWORD) {
  show_message('관리자 비밀번호가 올바르지 않습니다.');
}

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

if ($title === '' || $content === '') {
  show_message('제목과 내용을 입력해 주세요.');
}

$dataDir = __DIR__ . '/data';
$uploadDir = __DIR__ . '/uploads';

if (!is_dir($dataDir) && !mkdir($dataDir, 0755, true)) {
  show_message('data 폴더를 만들 수 없습니다. 서버 권한을 확인해 주세요.', 500);
}

if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
  show_message('uploads 폴더를 만들 수 없습니다. 서버 권한을 확인해 주세요.', 500);
}

$dataFile = $dataDir . '/notices.json';

if (!file_exists($dataFile)) {
  $created = file_put_contents($dataFile, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
  if ($created === false) {
    show_message('notices.json 파일을 만들 수 없습니다. data 폴더 권한을 확인해 주세요.', 500);
  }
}

$raw = file_get_contents($dataFile);
$notices = json_decode($raw, true);

if (!is_array($notices)) {
  $notices = [];
}

$attachment = null;
$hasFile = isset($_FILES['attachment'])
  && is_array($_FILES['attachment'])
  && ($_FILES['attachment']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

if ($hasFile) {
  if ($_FILES['attachment']['error'] !== UPLOAD_ERR_OK) {
    show_message('첨부파일 업로드 중 오류가 발생했습니다.');
  }

  if (($_FILES['attachment']['size'] ?? 0) > $maxUploadSize) {
    show_message('첨부파일은 최대 20MB까지 업로드할 수 있습니다.');
  }

  $originalName = basename($_FILES['attachment']['name'] ?? '');
  $tmpName = $_FILES['attachment']['tmp_name'] ?? '';
  $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

  if (!in_array($extension, $allowedExtensions, true)) {
    show_message('허용되지 않는 첨부파일 형식입니다.');
  }

  $savedName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
  $targetPath = $uploadDir . '/' . $savedName;

  if (!move_uploaded_file($tmpName, $targetPath)) {
    show_message('첨부파일 저장에 실패했습니다. uploads 폴더 권한을 확인해 주세요.', 500);
  }

  $attachment = [
    'original_name' => $originalName,
    'saved_name' => $savedName,
    'path' => 'uploads/' . $savedName
  ];
}

$newNotice = [
  'id' => date('YmdHis') . '-' . bin2hex(random_bytes(3)),
  'title' => $title,
  'content' => $content,
  'created_at' => date('Y-m-d H:i:s'),
  'attachment' => $attachment
];

array_unshift($notices, $newNotice);

$saved = file_put_contents(
  $dataFile,
  json_encode($notices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
  LOCK_EX
);

if ($saved === false) {
  show_message('공고 데이터를 저장하지 못했습니다. data 폴더 권한을 확인해 주세요.', 500);
}

header('Location: index.php');
exit;
