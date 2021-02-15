<?php

function lang ($phrase){
    static $lang = array(
        'MESSAGE' =>'مرحبا',
        'ADMIN' => 'أدمن'
    );
    return $lang[$phrase];
}
