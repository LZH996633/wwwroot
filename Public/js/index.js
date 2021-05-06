
var currentUrl = this.location.href;
/*head.ready('jquerycookie', function() {   
     var design=$.cookie('cwDNG__designer');
     console.log(design);     
    $('.index_hot dl').each(function(i){
       if(design){
       	$(this).append('<a href="index.php?m=ad&c=member&a=buy&aid=1&adid='+(i+1)+'" class="wmxhji" target="_blank">我要出现在这里</a>');
       }
    });
    
});*/
head.ready('imgload', function() {
    $('img.lazy').imglazyload({
        event: 'scroll',
        attr: 'lazy-src'
    });
    
});
head.ready('flexslider', function() {
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false,
        pauseOnHover: true
    });
});