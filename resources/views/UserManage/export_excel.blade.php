<?php 
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
 ?>
 <style type="text/css">
     th, td {
    padding: 8px;
    font-size:16px;
    }
 </style>
<table width="100">
    <thead>
        <tr>
            <th colspan="6">
                ข้อมูลผู้ใช้งาน กลุ่ม
                <?php if ($user_type == 1): ?>
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
            </th>
        </tr>
        <tr>
            <th align="center">ลำดับ</th>
            <th align="center">Username</th>
            <th align="center">ชื่อ-นามสกุล</th>
            <th align="center">อีเมล</th>
            <th align="center">สถานะ</th>
            <th align="center">ประเภทผู้ใช้งาน</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($Users as $key => $value): ?>
        <tr>
            <td align="center">{{ $i++ }}</td>
            <td align="center">{{ $value->username }}</td>
            <td align="center" style="padding: 5px;">{{ $value->name }}</td>
            <td align="center">{{ $value->email }}</td>
            <td align="center">
                <?php if ($value->user_status == 1): ?>
                ใช้งาน
                <?php else: ?>
                    ไม่ใช้งาน
                <?php endif; ?>
            </td>
            <td align="center">
            <?php if ($value->user_type == 1): ?>
            เจ้าหน้าที่
            <?php elseif($value->user_type == 2): ?>
            ผู้ใช้บริการ
            <?php elseif($value->user_type == 3): ?>
            ครู
            <?php elseif($value->user_type == 4): ?>
            นักเรียน
            <?php else: ?>
            -
            <?php endif; ?>
            </td>
        </tr>  
        <?php endforeach ?>
    </tbody>
</table>
