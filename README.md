# KOREA IT 공식 홈페이지 운영 매뉴얼 (코딩 초보자용)

## 1. 파일 구조 설명
- `index.html`: 한국어 메인 페이지
- `ja/index.html`: 일본어 메인 페이지
- `notice/index.html`: 공고 목록 페이지
- `notice/notice-data.js`: 공고 목록 데이터(제목/날짜/링크/첨부파일)
- `notice/sample-notice.html`: 공고 상세 예시 템플릿
- `css/style.css`: 색상, 배경, 반응형, 여백
- `js/main.js`: 모바일 메뉴, 부드러운 스크롤, 맨 위 버튼
- `assets/images/`: 배경 이미지/일반 이미지 저장
- `assets/notices/`: 공고 첨부 PDF 저장

## 2. 배경 이미지 교체 방법
1. 배경 사진을 준비합니다.
2. 파일명을 `hero-bg.jpg`로 맞춥니다.
3. `assets/images/hero-bg.jpg` 위치에 업로드(또는 교체)합니다.
4. 저장 후 페이지를 새로고침합니다.
5. 권장: 가로 1920px 이상, 너무 어둡거나 화려하지 않은 사진.
6. 저작권 문제가 없는 사진만 사용하세요.

> 배경 사진이 없어도 깨지지 않게 CSS 기본 흰색 배경이 함께 설정되어 있습니다.

## 3. 로고 교체 방법
1. `assets/logo-horizontal.svg`, `assets/logo-stacked.svg`, `assets/symbol.svg`를 공식 파일로 교체합니다.
2. HTML에 텍스트로 로고를 다시 쓰지 않습니다.
3. 로고 크기는 `css/style.css`의 `.site-logo img`에서 `width`만 조정하고 `height: auto`를 유지합니다.

## 4. 색상 수정 방법
1. `css/style.css` 상단 `:root`를 찾습니다.
2. `--color-red`, `--color-blue`, `--color-dark` 등 값을 수정합니다.
3. 브랜드 일관성을 위해 Red/Blue는 포인트로만 사용하세요.

## 5. 한국어 문구 수정 방법
1. `index.html`을 엽니다.
2. 수정할 섹션(Hero/회사소개/서비스/문의 등) 문구를 바꿉니다.
3. 저장 후 브라우저에서 확인합니다.

## 6. 일본어 페이지 수정 방법
1. `ja/index.html`을 엽니다.
2. 한국어 페이지와 같은 구조이므로 같은 위치 문구를 수정하면 됩니다.
3. 일본어 페이지 로고 경로는 `../assets/logo-horizontal.svg`입니다.
4. 일본어 페이지 이미지 경로는 `../assets/images/...` 형식입니다.

## 7. 공고 추가 방법
1. `notice/sample-notice.html`을 복사합니다.
2. 파일명을 `2026-06-01-establishment.html` 같은 형식으로 바꿉니다.
3. 복사본에서 제목/게시일/본문/첨부 링크를 수정합니다.
4. PDF가 있으면 `assets/notices/`에 업로드합니다.
5. `notice/notice-data.js`를 열고 `notices` 배열에 항목을 추가합니다.
6. `title`, `date`, `url`, `attachment`를 입력합니다.
7. 첨부파일이 없으면 `attachment: ""`로 둡니다.

## 8. 첨부파일 PDF 추가 방법
1. PDF 파일을 `assets/notices/`에 업로드합니다.
2. 상세 페이지 HTML에 링크를 걸어줍니다.
3. `notice-data.js`의 `attachment`에도 같은 경로를 넣어 목록에서 바로 접근 가능하게 합니다.

## 9. 공고 관리자 기능의 한계와 대안
### GitHub Pages에서 가능한 것
- 정적 HTML/CSS/JS 파일 수정 후 배포
- `notice-data.js` 기반 목록 관리
- PDF 첨부 파일 링크 연결

### GitHub Pages에서 불가능한 것(기본 상태)
- 웹 화면에서 로그인 후 글 작성 저장
- 웹 화면에서 서버 업로드 후 즉시 저장
- DB 기반 관리자 게시판

### 현실적인 대안
1. **정적 방식 유지(현재 구현)**: 가장 단순하고 안정적.
2. **Decap CMS + GitHub 저장소 연동**: GitHub OAuth/백엔드 설정이 필요하며, 설정 후 웹에서 콘텐츠 편집 가능.
3. **별도 백엔드/호스팅 도입**: 관리자 업로드/DB 저장이 필요하면 서버가 있는 구조로 이전 필요.

> 중요: 실제 저장이 안 되는 “가짜 글쓰기 폼”은 만들지 않는 것이 맞습니다.

## 10. GitHub Pages 배포 확인 방법
1. GitHub 저장소에 커밋/푸시합니다.
2. 저장소 Settings → Pages에서 배포 브랜치를 확인합니다.
3. 배포 URL 접속 후 메뉴/배경/공고 링크를 확인합니다.

## 11. merge conflict 발생 시 주의사항
1. `<<<<<<<`, `=======`, `>>>>>>>` 표시를 기준으로 충돌 구간을 찾습니다.
2. 최신 main 내용을 우선 확인합니다.
3. 필요한 변경만 골라 반영하고 충돌 표시를 삭제합니다.
4. 저장 후 다시 충돌 마커가 없는지 검색합니다.

## 12. 수정 전 백업 방법
1. 전체 폴더를 복사해 날짜를 붙여 백업합니다.
2. 큰 수정 전에는 브랜치를 새로 만들어 작업합니다.
3. 문제가 생기면 백업본 또는 이전 커밋으로 복구합니다.
