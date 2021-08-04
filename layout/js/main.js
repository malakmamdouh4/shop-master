$(function() {

    $("#name_error_message").hide();
    $("#fname_error_message").hide();
    $("#email_error_message").hide();
    $("#password_error_message").hide();
    $("#retype_password_error_message").hide();
    $("#address_error_message").hide();
    $("#phone_error_message").hide();

    var error_name = false;
    var error_email = false;
    var error_password = false;
    var error_retype_password = false;
    var error_address = false;
    var error_phone = false;

    $("#form_name").focusout(function(){
        check_name();
    });
    $("#form_email").focusout(function() {
        check_email();
    });
    $("#form_password").focusout(function() {
        check_password();
    });
    $("#form_retype_password").focusout(function() {
        check_retype_password();
    });

    $("#form_address").focusout(function() {
        check_address();
    });

    $("#form_phone").focusout(function() {
        check_phone();
    });

    function check_address() {
        var pattern = /^[a-zA-Z]*$/;
        var address = $("#form_address").val();

        if(pattern.test(address) && address !== ''){
            $("#address_error_message").hide();
            $("#form_address").css("border","2px solid #34F458");
        } else {
            $("#address_error_message").html("Address Should contain only Characters");
            $("#address_error_message").show();
            $("#form_address").css("border","2px solid #F90A0A");
            error_address = true;
        }
    }

    function check_name() {
        var pattern = /^[a-zA-Z]*$/;
        var fname = $("#form_name").val();

        if (pattern.test(fname) && fname !== '') {
            $("#name_error_message").hide();
            $("#form_name").css("border","2px solid #34F458");
        } else {
            $("#name_error_message").html("Should contain only Characters");
            $("#name_error_message").show();
            $("#form_name").css("border","2px solid #F90A0A");
            error_name = true;
        }
    }


    function check_password() {
        var password_length = $("#form_password").val().length;
        if (password_length < 8) {
            $("#password_error_message").html("Atleast 8 Characters");
            $("#password_error_message").show();
            $("#form_password").css("border","2px solid #F90A0A");
            error_password = true;
        } else {
            $("#password_error_message").hide();
            $("#form_password").css("border","2px solid #34F458");
        }
    }

    function check_phone() {
        var phone = $("#form_phone").val().length;
        if (phone < 11){
            $("#phone_error_message").html("You Need To Add 11 Numbers");
            $("#phone_error_message").show();
            $("#form_phone").css("border","2px solid #F90A0A");
            error_phone = true;
        } else {
            $("#phone_error_message").hide();
            $("#form_phone").css("border","2px solid #34F458");
        }
    }

    function check_retype_password() {
        var password = $("#form_password").val();
        var retype_password = $("#form_retype_password").val();
        if (password !== retype_password) {
            $("#retype_password_error_message").html("Passwords Did not Matched");
            $("#retype_password_error_message").show();
            $("#form_retype_password").css("border","2px solid #F90A0A");
            error_retype_password = true;
        } else {
            $("#retype_password_error_message").hide();
            $("#form_retype_password").css("border","2px solid #34F458");
        }
    }

    function check_email() {
        var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var email = $("#form_email").val();
        if (pattern.test(email) && email !== '') {
            $("#email_error_message").hide();
            $("#form_email").css("border","2px solid #34F458");
        } else {
            $("#email_error_message").html("Invalid Email");
            $("#email_error_message").show();
            $("#form_email").css("border","2px solid #F90A0A");
            error_email = true;
        }
    }

    $('#buy_form').submit(function () {
        error_name = false;
        error_email = false;
        error_address = false;
        error_phone = false;

        check_name();
        check_email();
        check_phone();
        check_address();

        if (error_name === false && error_email === false && error_address === false && error_phone === false){
            return true;
        } else {
            alert("Please Fill the form Correctly");
            return false;
        }

    });

    $("#registration_form").submit(function() {
        error_name = false;
        error_email = false;
        error_password = false;
        error_retype_password = false;

        check_name();
        check_email();
        check_password();
        check_retype_password();

        if (error_name === false && error_email === false && error_password === false && error_retype_password === false) {

            return true;
        } else {
            alert("Please Fill the form Correctly");
            return false;
        }


    });

    $("#edit_form").submit(function() {
        error_name = false;
        error_email = false;


        check_name();
        check_email();


        if (error_name === false && error_email === false) {
            return true;
        } else {
            alert("Please Fill the form Correctly");
            return false;
        }

    });


    // delete Confirm

    $('.confirm').click(function () {
        return confirm('Are Sure To Delete This ?');
    });



});