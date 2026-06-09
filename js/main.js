/* KOREA IT 홈페이지 JavaScript: 모바일 메뉴, 맨 위 버튼, 메인 공고 제목 목록만 담당합니다. */

window.addEventListener('load', function () {
  const intro = document.getElementById('intro-loader');
  if (!intro) return;

  window.setTimeout(function () {
    intro.classList.add('is-hidden');
  }, 1200);
});


const menuButton = document.querySelector('.menu-button');
const mobileMenu = document.querySelector('.mobile-menu');

if (menuButton && mobileMenu) {
  menuButton.addEventListener('click', function () {
    const isOpen = mobileMenu.classList.toggle('active');
    menuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
}

document.querySelectorAll('.mobile-menu a').forEach(function (link) {
  link.addEventListener('click', function () {
    if (mobileMenu) mobileMenu.classList.remove('active');
    if (menuButton) menuButton.setAttribute('aria-expanded', 'false');
  });
});

const toTopButton = document.querySelector('.to-top');
window.addEventListener('scroll', function () {
  if (!toTopButton) return;
  toTopButton.classList.toggle('show', window.scrollY > 260);
});
if (toTopButton) {
  toTopButton.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

const noticePreviewList = document.querySelector('#notice-preview-list');
if (noticePreviewList) {
  const jsonPath = noticePreviewList.dataset.noticeJson || 'notice/data/notices.json';
  const viewBase = noticePreviewList.dataset.viewBase || 'notice/view.php?id=';

  fetch(jsonPath, { cache: 'no-store' })
    .then(function (response) {
      if (!response.ok) throw new Error('notice json not found');
      return response.json();
    })
    .then(function (notices) {
      if (!Array.isArray(notices) || notices.length === 0) {
        noticePreviewList.innerHTML = '<p class="notice-empty">등록된 공고가 없습니다.</p>';
        return;
      }

      const recentNotices = notices.slice().reverse().slice(0, 5);
      noticePreviewList.innerHTML = recentNotices.map(function (notice) {
        const title = notice.title || '제목 없는 공고';
        const date = notice.created_at || '';
        const id = encodeURIComponent(notice.id || '');
        return '<a class="notice-preview-item" href="' + viewBase + id + '"><strong>' + escapeHtml(title) + '</strong><span>' + escapeHtml(date) + '</span></a>';
      }).join('');
    })
    .catch(function () {
      noticePreviewList.innerHTML = '<p class="notice-empty">등록된 공고가 없습니다.</p>';
    });
}

function escapeHtml(value) {
  return String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');
}
