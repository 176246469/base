$(function(){
    $('.weui-menu-inner').click(function () {
        var $menu = $(this).find('ul'),
            height = $menu.find('li').length * 40 + 15 + 'px',
            opacity = $menu.css('opacity');

        $('.weui-menu-inner ul').css({
            'top': '0',
            'opacity': '0'
        });
        if(opacity == 0) {
            $menu.css({
                'top': '-' + height,
                'opacity': 1
            });
        }else {
            $menu.css({
                'top': 0,
                'opacity': 0
            });
        }
    });
    $("img").attr("src","data:image/jpg;base64,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"); 

    $('#slide1').swipeSlide({
        autoSwipe:true,//自动切换默认是
        speed:3000,//速度默认4000
        continuousScroll:true,//默认否
        transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
        lazyLoad:true,//懒加载默认否
        firstCallback : function(i,sum,me){
                    me.find('.dot').children().first().addClass('cur');
                },
                callback : function(i,sum,me){
                    me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
                }
    });

    $('#slide2').swipeSlide({
        autoSwipe:true,//自动切换默认是
        speed:3000,//速度默认4000
        continuousScroll:true,//默认否
        transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
        lazyLoad:true,//懒加载默认否
        firstCallback : function(i,sum,me){
                    me.find('.dot').children().first().addClass('cur');
                },
                callback : function(i,sum,me){
                    me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
                }
    });
    $('#slide3').swipeSlide({
        autoSwipe:true,//自动切换默认是
        speed:3000,//速度默认4000
        continuousScroll:true,//默认否
        transitionType:'ease-in'
    }); 
});    
      