$(function() {
    $('.selectpicker').selectpicker();
  }); 

function changedes(){
  var start = $("#ori").val();
  var end = $("#des").val();
  document.getElementById("ori").value = start;
  document.getElementById("des").value = end;
}
