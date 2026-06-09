# KOREA IT 공식 홈페이지 1차 제작본

이번 1차 작업은 순수 HTML/CSS/JavaScript 기반의 기본 홈페이지입니다.
PHP 전자공고 게시판과 일본어 페이지는 이번 단계에서 만들지 않았으며, 2차 작업에서 별도로 연결할 예정입니다.

## 1. 파일 구조

```text
/
├─ index.html
├─ about/index.html
├─ services/index.html
├─ erp/index.html
├─ assets-page/index.html
├─ contact/index.html
├─ css/style.css
├─ js/main.js
└─ assets/
```

## 2. 메뉴 구조

모든 페이지 상단 메뉴는 아래 순서입니다.

```text
Home / 회사소개 / 서비스 / 운영 가능한 ERP / 기술자산 / 공고 / 문의
```

공고 링크는 2차 작업을 위한 준비 링크입니다.

- 메인 페이지: `#notice-ready`
- 하위 페이지: `../index.html#notice-ready`

현재는 `notice/` 폴더와 PHP 게시판을 만들지 않았습니다. 공고 메뉴는 메인 페이지의 “전자공고 준비 안내” 영역으로 이동합니다.

## 3. 메인 페이지 역할

`index.html`은 긴 설명 페이지가 아니라 첫인상 중심의 관문 페이지입니다.

포함 내용:

1. Hero 첫 화면
2. 핵심 메시지 3개
3. 대표 서비스 요약
4. ERP 강조 섹션
5. 1997년부터 이어온 신뢰 요약
6. 전자공고 준비 안내
7. 문의 CTA

자세한 설명은 아래 상세 페이지로 이동합니다.

- 회사소개: `about/index.html`
- 서비스: `services/index.html`
- ERP: `erp/index.html`
- 기술자산: `assets-page/index.html`
- 문의: `contact/index.html`

## 4. 로고와 브랜드 자산 주의사항

`assets/` 폴더의 기존 로고 파일을 그대로 사용합니다.

금지:

- 로고 색상 변경
- 로고 회전
- 로고 그림자 추가
- 로고 비율 왜곡
- 새 로고 생성

## 5. CSS 수정 방법

전체 디자인은 `css/style.css`에서 관리합니다.

브랜드 색상 변수:

```css
--color-red: #DC2832;
--color-blue: #0F4B9B;
--color-dark: #1E1E23;
--color-mid: #5A5A5F;
--color-light: #8C8C91;
--color-bg: #FFFFFF;
--color-bg-soft: #F6F7F9;
--color-border: #E5E7EB;
```

Red/Blue는 버튼, 숫자, 짧은 강조 정도에만 사용하세요.

## 6. JavaScript 기능

`js/main.js`는 두 가지 기능만 담당합니다.

1. 모바일 메뉴 열기/닫기
2. 맨 위로 이동 버튼

React, Next.js, Vue, WordPress는 사용하지 않습니다.

## 7. 확인 방법

정적 서버 또는 브라우저에서 아래 파일을 확인합니다.

```text
index.html
about/index.html
services/index.html
erp/index.html
assets-page/index.html
contact/index.html
```

확인 체크리스트:

- 루트 `index.html`이 새 메인 페이지로 보이는가?
- 기존 단일 페이지형 긴 구조가 남아 있지 않은가?
- 일본어 페이지가 생성되지 않았는가?
- 공고 PHP 게시판이 아직 생성되지 않았는가?
- Home 메뉴가 모든 페이지에 있는가?
- 로고 클릭 시 첫 페이지로 이동하는가?
- 하위 페이지에서 `../css/style.css`, `../js/main.js`, `../assets/logo-horizontal.svg` 경로가 맞는가?
- 모바일 메뉴가 열리고 닫히는가?


## 8. assets 폴더 확인

이번 1차 작업에서는 `assets/` 폴더 안의 파일을 생성, 수정, 삭제하지 않습니다.
로고와 파비콘은 기존 파일을 읽어서 표시만 합니다.

## 9. 2차 작업 계획

2차 작업에서 별도 PR로 전자공고 게시판을 추가합니다.
예정 범위는 PHP 기반 공고 목록, 상세보기, 관리자 작성, 첨부파일 업로드, 데이터 저장 기능입니다.

## 10. PR 변경 파일 허용 목록

이번 1차 PR에서 변경되어도 되는 파일은 아래 9개뿐입니다.

```text
README.md
index.html
about/index.html
services/index.html
erp/index.html
assets-page/index.html
contact/index.html
css/style.css
js/main.js
```

검수 명령:

```bash
git diff --name-only main...HEAD
```

위 결과에 `assets/`, `notice/`, `ja/` 경로가 보이면 1차 작업 범위를 벗어난 것이므로 병합하면 안 됩니다.
