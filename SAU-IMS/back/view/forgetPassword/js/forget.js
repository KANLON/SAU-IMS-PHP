function forget() {
    var xmlhttp;
    var userName = document.getElementById("user");

    if (userName.value == "") {
        document.getElementById("tips").innerHTML = "账号不能为空";
        return false;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject();
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var json = xmlhttp.responseText;
            var get = eval("(" + json + ")");
            if (get.success) {
                window.location.href = get.url;
            } else {
                document.getElementById("tips").innerHTML = get.message;
            }
        }
    }
    xmlhttp.open("POST", "./index.php?c=ForgetPass&a=forgetPass&t=" + Math.random(), true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("userName=" + userName.value);
}

$("#button").click(function () {
    forget();
});

$(this).keydown(function (e) {
    if (e.keyCode == "13") {
        forget();
    }
});


