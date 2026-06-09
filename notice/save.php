<?php
date_default_timezone_set('Asia/Seoul');

function fail($message, $code = 400) {
    http_response_code($code);
    echo '<!doctype html><html lang="ko"><head><meta charset="utf-8"><title>공고 저장 오류</title></head><body>';
    echo '<h1>공고 저장 오류</h1>';
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p><a href="admin.php">관리자 페이지로 돌아가기</a></p>';
    echo '</body></html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('공고 저장은 관리자 페이지에서 작성 후 저장해야 합니다.', 405);
}

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($title === '') {
    fail('공고 제목을 입력해 주세요.');
}

if ($content === '') {
    fail('공고 내용을 입력해 주세요.');
}

if ($password === '') {
    fail('공고 삭제용 비밀번호를 입력해 주세요.');
}

/*
  작성 시 입력한 비밀번호를 원문으로 저장하지 않고 hash로 저장합니다.
  나중에 remove.php에서 password_verify()로 비교합니다.
*/
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$dataDir = __DIR__ . '/data';
$uploadDir = __DIR__ . '/uploads';
$dataFile = $dataDir . '/notices.json';

if (!is_dir($dataDir) && !mkdir($dataDir, 0755, true)) {
    fail('data 폴더를 생성할 수 없습니다. 서버 권한을 확인해 주세요.', 500);
}

if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
    fail('uploads 폴더를 생성할 수 없습니다. 서버 권한을 확인해 주세요.', 500);
}

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

$raw = file_get_contents($dataFile);
$notices = json_decode($raw, true);

if (!is_array($notices)) {
    $notices = [];
}

$attachment = null;

$hasFile = isset($_FILES['attachment'])
    && is_array($_FILES['attachment'])
    && $_FILES['attachment']['error'] !== UPLOAD_ERR_NO_FILE;

if ($hasFile) {
    if ($_FILES['attachment']['error'] !== UPLOAD_ERR_OK) {
        fail('첨부파일 업로드 중 오류가 발생했습니다. 파일 크기 또는 서버 업로드 제한을 확인해 주세요.');
    }

    $originalName = $_FILES['attachment']['name'];
    $tmpName = $_FILES['attachment']['tmp_name'];
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    $allowed = ['pdf', 'hwp', 'hwpx', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'zip'];

    if (!in_array($extension, $allowed, true)) {
        fail('허용되지 않는 첨부파일 형식입니다. pdf, hwp, hwpx, doc, docx, xls, xlsx, jpg, jpeg, png, zip 파일만 업로드할 수 있습니다.');
    }

    $savedName = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
    $targetPath = $uploadDir . '/' . $savedName;

    if (!move_uploaded_file($tmpName, $targetPath)) {
        fail('첨부파일 저장에 실패했습니다. uploads 폴더 권한을 확인해 주세요.', 500);
    }

    $attachment = [
        'original_name' => $originalName,
        'saved_name' => $savedName,
        'path' => 'uploads/' . $savedName
    ];
}

$id = date('YmdHis') . '_' . bin2hex(random_bytes(3));

$newNotice = [
    'id' => $id,
    'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
    'content' => htmlspecialchars($content, ENT_QUOTES, 'UTF-8'),
    'created_at' => date('Y-m-d H:i:s'),
    'attachment' => $attachment,

    /*
      이 공고를 삭제할 때 확인할 비밀번호 hash입니다.
      원문 비밀번호는 저장하지 않습니다.
    */
    'password_hash' => $passwordHash
];

array_unshift($notices, $newNotice);

$result = file_put_contents(
    $dataFile,
    json_encode($notices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

if ($result === false) {
    fail('공고 데이터를 저장하지 못했습니다. notices.json 파일 권한을 확인해 주세요.', 500);
}

header('Location: index.php');
exit;