/**
 * Default project scripts go here
 */

// Sticky Header
jQuery(document).ready(function ($) {
	$(window).scroll(function () {
		// Variables
		var header = jQuery(".ar-header");
		var offset = jQuery(".ar-header").height();
		var scrollPosition = jQuery(window).scrollTop();

		// Add/remove sticky classes based on scroll position
		if (scrollPosition >= offset) {
			header.addClass("sticky-header");

			// Special case for home header (Transparent theme)
			if (header.is("#home-header")) {
				header.removeClass("home-header");
			}
		} else {
			header.removeClass("sticky-header");

			// Special case for home header (Transparent theme)
			if (header.is("#home-header")) {
				header.addClass("home-header");
			}
		}
	});
});

// Sticky Header 2
jQuery(document).ready(function ($) {
	var d = $('.site-header');
	d.scrollToFixed({
	  zIndex: 999
	});

	$(window).scroll(function () {
		scroll = $(window).scrollTop();
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			if (scroll >= 50) d.addClass('smheader');
			else d.removeClass('smheader');
		} 
    	else {
			if (scroll >= 80) d.addClass('smheader');
			else d.removeClass('smheader');
	    }	
	});
});

// Scroll to top
jQuery(document).ready(function ($) {
	$("#scroll-to-top").on("click", function () {
		$("html, body").animate({ scrollTop: 0 }, "slow", function () {});
	});
});

//Slide Toggle for menu
jQuery(document).ready(function ($) {
	$(".navbar__icon").on("click", function () {
	  $(".site-header .navbar__menu").slideToggle(200);
	  $(".site-header .navbar__menu").toggleClass("open");
	});
});

//Flexslider JS Slider
jQuery(document).ready(function ($) {
	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: true,
		animationSpeed: 4000,
		directionNav: true
	});
});

// Ajax posts filter
jQuery(function ($) {
	$("#filter").submit(function () {
		var filter = $("#filter");
		$.ajax({
			url: filter.attr("action"),
			data: filter.serialize(), // form data
			type: filter.attr("method"), // POST
			beforeSend: function (xhr) {
				filter.find("button").text("Loading..."); // changing the button label
			},
			success: function (data) {
				filter.find("button").text("Apply filter"); // changing the button label back
				$("#response").html(data); // insert data
			},
		});
		return false;
	});
});
  
  
//GSAP ANIMATION
jQuery(document).ready(function ($) {
	setTimeout(function () {
	  // Loop through all images in the template and store the src and alt attr
	  var igImages = [];
	  $(".igfeed #sb_instagram .sbi_item .sbi_photo img").each(function () {
		igImages.push({
		  url: $(this).attr("src"),
		  alt: $(this).attr("alt")
		});
	  }); // Split result into two arrays of 4 images and store
  
	  var first4Images = igImages.splice(0, 4);
	  var second4Images = igImages.splice(0, 4);
	  var images = [first4Images, second4Images]; // Find the two target divs for the images and store
  
	  var targets = [$(".igfeed .igfeed__aside--start"), $(".igfeed .igfeed__aside--end")]; // Loop through images array and append the img template
  
	  $.each(images, function (index, arr) {
		var target = targets[index];
		$.each(arr, function (index, obj) {
		  var img = "\n        <div  class=\"igfeed__img\">\n          <img src=".concat(obj.url, " alt=").concat(obj.alt, ">\n        </div>\n        ");
		  target.append(img);
		});
	  }); // Retrieve instagram page url and set in follow btn
  
	  var btnTarget = $("#igfeed__btn--follow");
	  var btnSrc = $(".igfeed #sb_instagram .sbi_follow_btn a").attr("href");
	  btnTarget.attr("href", btnSrc); // Remove Smash balloon Feed from document
  
	  $(".igfeed__template").remove();
	}, 50); // A 50ms delay allows the Smash balloon feed scripts to pull in the data from Instagram and load into the document
}); // GSAP Animations (fromLeft, fromRight, fromBottom, fromTop)
  
