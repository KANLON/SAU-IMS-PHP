function login() {
    var xmlhttp;
    var userName = document.getElementById("user");
    var password = document.getElementById("password");

    if (userName.value == "" || password.value == "") {
        document.getElementById("tips").innerHTML = "账号或密码不能为空";
        return;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject();
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var json = xmlhttp.responseText;
            var login = eval("("+json+")");
            if(login.success){
                location.href=login.url;
            }else{
                password.value="";
                document.getElementById("tips").innerHTML=login.message;
            }
        }
    }
    xmlhttp.open("POST", "./index.php?c=ForgetPass", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("userName=" + userName.value);
}

document.getElementById("button").onclick=login;

$("input").keydown(login);
