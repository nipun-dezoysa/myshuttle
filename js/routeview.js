var rating = 0;
$("#box1").hide();
function star(a){
    switch(a){
        case 1:
            document.getElementById("s1").className = "fa-solid fa-star gold";
            document.getElementById("s2").className = "fa-solid fa-star";
            document.getElementById("s3").className = "fa-solid fa-star";
            document.getElementById("s4").className = "fa-solid fa-star";
            document.getElementById("s5").className = "fa-solid fa-star";
            rating=1;
            break;
        case 2:
            document.getElementById("s1").className = "fa-solid fa-star gold";
            document.getElementById("s2").className = "fa-solid fa-star gold";
            document.getElementById("s3").className = "fa-solid fa-star";
            document.getElementById("s4").className = "fa-solid fa-star";
            document.getElementById("s5").className = "fa-solid fa-star";
            rating=2;
            break;
        case 3:
            document.getElementById("s1").className = "fa-solid fa-star gold";
            document.getElementById("s2").className = "fa-solid fa-star gold";
            document.getElementById("s3").className = "fa-solid fa-star gold";
            document.getElementById("s4").className = "fa-solid fa-star";
            document.getElementById("s5").className = "fa-solid fa-star";
            rating=3;
            break;
        case 4:
            document.getElementById("s1").className = "fa-solid fa-star gold";
            document.getElementById("s2").className = "fa-solid fa-star gold";
            document.getElementById("s3").className = "fa-solid fa-star gold";
            document.getElementById("s4").className = "fa-solid fa-star gold";
            document.getElementById("s5").className = "fa-solid fa-star";
            rating=4;
            break;
        case 5:
            document.getElementById("s1").className = "fa-solid fa-star gold";
            document.getElementById("s2").className = "fa-solid fa-star gold";
            document.getElementById("s3").className = "fa-solid fa-star gold";
            document.getElementById("s4").className = "fa-solid fa-star gold";
            document.getElementById("s5").className = "fa-solid fa-star gold";
            rating=5;
            break;    
        default:
            document.getElementById("s1").className = "fa-solid fa-star";
            document.getElementById("s2").className = "fa-solid fa-star";
            document.getElementById("s3").className = "fa-solid fa-star";
            document.getElementById("s4").className = "fa-solid fa-star";
            document.getElementById("s5").className = "fa-solid fa-star";
            rating=0;

    }
}

function addcomment(r_id){
    
        $( "#comment-btn" ).prop( "disabled", true );
        var message = $("#comment-msg").val();
        var valid = true;
        if(message=="" || message.length >500){
            valid=false;
        }
        if(rating==0){
            valid=false;
        }
        
        if(valid){
            $.ajax({
            url:'inc/addcomment_inc.php',
            type: 'POST',
            data: {
                rate: rating,
                rid: r_id,
                msg: message	
            },
            success:function(response){
                var res =JSON.parse(response);
                if(res.statusCode==200){
                    location.reload();
                }
                else if(res.statusCode==201){
                }
            }
            });
        }
        
        $( "#comment-btn" ).prop( "disabled", false );

}

function addreply(co_id,mid){
    // $( "#reply-btn" ).prop( "disabled", true );
    var reply = $("#reply-msg"+mid).val();
    var valid = true;
    if(reply=="" || reply.length >500){
        valid=false;
    }
    if(valid){
        $.ajax({
        url:'inc/addreply_inc.php',
        type: 'POST',
        data: {
            coid: co_id,
            reply: reply	
        },
        success:function(response){
            var res =JSON.parse(response);
            if(res.statusCode==200){
                location.reload();
            }
            else if(res.statusCode==201){
            }
        }
        });
    }
    
    // $( "#reply-btn" ).prop( "disabled", false );

}
function delcom(c){
    $.ajax({
        url:'inc/delcom_inc.php',
        type: 'POST',
        data: {
            coid: c	
        },
        success:function(response){
            var res =JSON.parse(response);
            if(res.statusCode==200){
                location.reload();
            }
            else if(res.statusCode==201){
            }
        }
    });

}
function delrep(c){
    $.ajax({
        url:'inc/delrep_inc.php',
        type: 'POST',
        data: {
            reid: c	
        },
        success:function(response){
            var res =JSON.parse(response);
            if(res.statusCode==200){
                location.reload();
            }
            else if(res.statusCode==201){
            }
        }
    });

}