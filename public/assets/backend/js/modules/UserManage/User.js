$(document).ready(function () {
  $('#username').keyup(function() {
    var username = $(this).val();
    var user_id = $('.section').attr('data-id');
    var rv = true;
  $.ajax({
    type:'POST',
    url:base_url+'/check_username',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:{username:username,user_id:user_id},
    success:function(data){
      console.log(data);
      if (data > 0) {
        swal({
          title: "แจ้งเตือน",
          text: "Username นี้ได้ถูกใช้ไปแล้ว กรุณากรอกใหม่",
          icon: "warning",
          button: "ตกลง",
        });
        $('#username').val('');
        $('#username').focus();
        return rv = false;
      }
    }
  });
  });
  $('#email').keyup(function() {
    var email = $(this).val();
    var user_id = $('.section').attr('data-id');
    var rv = true;
  $.ajax({
    type:'POST',
    url:base_url+'/check_email',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:{email:email,user_id:user_id},
    success:function(data){
      if (data > 0) {
        swal({
          title: "แจ้งเตือน",
          text: "อีเมล นี้ได้ถูกใช้ไปแล้ว กรุณากรอกใหม่",
          icon: "warning",
          button: "ตกลง",
        });
        $('#email').val('');
        $('#email').focus();
        return rv = false;
      }
    }
  });
  });
  $('#submit').click(function() {
  var username = $('#username').val();
  var password = $('#password').val();
  var confirm_password = $('#confirm_password').val();
  var name = $('#name').val();
  var email = $('#email').val();
  var phone = $('#phone').val();
  var user_status = $('#user_status').val();
  var user_type = $('#user_type').val();
  var user_id = $('.section').attr('data-id');
  var username_eng = /^[a-zA-Z]+$/.test(username);
  if (username == '') {
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก Username",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }else if (username_eng == false) {
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก Username เป็นภาษาอังกฤษ",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }else if(name == ''){
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก ชื่อ-นามสกุล",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }else if(email == ''){
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก อีเมล",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }else if(phone == ''){
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก เบอร์โทรศัพท์",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }else if(user_status == ''){
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก สถานะ",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }else if(user_type == ''){
    alert('กรุณากรอก ประเภทผู้ใช้');
    swal({
      title: "แจ้งเตือน",
      text: "กรุณากรอก ประเภทผู้ใช้",
      icon: "warning",
      button: "ตกลง",
    });
    return false;
  }
  else{
    if (user_id == '') {
      if (password == '') {
        swal({
          title: "แจ้งเตือน",
          text: "กรุณากรอก Password",
          icon: "warning",
          button: "ตกลง",
        });
        return false;
      }else if (confirm_password == '') {
        swal({
          title: "แจ้งเตือน",
          text: "กรุณากรอก Confirm Password",
          icon: "warning",
          button: "ตกลง",
        });
        return false;
      }else if (password != confirm_password) {
        swal({
          title: "แจ้งเตือน",
          text: "กรุณากรอก Password กับ Confirm Password ให้ตรงกัน",
          icon: "warning",
          button: "ตกลง",
        });
        return false;
      } else {

      }
    } else {
      if (password != confirm_password) {
        swal({
          title: "แจ้งเตือน",
          text: "กรุณากรอก Password กับ Confirm Password ให้ตรงกัน",
          icon: "warning",
          button: "ตกลง",
        });
        return false;
      }
    }

  }
  });
});
