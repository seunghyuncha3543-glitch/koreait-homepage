# KOREA IT 공식 홈페이지 수정 가이드 (초보자용)

## 1) 파일 구조
- `index.html`: 한국어 메인 페이지
- `ja/index.html`: 일본어 페이지
- `notice/index.html`: 공고 목록
- `notice/sample-notice.html`: 공고 상세 예시
- `css/style.css`: 전체 디자인
- `js/main.js`: 모바일 메뉴, 스크롤, 맨 위 버튼
- `assets/`: 로고, 이미지, 공고 첨부 파일 보관

## 2) 메인 문구 수정 방법
1. `index.html`을 엽니다.
2. `hero` 섹션의 `h1`과 `p` 문구를 수정합니다.
3. 저장 후 브라우저 새로고침으로 확인합니다.

## 3) 서비스 항목 수정 방법
1. `index.html`에서 `id="services"`를 찾습니다.
2. 각 `article.card`의 제목(`h3`)과 설명(`p`)을 수정합니다.

## 4) 연락처 수정 방법
1. `index.html`에서 `id="contact"`를 찾습니다.
2. 회사명, 이메일, 전화번호, 주소를 원하는 정보로 변경합니다.

## 5) 일본어 페이지 수정 방법
1. `ja/index.html` 파일을 엽니다.
2. 한국어 페이지와 동일한 위치의 일본어 문장을 수정합니다.

## 6) 공고 추가 방법
1. `notice/sample-notice.html` 파일을 복사합니다.
2. 파일명을 `날짜-영문제목.html`로 변경합니다. 예: `2026-06-01-establishment.html`
3. 공고 제목, 게시일, 본문을 수정합니다.
4. `notice/index.html`의 공고 목록에 새 링크를 추가합니다.
5. PDF가 있으면 `assets/notices/`에 넣고 상세 페이지에 링크합니다.

## 7) 이미지 교체 방법
1. 교체할 이미지를 `assets/images/`에 업로드합니다.
2. HTML 파일에서 이미지 경로를 새 파일명으로 바꿉니다.

## 8) 로고 교체 방법
1. `assets/logo-horizontal.svg`, `assets/logo-stacked.svg`, `assets/symbol.svg` 파일을 새 공식 파일로 교체합니다.
2. HTML에서 로고를 텍스트로 다시 작성하지 않습니다.
3. CSS에서는 `width`만 조정하고 `height: auto`를 유지합니다.

## 9) 웹호스팅 업로드 방법
1. 모든 파일을 폴더 구조 그대로 압축합니다.
2. 호스팅 파일 관리자 또는 FTP로 업로드합니다.
3. `index.html`이 루트에 있는지 확인합니다.

## 10) 수정 전 백업 방법
1. 전체 폴더를 복사해 `koreait-homepage-backup-날짜`로 저장합니다.
2. 수정 후 문제가 생기면 백업본으로 복원합니다.

---

## 공식 로고 자산 안내
현재 저장소에는 임시 자리 파일명이 들어가 있습니다. 실제 배포 전 반드시 제공받은 `koreait_brand_assets_extracted.zip`의 공식 로고 파일로 `assets/` 내부 파일을 교체해 주세요.
