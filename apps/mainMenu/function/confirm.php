<?php
  $title="OTP SMS";
  $subtitle="ยืนยันหมายเลขโทรศัพท์ผู้รับข้อความ";
  $save=$_SESSION['SMS']['isSave'];
  $sent=$_SESSION['SMS']['isSent'];
//  print_r($_POST);
//  print_r($_SESSION['OTP']);
  load_fun("thaibulk");
  
  if($_POST['OTP']&&$_POST['OTP_secret']){
  	$OTP_secret=$_POST['OTP_secret']-1111;
  	if($_POST['OTP']==$OTP_secret){
  		print "บันทึกข้อมูลเรียบร้อยแล้ว";
//  		print_r($_POST);
                $chkSMS=$_POST['chkSMS'];
                if($chkSMS=='on')$chkSMS='1';
                else $chkSMS='0';
                $chkEmail=$_POST['chkEmail'];
                if($chkEmail=='on')$chkEmail='1';
                else $chkEmail='0';
  		$save=1;
  		$message="คุณได้ลงทะเบียนเป็นผู้รับข้อความของ ".
  		current_user('name').' '.current_user('surname')
  		." เรียบร้อยแล้ว";
  		$msgData=selectTb('msgData','*',' tagID="'.$_POST['tag'].'" and user_id="'.current_user('user_id').'" limit 1');
  		$uData=array('isConfirm'=>"1",'isSentSMS'=>'"'.$chkSMS.'"','isSentEmail'=>'"'.$chkEmail.'"','mobile'=>'"'.$_POST['phone'].'"','email'=>'"'.$_POST['email'].'"','msg'=>'"'.$_POST['msg'].'"');
  		$iData=array('isConfirm'=>"1",'isSentSMS'=>'"'.$chkSMS.'"','isSentEmail'=>'"'.$chkEmail.'"','tagID'=>'"'.$_POST['tag'].'"','mobile'=>'"'.$_POST['phone'].'"','email'=>'"'.$_POST['email'].'"','msg'=>'"'.$_POST['msg'].'"','user_id'=>'"'.current_user('user_id').'"');
  		if(count($msgData))updateTb('msgData',$uData,'tagID="'.$_POST['tag'].'" and user_id="'.current_user('user_id').'" limit 1');
                elseif(!count($msgData))insertTb('msgData',$iData);
                unset($_SESSION['OTP']);
                unset($_SESSION['SMS']);
                redirect('main/mainMenu/dashboard/index',false,3);
//  		send_sms("Member",array($_POST['phone']),$message,1);
                
//  		exit();
  	}else{
            print 'คุณใส่รหัส OTP ไม่ถูกต้อง โปรดตรวจสอบ!';
            $save=1;
            redirect('main/mainMenu/function/confirm',false,3);
        }
  	
  }
  
  if(!$save){
        $OTP=$_SESSION['OTP']['OTP'];
  	if(!$sent){
            $OTP=rand ( 1000 , 9999 );
            $_SESSION['OTP']['OTP']=$OTP;
            $message="รหัสยืนยันหมายเลขโทรศัพท์ (OTP) คือ ".$OTP;
            if(!isset($_SESSION['OTP']))$to=$_POST['phone'];
            else $to=$_SESSION['OTP']['phone'];
          send_sms("Member",array($to),$message,1);
//          print $message;
            $_SESSION['SMS']['isSent']=1;
        }
  
  ?>
   <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ยืนยันการแก้ไขหมายเลข
              <?php if(!isset($_SESSION['OTP']))print $_POST['phone'];
                    else print $_SESSION['OTP']['phone'];
              ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="confirmOTP" action="<?php print site_url("ajax/mainMenu/function/confirm"); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              
                <div class="form-group input-group input-group-lg">
                  <label class="col-md-4 control-label">รหัส OTP
                  <?php 
//                  print $message; 
                  ?></label>
                  <?php if(!isset($_SESSION['OTP'])){?>
                    <div class="col-md-8"><input id="OTP" type="text" class="col-sm-4 form-control" name="OTP" placeholder="OTP :"></div>
                  <input type="hidden" class="form-control" name="OTP_secret" value="<?php print ($OTP+1111)?>">
                  <input type="hidden" class="form-control" name="phone" value="<?php print $_POST['phone']; ?>">
                  <input type="hidden" class="form-control" name="tag" value="<?php print $_POST['tag']; ?>">
                  <input type="hidden" class="form-control" name="email" value="<?php print $_POST['email']; ?>">
                  <input type="hidden" class="form-control" name="msg" value="<?php print $_POST['msg']; ?>">
                  <input type="hidden" class="form-control" name="chkSMS" value="<?php print $_POST['chkSMS']; ?>">
                  <input type="hidden" class="form-control" name="chkEmail" value="<?php print $_POST['chkEmail']; ?>">
                  <?php }else{?>
                  <div class="col-md-8"><input id="OTP" type="text" class="col-sm-4 form-control" name="OTP" placeholder="OTP :"></div>
                  <input type="hidden" class="form-control" name="OTP_secret" value="<?php print ($OTP+1111)?>">
                  <input type="hidden" class="form-control" name="phone" value="<?php print $_SESSION['OTP']['phone']; ?>">
                  <input type="hidden" class="form-control" name="tag" value="<?php print $_SESSION['OTP']['tag']; ?>">
                  <input type="hidden" class="form-control" name="email" value="<?php print $_SESSION['OTP']['email']; ?>">
                  <input type="hidden" class="form-control" name="msg" value="<?php print $_SESSION['OTP']['msg']; ?>">
                  <input type="hidden" class="form-control" name="chkSMS" value="<?php print $_SESSION['OTP']['chkSMS']; ?>">
                  <input type="hidden" class="form-control" name="chkEmail" value="<?php print $_SESSION['OTP']['chkEmail']; ?>">
                  <?php }?>
                </div>
                
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-9">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">บันทึก</button><span id="save"></span>
                    </div>
                  </div>
            </form>
              </div>
              <!-- /.box-body -->
             </div>
    </div>
    <?php
  }
    ?>

<script>
$( "#confirmOTP").submit(function( event ) {
  event.preventDefault();
  var $form = $( this ),
    inputOTP=$form.find("input[name='OTP']").val(),
    inputOTPSecret=$form.find("input[name='OTP_secret']").val(),
    inputTag = $form.find( "input[name='tag']" ).val(),
    inputPhone = $form.find( "input[name='phone']" ).val(),
    inputEmail = $form.find("input[name='email']").val(),
    inputMsg = $form.find("input[name='msg']").val(),
    chkSMS=$form.find("input[name='chkSMS']").val(),
    chkEmail=$form.find("input[name='chkEmail']").val(),
    url = $form.attr( "action" );
    //alert(inputMobile);
  var posting = $.post( url, {OTP:inputOTP,OTP_secret:inputOTPSecret, tag: inputTag, phone: inputPhone, email : inputEmail, msg : inputMsg, chkSMS:chkSMS,chkEmail:chkEmail} );
  posting.done(function( data ) {
    //$( "#result" ).empty().append( data );
    showUpdate(data);
  });
});

    function showUpdate(txt){
      $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
                +txt+
                '</b></div>');
    }
</script>
           
<?php // unset($_SESSION['OTP']);?>