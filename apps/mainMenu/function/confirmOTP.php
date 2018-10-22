<?php
$_SESSION['OTP']=$_POST;
$_SESSION['SMS']=array('isSent'=>0,'isSave'=>0);
if($_POST['isConfirm']=='1'){
    print "บันทึกข้อมูลเรียบร้อยแล้ว";
    $chkSMS=$_POST['chkSMS'];
    if($chkSMS=='on')$chkSMS='1';
    else $chkSMS='0';
    $chkEmail=$_POST['chkEmail'];
    if($chkEmail=='on')$chkEmail='1';
    else $chkEmail='0';
    $msgData=selectTb('msgData','*',' tagID="'.$_POST['tag'].'" and user_id="'.current_user('user_id').'" limit 1');
    $uData=array('isConfirm'=>"1",'isSentSMS'=>'"'.$chkSMS.'"','isSentEmail'=>'"'.$chkEmail.'"','mobile'=>'"'.$_POST['phone'].'"','email'=>'"'.$_POST['email'].'"','msg'=>'"'.$_POST['msg'].'"');
    $iData=array('isConfrim'=>"1",'isSentSMS'=>'"'.$chkSMS.'"','isSentEmail'=>'"'.$chkEmail.'"','tagID'=>'"'.$_POST['tag'].'"','mobile'=>'"'.$_POST['phone'].'"','email'=>'"'.$_POST['email'].'"','msg'=>'"'.$_POST['msg'].'"','user_id'=>'"'.current_user('user_id').'"');
    if(count($msgData))updateTb('msgData',$uData,'tagID="'.$_POST['tag'].'" and user_id="'.current_user('user_id').'" limit 1');
    elseif(!count($msgData))insertTb('msgData',$iData);
    unset($_SESSION['OTP']);
    unset($_SESSION['SMS']);
    redirect('main/mainMenu/dashboard/index',false,3);
    
}else{
    print 'กำลังนำท่านไปสู่หน้าจอยืนยัน OTP';
    redirect('main/mainMenu/function/confirm',false,3);
}