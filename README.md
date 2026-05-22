# KOREA IT 공식 홈페이지 수정 가이드 (코딩 초보자용)

> 이 문서는 **코딩 경험이 거의 없는 사용자**가 직접 홈페이지를 관리할 수 있도록 만든 실무용 안내서입니다.

## 1) 홈페이지 파일 구조 설명

```text
koreait-homepage/
├─ index.html                # 한국어 메인 페이지
├─ ja/
│  └─ index.html             # 일본어 페이지
├─ notice/
│  ├─ index.html             # 공고 목록 페이지(자동 목록 렌더링)
│  ├─ sample-notice.html     # 공고 상세 예시 페이지(복사용 템플릿)
│  └─ notice-data.js         # 공고 목록 데이터 배열
├─ css/
│  └─ style.css              # 전체 디자인/레이아웃/배경 설정
├─ js/
│  └─ main.js                # 모바일 메뉴, 부드러운 스크롤, 맨 위 버튼
├─ assets/
│  ├─ logo-horizontal.svg
│  ├─ logo-stacked.svg
│  ├─ symbol.svg
│  ├─ wordmark.svg
│  ├─ favicon.svg
│  ├─ images/
│  │  └─ hero-bg.jpg         # (선택) 첫 화면 배경 사진
│  └─ notices/
│     └─ sample-notice.pdf   # 공고 첨부 PDF 예시
└─ README.md
```

## 2) 메인 문구 수정 방법 (한국어)
1. `index.html` 파일을 엽니다.
2. 첫 화면 문구는 `hero` 섹션의 `h1`, `p`를 수정합니다.
3. 회사소개/서비스/ERP/기술자산/일하는 기준/문의 섹션도 같은 방식으로 텍스트를 수정합니다.
4. 저장 후 GitHub에 푸시하면 Pages 반영 후 확인할 수 있습니다.

## 3) 서비스 항목 수정 방법
1. `index.html`에서 `id="services"`를 찾습니다.
2. `article class="card"` 블록이 6개 있으며 각 카드의 `h3`(제목), `p`(설명)을 바꾸면 됩니다.
3. 카드 개수를 바꾸려면 같은 형식의 `article`을 복사/삭제하면 됩니다.

## 4) 연락처 수정 방법
1. `index.html`에서 `id="contact"`를 찾습니다.
2. 회사명, 이메일, 전화, 모바일, 웹사이트, 주소를 실제 정보로 수정합니다.
3. 전화 링크(`tel:`), 이메일 링크(`mailto:`)도 함께 수정하세요.

## 5) 배경사진 바꾸는 방법
1. 원하는 배경사진을 준비합니다.
2. 파일명을 `hero-bg.jpg`로 변경합니다.
3. `assets/images/` 폴더에 넣습니다.
4. 기존 `hero-bg.jpg`가 있으면 교체합니다.
5. 권장 크기는 가로 1920px 이상입니다.
6. 저작권 문제가 없는 직접 촬영 사진 또는 라이선스 확인된 이미지만 사용하세요.

> 참고: `hero-bg.jpg`가 없어도 홈페이지는 깨지지 않으며, CSS 기본 패턴 배경이 표시됩니다.

## 6) 일본어 페이지 수정 방법
1. `ja/index.html` 파일을 엽니다.
2. 한국어 `index.html`과 섹션 구조가 같으므로 같은 위치의 일본어 문구를 수정하면 됩니다.
3. 일본어 페이지 로고 경로는 `../assets/logo-horizontal.svg` 입니다.
4. 일본어 페이지 이미지 경로는 한 단계 위로 올라가는 `../` 경로를 사용합니다.

## 7) 공고 추가 방법 (가장 중요)
1. `notice/sample-notice.html` 파일을 복사합니다.
2. 파일명을 `날짜-영문제목.html` 형식으로 바꿉니다.
   - 예: `2026-06-01-establishment.html`
3. 복사한 HTML 파일 안에서 공고 제목, 게시일, 본문을 수정합니다.
4. 첨부파일이 있으면 PDF 파일을 `assets/notices/` 폴더에 업로드합니다.
5. `notice/notice-data.js` 파일을 엽니다.
6. `notices` 배열에 새 공고 항목을 추가합니다.
7. `title`, `date`, `url`, `attachment` 값을 수정합니다.
8. 첨부파일이 없으면 `attachment: ""` 로 둡니다.

예시:

```js
{
  title: "제1기 결산공고",
  date: "2026.12.31",
  url: "2026-12-31-financial-statement.html",
  attachment: "../assets/notices/2026-12-31-financial-statement.pdf"
}
```

## 8) 공고 운영 시 주의사항
- GitHub Pages에서는 웹 화면에서 직접 글쓰기와 파일 업로드를 할 수 없습니다.
- 공고 추가는 **HTML 파일 + notice-data.js** 수정 방식입니다.
- 공고 PDF는 `assets/notices/`에 직접 업로드해야 합니다.
- 공고 삭제 전에는 법적 보관 필요성을 먼저 확인하세요.

## 9) 이미지 교체 방법
1. 일반 이미지는 `assets/images/`에 업로드합니다.
2. 해당 이미지를 사용하는 HTML의 `src`를 새 파일명으로 바꿉니다.
3. 일본어 페이지에서는 경로가 `../assets/images/...` 형태인지 확인하세요.

## 10) 로고 교체 방법
1. `assets/logo-horizontal.svg`, `assets/logo-stacked.svg`, `assets/symbol.svg` 파일을 공식 파일로 교체합니다.
2. HTML에서 로고를 텍스트로 직접 만들지 않습니다.
3. CSS는 `width`만 조정하고 `height: auto`를 유지합니다.

## 11) 웹호스팅/깃허브 업로드 방법
1. 수정한 파일을 저장합니다.
2. Git에 커밋하고 원격 저장소에 푸시합니다.
3. GitHub Pages 반영(보통 수십 초~수분) 후 사이트를 새로고침해서 확인합니다.

## 12) 수정 전 백업 방법
1. 전체 폴더를 복사해 `koreait-homepage-backup-날짜` 형태로 저장합니다.
2. 중요한 수정 전에는 반드시 백업본을 남겨두세요.
3. 문제 발생 시 백업본으로 즉시 복원할 수 있습니다.
