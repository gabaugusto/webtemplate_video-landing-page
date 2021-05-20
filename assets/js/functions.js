/* ////////////////////// */
//Scroll to ID
function ScrollTo(name) {
    ScrollToResolver(document.getElementById(name));
}

function ScrollToResolver(elem) {
    var jump = parseInt(elem.getBoundingClientRect().top * .4);
    document.body.scrollTop += jump;
    document.documentElement.scrollTop += jump;
    //lastjump detects anchor unreachable, also manual scrolling to cancel animation if scroll > jump
    if (!elem.lastjump || elem.lastjump > Math.abs(jump)) {
        elem.lastjump = Math.abs(jump);
        setTimeout(function () {
            ScrollToResolver(elem);
        }, "50");
    } else {
        elem.lastjump = null;
    }
}


/* ////////////////////// */
//Send info via Ajax
var frm = $('#form');
frm.submit(function (ev) {

    var data = {
        name: $("#name").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        msg: $("#msg").val()
    };
    ev.preventDefault();
    $.ajax({
        type: "post",
        url: "send.php",
        data: data,
        success: function (res) {
            $('.messageSucess').css('display', 'block');
        }
    });
});


/* ////////////////////// */
//ResponsiveMenu
function actMenu() {
    var x = document.getElementById("mainMenu");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

/* ////////////////////// */
//Sticky Menu
var stickyNavTop = $('.contentHeader').offset().top;
var stickyNav = function () {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 400) {
        $('.contentHeader').addClass('sticky');
    } else {
        $('.contentHeader').removeClass('sticky');
    }
};

stickyNav();

$(window).scroll(function () {
    stickyNav();
});




/* ////////////////////// */
//Scroll to top
$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollToTop').fadeIn();
    } else {
        $('.scrollToTop').fadeOut();
    }
});

//ClickEvent to scroll to top
$('.scrollToTop').click(function () {
    goToTop();
    return false;
});

function goToTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 400);
    return false;
};

//Click Cookie
$(document).ready(function () {
    let cookie = getCookieValue('candidate_accept_cookies_guest');
    if (!cookie) {
        $('.cookies-snackbar').show();
        console.log('not saved')
    }
});

function getCookieValue(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function saveCookie() {
    const sixMonths = 182 * 24 * 60 * 60;
    document.cookie = `candidate_accept_cookies_guest=true; max-age=${sixMonths}; path=/; domain=.gupy.io`;
    $('.cookies-snackbar').hide();
}