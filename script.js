$(function(){
    $('select').material_select();
    $('#form_sup_fab').on('click',function(){
        $('#card0').hide(600);
        $('#card1').show(600);
    });
    $('#form_sin_fab').on('click',function(){
        $('#card1').hide(600);
        $('#card0').show(600);
    });

    //sign in button
    $('#button_sin').on('click',function(){
        console.log("button_sin clicked");
        $.post({
            processData: false,
            dataType: 'json',
            data: $('#form_sin').serialize(),
            url: 'sin.php',
            success: function(data){
                console.log(data);
                if(data.success == 'true'){
                    window.location.replace("./menu2.html");
                }else{
                    Materialize.toast("UIDN or Password incorrect", 3000);
                    $('#form_sin')[0].reset();
                }
            }
        });

        // $('#form_sin').submit();
    });

    //sign up button
    // $('#button_sup').on('click',function(){
        


    //     $('#form_sup').submit();
    // });
});