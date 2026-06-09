<?php
// [파일 역할] 공고 상세 페이지입니다. 주소의 id 값으로 공고 1건을 찾아 표시합니다.
$dataFile = __DIR__ . '/data/notices.json';
if (!file_exists($dataFile)) { file_put_contents($dataFile, '[]'); }
$notices = json_decode(file_get_contents($dataFile), true);
if (!is_array($notices)) { $notices = []; }
$id = $_GET['id'] ?? '';
$notice = null;
foreach ($notices as $item) { if (($item['id'] ?? '') === $id) { $notice = $item; break; } }
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html><html lang="ko"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>공고 상세 | KOREA IT</title><link rel="stylesheet" href="../css/style.css"><link rel="icon" type="image/svg+xml" href="../assets/favicon.svg"></head><body><header class="site-header"><div class="container header-inner"><a class="site-logo" href="../index.html"><img src="../assets/logo-horizontal.svg" alt="KOREA IT"></a></div></header><main class="section"><div class="container"><?php if (!$notice): ?><h1 class="section-title">공고를 찾을 수 없습니다.</h1><p><a class="btn btn-primary" href="index.php">목록으로 돌아가기</a></p><?php else: ?><h1 class="section-title"><?= e($notice['title'] ?? '') ?></h1><p class="section-lead">작성일: <?= e($notice['created_at'] ?? '') ?></p><article class="card"><div class="notice-content"><?= nl2br(e($notice['content'] ?? '')) ?></div><?php if (!empty($notice['file_path'])): ?><p><a class="btn btn-secondary" href="<?= e($notice['file_path']) ?>" download>첨부파일 다운로드: <?= e($notice['file_original'] ?? '첨부파일') ?></a></p><?php endif; ?></article><p style="margin-top:20px"><a class="btn btn-primary" href="index.php">목록으로 돌아가기</a></p><?php endif; ?></div></main></body></html>
