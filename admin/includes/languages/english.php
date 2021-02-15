<?php

function lang ($phrase){
    static $lang = array(
        //homepage
        'MESSAGE' =>'Welcome',
        'ADMIN' => 'Administrator'
    );
    return $lang[$phrase];
}


