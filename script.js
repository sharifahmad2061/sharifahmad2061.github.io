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

    // for student role showing all advisors
    $('#role_sup select').on('change', function () {
        if ($(this).val() == 'student') {
            // console.log("student branch fired");
            // console.log("else part fired for role select");
            if (document.querySelector("#advisors")) {
                console.log("advisors select exist hence we not inserting new things");
                return;
            }
            $.post({
                processData: false,
                url: 'advisors.php',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    var adv = $('<div class="input-field" id="advisors"></div>');
                    var sel = $('<select name="advisor_id"></select>');
                    adv.append('<i class="fa fa-graduation-cap prefix"></i>');
                    // console.log(Object.keys(data).length);
                    sel.append('<option disabled selected>Choose Your Advisor</option>');
                    $.each(data, function (key, value) {
                        // console.log(key, value);
                        sel.append(`<option value='${key}'>${value}</option>`);
                    });
                    adv.append(sel);
                    adv.append(`<label>advisor</label>`);
                    $('#role_sup').after(adv);
                    $('#advisors select').material_select();

                    var el = $('<div class="input-field" id="section"></div>');
                    el.append('<i class="fa fa-map-marker prefix"></i>');
                    el.append('<input id="section_sup" type="text" name="section" class="validate" maxlength="7">');
                    el.append('<label for="section_sup">Section</label>');
                    $('#advisors').after(el);
                    // console.log(adv);
                },
                error: function (data) {
                    console.log("error occured on post request in sign up");
                    console.log(data);
                }
            }); //end of ajax request
        } //end of if
        else {
            console.log("else part fired for role select");
            if (document.querySelector("#advisors")) {
                console.log("advisors select exist which is going to be deleted");
                $('#advisors select').material_select('destroy');
                $('#advisors').remove();
                $('#section').remove();
            } else {
                console.log("no advisors exist");
            }
        } //end of else
    });

    //sign in button
    $('#button_sin').on('click', function () {
        // console.log("ëvent triggered");
        console.log("I'm fired");
        var form_sin = $("#form_sin")[0];
        if (!form_sin.checkValidity()) {
            if (form_sin.reportValidity) {
                form_sin.reportValidity();
                return;
            } else {
                console.log('not working here');
            }
        }
        $.post({
            processData: false,
            dataType: 'json',
            data: $('#form_sin').serialize(),
            url: 'sin.php',
            success: function (data) {
                // console.log(data);
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
                } else {
                    // console.log("entered else");
                    Materialize.toast("UIDN or Password incorrect", 3000);
                    $('#form_sin')[0].reset();
                }
            },
            error: function (data) {
                console.log("error occured in post request for sign in");
                console.log(data);
            }
        });
    });

    //external functions
    function persist() {
        $.post({
            processData: false,
            dataType: 'json',
            data: $('#form_sup').serialize(),
            url: 'sup.php',
            success: function (data) {
                // console.log(data);
                if (data.success == 'true') {
                    // console.log(data);
                    Materialize.toast("you are up for the task", 2000);
                    if (data.role == 'teacher') {
                        setTimeout(function () {
                            // console.log("hello");
                            window.location.replace("./teacher.html");
                        }, 2000);
                    } else {
                        setTimeout(function () {
                            // console.log("hello");
                            window.location.replace("./menu2.html");
                        }, 2000);
                    }
                } else {
                    Materialize.toast("UIDN or Password incorrect", 3000);
                    $('#form_sup')[0].reset();
                }
            },
            error: function (data) {
                console.log("button_sup failed");
                console.log(data);
            }
        });
    }

    //sign up button
    $('#button_sup').on('click', function () {
        // console.log("I'm fired");

        //verifying that all fields have values
        var form_sup = $("#form_sup")[0];
        if (!form_sup.checkValidity()) {
            if (form_sup.reportValidity) {
                form_sup.reportValidity();
                return;
            } else {
                console.log('not working here');
            }
        }

        //post request for verification of duplicate usernames
        console.log("we have not returned");
        // var verify = false;
        $.post({
            processData: false,
            dataType: 'json',
            url: 'verify_username.php',
            success: function (data) {
                const ver = $('#form_sup #reg_sup').val();
                if (data.indexOf(ver) != -1) {
                    console.log("found something");
                    Materialize.toast("UIDN already exist", 3000);
                    // verify = true;
                } else {
                    persist();
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    }); //end of button_sup functionality

}); //end of document ready function