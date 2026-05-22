/*
  [파일 역할]
  공고 목록 데이터를 모아두는 파일입니다.
  초보자는 이 파일에서 notices 배열만 수정하면 됩니다.
*/

/*
  [공고 목록 수정 파일]
  이 파일은 공고 목록 데이터를 모아두는 곳입니다.
  코딩을 잘 몰라도 아래 notices 배열의 형식만 지키면 공고를 추가할 수 있습니다.

  새로운 공고를 추가하는 방법:
  1) notice/sample-notice.html 파일을 복사해서 새 상세 페이지를 만듭니다.
  2) 아래 배열에 같은 형식으로 객체를 하나 더 추가합니다.
  3) title(제목), date(날짜), url(상세페이지 파일명), attachment(PDF 경로)를 채웁니다.

  항목 설명:
  - title: 공고 제목
  - date: 게시일 (예: 2026.06.01)
  - url: 공고 상세 페이지 경로 (notice 폴더 기준 상대경로)
  - attachment: 첨부 PDF 경로 (없으면 빈 문자열 "")

  첨부파일 PDF 업로드 위치:
  - assets/notices/
*/
const notices = [
  {
    title: "주식회사 코리아아이티 설립 공고",
    date: "2026.06.01",
    url: "sample-notice.html",
    attachment: "../assets/notices/sample-notice.pdf"
  },
  {
    title: "제1기 결산공고",
    date: "2026.12.31",
    url: "2026-12-31-financial-statement.html",
    attachment: "../assets/notices/2026-12-31-financial-statement.pdf"
  },
  {
    title: "정기주주총회 관련 공고",
    date: "2027.03.31",
    url: "2027-03-31-annual-general-meeting.html",
    attachment: ""
  }
];
