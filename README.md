# KOREA IT Homepage

주식회사 코리아아이티(KOREA IT) 공식 홈페이지 소스 저장소입니다.

이 홈페이지는 회사 소개, 서비스 안내, 기술자산 소개, 문의 정보, 전자공고 게시판 운영을 목적으로 제작되었습니다.

---

## 1. 프로젝트 목적

본 홈페이지의 목적은 다음과 같습니다.

* KOREA IT의 회사 정체성 전달
* 1997년부터 이어온 IT 운영 경험 소개
* 기업 IT 운영, 업무 시스템, 데이터 자동화, 보안·백업 등 주요 서비스 안내
* 서비스별 상세 페이지 제공
* 기술자산 소개
* 회사 전자공고 게시판 운영
* 닷홈 웹호스팅 기반의 회사 홈페이지 운영

---

## 2. 홈페이지 운영 방향

현재 홈페이지는 다음 방향으로 정리되었습니다.

* 메인 페이지는 간결하게 유지한다.
* 첫 화면에서는 KOREA IT의 핵심 정체성만 전달한다.
* 서비스 설명은 메인 페이지에 길게 넣지 않고 `services/` 하위 페이지에서 관리한다.
* HISTORY, 즉 회사 연혁은 메인 페이지가 아니라 `about/` 회사소개 페이지에서 관리한다.
* ERP 관련 내용은 별도 최상위 페이지가 아니라 서비스 상세 페이지 중 `업무 시스템 / ERP·MIS` 영역에서 관리한다.
* 공고는 `notice/` 폴더의 PHP 게시판으로 관리한다.
* 일본어 페이지는 현재 운영하지 않는다.
* `assets/` 폴더의 로고와 이미지 파일은 공식 자산으로 보고 임의 수정하지 않는다.

---

## 3. 현재 파일 구조

현재 홈페이지는 아래 구조를 기준으로 운영합니다.

```text
/
├─ index.html
├─ about/
│  └─ index.html
├─ services/
│  ├─ index.html
│  ├─ it-operations/
│  │  └─ index.html
│  ├─ business-system/
│  │  └─ index.html
│  ├─ data-automation/
│  │  └─ index.html
│  ├─ security-backup/
│  │  └─ index.html
│  ├─ ai-automation/
│  │  └─ index.html
│  └─ web-hosting/
│     └─ index.html
├─ assets-page/
│  └─ index.html
├─ contact/
│  └─ index.html
├─ notice/
│  ├─ index.php
│  ├─ view.php
│  ├─ admin.php
│  ├─ save.php
│  ├─ data/
│  │  └─ notices.json
│  └─ uploads/
├─ css/
│  └─ style.css
├─ js/
│  └─ main.js
└─ assets/
```

---

## 4. 주요 페이지 설명

### 4.1 메인 페이지

```text
index.html
```

홈페이지 첫 화면입니다.

역할:

* KOREA IT의 핵심 메시지 전달
* 회사 로고 및 브랜드 인상 제공
* 최근 공고 제목 표시
* 서비스, 회사소개, 문의 페이지로 이동 유도

메인 페이지에는 서비스 설명, ERP 설명, 회사 연혁을 길게 넣지 않습니다.

---

### 4.2 회사소개

```text
about/index.html
```

KOREA IT의 연혁과 회사 방향을 설명합니다.

관리 내용:

* 1997 휴먼PC
* 2005 대한정보
* 2016 코리아아이티
* 2026 주식회사 코리아아이티
* “오래 지켜온 약속이, 내일의 기술이 된다.”
* 가까이에서, 오래, 정확하게

회사 연혁은 메인 페이지가 아니라 이 페이지에서 관리합니다.

---

### 4.3 서비스

```text
services/index.html
```

KOREA IT의 주요 서비스를 안내하는 페이지입니다.

서비스 상세 페이지는 아래처럼 분리되어 있습니다.

```text
services/it-operations/index.html
services/business-system/index.html
services/data-automation/index.html
services/security-backup/index.html
services/ai-automation/index.html
services/web-hosting/index.html
```

서비스 항목:

* 기업 IT 운영 / MSP
* 업무 시스템 / ERP·MIS
* 데이터 자동화
* 보안 / 백업 / 권한 관리
* AI 업무 자동화
* 웹 / 호스팅 / 업무 시스템

