$(function () {
  var limit = '{"l":"0","r":"10"}';
  var srcOfHead = "./view/admin/img/头像logo.png";
  var sender = "校社联";
  var address = "各位社长、成员、同学们：";
  //生成
  $.post("./index.php?c=AdminMain&a=refresh", {"limit": limit}, function (data) {
    eval("data =" + data);
    for (var i = 0; i < 10; i++) {
      createList(data[i]['title'], data[i]['text'], data[i]['time'], data[i]['id']);
    }
    var firstId = data[0]['id'];
    var firstDom = document.getElementById(firstId);
    checkedStyle(firstDom);
    //生成正文内容
    $.post("./index.php?c=AdminMain&a=getNoticeById", {"nid": firstId}, function (data) {
      eval("data = " + data);
      createRight(srcOfHead, data['name'], data['time'], data['title'], address, data['text'])
    })
  });


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
  });

  //新建
  var newObj = $("#new1");
  newObj.click(function () {
    newNotice();
  });

  // 滚轮事件
  var boxxx = document.getElementById("listContainer");
  boxxx.onscroll = function () {
    var limitL = document.getElementById("announcementList").childNodes.length;
    var limit = '{"l":"' + limitL + '","r":"10"}';
    var scrollTop = boxxx.scrollTop;
    var max = boxxx.scrollHeight - boxxx.offsetHeight;
    if (scrollTop >= max) {
      $.post("./index.php?c=AdminMain&a=getSendNotices", {"limit": limit}, function (data) {
        eval("data =" + data);
        for (var i = 0; i < 10; i++) {
          createList(data[i]['title'], data[i]['text'], data[i]['time'], data[i]['id']);
        }
      });
    }
  }

});
