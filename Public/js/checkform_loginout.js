// JavaScript Document

	
$(document).ready(function(){
	//右侧浮动
	$(".rightcolumn li").hover(function(){
		$(this).find(".zxmain").show();
		},
		function(){
			$(this).find(".zxmain").hide();
		});
	//登陆弹框
	$(".tabbtn .dl").click(
		function(){
		$(".zcf").slideUp();

		$(".loginf").slideDown();
	});
	$(".tabbtn .cz").click(
		function(){
		$(".loginf").slideUp();

		$(".zcf").slideDown();
	});
  /*  $(".tabbtn .phone").click(
        function(){
            $(".loginf").slideUp();
            $(".zcf").slideUp();
            $(".phone").slideDown();
        });*/

	$(".logina").click(function(){
		$(".logintk").slideDown();
		$(".graybg").fadeIn();
		$(".loginf").show();
		$(".zcf").hide();
	});
	$(".zcy").click(function(){
		$(".logintk").slideDown();
		$(".graybg").fadeIn();
		$(".loginf").hide();
		$(".zcf").show();
	});
	$(".graybg,.closed").click(function(){
		$(".logintk").slideUp();
		$(".graybg").fadeOut();
	});
});

function save_username(form) {
	if(form.username.value==''){
		$("#utip").attr("class","onError").html("Username or email cannot be empty");
		form.username.focus();
		return false;
	}
	if(form.password.value==''){
		$("#ptip").html("password can not be blank").attr("class","onError");
		form.password.focus();
		return false;
	}
	if($('#cookietime').attr('checked')==true) {
		var username = $('#log_username').val();
		setcookie('username', username, 3);
	} else {
		delcookie('username');
	}
}
/*var username = getcookie('username');
if(username != '' && username != null) {
	$('#log_username').val(username);
	$('#cookietime').attr('checked',true);
}*/


$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});

$("#username")
	.formValidator({
	onshow:"please enter user name",
	onfocus:"3-20 characters, beginning with a letter, consisting of numbers, letters or underscores"})
    .inputValidator({
	min:3,max:20,onerror:"User name is between 3-20 characters"})
	.regexValidator({regexp:"username",datatype:"enum",onerror:"wrong format"}).ajaxValidator({
	type : "get",
	url : "/index.php/public/check_name",
	data :"",
	datatype : "json",
	async:'false',
	success : function(data){

	if( data.status == 'true') {

			return true;
		} else {
			return false;
		}
	},
	 buttons: $("#dosubmit"),
	 onerror : "Registration is forbidden or user name already exists",
	 onwait : "Verifying"
});
$("#password")
	.formValidator({onshow:"Please enter the password",onfocus:"6-20 characters, composed of numbers, letters or underscores"})
	.inputValidator({min:6,max:20,onerror:"Password is between 6-20 characters"})
.ajaxValidator({
type : "get",
	url : "/index.php/public/check_pass",
	data :"",
	datatype : "json",
	async:'false',
	success : function(data){

		if( data.status == 'true'  ) {
			return true;
		} else {
			return false;
		}
	},
	buttons: $("#dosubmit"),
	onerror : "There are special characters in the password",
	onwait : "Verifying"
});
$("#pwdconfirm")
	.formValidator({onshow:"Please enter a repeat password",onfocus:"Repeat password between 6-20 characters"})
	.inputValidator({min:6,max:20,onerror:"Repeat password between 6-20 characters"})
	.compareValidator({desid:"password",operateor:"=",onerror:"Passwords are not the same"});
$("#email")
	.formValidator({onshow:"please input your email",onfocus:"please input your email"})
	.regexValidator({regexp:"email",datatype:"enum",onerror:"E-mail format is incorrect"})
	.ajaxValidator({
	type : "get",
	url : "/index.php/public/check_email",
	data :"",
	datatype : "json",
	async:'false',
	success : function(data){

		if( data.status == 'true' ) {
			return true;
		} else {
						return false;
		}
	},
	buttons: $("#dosubmit"),
	onerror : "Registration is forbidden or the mailbox already exists",
	onwait : "Verifying"
});


$("#emailword")
	.formValidator({onshow:"please enter verification code",onfocus:"The verification code is a 5-digit pure number"})
	.inputValidator({min:5,max:5,onerror:"The verification code is a 5-digit pure number"});


$("#code").formValidator({onshow:" 2131231",onfocus:" ",onerror:" "}).regexValidator({regexp:"code",datatype:"enum",onerror:"Verification code error"}).functionValidator({
            fun: function (val) {
				
                if ($(".gt_ajax_tip").hasClass("gt_success")) {
                    
					$("#codeTip").hide();
					return true;
					
                }
				$(".gt_ajax_tip").addClass("gt_fail");
                return false;
            },
			onerror:" "
			
        });
$(":checkbox[name='protocol']").formValidator({tipid:"protocoltip",onshow:" ",onfocus:" "}).inputValidator({min:1,onerror:"{L('Please check and agree')}"});