ERP 관련 내용은 `services/business-system/index.html`에서 관리합니다.

---

### 4.4 기술자산

```text
assets-page/index.html
```

KOREA IT의 기술자산을 설명하는 페이지입니다.

주요 내용:

* Universal Excel Parser
* OpenClaw
* AI는 의사결정 주체가 아니라 보조 도구
* 모든 산출물은 사람이 검토하고 승인
* 비밀정보 보호 원칙

---

### 4.5 문의

```text
contact/index.html
```

회사 연락처와 문의 정보를 관리합니다.

현재 정보:

```text
회사명: 주식회사 코리아아이티
이메일: help@koreait.net
전화: 051-231-4434
모바일: 010-2858-4582
웹사이트: www.koreait.net
주소: 부산광역시 사상구 새벽로 131
```

---

### 4.6 전자공고

```text
notice/index.php
```

회사 전자공고 목록 페이지입니다.

공고 관련 파일:

```text
notice/index.php
notice/view.php
notice/admin.php
notice/save.php
notice/data/notices.json
notice/uploads/
```

역할:

* `notice/index.php` : 공고 목록
* `notice/view.php` : 공고 상세
* `notice/admin.php` : 공고 등록 관리자 화면
* `notice/save.php` : 공고 저장 처리
* `notice/data/notices.json` : 공고 데이터 저장
* `notice/uploads/` : 첨부파일 저장

주의:

* `notice/index.html`은 만들지 않습니다.
* 공고 목록 대표 파일은 `notice/index.php`입니다.

---

## 5. assets 폴더 사용 원칙

```text
assets/
```

`assets/` 폴더에는 KOREA IT 공식 로고 및 이미지 자산이 들어 있습니다.

운영 원칙:

* `assets/` 폴더의 파일은 임의로 삭제하지 않습니다.
* 로고 파일을 새로 만들지 않습니다.
* 기존 로고를 placeholder 파일로 덮어쓰지 않습니다.
* 로고 색상, 비율, 형태를 임의로 변경하지 않습니다.
* HTML/CSS에서는 기존 assets 파일을 참조만 합니다.

로고 사용 예시:

루트 페이지:

```html
<img src="assets/logo-horizontal-1200.png" alt="KOREA IT">
```

1단계 하위 페이지:

```html
<img src="../assets/logo-horizontal-1200.png" alt="KOREA IT">
```

2단계 하위 페이지:

```html
<img src="../../assets/logo-horizontal-1200.png" alt="KOREA IT">
```

실제 파일명은 현재 `assets/` 폴더에 존재하는 파일명을 기준으로 합니다.

---

## 6. CSS / JS 관리

### CSS

```text
css/style.css
```

공통 디자인과 반응형 스타일을 관리합니다.

포함 영역:

* 브랜드 색상 변수
* 공통 레이아웃
* 헤더
* 모바일 메뉴
* Hero 영역
* 서비스 카드
* 상세 페이지
* 공고 목록
* 문의 영역
* 반응형 미디어쿼리

브랜드 색상 기준:

```css
:root {
  --color-red: #DC2832;
  --color-blue: #0F4B9B;
  --color-dark: #1E1E23;
  --color-mid: #5A5A5F;
  --color-light: #8C8C91;
  --color-bg: #FFFFFF;
  --color-bg-soft: #F6F7F9;
  --color-border: #E5E7EB;
}
```

### JavaScript

```text
js/main.js
```

공통 스크립트를 관리합니다.

주요 기능:

* 모바일 메뉴 열기/닫기
* 맨 위로 이동 버튼
* 메인 페이지 공고 제목 미리보기
* 첫 진입 로고 인트로 애니메이션이 있을 경우 해당 기능 처리

---

## 7. 로컬 확인 방법

VSCode에서 프로젝트 폴더를 열고 Live Server로 확인합니다.

```text
index.html 우클릭
→ Open with Live Server
```

예시 주소:

```text
http://127.0.0.1:5500/index.html
```

주의:

PHP 기반 공고 게시판 기능은 VSCode Live Server에서 정상 작동하지 않을 수 있습니다.
공고 등록, 저장, 첨부파일 업로드 기능은 닷홈 서버에 업로드한 뒤 테스트합니다.

---

## 8. 닷홈 업로드 방법

닷홈 웹호스팅 업로드 위치:

