<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>跳转提示</title>
</head>
<style>
	body, h1, h2, h3, h4, h5, h6, p, ul, ol, li, form, img, dl, dt, dd, table, th, td, blockquote, fieldset, div, strong, label, em{margin:0; padding:0; border:0; }
	ul, ol, li{list-style:none; }
	input, button{margin:0; font-size:12px; vertical-align:middle; }
	body{font:12px microsoft yahei, arial, helvetica, sans-serif  arial, helvetica, sans-serif; margin:0; color:#868686; }
	table{border-collapse:collapse; border-spacing:0; }
	a{text-decoration:none; outline:none; color:#868686;  }

	a:hover{text-decoration:none; -moz-transition:color .4s linear; -webkit-transition:color .4s linear; transition:color .35s linear; color:#ffb800 }
	.cl{height:0; font-size:1px; clear:both; line-height:0; }
	.none{display:none}
	*:focus{outline:none}
	i,em,ins,u{font-style:normal; text-decoration:none }
	nav,footer,section,header,article{display:block; }
	.wraps{width:1200px; margin:0 auto; }
	.fl{float:left}
	.fr{float:right}
	.pr{position:relative}
	.pa{position:absolute}
	.clearfix:after{clear:both; }
	input[type="submit"],
	input[type="reset"],
	input[type="button"],

	::-webkit-scrollbar{width:10px;height:10px; }
	::-webkit-scrollbar-track{background:#f1f1f1; }
	::-webkit-scrollbar-track:hover{background:#eee; }
	::-webkit-scrollbar-thumb{border-radius:10px;background:#b9b9b9; }
	::-webkit-scrollbar-thumb:hover{background:#747474; }
	::-webkit-scrollbar-thumb:active{background:#555; }
	.main{ width:100%; margin:0 auto;}
	.main .dlsbcmt{ overflow:hidden; margin:50px 0}
	.main .dlsbcmt .pic{ float:left; width:33%; overflow:hidden;}
	.main .dlsbcmt .pic img{ display:block; width:80%; float:right}
	.main .dlsbcmt .word{ float:left; width:58%;}
	.main .dlsbcmt .word dl{ padding:4% 0 0 10%; font-size:15px; color:#464646; line-height:24px;}
	.main .dlsbcmt .word dt{ font-size:20px; color:#38ae4a; padding-bottom:8%;}
	.main .dlsbcmt .word dd a{ color:#464646; text-decoration:underline;margin-right: 20px}
	.main .dlsbcmt .word dd{ padding-top:4px;}

</style>
<script src="__JS__/jquery.1.9.1.min.js" type="text/javascript"></script>
<script src="__JS__/layer.js" type="text/javascript"></script>
<link  href="__CS__/layer.css" rel="stylesheet"  type="text/css">
<body>
<div class="main" id="main">
	<div class="dlsbcmt">
		<div class="pic"><img src="<?php echo $ad['ad_pic'] ?>"></div>
		<div class="word">
			<dl>
				<dt><?php echo($message); ?></dt>
				<dt><?php echo($error); ?></dt>
				<dd><a href="javascript:history.back();" >Go back</a><a id="href" href="<?php echo($jumpUrl); ?>" >Jump now</a>Waiting time： <b id="wait"><?php echo($waitSecond); ?></b></dd>
			</dl>
		</div>
	</div>
</div>
<script type="text/javascript">
	(function(){
		var wait = document.getElementById('wait'),href = document.getElementById('href').href;
		var interval = setInterval(function(){
			var time = --wait.innerHTML;
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
	})();
</script>
<script>
	var index = parent.layer.getFrameIndex(window.name);
	if(index){
		parent.layer.style(index,{
			width:'30%',
			left:'33%',
			top:'30%'
		});
		parent.layer.iframeAuto(index)

	}else{
		layer.open({
			title:'Prompt information',
			closeBtn: 0,
			type:1,
			content:$("#main"),
			area:['33%']
		});
	}

</script>
</body>
</html>
