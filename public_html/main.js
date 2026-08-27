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
// Client-review preview safety
(function () {
    'use strict';

    var isFrench = document.documentElement.lang === 'fr';
    var previewMessage = isFrench
        ? "Cette action est d&eacute;sactiv&eacute;e dans la pr&eacute;visualisation client."
        : 'This action is disabled in the client review preview.';
    var formMessage = isFrench
        ? "Pr&eacute;visualisation uniquement : votre message n'a pas &eacute;t&eacute; envoy&eacute;."
        : 'Preview only: your message was not sent.';
    var messageTimer;

    function showPreviewMessage(message) {
        var actionMessage = document.getElementById('previewActionMsg');
        if (!actionMessage) {
            return;
        }

        window.clearTimeout(messageTimer);
        actionMessage.innerHTML = message;
        actionMessage.style.display = 'block';
        messageTimer = window.setTimeout(function () {
            actionMessage.style.display = 'none';
        }, 4000);
    }

    document.querySelectorAll('a[href*="app.immobiliermatrixfrance.fr"]').forEach(function (link) {
        link.classList.add('preview-disabled-action');
        link.setAttribute('aria-description', previewMessage);
    });

    document.addEventListener('click', function (event) {
        var link = event.target.closest('a[href*="app.immobiliermatrixfrance.fr"]');
        if (!link) {
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();
        showPreviewMessage(previewMessage);
    }, true);

    document.addEventListener('submit', function (event) {
        if (!event.target.matches('#contactForm')) {
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        if (!event.target.checkValidity()) {
            event.target.reportValidity();
            return;
        }

        var contactMessage = document.getElementById('contactMsg');
        contactMessage.classList.remove('error');
        contactMessage.classList.add('success');
        contactMessage.innerHTML = formMessage;
        contactMessage.style.display = 'block';
    }, true);
})();