```text
/hosting/kfh007/html
```

업로드 시 프로젝트 폴더 자체를 올리지 말고, 프로젝트 안의 파일과 폴더를 `/html` 안에 직접 업로드합니다.

올바른 구조:

```text
/hosting/kfh007/html/index.html
/hosting/kfh007/html/about/
/hosting/kfh007/html/services/
/hosting/kfh007/html/assets-page/
/hosting/kfh007/html/contact/
/hosting/kfh007/html/notice/
/hosting/kfh007/html/css/
/hosting/kfh007/html/js/
/hosting/kfh007/html/assets/
```

잘못된 구조:

```text
/hosting/kfh007/html/koreait-homepage/index.html
```

---

## 9. 닷홈 확인 주소

메인 페이지:

```text
https://kfh007.dothome.co.kr/
```

회사소개:

```text
https://kfh007.dothome.co.kr/about/
```

서비스:

```text
https://kfh007.dothome.co.kr/services/
```

서비스 상세:

```text
https://kfh007.dothome.co.kr/services/it-operations/
https://kfh007.dothome.co.kr/services/business-system/
https://kfh007.dothome.co.kr/services/data-automation/
https://kfh007.dothome.co.kr/services/security-backup/
https://kfh007.dothome.co.kr/services/ai-automation/
https://kfh007.dothome.co.kr/services/web-hosting/
```

기술자산:

```text
https://kfh007.dothome.co.kr/assets-page/
```

문의:

```text
https://kfh007.dothome.co.kr/contact/
```

공고:

```text
https://kfh007.dothome.co.kr/notice/
```

공고 관리자:

```text
https://kfh007.dothome.co.kr/notice/admin.php
```

---

## 10. 공고 게시판 테스트 방법

닷홈 업로드 후 아래 순서로 테스트합니다.

### 10.1 첨부파일 없이 공고 등록

1. `notice/admin.php` 접속
2. 관리자 비밀번호 입력
3. 공고 제목 입력
4. 공고 내용 입력
5. 첨부파일은 선택하지 않음
6. 저장
7. `notice/index.php`에서 공고 목록 확인
8. 제목 클릭 후 `notice/view.php` 상세 페이지 확인

### 10.2 첨부파일 포함 공고 등록

1. `notice/admin.php` 접속
2. 공고 제목 입력
3. 공고 내용 입력
4. PDF, 이미지, 문서 파일 첨부
5. 저장
6. `notice/index.php`에서 공고 목록 확인
7. `notice/view.php`에서 첨부파일 다운로드 확인

허용 확장자:

```text
pdf, hwp, hwpx, doc, docx, xls, xlsx, jpg, jpeg, png, zip
```

---

## 11. 공고 저장 오류 관련 기록

작업 중 `notice/save.php`에서 `400 Bad Request` 오류가 발생했습니다.

주요 원인 후보:

* `notice/admin.php`의 form 필드 name과 `notice/save.php`의 `$_POST` / `$_FILES` 키 불일치
* form에 `enctype="multipart/form-data"` 누락
* 첨부파일이 필수값처럼 처리됨
* 허용되지 않는 확장자 업로드
* 업로드 파일 크기 제한 초과
* `notice/data/` 또는 `notice/uploads/` 폴더 권한 문제
* `notice/data/notices.json` 생성 또는 쓰기 실패

해결 원칙:

* 제목과 내용만 있으면 저장 가능해야 한다.
* 첨부파일은 선택사항으로 처리한다.
* 첨부파일이 없어도 Bad Request를 내지 않는다.
* 오류 발생 시 원인을 한국어 메시지로 표시한다.
* `data/`, `uploads/`, `notices.json`은 없으면 자동 생성한다.

---

## 12. 현재까지의 주요 작업 기록

### 1차 시안

* 단일 페이지 형태로 회사소개, 서비스, ERP, 기술자산, 문의를 구성
* 한국어/일본어 페이지 시도
* GitHub Pages 및 닷홈 호스팅 테스트
* VSCode + GitHub Desktop + WinSCP 기반 운영 흐름 확인

### 구조 개편

대표 피드백에 따라 아래 방향으로 재정리:

* 첫페이지가 중요하므로 Hero 영역 강화
* 상세 내용은 각 페이지로 분리
* 메인 페이지에서 서비스/ERP/연혁을 길게 나열하지 않도록 정리
* Home 메뉴 추가
* 일본어 페이지는 현재 제외
* 서비스별 상세 페이지 생성

