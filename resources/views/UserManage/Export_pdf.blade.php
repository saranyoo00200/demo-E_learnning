<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        table{
          width:100%;
          border-collapse: collapse;
          border: 1px solid black;
        }
        td,th{
          border:1px solid;
          padding: 5px;

        }
    </style>
</head>
<body>
<div align="center"><b>
  ข้อมูลผู้ใช้งาน กลุ่ม <?php if ($user_type == 1): ?>
    เจ้าหน้าที่
  <?php elseif($user_type == 2): ?>
    ผู้ใช้บริการ
  <?php elseif($user_type == 3): ?>
    ครู
  <?php elseif($user_type == 4): ?>
    นักเรียน
  <?php else: ?>
    เลือกทั้งหมด
  <?php endif; ?>
  </b>
</div>
<br>
<table>
  <tr>
    <th>ลำดับ</th>
    <th>Username</th>
    <th>ชื่อ-นามสกุล</th>
    <th>อีเมล</th>
    <th>สถานะ</th>
    <th>ประเภทผู้ใช้งาน</th>
  </tr>
  <?php if (sizeof($users) ): ?>
    <?php $i=1; foreach ($users as $key => $value): ?>
      <tr>
        <td align="center">{{ $i++ }}</th>
        <td align="center">{{ $value->username }}</td>
        <td align="center">{{ $value->name }}</td>
        <td align="center">{{ $value->email }}</td>
        <td align="center"><?php if ($value->user_status == 1): ?>
          ใช้งาน
        <?php else: ?>
          ไม่ใช้งาน
        <?php endif; ?>
       </td>
        <td align="center"><?php if ($value->user_type == 1): ?>
          เจ้าหน้าที่
        <?php elseif($value->user_type == 2): ?>
          ผู้ใช้บริการ
        <?php elseif($value->user_type == 3): ?>
          ครู
        <?php elseif($value->user_type == 4): ?>
          นักเรียน
        <?php else: ?>
          -
        <?php endif; ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="6" align="center">ไม่พบข้อมูล</td>
    </tr>
  <?php endif; ?>
</table>
</body>
</html>
