var inputNRIC = document.getElementById("inputNRICFIN");
var inputPass = document.getElementById("inputPassword");
var isNric = false;
var isPass = false;

const nricHandler = function(e) {
    if (e.target.value.length == 9) {
        isNric = true;
    } else {
        isNric = false;
    }

    if (isNric && isPass) {
        enableButton(false);
    } else {
        enableButton(true);
    }
}

const passHandler = function(e) {
    if (e.target.value.length >= 8) {
        isPass = true;
    } else {
        isPass = false;
    }

    if (isNric && isPass) {
        enableButton(false);
    } else {
        enableButton(true);
    }
}

function enableButton(isEnable) {
    document.getElementById("sign-in-button").disabled = isEnable;
}

inputNRIC.addEventListener('input', nricHandler);
inputNRIC.addEventListener('propertychange', nricHandler);

inputPass.addEventListener('input', passHandler);
inputPass.addEventListener('propertychange', passHandler);

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  var user = getCookie("nric");
  if (user != "") {
    $('#inputNRICFIN').val(getCookie("nric"));
    $('#inputPassword').val(getCookie("password"));
    enableButton(false);
  }
}

$(function() {
  $("#loginForm").submit(function() {
    if ($('#customCheck').is(':checked')) {
      setCookie("nric", $('#inputNRICFIN').val(), 14);
      setCookie("password", $('#inputPassword').val(), 14);       
    }
  });
});

/*!
* Start Bootstrap - Freelancer v6.0.4 (https://startbootstrap.com/themes/freelancer)
* Copyright 2013-2020 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-freelancer/blob/master/LICENSE)
*/
(function($) {
    "use strict"; // Start of use strict
  
    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: (target.offset().top - 71)
          }, 1000, "easeInOutExpo");
          return false;
        }
      }
    });
  
    // Scroll to top button appear
    $(document).scroll(function() {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });
  
    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
      $('.navbar-collapse').collapse('hide');
    });
  
    // Activate scrollspy to add active class to navbar items on scroll
    // $('body').scrollspy({
    //   target: '#mainNav',
    //   offset: 80
    // });
  
    // Collapse Navbar
    var navbarCollapse = function() {
      if ($("#mainNav").offset().top > 100) {
        $("#mainNav").addClass("navbar-shrink");
      } else {
        $("#mainNav").removeClass("navbar-shrink");
      }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
  
    // Floating label headings for the contact form
    $(function() {
        $("body").on("input propertychange", ".floating-label-form-group", function(e) {
            $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
        }).on("focus", ".floating-label-form-group", function() {
            $(this).addClass("floating-label-form-group-with-focus");
        }).on("blur", ".floating-label-form-group", function() {
            $(this).removeClass("floating-label-form-group-with-focus");
        });
    });
  
})(jQuery); // End of use strict