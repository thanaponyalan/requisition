<?php
    $title='แก้ไขข้อมูลผู้ใช้งาน';
    if(is_numeric($hGET['id'])){
        $userData=selectTb('userdata','*','user_id="'.$hGET['id'].'"');
        $userData=$userData[0];
//        print_r($userData);
    }else{
        exit();
    }
    $picPath='system/pictures/profile/'.$userData['username'].'.png';
    if(!file_exists(BASE_PATH.$picPath))$picPath='system/pictures/profile/noimage.png';
    
?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php print site_url($picPath, true); ?>" alt="User profile picture">

                <h3 class="profile-username text-center"><?php print $userData['name'] . " " . $userData['surname']; ?></h3>
                <?php
                $accession = json_decode($userData['accession']);
                ?>
                <p class="text-muted text-center"><?php
                    print "<b>" . ucfirst($userData['user_type']) . "</b>";
                    ?></p>
                <p class="text-muted text-center">ข้อมูลพื้นฐาน</p>


                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">ชื่อผู้ใช้</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" placeholder="username" value="<?php
                                print $userData['username'];
                                ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="emai" class="col-sm-3 control-label">อีเมล</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="user@example.com" value="<?php
                                print $userData['email'];
                                ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emai" class="col-sm-3 control-label">สถานะ</label> 
                            <div class="col-sm-9" id="showStatus">
                                <?php
                                if ($userData['active'] == ''||$userData['active']=='N') {
                                    print " <a class=\"btn btn-default col-sm-9\" id=\"changeStatus\">"
                                            . "<i class=\"fa fa-hand-stop-o\" id=\"iconStatus\"></i> ยังไม่เปิดใช้"
                                            . "</a>";
                                } else if ($userData['active'] == 'Y') {
                                    print " <a class=\"btn btn-success col-sm-9\" id=\"changeStatus\">"
                                            . "<i class=\"fa fa-thumbs-o-up\" id=\"iconStatus\"></i> เปิดใช้งาน"
                                            . "</a>";
                                } else if ($userData['active'] == 'B') {
                                    print " <a class=\"btn btn-danger col-sm-9\" id=\"changeStatus\">"
                                            . "<i class=\"fa fa fa-hand-stop-o\" id=\"iconStatus\"></i> ปิดกั้น"
                                            . "</a>";
                                }
                                ?>
                            </div>                         
                        </div>
                        <div class="form-group">
                            <label for="emai" class="col-sm-3 control-label">ผู้ดูแลระบบ</label>
                            <div class="col-sm-9">
                                <input type="checkbox" class="flat-red"<?php
                                if ($userData['user_type'] == 'administrator')
                                    print " checked";
                                ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary btn-block"><b>แก้ไขข้อมูล</b></a>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">

        <div class="box box-profile">
            <div class="box-body">
                <h3 class="box-title text-center">สิทธิ์เข้าใช้งานแอปพลิเคชั่น</h3>
                <form id="updateAccession" method="post" action="<?php print site_url("ajax/admin/userManage/updateAccession/id/" . $hGET['id']); ?>">

                    <ul class="list-group list-group-unbordered">
                        <?php
                        $accession = json_decode($userData['accession']);
                        //print_r($accession);
                        $appPath = APP_PATH;
                        $lsResult = array_slice(scandir($appPath), 2);
                        //print_r($lsResult);
                        $i = 0;
                        foreach ($lsResult as $row) {
                            if (!file_exists(APP_PATH . $row . "/menu.php"))
                                continue;
                            if (file_exists(APP_PATH . $row . "/config.php"))
                                continue;
                            ?>
                            <li class="list-group-item">
                                <b><?php print $row; ?></b> <a class="pull-right"><input type="checkbox" id="cb<?php print $row; ?>" name="cb<?php print $row; ?>" value="<?php print $row; ?>" class="flat-red"<?php
                                    if ($accession) {
                                        if (in_array($row, $accession))
                                            print " checked";
                                    }
                                    ?>></a>
                            </li>
                            <?php
                            $biddingVar .= "cb" . $row . " = $('#cb" . $row . "').is(':checked')? \$form.find( \"input[name='cb" . $row . "']\" ).val():false,";
                            if ($i)
                                $bidtoArr .= ",";
                            $bidtoArr .= "cb" . $row;
                            //$transferVar.="accession : cb".$row;
                            $i++;
                        }
                        print($biddingVar);
                        echo '<br>';
                        print($bidtoArr);
                        ?>
                    </ul>
                    <button class="btn btn-danger btn-block">แก้ไขสิทธิ์</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js", true); ?>"></script>
<script>

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

</script>
<script>
    $("#updateAccession").submit(function (event) {
        event.preventDefault();
        var $form = $(this),
<?php
print $biddingVar;
?>accArr = [
<?php
print $bidtoArr;
if ($bidtoArr && $systemAppArr)
    print ",";
print $systemAppArr;
?>
                ],
                url = $form.attr("action");
        //alert(accArr);

        var posting = $.post(url, {accession: accArr});
        posting.done(function (data) {
            //$( "#result" ).empty().append( data );
            showUpdate(data);
        });
    });

    function showUpdate(txt) {
        $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
                + txt +
                '</b></div>');
    }

    $('#changeStatus').click(function () {
        $('#changeStatus').html("<i id='iconStatus'></i>...");
        $('#iconStatus').removeClass().addClass('fa fa-refresh fa-spin');
        //$('#changeStatus').load("<?php print site_url('ajax/admin/userManage/changeStatus/id/' . pq($hGET['id'])); ?>");

        $.getJSON('<?php print site_url('ajax/admin/userManage/changeStatus/id/' . pq($hGET['id'])); ?>', function (data) {
            $.each(data, function (i, field) {
                if (i == 0) {
                    $('#changeStatus').html(field);
                    //alert(field);
                } else if (i == 1) {
                    //alert(field);
                    $('#changeStatus').removeClass().addClass(field);
                }
            });
        });
    });
</script>