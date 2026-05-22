/*
  [파일 역할]
  이 파일은 홈페이지에서 "움직이는 기능"(메뉴 열기/닫기, 부드러운 스크롤, 맨 위로 버튼)을 담당합니다.
  HTML은 화면 뼈대, CSS는 디자인, JS는 동작을 담당한다고 이해하면 쉽습니다.
*/

// [메뉴 버튼 찾기] class="menu-button" 요소를 찾아 menuButton 변수에 저장합니다.
const menuButton = document.querySelector('.menu-button');
// [모바일 메뉴 박스 찾기] class="mobile-menu" 요소를 찾아 mobileMenu 변수에 저장합니다.
const mobileMenu = document.querySelector('.mobile-menu');

// [안전 장치] 메뉴 버튼과 모바일 메뉴가 둘 다 있을 때만 아래 코드를 실행합니다.
if (menuButton && mobileMenu) {
  // [클릭 이벤트 등록] 메뉴 버튼을 클릭할 때마다 아래 함수가 실행됩니다.
  menuButton.addEventListener('click', function () {
    // [active 클래스 토글] active가 없으면 추가(열림), 있으면 제거(닫힘)합니다.
    const opened = mobileMenu.classList.toggle('active');
    // [접근성 속성 갱신] 스크린리더가 현재 메뉴 상태를 알 수 있도록 true/false를 반영합니다.
    menuButton.setAttribute('aria-expanded', opened ? 'true' : 'false');
  });
}

// [앵커 링크 수집] href가 #으로 시작하는 링크를 모두 찾습니다. 예: #about, #services
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
  // [각 링크에 클릭 이벤트 등록]
  anchor.addEventListener('click', function (event) {
    // [이동 대상 찾기] href 값(예: #about)과 같은 id를 가진 요소를 찾습니다.
    const target = document.querySelector(this.getAttribute('href'));
    // [안전 장치] 대상이 없으면 함수 실행을 중단합니다.
    if (!target) return;

    // [기본 점프 동작 막기] 브라우저 기본 순간 이동을 막고,
    event.preventDefault();
    // [부드러운 이동 실행] 원하는 섹션으로 천천히 이동합니다.
    target.scrollIntoView({ behavior: 'smooth' });

    // [모바일 메뉴 자동 닫기] 메뉴를 누른 뒤 섹션 이동했으면 메뉴를 닫아 화면을 깔끔하게 유지합니다.
    if (mobileMenu) {
      mobileMenu.classList.remove('active');
      // [접근성 상태 동기화] 메뉴 닫힘 상태를 aria-expanded=false로 맞춥니다.
      menuButton && menuButton.setAttribute('aria-expanded', 'false');
    }
  });
});

// [맨 위 버튼 찾기] class="to-top" 버튼을 찾아 저장합니다.
const toTopButton = document.querySelector('.to-top');

// [스크롤 이벤트 등록] 사용자가 화면을 스크롤할 때마다 실행됩니다.
window.addEventListener('scroll', function () {
  // [안전 장치] 버튼이 없으면 중단합니다.
  if (!toTopButton) return;
  // [표시/숨김 조건] 240px보다 많이 내렸을 때만 버튼이 보이도록 show 클래스를 제어합니다.
  toTopButton.classList.toggle('show', window.scrollY > 240);
});

// [클릭 시 맨 위 이동] 버튼을 누르면 페이지 최상단(top:0)으로 부드럽게 이동합니다.
if (toTopButton) {
  toTopButton.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}
