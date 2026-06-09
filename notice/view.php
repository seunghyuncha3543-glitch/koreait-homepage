<?php
// 전자공고 상세 페이지: id 값으로 공고 1건을 찾아 제목, 본문, 첨부파일을 표시합니다.
$dataFile = __DIR__ . '/data/notices.json';

if (!file_exists($dataFile)) {
  file_put_contents($dataFile, '[]');
}

$notices = json_decode(file_get_contents($dataFile), true);

if (!is_array($notices)) {
  $notices = [];
}

$id = $_GET['id'] ?? '';
$notice = null;

foreach ($notices as $item) {
  if (($item['id'] ?? '') === $id) {
    $notice = $item;
    break;
  }
}

function h($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$attachmentPath = '';
$attachmentName = '';

if ($notice) {
  $attachmentPath = $notice['attachment']['path'] ?? ($notice['file_path'] ?? '');
  $attachmentName = $notice['attachment']['original_name'] ?? ($notice['file_original'] ?? '첨부파일');
}
?>
<!doctype html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>공고 상세 | KOREA IT</title>
  <link rel="icon" href="../assets/favicon.svg">
  <link rel="stylesheet" href="../css/style.css?v=20260609">
</head>

<body>
  <header class="site-header">
    <div class="container header-inner">
      <a class="site-logo" href="../index.html">
        <img src="../assets/logo-horizontal-1200.png" alt="KOREA IT">
      </a>
    </div>
  </header>

  <main>
    <section class="section">
      <div class="container">

        <?php if (!$notice): ?>

          <h1 class="section-title">공고를 찾을 수 없습니다.</h1>
          <p>
            <a class="btn btn-primary" href="index.php">목록으로 돌아가기</a>
          </p>

        <?php else: ?>

          <p class="section-label">NOTICE</p>
          <h1 class="section-title"><?= h($notice['title'] ?? '') ?></h1>
          <p class="section-lead">작성일: <?= h($notice['created_at'] ?? '') ?></p>

          <article class="card">
            <p><?= nl2br(h($notice['content'] ?? '')) ?></p>

            <?php if ($attachmentPath !== ''): ?>
              <p style="margin-top:18px">
                <a class="btn btn-secondary" href="<?= h($attachmentPath) ?>" download>
                  첨부파일 다운로드: <?= h($attachmentName) ?>
                </a>
              </p>
            <?php endif; ?>
          </article>

          <!-- 공고 상세 하단 버튼 영역 -->
          <div
            class="notice-actions"
            style="margin-top: 24px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;"
          >
            <a class="btn btn-primary" href="index.php">목록으로 돌아가기</a>

            <form
              action="remove.php"
              method="post"
              onsubmit="return confirm('이 공고를 삭제하시겠습니까? 삭제 후 복구할 수 없습니다.');"
              style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;"
            >
              <input
                type="hidden"
                name="id"
                value="<?= h($notice['id'] ?? '') ?>"
              >

              <input
                type="password"
                name="password"
                placeholder="관리자 비밀번호"
                required
                style="padding: 10px 12px; border: 1px solid #E5E7EB; border-radius: 8px;"
              >

              <button
                type="submit"
                class="btn"
                style="background: #DC2832; color: #fff; border: 0; border-radius: 8px; padding: 10px 14px; cursor: pointer;"
              >
                삭제
              </button>
            </form>
          </div>

        <?php endif; ?>

      </div>
    </section>
  </main>
</body>
</html>
