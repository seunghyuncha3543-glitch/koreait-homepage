<?php
date_default_timezone_set('Asia/Seoul');

/*
  [관리자 비밀번호]
  notice/admin.php에서 쓰는 비밀번호와 반드시 동일하게 맞추세요.
*/
$ADMIN_PASSWORD = 'change-this-password';

function fail($message, $code = 400) {
    http_response_code($code);
    echo '<!doctype html>';
    echo '<html lang="ko">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>공고 삭제 오류</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>공고 삭제 오류</h1>';
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p><a href="index.php">공고 목록으로 돌아가기</a></p>';
    echo '</body>';
    echo '</html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('공고 삭제는 상세 페이지의 삭제 버튼을 통해서만 실행할 수 있습니다.', 405);
}

$id = trim($_POST['id'] ?? '');
$password = $_POST['password'] ?? '';

if ($id === '') {
    fail('삭제할 공고 ID가 전달되지 않았습니다.');
}

if ($password !== $ADMIN_PASSWORD) {
    fail('관리자 비밀번호가 올바르지 않습니다.', 403);
}

$dataFile = __DIR__ . '/data/notices.json';
$uploadDir = __DIR__ . '/uploads';

if (!file_exists($dataFile)) {
    fail('공고 데이터 파일이 없습니다.', 404);
}

$raw = file_get_contents($dataFile);
$notices = json_decode($raw, true);

if (!is_array($notices)) {
    fail('공고 데이터 형식이 올바르지 않습니다.', 500);
}

$deleted = false;
$newNotices = [];

foreach ($notices as $notice) {
    if (!isset($notice['id']) || (string)$notice['id'] !== (string)$id) {
        $newNotices[] = $notice;
        continue;
    }

    $deleted = true;

    /*
      첨부파일이 있으면 실제 uploads 파일도 삭제합니다.
    */
    if (
        isset($notice['attachment']) &&
        is_array($notice['attachment']) &&
        !empty($notice['attachment']['saved_name'])
    ) {
        $savedName = basename($notice['attachment']['saved_name']);
        $filePath = $uploadDir . '/' . $savedName;

        if (is_file($filePath)) {
            unlink($filePath);
        }
    }
}

if (!$deleted) {
    fail('해당 공고를 찾을 수 없습니다.', 404);
}

$result = file_put_contents(
    $dataFile,
    json_encode(array_values($newNotices), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

if ($result === false) {
    fail('공고 데이터 저장에 실패했습니다. notices.json 파일 권한을 확인해 주세요.', 500);
}

header('Location: index.php');
exit;