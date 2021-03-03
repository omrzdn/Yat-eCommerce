<?php

function lang ($phrase){
    static $lang = array(
        //nav links
        'home_admin'  =>'Home',
        'categories'  =>'Categories',
        'dropdown'    =>'Drop',
        'ITEMS'       =>'Items',
        'STATISTICS'  =>'Statistics',
        'MEMBERS'     =>'Members',
        'COMMENTS'    =>'Comments',
        'LOGS'        =>'Logs',
        
    );
    return $lang[$phrase];
}


