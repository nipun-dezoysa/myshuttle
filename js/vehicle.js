$(document).ready(function(){
    $("#save").on("click",function(){
        
        document.getElementById("num").className = "normal";
        document.getElementById("seat").className = "normal";
        document.getElementById("model").className = "normal";
        document.getElementById("name").className = "normal";
        document.getElementById("nic").className = "normal";
        document.getElementById("contact").className = "normal";

        $( "#save" ).prop( "disabled", true );
        // var email = $("#email").val();
        // var pass = $("#pass").val();

        var valid = true;
        if($("#num").val()==''){
            document.getElementById("num").className = "warning";
            valid = false;
        }
        if($("#seat").val()==''){
            document.getElementById("seat").className = "warning";
            valid = false;
        }
        if($("#model").val()==''){
            document.getElementById("model").className = "warning";
            valid = false;
        }
        if($("#name").val()==''){
            document.getElementById("name").className = "warning";
            valid = false;
        }
        if($("#nic").val()==''){
            document.getElementById("nic").className = "warning";
            valid = false;
        }
        if($("#contact").val()==''){
            document.getElementById("contact").className = "warning";
            valid = false;
        }
        
        if(valid){
            $.ajax({
            url:'http://localhost/myphp/myshuttle/inc/vehicle_inc.php',
            type: 'POST',
            data: $("#vehicle_detail").serialize(),
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.href="../dashboard.php";
                }
                else if(res.statusCode==201){
                    document.getElementById("num").className = "warning";
                }
                // else if(res.statusCode==202){
                //     $("#er-pass").show();
                //     document.getElementById("er-pass").innerHTML = "password is incorrect.";
                //     document.getElementById("e-box").className="textin-error";
                // }
            }
            });
        }
        
        $( "#save" ).prop( "disabled", false );

    });
});