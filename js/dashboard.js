
    $("#create").on("click",function(){
        location.href = "dashboard/routeplan.php";
    });

    $("#add").on("click",function(){
       location.href = "dashboard/vehicle.php";

    });

    function routeDelete(a){
        
        $.ajax({
            url:'http://localhost/myphp/myshuttle/inc/routedel_inc.php',
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
            url:'http://localhost/myphp/myshuttle/inc/vehicledel_inc.php',
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
    
