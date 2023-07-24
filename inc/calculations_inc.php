<?php
function setTime($a){
    $hour = intdiv($a, 100);
    $minute = $a%100;
    $minuteStr= "".$minute;
    if($minute<10){
        $minuteStr = "0".$minute;
    }
    if($hour<=12){
        return $hour.":".$minuteStr."AM";
    }
    else{
        $hour-=12;
        return $hour.":".$minuteStr."PM";
    }
}
?>