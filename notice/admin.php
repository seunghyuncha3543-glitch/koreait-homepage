```php
<?php
// 공고 등록 페이지
// 이 페이지에서는 공고 작성 시 사용할 "삭제용 비밀번호"를 함께 입력받습니다.
// 입력된 비밀번호는 save.php에서 password_hash()로 암호화되어 notices.json에 저장되어야 합니다.

$dataFile = __DIR__ . '/data/notices.json';

if (!file_exists($dataFile)) {
    if (!is_dir(__DIR__ . '/data')) {
        mkdir(__DIR__ . '/data', 0755, true);
    }

    file_put_contents($dataFile, '[]');
}

$notices = json_decode(file_get_contents($dataFile), true);

if (!is_array($notices)) {
    $notices = [];
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>공고 등록 | KOREA IT</title>
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
        <p class="section-label">ADMIN</p>
        <h1 class="section-title">공고 등록</h1>
        <p class="section-lead">
          제목과 내용만 입력해도 저장됩니다. 첨부파일은 선택 사항입니다.
          공고 삭제 시에는 작성할 때 입력한 비밀번호가 필요합니다.
        </p>

        <form class="admin-form" action="save.php" method="post" enctype="multipart/form-data">
          <label>
            공고 제목
            <input type="text" name="title" required>
          </label>

          <label>
            공고 내용
            <textarea name="content" rows="10" required></textarea>
          </label>

          <label>
            공고 삭제용 비밀번호
            <input
              type="password"
              name="password"
              required
              placeholder="이 공고를 삭제할 때 사용할 비밀번호"
            >
          </label>

          <label>
            첨부파일
            <input
              type="file"
              name="attachment"
              accept=".pdf,.hwp,.hwpx,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.zip"
            >
          </label>

          <p class="section-lead">
            허용 확장자: pdf, hwp, hwpx, doc, docx, xls, xlsx, jpg, jpeg, png, zip / 최대 20MB
          </p>

          <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 20px;">
            <button class="btn btn-primary" type="submit">저장</button>
            <a class="btn btn-secondary" href="index.php">목록</a>
          </div>
        </form>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <p class="section-label">NOTICE LIST</p>
        <h2 class="section-title">등록된 공고</h2>
        <p class="section-lead">
          공고 삭제는 각 공고 상세 페이지에서 작성 시 입력한 비밀번호로 진행합니다.
        </p>

        <?php if (empty($notices)): ?>
          <div class="notice-empty">
            등록된 공고가 없습니다.
          </div>
        <?php else: ?>
          <table class="notice-table">
            <thead>
              <tr>
                <th>작성일</th>
                <th>제목</th>
                <th>첨부</th>
                <th>관리</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($notices as $notice): ?>
                <tr>
                  <td>
                    <?= h($notice['created_at'] ?? '') ?>
                  </td>
                  <td>
                    <?= h($notice['title'] ?? '') ?>
                  </td>
                  <td>
                    <?php if (!empty($notice['attachment']) || !empty($notice['file_path'])): ?>
                      있음
                    <?php else: ?>
                      없음
                    <?php endif; ?>
                  </td>
                  <td>
                    <a
                      class="btn btn-secondary"
                      href="view.php?id=<?= h($notice['id'] ?? '') ?>"
                    >
                      상세 보기
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </section>
  </main>
</body>
</html>
```
