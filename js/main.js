/*
  [모바일 메뉴 열기/닫기]
  - 휴대폰 화면에서는 상단 메뉴가 접혀 있습니다.
  - "메뉴" 버튼을 누르면 숨겨진 메뉴(.mobile-menu)가 펼쳐집니다.
  - 다시 누르면 닫힙니다.
  - aria-expanded 값도 함께 바꿔서 접근성(스크린리더)도 맞춥니다.
*/
const menuButton = document.querySelector('.menu-button');
const mobileMenu = document.querySelector('.mobile-menu');

  휴대폰 화면에서 메뉴 버튼을 누르면 메뉴가 열리고,
  다시 누르면 메뉴가 닫히도록 하는 코드입니다.
*/
const menuButton = document.querySelector('.menu-button');
const mobileMenu = document.querySelector('.mobile-menu');
if (menuButton && mobileMenu) {
  menuButton.addEventListener('click', function () {
    const opened = mobileMenu.classList.toggle('active');
    menuButton.setAttribute('aria-expanded', opened ? 'true' : 'false');
  });
}

/*
  [부드러운 스크롤]
  - 메뉴에서 "#"으로 시작하는 링크(예: #services)를 눌렀을 때
    갑자기 점프하지 않고 부드럽게 이동합니다.
  - 모바일 메뉴가 열린 상태에서 링크를 눌렀다면,
    섹션 이동 후 메뉴가 자동으로 닫히도록 처리했습니다.
  메뉴를 클릭했을 때 해당 섹션으로 천천히 이동하도록 합니다.
*/
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
  anchor.addEventListener('click', function (event) {
    const target = document.querySelector(this.getAttribute('href'));
    if (!target) return;

    event.preventDefault();
    target.scrollIntoView({ behavior: 'smooth' });

    if (mobileMenu) {
      mobileMenu.classList.remove('active');
      menuButton && menuButton.setAttribute('aria-expanded', 'false');
    }
  });
});

/*
  [맨 위로 이동 버튼]
  - 스크롤을 240px 이상 내리면 우측 하단에 버튼이 나타납니다.
  - 버튼을 누르면 페이지 최상단으로 부드럽게 올라갑니다.
*/
const toTopButton = document.querySelector('.to-top');

    event.preventDefault();
    target.scrollIntoView({ behavior: 'smooth' });
    if (mobileMenu) mobileMenu.classList.remove('active');
  });
});

/*
  [맨 위로 이동 버튼]
  화면을 내리면 우측 아래 버튼이 보이고,
  버튼을 누르면 페이지 맨 위로 이동합니다.
*/
const toTopButton = document.querySelector('.to-top');
window.addEventListener('scroll', function () {
  if (!toTopButton) return;
  toTopButton.classList.toggle('show', window.scrollY > 240);
});

if (toTopButton) {
  toTopButton.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}
