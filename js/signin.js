
 $(document).ready(function(){
    $("#login").on("click",function(){
        $( "#login" ).prop( "disabled", true );
        var email = $("#email").val();
        var pass = $("#pass").val();

        var valid = true;
        const pattem = /^[a-z.0-9]+.@.[a-z]+.[.].[a-z.]+$/g;

        document.getElementById("e-box").className="textin";
        document.getElementById("p-box").className="textin";
        $("#er-email").hide();
        $("#er-pass").hide();

        if(email==""){
            $("#er-email").show();
            document.getElementById("er-email").innerHTML = "Enter your email.";
            document.getElementById("e-box").className="textin-error";
            valid=false;
        }else if(!pattem.test(email)){
            $("#er-email").show();
            document.getElementById("er-email").innerHTML = "Enter a valid email.";
            document.getElementById("e-box").className="textin-error";
            valid=false;
        }
        if(pass==""){
            $("#er-pass").show();
            document.getElementById("er-pass").innerHTML = "Enter your password.";
            document.getElementById("p-box").className="textin-error";
            valid=false;
        }
        
        if(valid){
            $.ajax({
            url:'inc/signin_inc.php',
            type: 'POST',
            data: $("#input_form").serialize(),
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.href="index.php";
                }
                else if(res.statusCode==201){
                    $("#er-email").show();
                    document.getElementById("er-email").innerHTML = "email does not exists.";
                    document.getElementById("e-box").className="textin-error";
                }
                else if(res.statusCode==202){
                    $("#er-pass").show();
                    document.getElementById("er-pass").innerHTML = "password is incorrect.";
                    document.getElementById("p-box").className="textin-error";
                }
            }
            });
        }
        
        $( "#login" ).prop( "disabled", false );

    });
});