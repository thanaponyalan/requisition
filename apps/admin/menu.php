<?php

//$countRec=count(selectTb('admin_user','*'));

$newUser = selectTb('userdata', 'count(*)', 'active=" " or active="N"');
$numNewUser = $newUser[0]['count(*)'];

$allUser = selectTb('userdata', 'count(*)', 'active="Y"');
$numAllUser = $allUser[0]['count(*)'];

$blockedUser = selectTb('userdata', 'count(*)', 'active="B"');
$numAllblockedUser = $blockedUser[0]['count(*)'];


$mainMenu['adminMenu'] = array(
    'class' => "header",
    'title' => 'ดูเลระบบ',
    'cond' => true,
    'item' => array(
        'manage' => array('bullet' => 'fa fa-gears',
            'title' => 'จัดการระบบ',
            'url' => '',
            'cond' => true,
            'item' => array('general' => array(
                    'bullet' => 'fa fa-wrench',
                    'title' => 'ตั้งค่าทั่วไป',
                    'url' => 'main/admin/manage/general',
                    'cond'=>'',
                    'num'=>'',
                ),
            ),
        ),
        'userManage' => array('bullet' => 'fa fa-users',
            'title' => 'จัดการผู้ใช้',
            'url' => 'main/userManage/user/list',
            'cond' => current_user('user_type')=='administrator',
            'item' => array('new' => array(
                'bullet' => 'fa fa-user-plus',
                    'title' => 'อนุมัติการลงทะเบียน',
                    'url' => 'main/admin/userManage/new',
                    'num' => $numNewUser,
                    'cond'=>'',
                ),
                'allUser' => array(
                    'bullet' => 'fa  fa-users',
                    'title' => 'ผู้ใช้ทั้งหมด',
                    'url' => 'main/admin/userManage/allUser',
                    'num' => $numAllUser,
                    'cond'=>'',
                ),
                'blockedUser' => array(
                    'bullet' => 'fa fa-user-times',
                    'title' => 'ผู้ใช้ที่ถูกบล็อก',
                    'url' => 'main/admin/userManage/blockedUser',
                    'num' => $numAllblockedUser,
                    'cond'=>'',
                ),
//                'userGroup' => array(
//                    'bullet' => 'fa  fa-users',
//                    'title' => 'กลุ่มผู้ใช้',
//                    'url' => 'main/admin/userManage/userGroup',
//                    'cond' => false,
//                //'num'=>$numAllblockedUser,
//                ),
            ),
        ),
        
    ),
);
?>