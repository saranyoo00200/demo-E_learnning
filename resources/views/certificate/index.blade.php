<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNewBold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNewItalic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNewBoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }

        /* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
        @import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Sarabun", sans-serif;
        }

        /* ========= Cards Certificate ========== */
        .outer-border {
            /* width: 210mm; */
            /* min-height: 297mm; */
            /* margin: 10mm auto; */
            padding: 20px;
            text-align: center;
            border: 10px solid #a12c2f;
        }

        .inner-dotted-border {
            padding: 20px;
            text-align: center;
            border: 4px solid #a12c2f;
            border-style: dotted;
        }

        .certification {
            font-size: 30px;
            font-weight: bold;
            color: #663ab7;
        }

        .certify {
            font-size: 25px;
        }

        .name {
            font-size: 30px;
            color: green;
        }

        .fs-30 {
            font-size: 30px;
        }

        .fs-20 {
            font-size: 25px;
        }

    </style>
</head>

<body>
    <div style="margin-top: 1%" class="container">
        <section class="home-section">
            <div class="card">
                <div class="outer-border ml-4 mr-4 mt-4 mb-4">
                    <div class="inner-dotted-border danger">
                        <br>
                        <img width="130px"
                            src="https://cdn.discordapp.com/attachments/841562172697477130/900606438395752478/jigsaw.png"
                            alt="">
                        <br />
                        <span class="certification">บริษัท จิ๊กซอว์ อินโนเวชั่น</span>
                        <span class="certify">ประกาศนียบัตรฉบับนี้ให้เพื่อแสดงว่า</span>
                        <br />
                        @foreach ($user as $item)
                            <span class="name"><b>นาย {{ $item->name }}</b></span><br /><br>
                        @endforeach
                        @foreach ($subject as $value)
                            <span class="certify">ได้ผ่านการเรียนรู้ผ่านสื่ออิเล็กทรอนิกส์ รายวิชา
                                {{ $value->subjectName }}</span>
                        @endforeach
                        <br />
                        @foreach ($day as $d)
                            <span class="fs-30">ให้ ณ วันที่
                                {{ formatDateThai(date($d->graduation_day)) }}</span> <br /><br><br>
                        @endforeach
                        <img width="150px"
                            src="https://cdn.discordapp.com/attachments/841562172697477130/900604154781777951/signature.png"
                            alt="">
                        <br />
                        <span class="certify"><i>( รศ.ดร. วีระพล ทองมา )</i></span><br />
                        <span class="fs-20">อธิการบดีมหาวิทยาลัยแม่โจ้</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
