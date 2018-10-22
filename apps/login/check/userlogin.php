<?php
  //print_r($_POST);
  load_fun('user');
//  print_r($_POST);
  $username=trim($_POST['username']);
  $password=md5(trim($_POST['password']));
  $data=selectTb('userdata','*','username="'.$username.'" AND password="'.$password.'" limit 1');
  if(!count($data)){
      $data=selectTb('userdata','*','email="'.$username.'" and password="'.$password.'" limit 1');
      if(!count($data)){
          print 'ชื่อผู้ใช้และ/หรือรหัสผ่านไม่ถูกต้อง'; redirect("signin/login/form/regular",false,5);
      }else{
          $userdata=$data[0];
          signInUser($userdata['user_id'],$_POST['remember_login']);
      }
  }else{
    $userdata=$data[0];
    signInUser($userdata['user_id'],$_POST['remember_login']);
  }
  //print_r($_COOKIE);