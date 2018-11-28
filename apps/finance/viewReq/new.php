<?php
    $listData=selectTb('req_material','*','isApprove="0"');
    foreach($listData as $r=>$k){
      $req_user_id=($k['req_user_id']);
      $n=selectTb('userdata','title,name,surname','user_id="'.$req_user_id.'"');
      $n=$n[0];
      $fullName=$n['title'].$n['name'].' '.$n['surname'];
        $box.='
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>'.number_format($k['total_cost'],2,'.',',').'</h3>
              <p>'.$fullName.'</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="'.site_url('main/finance/viewReq/index/id/').$k['id'].'" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        ';
    }
    print $box;
?>