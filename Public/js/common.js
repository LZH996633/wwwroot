var ie6 = /msie 6/i.test(navigator.userAgent),dv = $(".header"),st;
dv.attr("otop", dv.offset().top);
$(window).scroll(function() {
	st = Math.max(document.body.scrollTop || document.documentElement.scrollTop);
	if (st > parseInt(dv.attr("otop"))) {
		if (ie6) {
			dv.css({
				position: "absolute",
				top: st
			});
		} else if (dv.css("position") != "fixed") {
			dv.css({
				position: "fixed",
				top: 0
			});
			$(".normaltop .downnav").find("ul").hide();
			dv.addClass("fixedtop");
			dv.removeClass("normaltop");
			$(".fixedtop .downnav").hover(function() {
				$(".fixedtop .downnav").find("ul").stop(true, true).show();
			}, function() {
				$(".fixedtop .downnav").find("ul").stop(true, true).hide();
			})
		}
	} else if (dv.css("position") != "static") {
		dv.css({
			position: "static"
		});
		dv.addClass("normaltop");
		dv.removeClass("fixedtop");
		$(".normaltop .downnav").find("ul").show();
	}
});






