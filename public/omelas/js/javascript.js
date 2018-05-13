var pContainerHeight = $('.bird-box').height();

$(window).scroll(function(){

  var wScroll = $(this).scrollTop();

  if (wScroll <= pContainerHeight) {

    $('.logo').css({
      'transform' : 'translate(0px, '+ wScroll /2 +'%)'
    });

    $('.back-bird').css({
      'transform' : 'translate(0px, '+ wScroll /4 +'%)'
    });

    $('.fore-bird').css({
      'transform' : 'translate(0px, -'+ wScroll /40 +'%)'
    });

  }








var pageContainerHeight = $('section').height();

$(window).scroll(function(){

  var windowScroll = $(this).scrollTop();

  
  if(wScroll > $('.products').offset().top - ($(window).height() / 1.2)) {

    $('.products product').each(function(i){

      setTimeout(function(){
        $('.products product').eq(i).addClass('is-showing');
      }, (700 * (Math.exp(i * 0.14))) - 700);
    });




//hide description
$(document).ready(function(){
    $("hider").click(function(){
        $("hide-show").toggle();
    });
});

