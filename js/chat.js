
//ajax for loading the menu_left from php - server
	function _(e){
		return document.getElementById(e);
	}
	
	function loadlink(){
		$('#menu_left').load('menu_left_content.php');
	}

	loadlink();
	setInterval(function(){
		loadlink()
	}, 5000);

	var label_chat = _("label_chat");
	
	label_chat.addEventListener("click",function(){

		var menu_left = _("menu_left");

		var ajax = new XMLHttpRequest();

		ajax.onload = function(){
			if(ajax.status == 200 || ajax.readyState == 4){
				menu_left.innerHTML = ajax.responseText;
			}
		}

		ajax.open("POST", "menu_left_content.php", true);
		ajax.send();

	});


//ajax to send msg to db

	/*var send_msg = _("send_msg");

	send_msg.addEventListener("click", function(){
		var xml = new XMLHttpRequest();

		xml.open("POST", "chat_content.php", true);
		xml.send();
	});

	


	send_msg.addEventListener("click", collect_data_msg);

	function collect_data_msg(){
		var form = _("myForm");
		var inputs = form.getElementsByTagName("INPUT");

		var data = {};

		for (var i = inputs.length - 1; i >= 0; i--) {
			
			var key = inputs[i].name;
		
			switch(key){
				case "input_text": 
					data.input_text = inputs[i].value;
				break;
				case "session": 
					data.session = inputs[i].value;
				break;
			}
		}

		send_data_msg(data, "submit_message");
	}

	function send_data_msg(data, type){
		var xml = new XMLHttpRequest();
		
		data.data_type = type;
		var data_string = JSON.stringify(data);			

		_("chat_text").innerHTML = "bla";

		xml.open("POST", "chat_submit_content.php", true);
		xml.send(data_string);

	}
	*/
