window.onload = start;
function start(){
    function currentDate(){
            var heute = new Date();
            var wochentag = heute.getDay();
            var jahr = heute.getFullYear();
            var monat = heute.getMonth();
            var tag = heute.getDate();
            var days = new Array();
                days[0] = "Sonntag";
                days[1] = "Montag";
                days[2] = "Dienstag";
                days[3] = "Mittwoch";
                days[4] = "Donnerstag";
                days[5] = "Freitag";
                days[6] = "Samstag";
            var element= document.getElementById("date");
            element.innerHTML = days[wochentag] +", "+ tag+"."+(monat+1) +"."+jahr;   
    }  
    currentDate();
}