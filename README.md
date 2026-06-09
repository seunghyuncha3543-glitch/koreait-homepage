# KOREA IT 홈페이지 운영 매뉴얼

## 1. 현재 파일 구조
- `index.html`: 첫인상 중심의 메인 페이지입니다.
- `about/index.html`: 회사소개 상세 페이지입니다.
- `services/index.html`: 6대 서비스 안내 페이지입니다.
- `erp/index.html`: 운영 가능한 ERP 상세 페이지입니다.
- `assets-page/index.html`: Universal Excel Parser, OpenClaw 등 기술자산 페이지입니다.
- `contact/index.html`: 문의/연락처 페이지입니다.
- `ja/index.html`: 일본어 소개 페이지입니다.
- `notice/index.php`: 전자공고 목록 공개 페이지입니다.
- `notice/view.php`: 전자공고 상세보기 페이지입니다.
- `notice/admin.php`: 공고 담당자가 제목/내용/첨부파일을 입력하는 관리자 화면입니다.
- `notice/save.php`: 관리자 화면에서 보낸 공고를 저장하는 PHP 처리 파일입니다.
- `notice/data/notices.json`: 공고 데이터가 저장되는 JSON 파일입니다.
- `notice/uploads/`: 업로드 첨부파일이 저장되는 폴더입니다.
- `css/style.css`: 전체 디자인과 반응형 CSS입니다.
- `js/main.js`: 모바일 메뉴, 부드러운 스크롤, 맨 위 버튼 동작입니다.

## 2. 닷홈 업로드 방법
1. 저장소의 모든 파일과 폴더를 닷홈 FTP의 `/hosting/kfh007/html`에 업로드합니다.
2. `notice/data/`와 `notice/uploads/` 폴더가 함께 올라갔는지 확인합니다.
3. PHP 공고 기능은 로컬 Live Server에서는 작동하지 않으므로 닷홈 서버에서 테스트해야 합니다.
4. 업로드 후 `https://www.koreait.net/`에 접속해 메인 페이지를 확인합니다.

## 3. 공고 관리자 접속 주소
- 공개 목록: `https://www.koreait.net/notice/`
- 관리자 작성 화면: `https://www.koreait.net/notice/admin.php`

## 4. 관리자 비밀번호 변경 위치
1. `notice/admin.php` 파일 상단의 `$ADMIN_PASSWORD` 값을 변경합니다.
2. `notice/save.php` 파일 상단의 `$ADMIN_PASSWORD` 값도 같은 값으로 변경합니다.
3. 기본값 `change-this-password`는 실제 운영 전 반드시 바꿔야 합니다.

## 5. 공고 작성 테스트 방법
1. 닷홈 FTP에 전체 파일을 업로드합니다.
2. `/notice/admin.php`에 접속합니다.
3. 관리자 비밀번호를 입력합니다.
4. 제목과 내용을 입력합니다.
5. 저장 버튼을 누릅니다.
6. 저장 후 상세 페이지로 이동하면 성공입니다.
7. `/notice/`로 이동해 목록에 새 공고가 보이는지 확인합니다.

## 6. 첨부파일 업로드 테스트 방법
1. `admin.php`에서 PDF 또는 이미지 파일을 선택합니다.
2. 허용 확장자: `pdf, hwp, hwpx, doc, docx, xls, xlsx, jpg, jpeg, png, zip`.
3. 최대 파일 크기는 20MB입니다.
4. 저장 후 상세 페이지에서 첨부파일 다운로드 버튼이 보이는지 확인합니다.
5. `notice/uploads/` 폴더에 파일이 저장되었는지 확인합니다.

## 7. 로컬 Live Server 주의사항
- HTML/CSS/JS 화면 확인은 Live Server로 가능합니다.
- 하지만 PHP는 Live Server에서 실행되지 않습니다.
- 전자공고 등록/저장/첨부 업로드 기능은 반드시 닷홈 PHP 서버에 업로드 후 테스트하세요.

## 8. 배경/로고/색상 수정 방법
- 배경 이미지는 `assets/images/hero-bg.jpg`로 넣으면 전체 배경에 은은하게 반영됩니다.
- 로고는 `assets/logo-horizontal.svg` 등 기존 공식 파일을 교체하는 방식만 사용하세요.
- 로고에 그림자, 색상 변경, 회전, 왜곡 효과를 넣지 마세요.
- 색상은 `css/style.css` 상단 `:root` 변수에서 수정합니다.

## 9. 실제 운영 전 체크리스트
- 관리자 비밀번호를 변경했는가?
- `/notice/data/notices.json` 파일이 쓰기 가능한가?
- `/notice/uploads/` 폴더에 업로드 파일이 저장되는가?
- 테스트 공고 작성/상세보기/첨부 다운로드가 되는가?
- 상단 메뉴에서 회사소개/서비스/ERP/기술자산/공고/문의/日本語가 이동되는가?
- 모바일 메뉴가 정상 작동하는가?

## 10. 수정 전 백업 방법
1. FTP에서 전체 파일을 내려받아 날짜를 붙여 보관합니다.
2. 큰 수정 전에는 Git 브랜치를 새로 만듭니다.
3. 문제가 생기면 백업본 또는 이전 커밋으로 되돌립니다.
