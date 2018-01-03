$(function(){
    $('select').material_select();
    $('#form_sup').on('click',function(){
        $('#card0').hide(600);
        $('#card1').show(600);
    });
    $('#form_sin').on('click',function(){
        $('#card1').hide(600);
        $('#card0').show(600);
    });

    //sign in button
    $('#button_sin').on('click',function(){


        $('#form_sin').submit();
    });

    //sign up button
    $('#button_sup').on('click',function(){
        


        $('#form_sup').submit();
    });
});