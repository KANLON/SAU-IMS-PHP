var limit = '{"l":"0","r":"10"}';
/**
 * [createList 生成目录列表元素]
 * @param  {[String]} title [description]
 * @param  {[String]} text  [description]
 * @param  {[String]} time1 [description]
 * @param  {[int]} i     [description]
 * @return {[object]} input     [列表元素节点]
 */
function createList(title, text, time1, i) {
    var annousBox = document.getElementById("announcementList");
    var li = createEle("li", "fll", "content");
    ;
    li.id = i;
    li.onclick = hjlh;

    function hjlh() {
        // $.post("./index.php?c=AdminMain&a=getSendNotices", {"limit": limit}, function(data, status) {
        cheakedStyle(this);
    }

    var token = createEle("div", "fll", "token");

    var sender = createEle("h1", "fll", "sender");
    sender.innerHTML = title;

    var announcementTitle = createEle("h3", "fll", "announcementTitle");
    announcementTitle.innerHTML = text;

    var checkbox = createEle("div", "flr", "rlt", "checkbox");
    var input = document.createElement("input");
    input.type = "checkbox";
    input.name = i;
    checkbox.appendChild(input);

    var time = createEle("div", "rlt", "time");
    time.innerHTML = time1;

    addChilds(li, token, sender, announcementTitle, checkbox, time);
    annousBox.appendChild(li);

    return input;
} //createList

/**
 * [createRight 生成公告内容部分]
 * @param  {[String]} srcOfHead [头像图片的路径]
 * @param  {[String]} sender    [公告发布者]
 * @param  {[String]} time      [发布时间]
 * @param  {[String]} title     [公告题目]
 * @param  {[String]} addresee  [公告接受者]
 * @param  {[String]} text      [正文]
 * @return {[none]}           [description]
 */
function createRight(srcOfHead, sender, time, title, addresee, text) {
    var rightBar = document.getElementById("rightBar");
    var header = createEle("header", "mainHeader");
    var userHead = createEle("img", "userHead", "fll");
    userHead.src = srcOfHead;
    userHead.alt = "用户头像"
    var mainSender = createEle("h1", "mainSender", "fll");
    mainSender.innerHTML = sender;
    var mainTime = createEle("div", "mainTime", "fll");
    mainTime.innerHTML = time;
    var deleteButton = createEle("a", "deleteButton", "fll");
    deleteButton.href = "javascript:;"
    var mainDelete = createEle("img", "mainDelete");
    mainDelete.src = "./view/admin/img/删除logo.png";
    mainDelete.alt = "删除";
    var deleteText = createEle("span", "deleteText", "rlt");
    deleteText.innerHTML = "删除";
    addChilds(deleteButton, mainDelete, deleteText);
    addChilds(header, userHead, mainSender, mainTime, deleteButton);

    var main = createEle("section", "main");
    var mainTitle = createEle("h3", "mainTitle");
    mainTitle.innerHTML = title;
    var mainContent = createEle("div", "mainContent");
    var towho = createEle("p", "toWho");
    towho.innerHTML = addresee;
    var ti2 = createEle("p", "ti2");
    ti2.innerHTML = text;
    addChilds(mainContent, towho, ti2);
    addChilds(main, mainTitle, mainContent);
    addChilds(rightBar, header, main);
}


/**
 * [clearChecked 删除选中的列表项]
 * @return {[none]} []
 * 用到外界变量：checkboxs
 */
function clearChecked() {
    // 此数组用于储存要删除的节点id
    var checkedIds = '{';
    // 此数组用于储存要删除的节点
    var checkedobj = new Array;
    var announcementList = document.getElementById("announcementList");
    var checkboxs = announcementList.getElementsByTagName("input");
    var j = 0;
    for (var i = 0; i < checkboxs.length; i++) {
        if (checkboxs[i].checked) {
            checkedIds += '"' + j + '"' + ':' + checkboxs[i].name + ',';
            checkedobj[j] = document.getElementById(checkboxs[i].name)
            j++;
        } //if
    } //for
    checkedIds = checkedIds.substring(0, checkedIds.length - 1)
    checkedIds += '}';
    $.post("./index.php?c=AdminMain&a=deleteNotices", {"noticeIds": checkedIds}, function (data, status) {
        if (status == "success") {
            var announcementList = document.getElementById("announcementList");
            for (var i = 0; i < checkedobj.length; i++) {
                announcementList.removeChild(checkedobj[i]);
            } //for
        } //if
    })
} //clearChecked

/**
 * 搜索
 * @return none
 */
function search() {
    var val = $("#searchField").val();
    var search = '{"title":"' + val + '","l":"0","r":"10"}';
    $.post("./index.php?c=AdminMain&a=searchNotices", {"search": search}, function (data, status) {
        if (status == "success") {
            clearAll("announcementList");
            eval("data =" + data);
            if (!(data)) {
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    createList(data[i]['title'], data[i]['text'], data[i]['time'], i);
                }
            }
            else {
                alert('查找不到关于"' + val + '"的公告');
            }

        }
        else alert("查询出错");
    })
}

/**
 * 刷新
 * @return none
 */
function refresh() {
    clearAll("announcementList");
    var limit = '{"l":"0","r":"10"}';
    $.post("./index.php?c=AdminMain&a=getSendNotices", {"limit": limit}, function (data, status) {
        if (status == "success") {
            clearAll("announcementList");
            eval("data =" + data);
            var len = data.length
            for (var i = 0; i < len; i++) {
                createList(data[i]['title'], data[i]['text'], data[i]['time'], i);
            }
        }
    })
}


//新建
function newNotice() {
    clearAll("rightBar");
    var boxDom = document.getElementById("rightBar");

    var header = createEle("header", "mainHeader");
    header.innerHTML = "创建公告";
    var main = createEle("section", "main");
    var titleDom = createEle("div", "titleNew");
    titleDom.contentEditable = true;
    titleDom.innerHTML = ("标题");
    var textDom = createEle("div", "textNew");
    textDom.contentEditable = true;
    textDom.innerHTML = "内容";
    var btnDom = createEle("div", "btnNew");
    btnDom.id = "btnNew";
    btnDom.onclick = btnClick;
    function btnClick() {
        var title = titleDom.innerHTML;
        var text = textDom.innerHTML;
        var time = getNowFormatDate()

        function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var seperator2 = ":";
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                + " " + date.getHours() + seperator2 + date.getMinutes()
                + seperator2 + date.getSeconds();
            return currentdate;
        }

        alert(time)
    }

    addChilds(main, titleDom, textDom, btnDom);
    addChilds(boxDom, header, main);

    // $.post("text.php",)
}