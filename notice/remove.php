<?php
date_default_timezone_set('Asia/Seoul');

/*
  공고 삭제 처리 페이지
  - 공통 관리자 비밀번호를 사용하지 않습니다.
  - 공고 작성 시 입력해 notices.json에 저장된 password_hash와
    삭제 시 입력한 비밀번호를 비교합니다.
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
  주소창에서 remove.php를 직접 여는 경우 삭제되지 않게 막습니다.
*/
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('공고 삭제는 공고 상세 페이지의 삭제 버튼을 통해서만 실행할 수 있습니다.');
}

$id = trim($_POST['id'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($id === '') {
    fail('삭제할 공고 ID가 전달되지 않았습니다.');
}

if ($password === '') {
    fail('공고 작성 시 입력한 삭제용 비밀번호를 입력해 주세요.');
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

$targetIndex = null;
$targetNotice = null;

foreach ($notices as $index => $notice) {
    if ((string)($notice['id'] ?? '') === (string)$id) {
        $targetIndex = $index;
        $targetNotice = $notice;
        break;
    }
}

if ($targetNotice === null || $targetIndex === null) {
    fail('해당 공고를 찾을 수 없습니다.');
}

/*
  새 방식으로 등록된 공고는 password_hash를 가지고 있어야 합니다.
  기존에 등록한 공고에는 password_hash가 없을 수 있습니다.
*/
$passwordHash = $targetNotice['password_hash'] ?? '';

if ($passwordHash === '') {
    fail('이 공고에는 삭제용 비밀번호 정보가 없습니다. 기존에 등록된 공고라면 notices.json에서 직접 삭제하거나, 새 방식으로 다시 등록해 주세요.');
}

if (!password_verify($password, $passwordHash)) {
    fail('공고 작성 시 입력한 비밀번호와 일치하지 않습니다.');
}

/*
  첨부파일이 있으면 실제 uploads 파일도 삭제합니다.
  saved_name 기준으로만 삭제하여 uploads 폴더 밖 파일 삭제를 방지합니다.
*/
if (
    isset($targetNotice['attachment']) &&
    is_array($targetNotice['attachment']) &&
    !empty($targetNotice['attachment']['saved_name'])
) {
    $savedName = basename($targetNotice['attachment']['saved_name']);
    $filePath = $uploadDir . '/' . $savedName;

    if (is_file($filePath)) {
        unlink($filePath);
    }
}

/*
  구버전 데이터 호환:
  혹시 file_path만 저장된 예전 공고가 있으면 처리합니다.
*/
if (!empty($targetNotice['file_path'])) {
    $legacyFile = basename($targetNotice['file_path']);
    $legacyPath = $uploadDir . '/' . $legacyFile;

    if (is_file($legacyPath)) {
        unlink($legacyPath);
    }
}

/*
  notices.json에서 해당 공고 제거
*/
unset($notices[$targetIndex]);

$result = file_put_contents(
    $dataFile,
    json_encode(array_values($notices), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
);

if ($result === false) {
    fail('공고 데이터 저장에 실패했습니다. notices.json 파일 권한을 확인해 주세요.');
}

header('Location: index.php');
exit;