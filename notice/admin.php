<?php
// 관리자 비밀번호: 실제 운영 전 반드시 변경하세요.
$ADMIN_PASSWORD = 'change-this-password';
?>
<!doctype html><html lang="ko"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>공고 등록 | KOREA IT</title><link rel="icon" href="../assets/favicon.svg"><link rel="stylesheet" href="../css/style.css?v=20260609"></head><body><header class="site-header"><div class="container header-inner"><a class="site-logo" href="../index.html"><img src="../assets/logo-horizontal-1200.png" alt="KOREA IT"></a></div></header><main><section class="section"><div class="container"><p class="section-label">ADMIN</p><h1 class="section-title">공고 등록</h1><p class="section-lead">제목과 내용만 입력해도 저장됩니다. 첨부파일은 선택 사항입니다.</p><form class="admin-form" action="save.php" method="post" enctype="multipart/form-data"><label>관리자 비밀번호<input type="password" name="password" required></label><label>공고 제목<input type="text" name="title" required></label><label>공고 내용<textarea name="content" rows="10" required></textarea></label><label>첨부파일<input type="file" name="attachment" accept=".pdf,.hwp,.hwpx,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.zip"></label><p class="section-lead">허용 확장자: pdf, hwp, hwpx, doc, docx, xls, xlsx, jpg, jpeg, png, zip / 최대 20MB</p><button class="btn btn-primary" type="submit">저장</button><a class="btn btn-secondary" href="index.php">목록</a></form></div></section></main></body></html>
<?php
$dataFile = __DIR__ . '/data/notices.json';
$notices = [];

if (file_exists($dataFile)) {
    $raw = file_get_contents($dataFile);
    $decoded = json_decode($raw, true);

    if (is_array($decoded)) {
        $notices = $decoded;
    }
}
?>

<section class="admin-notice-list" style="margin-top: 40px;">
  <h2>등록된 공고 관리</h2>

  <?php if (empty($notices)): ?>
    <p>등록된 공고가 없습니다.</p>
  <?php else: ?>
    <table class="notice-table">
      <thead>
        <tr>
          <th>작성일</th>
          <th>제목</th>
          <th>첨부</th>
          <th>삭제</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($notices as $notice): ?>
          <tr>
            <td>
              <?php echo htmlspecialchars($notice['created_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($notice['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </td>
            <td>
              <?php if (!empty($notice['attachment'])): ?>
                있음
              <?php else: ?>
                없음
              <?php endif; ?>
            </td>
            <td>
              <form
                action="delete.php"
                method="post"
                onsubmit="return confirm('이 공고를 삭제하시겠습니까? 삭제 후 복구할 수 없습니다.');"
                style="display: flex; gap: 6px; align-items: center; flex-wrap: wrap;"
              >
                <input
                  type="hidden"
                  name="id"
                  value="<?php echo htmlspecialchars($notice['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                >

                <input
                  type="password"
                  name="password"
                  placeholder="관리자 비밀번호"
                  required
                  style="padding: 6px 8px;"
                >

                <button type="submit">
                  삭제
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</section>