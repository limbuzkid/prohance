$(document).ready(function() {

    /*-----------------Product Rotate Starts-----------------*/
    $(function(){
        setTimeout(function(){
            var src = $('iframe').attr('src');
            $('iframe').attr('src',src+'&wmode=opaque');
        },500);

        /*Fullpage-Js START*/
            $('#fullpage').fullpage({
                'verticalCentered': false,
                'css3': true,
                /*'sectionsColor': ['#F0F2F4', '#fff', '#fff', '#fff'],*/
                'navigation': true,
                'navigationPosition': 'right',
                'easingcss3': 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
                'afterLoad': function(anchorLink, index){
                    $('#fullpage .section').eq(0).removeClass("moveDown");
                    if(index == 1){
                        //$('.section').eq(0).removeClass("init");
                        //$('#iphone3, #iphone2, #iphone4').addClass('active');
                    }
                },
                'onLeave': function(index, nextIndex, direction){
                    anim();                 
                    if(index==1){
                        $('.bg-img').addClass('active');
                    }
                    else
                    {
                        $('.bg-img').removeClass('active');
                    }

                    if((index==3 && direction =='down') || (index==4 && direction =='down') || (index==5 && direction =='up')){
                        $('#rotator').hide();
                    }
                    else
                    {
                        $('#rotator').fadeIn();
                    }
                    if(nextIndex == 2 && direction == "down"){
                        $('#fullpage .section').eq(index-1).addClass("moveUp")
                        $('#fullpage .section').eq(nextIndex-1).removeClass("moveDown");
                        $('.static').addClass("moveUp");
                    }

                    if(nextIndex == 1 && direction == "up"){
                        $('#fullpage .section').eq(nextIndex-1).removeClass("moveUp")
                        $('#fullpage .section').eq(index-1).addClass("moveDown");
                        $('.static').removeClass("moveUp");
                    }
                    
                }
            });
        /*Fullpage-Js END*/
        var lFollowX = 0,
lFollowY = 0,
x = 0,
y = 0,
friction = 1 / 30;

function moveBackground() {
x += (lFollowX - x) * friction;
y += (lFollowY - y) * friction;

translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';

$('.petals').css({
'-webit-transform': translate,
'-moz-transform': translate,
'transform': translate
});

window.requestAnimationFrame(moveBackground);
}

$(window).on('mousemove click', function(e) {

var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
lFollowY = (10 * lMouseY) / 100;

});

moveBackground();
        
    });

    function anim(){
            var rotator = $('#rotator');                     
            var x = 300;
            var productRotation = setInterval(function(){
                var backgroundPos = $('#rotator').css('backgroundPosition').split(" ");
                // alert(backgroundPos)
                var xPos = backgroundPos[0];
                var finalPos = parseInt(xPos)*(-1);
                
                // console.log(finalPos , "-="+ x)
                if(finalPos==22200)
                {
                    console.log("A");
                    clearInterval(productRotation);
                    setTimeout(function(){
                        rotator.css('background-position', '0 0');
                    },100);
                    
                }
                else{
                    // console.log("B");
                    $('#rotator').css('background-position','-='+x+'px');
                }
            },15);
    }
    /*-----------------Product Rotate Ends-----------------*/


    
    /*-----------------Prohance-D Page Starts-----------------*/

    //Section main-banner Starts
    var header_height = $('header').outerHeight();
    var footer_height = $('footer').outerHeight();
    var sec_height = $('section.main-banner').css({'height': 'calc(100vh)'});
    //Section main-banner Ends


    //Section video-scoop Starts
    $('section.video-scoop .wrapper').css({'height': 'calc(100vh)'});
    //Section video-scoop Ends

    /*-----------------Prohance-D Page Ends-----------------*/


    /*-----------------Landing Page Starts-----------------*/
    var total_height = header_height + footer_height + 'px';
    $('.landing-page main').css({'margin-top' : header_height});
    $('section.product').css({'height': 'calc(100vh - '+ total_height +')'});
    /*-----------------Landing Page Ends-----------------*/
});