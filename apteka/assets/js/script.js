function hello() {
	alert("hello");
}
function resizeIframe(obj) {
	    obj.style.height = document.documentElement.scrollHeight - document.getElementById('header').scrollHeight - document.getElementById('koz').scrollHeight - document.getElementById('footer').scrollHeight - 71 + 'px';
}