/**
 * 
 */
$(document).ready(function() {

var article = {
	url : 'http://singa.com.vn/tin-tuc-xem/120/-2014-nganh-chan-nuoi-thang-dam/index.html',
	image : 'http://singa.com.vn/uploads/cms/120.jpg',
	title : 'Chính phủ bảo lưu đề xuất 4 thẩm quyền mới của Thủ tướng'
};
$("a.btn_facebook")
		.click(
				function(e) {
					var url = "https://www.facebook.com/sharer/sharer.php?u="
							+ article.url + "&t=" + article.title
							+ "&p[images][0]=" + article.image;
					var newwindow = window
							.open(url, "_blank",
									"menubar=no,toolbar=no,resizable=no,scrollbars=no,height=450,width=710");
					if (window.focus)
						newwindow.focus();
					e.preventDefault()
				});
});