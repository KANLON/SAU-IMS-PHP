/**
 * Created by APone on 2016/11/27.
 */
function returnLogin() {
    location.href = "?c=LoginAdmin";
}

document.getElementById("button").onclick=returnLogin();

var sec = 3;
var interval = setInterval("autoReturn()", 1000);
function autoReturn() {
    if (sec == 0) {
        returnLogin();
        clearInterval(interval);
    }
    document.getElementById("red").innerHTML = ""+sec;
    sec--;
}