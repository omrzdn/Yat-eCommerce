$(function(){

    'use strict';

    $('[placeholder]').focus(function(){

        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placholder', '');

    }).blur(function(){

        $(this).attr('placeholder'. $(this).attr('data-text'));
        
    });

    $('.confirm').click(function(){

        return confirm ('Are you Sure You Want to Delete This Category?');
    });
    //add asterisk on required feild
    $( 'input').each(function(){
        if($(this). attr('required') === 'required'){

            $(this).after ("<span class='asterisk'>*</span>");
        }
        

    });

});