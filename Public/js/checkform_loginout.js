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
		$("#utip").attr("class","onError").html("用户名或邮箱不能为空");
		form.username.focus();
		return false;
	}
	if(form.password.value==''){
		$("#ptip").html("密码不能为空").attr("class","onError");
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
	onshow:"请输入用户名",
	onfocus:"3-20字符，字母开头，由数字、字母或下划线组成"})
    .inputValidator({
	min:3,max:20,onerror:"用户名在3-20字符之间"})
	.regexValidator({regexp:"username",datatype:"enum",onerror:"格式错误"}).ajaxValidator({
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
	 onerror : "禁止注册或用户名已存在",
	 onwait : "验证中"
});
$("#password")
	.formValidator({onshow:"请输入密码",onfocus:"6-20个字符，由数字、字母或下划线组成"})
	.inputValidator({min:6,max:20,onerror:"密码在6-20个字符之间"})
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
	onerror : "密码中有特殊字符",
	onwait : "验证中"
});
$("#pwdconfirm")
	.formValidator({onshow:"请输入重复密码",onfocus:"重复密码在6-20个字符之间"})
	.inputValidator({min:6,max:20,onerror:"重复密码在6-20个字符之间"})
	.compareValidator({desid:"password",operateor:"=",onerror:"密码不相同"});
$("#email")
	.formValidator({onshow:"请输入邮箱",onfocus:"请输入邮箱"})
	.regexValidator({regexp:"email",datatype:"enum",onerror:"邮箱格式不正确"})
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
	onerror : "禁止注册或邮箱已存在",
	onwait : "验证中"
});


$("#emailword")
	.formValidator({onshow:"请输入验证码",onfocus:"验证码为5位纯数字"})
	.inputValidator({min:5,max:5,onerror:"验证码为5位纯数字"});


$("#code").formValidator({onshow:" 2131231",onfocus:" ",onerror:" "}).regexValidator({regexp:"code",datatype:"enum",onerror:"验证码错误"}).functionValidator({
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
$(":checkbox[name='protocol']").formValidator({tipid:"protocoltip",onshow:" ",onfocus:" "}).inputValidator({min:1,onerror:"{L('请勾选并同意')}"});