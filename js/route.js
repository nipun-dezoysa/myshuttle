var order = 1;
function changeOrder(){
    if(order==1){
        order=2;
        document.getElementById("order").value = "Reverse";
        document.getElementById("jj").className = "route-stops-reverse";
    }else{
        order=1;
        document.getElementById("order").value = "Normal";
        document.getElementById("jj").className = "route-stops";
    }
}
function addTurn(a,b){
    $( "#add" ).prop( "disabled", true );
    const time = [];
    let valid = true;
    for(let i=1;i<=a;i++){
        var h = parseInt($("#h"+i).val());
        var m = parseInt($("#m"+i).val());
        if(h>=0 && h<=24 && m>=0 && m<=60){
            let t = h+$("#m"+i).val();
            time.push(t);
        }
        else valid=false;
    }
    if(valid){
        $.ajax({
            url:'http://localhost/myphp/myshuttle/inc/route_inc.php',
            type: 'POST',
            data: {
                times: time,
                rid: b,
                type: order			
            },
            success:function(respon){
                var ff =JSON.parse(respon);
                
                if(ff.statusCode==201){
                    location.reload();
                }
            }
        });
    }
    $( "#add" ).prop( "disabled", false );
}