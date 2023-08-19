var g = parseInt(document.getElementById("count1").innerHTML);

var l = parseInt(document.getElementById("count3").innerHTML);

var h = parseInt(document.getElementById("count2").innerHTML);
const observer = new IntersectionObserver((entries)=>{
  entries.forEach((entry)=>{
    if(entry.isIntersecting){
      var i = 0;
      theLabel1 = document.getElementById("count1");
      var interval = setInterval(function(){ 
          if (i == g) clearInterval(interval);
          if(i<10){
            theLabel1.innerHTML = "0"+i; 
          }else{
            theLabel1.innerHTML = i; 
          }
          
          i++;
      },
      50);
      
      var m=0;
      theLabel2 = document.getElementById("count2");
      var interval1 = setInterval(function(){ 
          if (m == h) clearInterval(interval1);
          if(m<10){
            theLabel2.innerHTML = "0"+m; 
          }else{
            theLabel2.innerHTML = m; 
          } 
          m++;
      },
      50);
      var s=0;
      theLabel3 = document.getElementById("count3");
      var interval3 = setInterval(function(){ 
          if (s == l) clearInterval(interval3);
          if(s<10){
            theLabel3.innerHTML = "0"+s; 
          }else{
            theLabel3.innerHTML = s; 
          } 
          s++;
      },
      50);
    }
  });
});

const hidden = document.querySelectorAll('.summary');
hidden.forEach((el)=>observer.observe(el));

function addsub(){
  $( "#subs" ).prop( "disabled", true );
  var emails = $("#subemail").val();
  var valid = true;
  const pattem = /^[a-z.0-9]+.@.[a-z]+.[.].[a-z.]+$/g;

  if(emails==""){
      valid=false;
  }else if(!pattem.test(emails)){
      valid=false;
  }
  
  if(valid){
      
    $.ajax({
    url:'inc/addsubs_inc.php',
    type: 'POST',
    data: {
        emd: emails	
    },
    success:function(respon){
        var ff =JSON.parse(respon);
        
        if(ff.statusCode==200){
          document.getElementById("subs").value = "Subscribed";
        }
    }
    });
  }
  
  $( "#subs" ).prop( "disabled", false );

  }
  



