
// Get the element with id="noticeDefaultOpen" and click on it
document.getElementById("noticeDefaultOpen").click();


function openNotice(noticetype,elmnt,color) {
    var i, noticetabcontent, noticetablinks;
    noticetabcontent = document.getElementsByClassName("noticetabcontent");
    for (i = 0; i < noticetabcontent.length; i++) {
        noticetabcontent[i].style.display = "none";
    }
    noticetablinks = document.getElementsByClassName("noticetablink");
    for (i = 0; i < noticetablinks.length; i++) {
        noticetablinks[i].style.backgroundColor = "";
    }
    document.getElementById(noticetype).style.display = "block";
    elmnt.style.backgroundColor = color;

}
