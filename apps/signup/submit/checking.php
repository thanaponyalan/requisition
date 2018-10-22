<?php
  $title="เช็คการสมัครสมัครสมาชิก";
  //load_fun('tinyDB');
  //print_r($_POST);
  $username=$_POST['username'];
  $name=$_POST['name'];
  $surname=$_POST['surname'];
  $mobile=$_POST['mobile'];
  $email=$_POST['email'];
  $password=$_POST['password'];

  
   
  load_fun('user');
  $user_data=array(
                    "username"=>$username,
                    "name"=>$name,
                    "surname"=>$surname,
                    "mobile"=>$mobile,
                    "email"=>$email,
                    "password"=>$password,
                    "accession"=>'[]',
                    "active"=>'N',
                    "sid"=>session_id(),
                    'level'=>'3',
                    'totalSMS'=>'200',
                    'remainSMS'=>'200',
                   );
    $userDataEmail=selectTb('userdata','*','email="'.$email.'" limit 1');  
    $userDataUsername=selectTb('userdata','*','username="'.$username.'" limit 1');
    if($userDataEmail||$userDataUsername){
        print "กรุณาใช้\"ชื่อผู้ใช้\" และ/หรือ \"อีเมล์\" อื่น...</br><p>กำลังนำท่านกลับไปสู่หน้าลงทะเบียนใน.. <span id='counter'>5</span> วินาที.</p>";
//        exit();
//        redirect(site_url('signin/signup/form/register'),true,5);
    }else{
        if(add_user($user_data)){
            print "การลงทะเบียนเสร็จสิ้น กรุณาตรวจสอบอีเมล์ของท่านและยืนยันการสมัครสมาชิก ['".$email."']";
            print redirect(site_url('signin/login/form/regular'),true,5);
        }
    }
//if(add_user($user_data)){
//        print "กรุณารอสักครู่";
//
//        print redirect(site_url('signin/login/form/regular'),5);
//}else{
//        
//        print "การสมัครสมาชิกล้มเหลว";
//}

  ?>

<script>
    function countdown() {
        var i = document.getElementById('counter');
        i.innerHTML = parseInt(i.innerHTML)-1;
        if (parseInt(i.innerHTML)==0) {
            location.href = '?p=signin/signup/form/register';
        }
    }
    setInterval(function(){ countdown(); },1000);
</script>