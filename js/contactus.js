$("#success").hide();
$("#warning").hide();

$(document).ready(function(){
    $("#login").on("click",function(){
        $( "#login" ).prop( "disabled", true );
        var email = $("#email").val();
        var name = $("#name").val();
        var message = $("#message").val();

        var valid = true;
        const pattem = /^[a-z.0-9]+.@.[a-z]+.[.].[a-z.]+$/g;

        document.getElementById("e-box").className="textin";
        document.getElementById("n-box").className="textin";
        document.getElementById("m-box").className="textin";
        $("#er-email").hide();
        $("#er-name").hide();
        $("#er-message").hide();

        $("#success").hide();
        $("#warning").hide();

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
        if(name==""){
            $("#er-name").show();
            document.getElementById("er-name").innerHTML = "Enter your Name.";
            document.getElementById("n-box").className="textin-error";
            valid=false;
        }
        if(message==""){
            $("#er-message").show();
            document.getElementById("er-message").innerHTML = "Enter your Message.";
            document.getElementById("m-box").className="textin-error";
            valid=false;
        }
        
        if(valid){
            $.ajax({
            url:'inc/contact_inc.php',
            type: 'POST',
            data: $("#input_form").serialize(),
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    $("#success").show();
                    document.getElementById("name").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("message").value = "";
                }
                else if(res.statusCode==201){
                    $("#warning").show();
                }
            }
            });
        }
        
        $( "#login" ).prop( "disabled", false );

    });
});