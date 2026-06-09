/*
  KOREA IT 1차 홈페이지 JavaScript
  - 모바일 메뉴 열기/닫기
  - 맨 위로 이동 버튼
  복잡한 기능은 넣지 않습니다.
*/

// [모바일 메뉴] 버튼과 메뉴 영역을 찾습니다.
const menuButton = document.querySelector('.menu-button');
const mobileMenu = document.querySelector('.mobile-menu');

// [모바일 메뉴] 버튼이 있을 때만 클릭 기능을 연결합니다.
if (menuButton && mobileMenu) {
  menuButton.addEventListener('click', function () {
    const isOpen = mobileMenu.classList.toggle('active');
    menuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
}

// [모바일 메뉴] 메뉴 항목을 누르면 열린 메뉴를 닫습니다.
document.querySelectorAll('.mobile-menu a').forEach(function (link) {
  link.addEventListener('click', function () {
    if (mobileMenu) mobileMenu.classList.remove('active');
    if (menuButton) menuButton.setAttribute('aria-expanded', 'false');
  });
});

// [맨 위로 이동] 버튼을 찾습니다.
const toTopButton = document.querySelector('.to-top');

// [맨 위로 이동] 스크롤을 어느 정도 내리면 버튼을 보여줍니다.
window.addEventListener('scroll', function () {
  if (!toTopButton) return;
  toTopButton.classList.toggle('show', window.scrollY > 260);
});

// [맨 위로 이동] 버튼 클릭 시 페이지 맨 위로 이동합니다.
if (toTopButton) {
  toTopButton.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}
