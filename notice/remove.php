<?php
date_default_timezone_set('Asia/Seoul');

/*
  [관리자 비밀번호]
  notice/admin.php에서 공고 등록할 때 쓰는 비밀번호와 반드시 동일하게 맞추세요.
  예: admin.php의 비밀번호가 koreait1234 라면 여기도 koreait1234
*/
$ADMIN_PASSWORD = 'change-this-password';

/*
  오류 안내 함수
  중요:
  닷홈에서 403을 보내면 자체 "접근 거부" 화면이 뜰 수 있으므로,
  여기서는 일부러 403을 보내지 않고 일반 안내 화면으로 표시합니다.
*/
function fail($message) {
    echo '<!doctype html>';
    echo '<html lang="ko">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>공고 삭제 안내 | KOREA IT</title>';
    echo '<link rel="stylesheet" href="../css/style.css?v=20260609">';
    echo '</head>';
    echo '<body>';
    echo '<main class="section">';
    echo '<div class="container">';
    echo '<h1 class="section-title">공고 삭제 안내</h1>';
    echo '<p class="section-lead">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p><a class="btn btn-primary" href="index.php">공고 목록으로 돌아가기</a></p>';
    echo '</div>';
    echo '</main>';
    echo '</body>';
    echo '</html>';
    exit;
}

/*
  주소창에서 remove.php를 직접 여는 경우
*/
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('공고 삭제는 공고 상세 페이지의 삭제 버튼을 통해서만 실행할 수 있습니다.');
}

$id = trim($_POST['id'] ?? '');
$password = $_POST['password'] ?? '';

if ($id === '') {
    fail('삭제할 공고 ID가 전달되지 않았습니다.');
}

/*
  비밀번호가 틀린 경우
  403을 보내지 않고 안내 화면만 보여줍니다.
*/
if ($password !== $ADMIN_PASSWORD) {
    fail('관리자 비밀번호가 올바르지 않습니다.');
}

$dataFile = __DIR__ . '/data/notices.json';
$uploadDir = __DIR__ . '/uploads';

if (!file_exists($dataFile)) {
    fail('공고 데이터 파일이 없습니다.');
}

$raw = file_get_contents($dataFile);
$notices = json_decode($raw, true);

if (!is_array($notices)) {
    fail('공고 데이터 형식이 올바르지 않습니다.');
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
      saved_name 기준으로만 삭제하여 uploads 폴더 밖 파일 삭제를 방지합니다.
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

    /*
      구버전 데이터 호환:
      혹시 file_path만 저장된 예전 공고가 있으면 처리합니다.
    */
    if (!empty($notice['file_path'])) {
        $legacyFile = basename($notice['file_path']);
        $legacyPath = $uploadDir . '/' . $legacyFile;

        if (is_file($legacyPath)) {
            unlink($legacyPath);
        }
    }
}

if (!$deleted) {
    fail('해당 공고를 찾을 수 없습니다.');
}

$result = file_put_contents(
    $dataFile,
    json_encode(array_values($newNotices), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

if ($result === false) {
    fail('공고 데이터 저장에 실패했습니다. notices.json 파일 권한을 확인해 주세요.');
}

header('Location: index.php');
exit;