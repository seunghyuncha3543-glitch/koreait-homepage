<?php
date_default_timezone_set('Asia/Seoul');

/*
  [관리자 비밀번호]
  현재 admin.php에서 쓰는 비밀번호와 동일하게 맞추세요.
  나중에 실제 운영 전 반드시 변경하세요.
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
    echo '<p><a href="admin.php">관리자 페이지로 돌아가기</a></p>';
    echo '</body>';
    echo '</html>';
    exit;
}

/*
  삭제는 반드시 POST 방식으로만 처리합니다.
  주소창에서 delete.php를 직접 열어도 삭제되지 않게 하기 위함입니다.
*/
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('공고 삭제는 관리자 페이지에서만 실행할 수 있습니다.', 405);
}

$password = $_POST['password'] ?? '';

if ($password !== $ADMIN_PASSWORD) {
    fail('관리자 비밀번호가 올바르지 않습니다.', 403);
}

$id = trim($_POST['id'] ?? '');

if ($id === '') {
    fail('삭제할 공고 ID가 전달되지 않았습니다.');
}

$dataDir = __DIR__ . '/data';
$uploadDir = __DIR__ . '/uploads';
$dataFile = $dataDir . '/notices.json';

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

    /*
      여기부터는 삭제 대상 공고입니다.
      첨부파일이 있으면 uploads 폴더의 실제 파일도 삭제합니다.
    */
    $deleted = true;

    if (
        isset($notice['attachment']) &&
        is_array($notice['attachment']) &&
        !empty($notice['attachment']['saved_name'])
    ) {
        /*
          보안상 파일명만 사용합니다.
          path 전체를 그대로 믿고 삭제하면 위험할 수 있습니다.
        */
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

header('Location: admin.php');
exit;