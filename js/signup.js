
$(document).ready(function(){
    $("#submit").on('click',function(){
        $( "#submit" ).prop( "disabled", true );
        //$("#usn").attr("disabled", "disabled");
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var pass = $("#pass").val();
        var repass = $("#repass").val();

        //all boxes are reset to black, previous turn can be a error
        document.getElementById("n-box").className="textin";
        document.getElementById("e-box").className="textin";
        document.getElementById("p-box").className="textin";
        document.getElementById("pp-box").className="textin";
        document.getElementById("pr-box").className="textin";

        //error messaging boxes
        $("#er-name").hide();
        $("#er-email").hide();
        $("#er-phone").hide();
        $("#er-pass").hide();
        $("#er-repass").hide();

        let valid = true;

        //email and user name patterns
        const pattep = /^0.[0-9]+$/g;
        const pattem = /^[a-z.0-9]+.@.[a-z]+.[.].[a-z.]+$/g;

        if(name==""){
            $("#er-name").show();
            document.getElementById("er-name").innerHTML = "Enter your name";
            document.getElementById("n-box").className="textin-error";
            valid=false;
        }
        
        if(email==""){
            $("#er-email").show();
            document.getElementById("er-email").innerHTML = "Enter your e-mail";
            document.getElementById("e-box").className="textin-error";
            valid=false;
        }
        else{
            if(!pattem.test(email)){
                $("#er-email").show();
                document.getElementById("er-email").innerHTML = "Enter a valid e-mail";
                document.getElementById("e-box").className="textin-error";
                valid=false;
            }
        }
        
        if(phone==""){
            $("#er-phone").show();
            document.getElementById("er-phone").innerHTML = "Enter your phone number.";
            document.getElementById("p-box").className="textin-error";
            valid=false
        }
        else{
            if(pattep.test(phone)){
                if(phone.length!=10){
                    $("#er-phone").show();
                    document.getElementById("er-phone").innerHTML = "Phone Number should be 10 digits.";
                    document.getElementById("p-box").className="textin-error";
                    valid=false;
                }
            }else{
                $("#er-phone").show();
                document.getElementById("er-phone").innerHTML = "Enter a valid phone number.";
                document.getElementById("p-box").className="textin-error";
                valid=false;
            }
        }
        
        if(pass==""){
            $("#er-pass").show();
            document.getElementById("er-pass").innerHTML = "Enter your password";
            document.getElementById("pp-box").className="textin-error";
            valid=false;
        }
        else{
            if(pass.length<5){
                $("#er-pass").show();
                document.getElementById("er-pass").innerHTML = "Password need minimum 5 characters";
                document.getElementById("pp-box").className="textin-error";
                valid=false;
            }
        }
        
        if(repass==""){
            $("#er-repass").show();
            document.getElementById("er-repass").innerHTML = "Retype your password";
            document.getElementById("pr-box").className="textin-error";
            valid=false;
        }
        else{
            if(pass!=repass){
                $("#er-repass").show();
                document.getElementById("er-repass").innerHTML = "Password does not match";
                document.getElementById("pr-box").className="textin-error";
                valid=false;
            }
        }

        if(valid){
            $.ajax({
            url:'inc/signup_inc.php',
            type: 'POST',
            data: $("#input_form").serialize(),
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.href="signin.php";
                }
                else if(res.statusCode==201){
                    $("#er-phone").show();
                    document.getElementById("er-phone").innerHTML = "phone number already exists.";
                    document.getElementById("p-box").className="textin-error";
                }
                else if(res.statusCode==202){
                    $("#er-email").show();
                    document.getElementById("er-email").innerHTML = "e-mail already exists";
                    document.getElementById("e-box").className="textin-error";
                }
                else if(res.statusCode==203){
                    $("#er-name").show();
                    document.getElementById("er-name").innerHTML = "something wrong, data not updated.";
                    document.getElementById("n-box").className="textin-error";
                }
                else if(res.statusCode==204){
                    $("#er-phone").show();
                    document.getElementById("er-phone").innerHTML = "phone number already exists.";
                    document.getElementById("p-box").className="textin-error";
                    $("#er-email").show();
                    document.getElementById("er-email").innerHTML = "e-mail already exists";
                    document.getElementById("e-box").className="textin-error";
                }
            }
            });
        }

        $( "#submit" ).prop( "disabled", false);
    });
        
});