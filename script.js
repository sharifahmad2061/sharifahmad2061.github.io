$(function () {
    $('select').material_select();
    $('#form_sup_fab').on('click', function () {
        $('#card0').fadeTo(0, 0).hide(800);
        $('#card1').css("opacity", 1).show(800);
    });
    $('#form_sin_fab').on('click', function () {
        $('#card1').fadeTo(0, 0).hide(800);
        $('#card0').css("opacity", 1).show(800);
    });

    //for student role showing all advisors
    $('#role_sup').on('input',function(){
        if($(this).value == 'student'){
            
            $.post({
                processData: false,
                dataType: 'json',
                data: $('#form_sin').serialize(),
                url: 'sin.php',
                success: function (data) {
                    console.log(data);
                    if (data.success == 'true') {
                        console.log(data);
                        Materialize.toast("you've been logged in", 4000);
                        if (data.role == 'teacher') {
                            setTimeout(function () {
                                window.location.replace("./teacher.html");
                            }, 4500);
                        } else {
                            setTimeout(function () {
                                window.location.replace("./menu2.html");
                            }, 4500);
                        }
                    }
                }
            }); //end of ajax request
        }   //end of if
    });

    //sign in button
    $('#button_sin').on('click', function () {
        $.post({
            processData: false,
            dataType: 'json',
            data: $('#form_sin').serialize(),
            url: 'sin.php',
            success: function (data) {
                console.log(data);
                if (data.success == 'true') {
                    console.log(data);
                    Materialize.toast("you've been logged in", 4000);
                    if (data.role == 'teacher') {
                        setTimeout(function () {
                            window.location.replace("./teacher.html");
                        }, 4500);
                    } else {
                        setTimeout(function () {
                            window.location.replace("./menu2.html");
                        }, 4500);
                    }
                }
            }
        });
    });

    //sign up button
    $('#button_sup').on('click', function () {
        $.post({
            processData: false,
            dataType: 'json',
            data: $('#form_sup').serialize(),
            url: 'sup.php',
            success: function (data) {
                console.log(data);
                if (data.success == 'true') {
                    console.log(data);
                    Materialize.toast("you've been logged in", 3000);
                    if (data.role == 'teacher') {
                        setTimeout(function () {
                            console.log("hello");
                            window.location.replace("./teacher.html");
                        }, 3000);
                    } else {
                        setTimeout(function () {
                            console.log("hello");
                            window.location.replace("./menu2.html");
                        }, 3000);
                    }
                } else {
                    Materialize.toast("UIDN or Password incorrect", 3000);
                    $('#form_sin')[0].reset();
                }
            }
        });
    });
});