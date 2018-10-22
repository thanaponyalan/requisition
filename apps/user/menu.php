<?php
//global $mainMenu;
$mainMenu['userMenu']=array('title'=>'เมนูผู้ใช้',
                      'class'=>'header',
                      'cond'=>true,
                      'item'=> array('profile' => array('bullet'=>'fa fa-street-view',
                                                        'title'=>'โปรไฟล์',
                                                        'url'=>'main/home/profile/view',
                                                        'cond'=>true,
                                                       ),
                                     'manual'=>array('bullet'=>'fa fa-book',
                                                     'title'=>'คู่มือการใช้งาน',
                                                     'url'=>'main/home/manual/',
                                                     'cond' => current_user('user_id'),
                                                    ),
                                    ),
                      
                     );