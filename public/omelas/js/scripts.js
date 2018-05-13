
 


//hide description
$(document).ready(function(){
    $("hider").click(function(){
        $("hide-show").toggle();
    });
});

//product-color-change
$(document).ready(function(){
$(".color1").hover(function() {
$( '.main-img' ).attr("src","product2.jpg");
}, function() {
});


//to Top
$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.toTop a').fadeIn();
    } else {
        $('.toTop a').fadeOut();
    }
});

// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


function openSearch() {
    document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
    document.getElementById("myOverlay").style.display = "none";
}

//top

$('a[href=#top]').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 600);
    return false;
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.toTop a').fadeIn();
    } else {
        $('.toTop a').fadeOut();
    }
});
