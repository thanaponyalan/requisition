
<?php
//load_fun('statistic');
//load_fun('thai');	
load_fun('box');
load_fun('TinyDB');
  $title="ภาพรวม";
  $subtitle="";
//   $dailySMS=selectTb('msgHist','count(*)','user_id="'.current_user('user_id').'" and via="SMS" and DATE(last_update)=CURDATE()');
//   $dailySMS=$dailySMS[0]['count(*)'];
//   $remainSMS=selectTb('msgData','remainSMS','user_id="'.current_user('user_id').'" and isConfirm=0 limit 1');
//   $remainSMS=$remainSMS[0]['remainSMS'];
//   $monthySMS=selectTb('msgHist','count(*)','user_id="'.current_user('user_id').'" and via="SMS" and MONTH(last_update)="'.date(n).'"');
//   $monthySMS=$monthySMS[0]['count(*)'];
  ?>
  <div id="dashboard">
  <?php
  if($template!="ajax"){
  	print '<div class="callout callout-info">
        <h4>กำลังโหลด</h4>
        ระบบกำลังเรียกข้อมูลสถิติอยู่ โปรดรอสักครู่.. 
        <img src="'.site_url("pictures/images/loading-bar.gif",true).'">
      </div>';
      print ' <script src="'.site_url('system/jQuery/jquery.animateNumber.min.js',true).'"></script>';
  
  }else{
  	if($hGET['update']);// Update เมื่อเรียกจากเบื้องหลังเท่านั้น
  $box_data=array(array(
      "title"=>"ครู",
  						"start_number"=>$_SESSION['old_teacher'],
  						"id"=>"teacher",
  						"end_number"=>'',
  						"color"=>"green",
  						"icon"=>"fa fa-user",
  						"url"=>"",
  						"target"=>""),
  				  array("title"=>"นักเรียน",
  				  		"start_number"=>$_SESSION['old_student'],
  						"id"=>"student",
  						"end_number"=>'',
  						"color"=>"yellow",
  						"icon"=>"fa fa-users",
  						"url"=>site_url("main/userManage/user/stdList/"),
  						"target"=>""),
  				  array("title"=>"ผู้ปกครอง",
  				  		"start_number"=>$_SESSION['old_parent'],
  						"id"=>"parent",
  						"end_number"=>'',
  						"icon"=>"fa fa-mobile",
  						"url"=>"",
  						"target"=>""
  						),
  				  array("title"=>"ผู้บริหาร",
  				  		"start_number"=>$_SESSION['old_director'],
  						"id"=>"director",
  						"end_number"=>'',
  						"color"=>"red",
  						"icon"=>"fa fa-user-secret",
  						"url"=>"",
  						"target"=>""
  						),
  				);
//  print genSmallBox($box_data);
  
  $infoBox_data=array(
  				  array("title"=>"การส่ง SMS ในวันนี้",
  				  		"start_number"=>$_SESSION['old_dailySMS'],
  						"id"=>"dailySMS",
  						"end_number"=>$dailySMS,
  						"color"=>"blue",
  						"icon"=>"fa fa-comment-o",
  						"url"=>site_url("main/userManage/user/stdList/"),
  						"target"=>""),
  				  array("title"=>"การส่ง SMS ในเดือนนี้",
  				  		"start_number"=>$_SESSION['old_mounthySMS'],
  						"id"=>"mounthySMS",
  						"end_number"=>$monthySMS,
  						"color"=>"red",
  						"icon"=>"fa fa-commenting-o",
  						"url"=>"",
  						"target"=>""
  						),
  				  array("title"=>"SMS คงเหลือ",
  				  		"start_number"=>$_SESSION['old_credit'],
  						"id"=>"credit",
  						"end_number"=>$remainSMS,
  						"color"=>"blue",
  						"icon"=>"fa fa-bitcoin",
  						"url"=>"",
  						"target"=>""
  						),
  				);
  
  print genInfoBox($infoBox_data);
  ?>
</div>
<script>
$(document).ready( function() {

	$('#subtitle').text('<?php // $lastUpdate=getStatistic('last_check');
//	print "ข้อมูลล่าสุดเมื่อ ".
//	th_date($lastUpdate)." เวลา ".
//	th_time(substr($lastUpdate,11,8))." น.";
	?>');
});
</script>
         <?php 
  }
         if($template!="ajax"){
         	?>
         <script>
         	$(function() {
    			reloadDashboard(true);

    			function reloadDashboard(nonUpdate) {
    				if(nonUpdate){
       				$("#dashboard").load( "<?php print site_url("ajax/mainMenu/dashboard/index/"); ?>" );
    				}else{
       				$("#dashboard").load( "<?php print site_url("ajax/mainMenu/dashboard/index/update/yes/"); ?>" );
    				}
       				setTimeout(reloadDashboard,1000*15*1);
    				}
			});
         </script>
         <?php
         }else{
         	
         	//print_r($_SESSION);
         }
         
         ?>