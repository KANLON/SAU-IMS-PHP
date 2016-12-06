/**
 * Created by APone on 2016/11/27.
 */
function returnLogin() {
    window.location.href = "?c=LoginAdmin&t=" + Math.random();
}

function autoReturn() {
    if (sec == 0) {
        returnLogin();
        clearInterval(interval);
    }
    document.getElementById("red").innerHTML = "" + sec;
    sec--;
}

var sec = 3;
var interval = setInterval("autoReturn()", 1000);
