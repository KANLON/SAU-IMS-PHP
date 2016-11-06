
var css=function(t,s){
    s=document.createElement('style');
    s.innerText=t;
    document.body.appendChild(s);
};

$("#submit").click(function(){
    $.ajax({
        url:'../../controller/login_admin.php',
        type:"POST",
        data:$('#form').serialize(),
        success: function(data) {
           css('form:before{content:\''+data+'\'}');
        }
    });
});

