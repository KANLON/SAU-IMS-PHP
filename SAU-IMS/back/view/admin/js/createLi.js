$(function () {
    var limit = '{"l":"0","r":"10"}';
    //生成
    $.post("./index.php?c=AdminMain&a=getSendNotices", {"limit": limit}, function (data, status) {
        eval("data =" + data);
        for (var i = 0; i < 10; i++) {
            createList(data[i]['title'], data[i]['text'], data[i]['time'], data[i]['id']);
        }
    })


    //生成正文内容
    var srcOfHead = "./view/admin/img/头像logo.png";
    var sender = "校社联";
    var time = "2016年10月31日 14:11";
    var title = "校社联管理系统建好啦";
    var addresee = "各位社长、成员、同学们：";
    var text = "你们好！现在我们校社联管理系统已经建好，请各位填好自己的相关信息、并加入各自的社团。谢谢合作！"
    createRight(srcOfHead, sender, time, title, addresee, text)

    //删除
    var delist = document.getElementById("deleteimg");
    delist.onclick = clearChecked;

    // 搜索
    var searchobj = document.getElementById("searchbtn");
    searchobj.onclick = search;

    //刷新
    var refreshobj = $("#refresh");
    refreshobj.click(function () {
        refresh();
    })

    //新建
    var newObj = $("#new1");
    newObj.click(function () {
        newNotice();
    })
})