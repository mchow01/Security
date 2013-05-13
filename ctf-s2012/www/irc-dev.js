var counter = 0;

function HtmlEncode(s)
{
	var el = document.createElement("div");
	el.innerText = el.textContent = s;
	s = el.innerHTML;
	delete el;
	return s;
}
	
function init()
{
	setInterval(reload, 1000);
	if (localStorage["handle"]) {
		login();
	}
}
	
function reload()
{
	$.getJSON('http://lecturer.heroku.com/posts.json', function(data) {
		for (i = counter; i < data.length; i++) {
			console.log(data[i]);
			$("div#log").append('<p><span class="username">' + HtmlEncode(data[i].username) + '</span> <span class="datetime">' + data[i].created_at + '</span>: <span class="msg">' + HtmlEncode(data[i].content) + '</span></p>')
		}
		counter = data.length;
	});
}
	
function store()
{
	msg = document.getElementById("msg").value;
	postData = {'post[username]':localStorage['handle'], 'post[content]':msg};
	$.post('http://lecturer.heroku.com/posts', postData);
	reload();
}

function login()
{
	if (!localStorage["handle"]) {
		h = document.getElementById("handle").value;
		localStorage["handle"] = h;
	}
	try {
		document.getElementById("panel").innerHTML = '<p>' + localStorage["handle"] + ' &gt; <input type="text" id="msg" onchange="store()" maxlength="160" /></p>';
	}
	catch (error) {
	}
	reload();
}
