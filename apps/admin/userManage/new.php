<?php

    $title='อนุมัติการลงทะเบียน';

    $subtitle='ผู้ใช้ใหม่';

    load_fun('box');

    $userData=selectTb('userdata','*','active=" " or active="N"');

    // print_r($userData);
    print genSocialWidgets($userData);



/* 

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