var animateFrom = function animateFrom(elem, direction) {
	direction = direction || 1;
	var x = 0,
		y = direction * 50;
  
	if (elem.classList.contains("gs__reveal--fromLeft")) {
	  x = -50;
	  y = 0;
	} 
	else if (elem.classList.contains("gs__reveal--fromRight")) {
	  x = 50;
	  y = 0;
	}
	else if (elem.classList.contains("gs__reveal--fromBottom")) {
	  x = 0;
	  y = 80;
	}
	else if (elem.classList.contains("gs__reveal--fromTop")) {
	  x = 0;
	  y = -80;
	}
  
  
	elem.style.transform = "translate(" + x + "px, " + y + "px)";
	elem.style.opacity = "0"; // elem.style.overflow = "visible";
	// elem.parentNode.style.position = "relative";
	// elem.parentNode.style.overflowX = "auto";
  
	gsap.fromTo(elem, {
	  x: x,
	  y: y,
	  autoAlpha: 0
	}, {
	  duration: 1.25,
	  x: 0,
	  y: 0,
	  autoAlpha: 1,
	  ease: "expo",
	  overwrite: "auto"
	});
};
  
var hide = function hide(elem) {
	return gsap.set(elem, {
	  autoAlpha: 0
	});
};
  
jQuery(document).ready(function ($) {
	gsap.registerPlugin(ScrollTrigger);
	gsap.utils.toArray(".gs__reveal").forEach(function (elem) {
	  hide(elem); // assure that the element is hidden when scrolled into view
  
	  ScrollTrigger.create({
		trigger: elem,
		onEnter: function onEnter() {
		  animateFrom(elem);
		},
		onEnterBack: function onEnterBack() {
		  animateFrom(elem, -1);
		},
		onLeave: function onLeave() {
		  hide(elem);
		} // assure that the element is hidden when scrolled into view
  
	  });
	});
});


// Accordion JS
jQuery(document).ready(function ($) {
	$("body").delegate(".intro", "click", function (e) {
		e.stopPropagation();
		var c = $(this).parents(".accordion__hld"),
			m = c.find('.content');
		$(".accordion__hld .content").not(m).slideUp(1000);
		m.slideToggle(1000);
    //$(".icon").removeClass('active');
    $(this).find(".icon").toggleClass('active');
    $(this).parent().siblings().find('.intro').find('.icon').removeClass('active');
	});
});



//PAGE ANIMATIONS
jQuery(document).ready(function ($) {
	var $animation_elements = $('.js-anime');
	var $window = $(window);
	  
	function check_if_in_view() {
		var window_height = $window.height();
		var window_top_position = $window.scrollTop();
		var window_bottom_position = (window_top_position + window_height);
		
		$.each($animation_elements, function() {
			var $element = $(this);
			var element_height = $element.outerHeight();
			var element_top_position = $element.offset().top;
			var element_bottom_position = (element_top_position + element_height);
			
			if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
				$element.addClass('in-view');
			} else {
				$element.removeClass('in-view');
			}
		});
	}
	  
	$window.on('scroll resize', check_if_in_view);
	$window.trigger('scroll');
  
});


//Fancybox for Images
jQuery(document).ready(function ($) {
	$('[data-fancybox="gallery"]').fancybox({
	  loop: true,
	  buttons: [
		"zoom",
		"share",
		"slideShow",
		"fullScreen",
		//"download",
		"thumbs",
		"close"
	  ]
	});
});
  
//Isotope JS for filter functionality
jQuery(document).ready(function ($) {
	var $grid = $('.grid').isotope({
	  // options
	  itemSelector: '.grid-item',
	  layoutMode: 'fitRows'
	});
  
	$('.filter-button-group').on( 'click', 'button', function() {
		var filterValue = $(this).attr('data-filter');
		$grid.isotope({ filter: filterValue });
	});
  
});

// Counter JS
jQuery(document).ready(function ($) {
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});
});