### assets 관련 정리

* Codex가 placeholder 로고를 생성하면서 충돌 발생
* 이후 main 브랜치의 `assets/` 폴더를 공식 자산으로 간주
* `assets/`는 수정하지 않고 HTML/CSS에서 참조만 하는 원칙 확립

### 공고 게시판

* 회사 공고방법을 전자공고로 운영하기 위해 `notice/` 게시판 구성
* PHP 기반 등록/목록/상세/첨부파일 구조 적용
* `notice/save.php` 저장 오류 수정 필요

---

## 13. 수정 시 주의사항

홈페이지 수정 시 다음 원칙을 지킵니다.

* 메인 페이지를 다시 길게 만들지 않습니다.
* Hero 영역에 불필요한 키워드 나열을 넣지 않습니다.
* 상단 메뉴에 일본어 페이지를 넣지 않습니다.
* 상단 메뉴에 별도 ERP 메뉴를 만들지 않습니다.
* ERP 내용은 서비스 상세 페이지에서 관리합니다.
* HISTORY는 회사소개 페이지에서 관리합니다.
* `assets/` 폴더의 로고 파일을 수정하지 않습니다.
* 공고 게시판은 `notice/index.php`를 대표 목록으로 사용합니다.
* `notice/index.html`은 만들지 않습니다.
* README.md에는 주요 변경사항을 기록합니다.

---

## 14. 향후 작업 예정

남은 주요 작업:

* `notice/save.php` Bad Request 오류 완전 해결
* 공고 등록 및 첨부파일 업로드 실사용 테스트
* 실제 도메인 `www.koreait.net` 연결
* 전자공고 페이지 운영 검토
* 모바일 화면 최종 점검
* 회사 정보, 주소, 연락처 최종 검수
* 대표님 피드백 반영 후 정식 오픈

---

## 15. 운영 체크리스트

홈페이지 수정 후 배포 전 확인할 항목:

```text
1. 메인 페이지 로고 정상 표시
2. 상단 메뉴 정상 작동
3. 모바일 메뉴 정상 작동
4. 회사소개 페이지 정상 표시
5. 서비스 페이지 및 서비스 상세 페이지 정상 표시
6. 기술자산 페이지 정상 표시
7. 문의 페이지 정보 정확성 확인
8. 공고 목록 정상 표시
9. 공고 등록 정상 작동
10. 공고 상세 페이지 정상 표시
11. 첨부파일 다운로드 정상 작동
12. 닷홈 업로드 경로 확인
13. 브라우저 강제 새로고침 후 최신 CSS 반영 확인
```

---

## 16. 배포 후 캐시 문제 해결

닷홈에 업로드했는데 예전 화면이 보이면 브라우저 캐시일 수 있습니다.

확인 방법:

```text
Ctrl + Shift + R
```

또는 시크릿 창에서 확인합니다.

필요 시 CSS/JS 링크에 버전 쿼리를 붙입니다.

예시:

```html
<link rel="stylesheet" href="css/style.css?v=20260609">
<script src="js/main.js?v=20260609"></script>
```

하위 페이지에서는 경로에 맞춰 적용합니다.

---

## 17. GitHub 운영 원칙

작업 흐름:

```text
1. VSCode에서 수정
2. Live Server로 로컬 확인
3. GitHub Desktop에서 Commit
4. Push origin
5. 필요 시 PR 생성 및 Merge
6. WinSCP 또는 VSCode SFTP로 닷홈 업로드
7. 닷홈 주소에서 최종 확인
```

주의:

* 충돌 표시인 `<<<<<<<`, `=======`, `>>>>>>>`가 파일에 남아 있으면 merge가 되지 않습니다.
* README.md 충돌이 발생하면 충돌 표시를 제거하고 하나의 정상 문서로 정리합니다.
* `assets/` 파일은 충돌 시 반드시 기존 main 브랜치의 공식 자산을 유지합니다.

---

## 18. 라이선스 및 관리

본 저장소는 주식회사 코리아아이티 공식 홈페이지 운영을 위한 내부 관리용 저장소입니다.
로고, 브랜드 자산, 문구, 이미지의 무단 사용을 금지합니다.
