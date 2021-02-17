<?php

function lang ($phrase){
    static $lang = array(
        //nav links
        'home_admin'  =>'Home',
        'categories'  =>'categories',
        'dropdown'    =>'drop',
        'ITEMS'       =>'items',
        'STATISTICS'  =>'statistics',
        'MEMBERS'     =>'members',
        'LOGS'        =>'logs',
        
    );
    return $lang[$phrase];
}


