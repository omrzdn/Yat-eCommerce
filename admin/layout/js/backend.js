$(function(){

    'use strict';

    //Dashboard

    $('.toggle-info').click(function(){
        $(this).toggleClass('selected').parent().next('.card-body').fadeToggle(100);
        if($(this).hasClass('selected')){
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        }else{
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        }
    });

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