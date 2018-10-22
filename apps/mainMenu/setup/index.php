  <?php
  $title="WarningSystem";
//  $subtitle=ucfirst(current_user('name')." ".current_user('surname'));
  $subtitle='SETUP';
  load_fun('msg');
  ?>
    <link rel="stylesheet" href="<?php print site_url("system/template/AdminLTE/plugins/iCheck/all.css",true); ?>">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <?php 
                for($i=0;$i<7;$i++){
                    if($i==0){
                        print'<li class="active"><a href="#updateData'.$i.'" data-toggle="tab">แก้ไขช่องข้อมูลที่ '.($i+1).'</a></li>';
                    }else{
                        print'<li><a href="#updateData'.$i.'" data-toggle="tab">แก้ไขช่องข้อมูลที่ '.($i+1).'</a></li>';
                    }
                }
              ?>
<!--              <li class="active"><a href="#updateData" data-toggle="tab">แก้ไขข้อมูล</a></li>
              <li><a href="#userPicture" data-toggle="tab">รูปประจำตัว</a></li>-->
            </ul>
            <div class="tab-content">
            <?php for($i=0;$i<7;$i++){if($i==0)$strClass='active tab-pane';else $strClass='tab-pane';?>
              <div class="<?php print $strClass;?>" id="updateData<?php print $i;?>">
                <!--<form class="form-horizontal">-->
                <form id="updateDataForm<?php print $i;?>" action="<?php print site_url("ajax/mainMenu/function/confirmOTP"); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <h4 style="text-align: center">TagID : <?php print ($i+1);?></h4>
                        <input type="hidden" class="form-control" id="inputTag" name="tagID" value="<?php print $i+1?>">
                        <input type="hidden" class="form-control" id="inputConfirm" name="isConfirm" value="<?php print getMsg('isConfirm',$i+1);?>">
                    </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">หมายเลขโทรศัพท์</label>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputPhone" name="phoneNo" placeholder="หมายเลขโทรศัพท์" value="<?php print getMsg('mobile',($i+1));?>">
                    </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="chkSMS<?php print $i;?>" name="chkSMS<?php print $i;?>" class="flat-red"<?php
                            if (getMsg('isSentSMS',$i+1)== '1')
                                print " checked";
                            ?>><?php print "  ";?>
                            <label for="sms" class="control-label">  ส่ง SMS แจ้งเตือน</label>
                        </div>
                  </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">อีเมล</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="อีเมล" value="<?php print getMsg('email', ($i+1))?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="chkEmail<?php print $i;?>" name="chkEmail<?php print $i;?>" class="flat-red"<?php
                            if (getMsg('isSentEmail',$i+1) == '1')
                                print " checked";
                            ?>><?php print "  ";?>
                            <label for="email" class="control-label">  ส่งอีเมล์แจ้งเตือน</label>
                        </div>
                    </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">ข้อความ</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" style="height: 300px" id="inputMsg" name="msg" placeholder="ข้อความภาษาไทยจำนวนไม่เกิน 50 ตัวอักษร หรือ ข้อความภาษาอังกฤษจำนวน 140 ตัวอักษร หรือ ข้อความภาษาไทยและภาษาอังกฤษจำนวน 50 ตัวอักษร"><?php if(getMsg('msg',($i+1)))print getMsg('msg',($i+1));?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-9">
                      <button type="submit" class="btn btn-danger">บันทึก</button><span id="updateMessage"></span>
                    </div>
                  </div>
                  </form>
                  </div> 
              <!-- /.tab-pane -->
            <?php }?>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>

<!--<script>
  $(document).ready(function () {
    $("#message").empty();
    $('#loading').hide();
  });
                  
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
$('#loading').show();
$.ajax({
url: "<?php print site_url('ajax/home/profile/uploadProfilePicture/'); ?>", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$("#message").html(data);
}
});
return false;
}));
//$("#updateData").ajaxForm({url: '<?php print site_url('ajax/home/profile/update/'); ?>', type: 'post'});

// Function to preview image after validation
$(function() {
$("#profilePicture").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
if(!file){

$('#previewing').attr('src','<?php print site_url('pictures/profile/noimage.png',true); ?>');

    
}else{
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];

if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','<?php print site_url('pictures/profile/noimage.png',true); ?>');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);

}
}
});
});
function imageIsLoaded(e) {
      $("#profilePicture").css("color","green");
      $('#image_preview').css("display", "block");
      $('#previewing').attr('src', e.target.result);
      $('#previewing').attr('width', '160px');
    };
  
</script>-->
<?php for($i=0;$i<7;$i++){?>
<script>
$( "#updateDataForm<?php print $i;?>" ).submit(function( event ) {
  event.preventDefault();
  var $form = $( this ),
    inputTag = $form.find( "input[name='tagID']" ).val(),
    inputPhone = $form.find( "input[name='phoneNo']" ).val(),
    inputEmail = $form.find("input[name='email']").val(),
    inputMsg = $form.find("textarea[name='msg']").val(),
//    chkSMS=$form.find("input[name='chkSMS']").val(),
//    chkEmail=$form.find("input[name='chkEmail']").val(),
    chkSMS = $('#chkSMS<?php print $i;?>').is(':checked')? $form.find( "input[name='chkSMS<?php print $i;?>']" ).val():false,
    chkEmail = $('#chkEmail<?php print $i;?>').is(':checked')? $form.find( "input[name='chkEmail<?php print $i;?>']" ).val():false,
    inputConfirm=$form.find("input[name='isConfirm']").val(),
    url = $form.attr( "action" );
    //alert(inputMobile);
  var posting = $.post( url, {isConfirm:inputConfirm, tag: inputTag, phone: inputPhone, email : inputEmail, msg : inputMsg, chkSMS:chkSMS,chkEmail:chkEmail} );
  posting.done(function( data ) {
    //$( "#result" ).empty().append( data );
    showUpdate(data);
  });
});
</script>
<?php }?>

<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js",true); ?>"></script>
        <script>
    
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
    function showUpdate(txt){
      $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
                +txt+
                '</b></div>');
    }
  </script>