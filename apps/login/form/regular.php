<body class="hold-transition login-page">
<!-- jQuery 3 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery/dist/jquery.min.js',true);?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js',true);?>"></script>
<!-- iCheck -->
<script src="<?php print site_url('system/template/AdminLTE/plugins/iCheck/icheck.min.js',true);?>"></script>

    <?php
        $title='ลงชื่อเข้าใช้';
        load_fun('TinyDB');
//        print_r($_COOKIE);
        load_fun("google");
        googleINI();
    ?>

<div class="login-box">
    
  <div class="login-logo">
      <a href="<?php print site_url();?>"><b>
          <?php 
          $siteName_data=getConfig('siteName','*');
          print $siteName_data['detail'];
      ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">ลงชื่อเข้าใช้งาน</p>

    <form action="<?php print site_url('signin/login/check/userlogin/');?>" method="post">
      <div class="form-group has-feedback">
        <input name="username" type="username" class="form-control" placeholder="อีเมล์/ชื่อผู้ใช้">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_login" value="remember"> จดจำการลงชื่อเข้าใช้
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
     /.social-auth-links 

    <a href="#">I forgot my password</a><br>-->
    <hr>
	<?php
	if(get_system_config("activeGoogleOpenID")=='activated'){
	?>
        <a class="btn btn-block btn-social btn-google" href="<?php print genGoogleLinkLogin(); ?>">
                <i class="fa fa-google-plus"></i>ลงชื่อเข้าใช้ด้วย Gmail
        </a>
		<?php
	}
		?>
        <a class="btn btn-block btn-social btn-default" href="<?php print site_url("signin/signup/form/register/"); ?>">
                <i class="fa fa-pencil-square-o"></i>
                ลงทะเบียน
        </a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
