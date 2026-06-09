# KOREA IT 공식 홈페이지 + 전자공고 운영 매뉴얼

이 저장소는 닷홈 웹루트 `/hosting/kfh007/html`에 그대로 업로드해 사용할 수 있도록 만든 **순수 HTML/CSS/JavaScript/PHP 기반 KOREA IT 공식 홈페이지 완성본**입니다.

## 1. 업로드 후 서버 구조

닷홈 FTP에서 아래 구조가 그대로 보여야 합니다.

```text
/hosting/kfh007/html/index.html
/hosting/kfh007/html/about/index.html
/hosting/kfh007/html/services/index.html
/hosting/kfh007/html/erp/index.html
/hosting/kfh007/html/assets-page/index.html
/hosting/kfh007/html/contact/index.html
/hosting/kfh007/html/ja/index.html
/hosting/kfh007/html/notice/index.php
/hosting/kfh007/html/notice/view.php
/hosting/kfh007/html/notice/admin.php
/hosting/kfh007/html/notice/save.php
/hosting/kfh007/html/notice/data/notices.json
/hosting/kfh007/html/notice/uploads/
/hosting/kfh007/html/css/style.css
/hosting/kfh007/html/js/main.js
/hosting/kfh007/html/assets/logo-horizontal.svg
```

## 2. 페이지 역할

- `index.html`: 첫인상 중심 메인 페이지입니다. 긴 상세 설명을 줄이고 상세 페이지로 이동시키는 관문 역할을 합니다.
- `about/index.html`: 회사소개와 1997년부터 이어온 연혁을 설명합니다.
- `services/index.html`: 6대 대표 서비스 목록을 보여줍니다.
- `erp/index.html`: 운영 가능한 ERP, UAT, Go-Live, 유지보수 흐름을 설명합니다.
- `assets-page/index.html`: Universal Excel Parser, OpenClaw 등 기술자산을 설명합니다.
- `contact/index.html`: 이메일, 전화, 주소 등 문의 정보를 표시합니다.
- `ja/index.html`: 일본어 소개 페이지입니다.
- `notice/index.php`: 전자공고 공개 목록 페이지입니다.
- `notice/view.php`: 전자공고 상세 페이지입니다.
- `notice/admin.php`: 공고 제목/내용/첨부파일을 등록하는 관리자 페이지입니다.
- `notice/save.php`: 공고 저장과 첨부파일 업로드를 처리하는 PHP 파일입니다.

## 3. 닷홈 테스트 주소

업로드 후 아래 주소를 순서대로 확인하세요.

```text
https://kfh007.dothome.co.kr/
https://kfh007.dothome.co.kr/about/
https://kfh007.dothome.co.kr/services/
https://kfh007.dothome.co.kr/erp/
https://kfh007.dothome.co.kr/assets-page/
https://kfh007.dothome.co.kr/contact/
https://kfh007.dothome.co.kr/ja/
https://kfh007.dothome.co.kr/notice/
https://kfh007.dothome.co.kr/notice/admin.php
```

공식 도메인 연결 후에는 같은 경로를 `https://www.koreait.net/` 기준으로 확인하면 됩니다.

## 4. 전자공고 관리자 비밀번호 변경

실제 운영 전 반드시 기본 비밀번호를 변경하세요.

1. `notice/admin.php` 파일 상단의 `$ADMIN_PASSWORD` 값을 변경합니다.
2. `notice/save.php` 파일 상단의 `$ADMIN_PASSWORD` 값도 **같은 값**으로 변경합니다.
3. 기본값 `change-this-password`를 그대로 두면 안 됩니다.

## 5. 공고 등록 테스트 방법

1. 닷홈 FTP에 전체 파일을 업로드합니다.
2. 브라우저에서 `/notice/admin.php`에 접속합니다.
3. 관리자 비밀번호를 입력합니다.
4. 공고 제목을 입력합니다.
5. 공고 내용을 입력합니다.
6. 첨부파일이 있으면 선택합니다.
7. `공고 저장` 버튼을 누릅니다.
8. 저장 후 `/notice/` 목록 페이지로 이동하는지 확인합니다.
9. 목록에서 새 공고 제목을 클릭해 `/notice/view.php?id=...` 상세 페이지가 열리는지 확인합니다.
10. 첨부파일이 있는 경우 다운로드 버튼이 보이고 실제 다운로드되는지 확인합니다.

## 6. 첨부파일 규칙

허용 확장자:

```text
pdf, hwp, hwpx, doc, docx, xls, xlsx, jpg, jpeg, png, zip
```

- 최대 파일 크기: 20MB
- 업로드 위치: `notice/uploads/`
- 원본 파일명은 표시용으로 저장됩니다.
- 실제 저장 파일명은 날짜와 랜덤값을 붙여 저장하므로, 같은 이름의 파일을 올려도 충돌 가능성이 낮습니다.

## 7. GitHub Pages / Live Server 주의사항

- HTML/CSS/JavaScript 화면 확인은 GitHub Pages나 Live Server에서도 가능합니다.
- 하지만 PHP는 GitHub Pages와 Live Server에서 실행되지 않습니다.
- 전자공고 등록, JSON 저장, 첨부파일 업로드 기능은 반드시 닷홈 같은 PHP 지원 서버에서 테스트해야 합니다.

## 8. 로고와 브랜드 자산 주의사항

다음 파일은 공식 로고/브랜드 자산이므로 새로 만들거나 임의로 바꾸지 마세요.

```text
assets/logo-horizontal.svg
assets/favicon.svg
assets/symbol.svg
```

금지 사항:

- 로고 색상 변경 금지
- 로고 그림자 금지
- 로고 왜곡 금지
- 로고 회전 금지
- 임의 SVG 로고 재생성 금지

## 9. 배경/색상 수정 방법

- 배경 이미지는 `assets/images/hero-bg.jpg`로 넣으면 전체 배경에 은은하게 반영됩니다.
- 색상은 `css/style.css` 상단 `:root` 변수에서 관리합니다.
- Red/Blue는 버튼, 숫자, 짧은 강조선 정도에만 제한적으로 사용하세요.
- 홈페이지 분위기는 화이트 중심, 넓은 여백, 신뢰감, 전문성을 기준으로 유지합니다.

## 10. 운영 전 최종 체크리스트

- 루트 `/index.html`이 첫인상 중심 메인 페이지로 보이는가?
- `/about/`, `/services/`, `/erp/`, `/assets-page/`, `/contact/`가 열리는가?
- `/notice/index.html` 파일이 남아 있지 않은가?
- `/notice/`가 `index.php` 전자공고 목록으로 열리는가?
- `/notice/admin.php`에서 제목/내용/첨부파일 등록이 되는가?
- `/notice/data/notices.json`에 저장 데이터가 반영되는가?
- `/notice/uploads/`에 첨부파일이 저장되는가?
- `/notice/view.php?id=...`에서 상세 공고와 첨부파일 다운로드가 되는가?
- 모바일 메뉴가 정상 작동하는가?
- 하위 페이지에서 로고, CSS, JS 경로가 깨지지 않는가?

## 11. 수정 전 백업 방법

1. 닷홈 FTP에서 `/hosting/kfh007/html` 전체를 내려받아 날짜별로 보관합니다.
2. 큰 수정 전에는 Git에서 새 브랜치를 만들어 작업합니다.
3. 문제가 생기면 백업본 또는 이전 커밋으로 되돌립니다.
