<?php
$mainMenu['mainMenu']=array(
    'title'=>'เมนูหลัก',
    'class'=>'header',
    'cond'=>true,
    'item'=>array(
        'Dashboard'=>array(
            'bullet'=>'fa fa-home',
            'title'=>'ภาพรวม',
            'url'=>'main/mainMenu/dashboard/index',
        ),
        'Setup'=>array(
            'bullet'=>'fa fa-gears',
            'title'=>'ตั้งค่าพื้นฐาน',
            'url'=>'main/mainMenu/setup/index',
        ),
    ),
);