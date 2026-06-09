<?php
// 공고 첨부파일 다운로드 처리
// 실제 서버 저장 파일명(saved_name)이 아니라 원본 파일명(original_name)으로 다운로드되게 합니다.

$dataFile = __DIR__ . '/data/notices.json';
$uploadDir = __DIR__ . '/uploads';

function fail($message, $code = 404) {
    http_response_code($code);
    echo '<!doctype html>';
    echo '<html lang="ko">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>첨부파일 다운로드 오류</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>첨부파일 다운로드 오류</h1>';
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p><a href="index.php">공고 목록으로 돌아가기</a></p>';
    echo '</body>';
    echo '</html>';
    exit;
}

$id = trim($_GET['id'] ?? '');

if ($id === '') {
    fail('공고 ID가 전달되지 않았습니다.');
}

if (!file_exists($dataFile)) {
    fail('공고 데이터 파일이 없습니다.');
}

$notices = json_decode(file_get_contents($dataFile), true);

if (!is_array($notices)) {
    fail('공고 데이터 형식이 올바르지 않습니다.');
}

$targetNotice = null;

foreach ($notices as $notice) {
    if ((string)($notice['id'] ?? '') === (string)$id) {
        $targetNotice = $notice;
        break;
    }
}

if (!$targetNotice) {
    fail('해당 공고를 찾을 수 없습니다.');
}

$attachment = $targetNotice['attachment'] ?? null;

if (!is_array($attachment)) {
    fail('첨부파일이 없습니다.');
}

$savedName = basename($attachment['saved_name'] ?? '');
$originalName = $attachment['original_name'] ?? 'attachment';

if ($savedName === '') {
    fail('첨부파일 저장명이 없습니다.');
}

$filePath = $uploadDir . '/' . $savedName;

if (!is_file($filePath)) {
    fail('첨부파일을 찾을 수 없습니다.');
}

/*
  파일명 정리
  - 줄바꿈, 따옴표 등 헤더를 깨뜨릴 수 있는 문자를 제거합니다.
*/
$downloadName = str_replace(["\r", "\n", '"'], '', $originalName);

if ($downloadName === '') {
    $downloadName = $savedName;
}

$encodedName = rawurlencode($downloadName);

/*
  다운로드 헤더
  filename은 구형 브라우저용,
  filename*은 한글 파일명 대응용입니다.
*/
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($downloadName) . '"; filename*=UTF-8\'\'' . $encodedName);
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: private, no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

readfile($filePath);
exit;