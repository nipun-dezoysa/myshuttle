
    $("#create").on("click",function(){
        location.href = "dashboard/routeplan.php";
    });

    $("#add").on("click",function(){
       location.href = "dashboard/vehicle.php";

    });

    function routeDelete(a){
        
        $.ajax({
            url:'inc/routedel_inc.php',
            type: 'POST',
            data:{
                rid: a,
            },
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.reload();
                }
            }
            });
    }

    function vehicleDelete(a){
        
        $.ajax({
            url:'inc/vehicledel_inc.php',
            type: 'POST',
            data:{
                vid: a,
            },
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.reload();
                }
            }
            });
    }
    
