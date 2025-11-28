// Header Toggle
$('.nav-toggle').click(function(e) {
	e.stopPropagation();
	$('.nav-toggle').toggleClass('active');
	$('.header-mob-nav').fadeToggle();
});

$(document).click(function(e) {
	if (!$('.nav-toggle').is(e.target) && $('.nav-toggle').hasClass('active')) {
	  $('.nav-toggle').removeClass('active');
	  $('.header-mob-nav').fadeOut(800);
	}
});

// Testimonials

const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    centeredSlides: true,
    // spaceBetween: 116,
    loop: true,
    autoplay: {
        delay: 5000,
    },
    breakpoints: {
        1920: {
            slidesPerView: 4.5,
            spaceBetween: 116,
            // intialSlide: 1,
        },
        1600: {
            slidesPerView: 3.5,
            spaceBetween: 75,
        },
        1400: {
            slidesPerView: 3.7,
            spaceBetween: 50,
        },
        1024: {
            slidesPerView: 3.2,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 2.2,
            spaceBetween: 15,
            centeredSlides: true,
           
        },
        767: {
            slidesPerView: 1,
            spaceBetween: 30,
        },
    }	
});

// FAQ Accordions
if ($('.accordions').length) {
    var allPanels = $('.accordion > .accordion__content').hide();
    $('.accordion:first-child .accordion__content').show();
    $('.accordion:first-child').addClass('active');
    $('.accordion:first-child .accordion__title').addClass('active');
    $('.accordion > .accordion__title').click(function() {
        var isOpen = $(this).next('.accordion__content:visible').length;
        if (isOpen) {
            $(this).next().slideUp();
            $('.accordion > .accordion__title').removeClass('active');
            $('.accordion').removeClass('active');
            return false;
        } else {
            allPanels.slideUp();
            $('.accordion').removeClass('active');
            $('.accordion > .accordion__title').removeClass('active');
            $(this).addClass('active');
            $(this).parents('.accordion').addClass('active');
            $(this).next().slideDown();
            return false;
        }
    });
}

// Header language change

let currentLanguage = 'en';

    function changeLanguage() {
    if (currentLanguage === 'en') {
        // Change to French
        document.querySelector('.flag').src = './france.png';
        document.querySelector('.language p').textContent = 'FR';
        currentLanguage = 'fr';
    } else {
        // Change back to English
        document.querySelector('.flag').src = './english.png';
        document.querySelector('.language p').textContent = 'EN';
        currentLanguage = 'en';
    }
}

let currentLanguagefr = 'fr';

function changeLanguage() {
  if (currentLanguage === 'fr') {
    // Change to English
    document.querySelector('.flag').src = './english.png';
    document.querySelector('.language p').textContent = 'EN';
    currentLanguage = 'en';
  } else {
    // Change back to French
    document.querySelector('.flag').src = './france.png';
    document.querySelector('.language p').textContent = 'FR';
    currentLanguage = 'fr';
  }
}


// loading screen

if ( $('.loading_screen').length > 0 ) {
    $('.loading_screen').delay(2500).fadeOut(500);
}