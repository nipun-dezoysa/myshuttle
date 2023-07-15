$(document).ready(function(){
    const cities = [];
    var count = 0;
    $("#add").on("click",function(){
        var city = $("#loc").val();
        cities.push(city);
        count++;
        cities.push(city);
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
                            // for(var i=0;i<count;i++){
                            //     prompt("hey");
                            //     $.ajax({
                            //         url:'http://localhost/myphp/myshuttle/inc/addstops.php',
                            //         type: 'POST',
                            //         data: {
                            //             city: cities[i],
                            //             rid: r_id			
                            //         },
                            //         success:function(respon){
                            //             var ff =JSON.parse(respon);
                            //             prompt(hey);
                            //             if(ff.statusCode==201){
                                            
                            //             }
                            //         }
                            //     });
                            // }

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
                                        prompt(hey);
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