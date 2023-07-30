
    $("#create").on("click",function(){
        location.href = "dashboard/routeplan.php";
    });

    $("#add").on("click",function(){
       location.href = "dashboard/vehicle.php";

    });

    function deleteItem(a,b){
        
        $.ajax({
            url:'inc/delete_inc.php',
            type: 'POST',
            data:{
                id: a,
                type: b            
            },
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.reload();
                }
            }
            });
    }
    
