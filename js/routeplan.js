$(document).ready(function(){
    const cities = [];
    var count = 0;
    $("#add").on("click",function(){
        var city = $("#loc").val();
        cities.push(city);
        count++;
        const cityt = document.createElement("div");
        const citys = document.createTextNode(count+". "+city);
        cityt.setAttribute("class","stop");
        cityt.setAttribute("id","id"+count);
        cityt.appendChild(citys);
        document.getElementById("places").appendChild(cityt);
        
    });
    $("#delete").on("click",function(){
        if(count>0){
            document.getElementById("id"+count).remove();
            count--;
            cities.pop();
        }
    });

    $("#save").on("click",function(){
        if((document.log.type[0].checked) || (document.log.type[1].checked)|| (document.log.type[2].checked)){
            var types = 1;
            if(document.log.type[0].checked)types=1;
            else if(document.log.type[1].checked)types=2;
            else types=3;
            if(count>0){
                var isRouteCreated = false;
                var r_id = 1;
                $.ajax({
                    url:'http://localhost/myphp/myshuttle/inc/routecreate_inc.php',
                    type: 'POST',
                    data: {
                        type: types			
                    },
                    success:function(response){
                        var res =JSON.parse(response);
                        if(res.statusCode==200){
                            r_id = res.rid;
                            $.ajax({
                                url:'http://localhost/myphp/myshuttle/inc/addstops.php',
                                type: 'POST',
                                data: {
                                    city: cities,
                                    rid: r_id			
                                },
                                success:function(respon){
                                    var ff =JSON.parse(respon);
                                    
                                    if(ff.statusCode==201){
                                        location.href="../dashboard.php";
                                    }
                                }
                            });
                            
                        }
                    }
                });
            }
        }
    });
});