(function($) {
    "use strict";

	// ______________ Page Loading
	$(window).on("load", function(e) {
		$("#global-loader").fadeOut("slow");
	})

	// ______________Full screen
	$(document).on("click", ".fullscreen-button", function toggleFullScreen() {
		$('html').addClass('fullscreen-content');
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			$('html').removeClass('fullscreen-content');
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	})
	

	// ______________Cover Image
	$(".cover-image").each(function() {
		var attr = $(this).attr('data-image-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background', 'url(' + attr + ') center center');
		}
	});


	// ______________ Horizonatl
	$(document).ready(function() {
      $("a[data-theme]").on('click', function() {
        $("head link#theme").attr("href", $(this).data("theme"));
        $(this).toggleClass('active').siblings().removeClass('active');
      });
      $("a[data-effect]").on('click', function() {
        $("head link#effect").attr("href", $(this).data("effect"));
        $(this).toggleClass('active').siblings().removeClass('active');
      });
    });

	// ______________ Tooltip
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
	})
	

	
	// __________POPOVER
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
	var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
	  return new bootstrap.Popover(popoverTriggerEl)
	})
	

	// __________MODAL
	// showing modal with effect
	$('.modal-effect').on('click', function(e) {
		e.preventDefault();
		var effect = $(this).attr('data-effect');
		$('#modaldemo8').addClass(effect);
	});
	// hide modal with effect
	$('#modaldemo8').on('hidden.bs.modal', function(e) {
		$(this).removeClass(function(index, className) {
			return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
		});
	});


	// ______________Back to top Button
	$(window).on("scroll", function(e) {
    	if ($(this).scrollTop() > 0) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $("#back-to-top").on("click", function(e){
        $("html, body").animate({
            scrollTop: 0
        }, 0);
        return false;
    });

	// ______________ Chart-circle
	if ($('.chart-circle').length) {
		$('.chart-circle').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: '#e5e9f2',
			  lineCap: 'round'
			});
		});
	}
	// ______________ Chart-circle
	if ($('.chart-circle-primary').length) {
		$('.chart-circle-primary').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: 'rgba(51, 102, 255, 0.4)',
			  lineCap: 'round'
			});
		});
	}

	// ______________ Chart-circle
	if ($('.chart-circle-secondary').length) {
		$('.chart-circle-secondary').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: 'rgba(254, 127, 0, 0.4)',
			  lineCap: 'round'
			});
		});
	}

	// ______________ Chart-circle
	if ($('.chart-circle-success').length) {
		$('.chart-circle-success').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: 'rgba(13, 205, 148, 0.5)',
			  lineCap: 'round'
			});
		});
	}

	// ______________ Chart-circle
	if ($('.chart-circle-warning').length) {
		$('.chart-circle-warning').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: 'rgba(247, 40, 74, 0.4)',
			  lineCap: 'round'
			});
		});
	}

	// ______________ Chart-circle
	if ($('.chart-circle-danger').length) {
		$('.chart-circle-danger').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: 'rgba(247, 40, 74, 0.4)',
			  lineCap: 'round'
			});
		});
	}

	// ______________ Global Search
	$(document).on("click", "[data-bs-toggle='search']", function(e) {
		var body = $("body");

		if(body.hasClass('search-gone')) {
			body.addClass('search-gone');
			body.removeClass('search-show');
		}else{
			body.removeClass('search-gone');
			body.addClass('search-show');
		}
	});
	var toggleSidebar = function() {
		var w = $(window);
		if(w.outerWidth() <= 1024) {
			$("body").addClass("sidebar-gone");
			$(document).off("click", "body").on("click", "body", function(e) {
				if($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
					$("body").removeClass("sidebar-show");
					$("body").addClass("sidebar-gone");
					$("body").removeClass("search-show");
				}
			});
		}else{
			$("body").removeClass("sidebar-gone");
		}
	}
	toggleSidebar();
	$(window).resize(toggleSidebar);

	const DIV_CARD = 'div.card';
	
	// ______________ Function for remove card
	$(document).on('click', '[data-bs-toggle="card-remove"]', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.remove();
		e.preventDefault();
		return false;
	});
	// ______________ Functions for collapsed card
	$(document).on('click', '[data-bs-toggle="card-collapse"]', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	
	// ______________ Card full screen
	$(document).on('click', '[data-bs-toggle="card-fullscreen"]', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');
		e.preventDefault();
		return false;
	});

	//Input file-browser
	$(document).on('change', '.file-browserinput', function() {
		var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
	});// We can watch for our custom `fileselect` event like this

	//______File Upload
	$('.file-browserinput').on('fileselect', function(event, numFiles, label) {
			var input = $(this).parents('.input-group').find(':text'),
			log = numFiles > 1 ? numFiles + ' files selected' : label;
			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}
	});

	//______Select2
	$('.select2').select2({
		minimumResultsForSearch: Infinity,
		width: '100%'
	});

	//______Product carosuel
	$('.thumb').on('click', function () {
		if(!$(this).hasClass('active'))
		{
			$(".thumb.active").removeClass("active");
			$(this).addClass("active");
		}
	});

	// ______________ SWITCHER-toggle ______________//
	
	$('.layout-setting').on("click", function(e) {
		if (document) {
			$('body').toggleClass('dark-mode');
		} else {
			$('body').removeClass('dark-mode');
			$('body').addClass('light-mode');
		}
	});

	

	  $('.default-menu').on('click', function() {
		var ww = document.body.clientWidth;
		if (ww >= 992) {
			$('body').removeClass('sidenav-toggled');
		}
	});



	//______Switcher

	/*Theme-layout*/
	// $('body').addClass('light-mode');
	// $('body').addClass('dark-mode');

	/*Header Style*/
	// $('body').addClass('light-header');
	// $('body').addClass('color-header');
	// $('body').addClass('dark-header');
	// $('body').addClass('gradient-header');

	/*Leftmenu Style*/
	// $('body').addClass('light-menu');
    // $('body').addClass('color-menu');
	// $('body').addClass('dark-menu');
	// $('body').addClass('gradient-menu');

	/*Horizontal Style*/
	// $('body').addClass('light-hormenu');
	// $('body').addClass('color-hormenu');
	// $('body').addClass('dark-hormenu');
	// $('body').addClass('gradient-hormenu');


	/*Theme-layout*/

	/*Light Layout Start*/
    	// $('body').addClass('light-mode');
	/*Light Layout End*/

	/*Dark Layout Start*/
    	// $('body').addClass('dark-mode');
	/*Dark Layout End*/

	/*Light Menu Start*/
    	// $('body').addClass('light-menu');
	/*Light Menu End*/

    /*Color Menu Start*/
   		// $('body').addClass('color-menu');
	/*Color Menu End*/

    /*Dark Menu Start*/
    	// $('body').addClass('dark-menu');
	/*Dark Menu End*/

	/*Gradient Menu Start*/
    	// $('body').addClass('gradient-menu');
	/*Gradient Menu End*/

	/*Light Header Start*/
    	// $('body').addClass('light-header');
	/*Light Header End*/

	/*Color Header Start*/
   		// $('body').addClass('color-header');
	/*Color Header End*/

	/*Dark Header Start*/
		// $('body').addClass('dark-header');
	/*Dark Header End*/

	/*Gradient Header Start*/
		// $('body').addClass('gradient-header');
	/*Gradient Header End*/

	/*Boxed Layout Start*/
		// $('body').addClass('boxed');
	/*Boxed Layout End*/

	
	/*Default Sidemenu Start*/
		// $('body').addClass('default-menu');
	/*Default Sidemenu End*/

	
	/*Closed Sidemenu Start*/
		// $('body').addClass('closed-menu');
		// $('body').addClass('sidenav-toggled');
	/*Closed Sidemenu End*/

	/*Hover Submenu Start*/
		//  $('body').addClass('hover-submenu');
		//  $('body').addClass('sidenav-toggled');
	/*Hover Submenu Start*/

	
	/*Hover Submenu1 Start*/
		// $('body').addClass('hover-submenu1');
		// $('body').addClass('sidenav-toggled');
	/*Hover Submenu1 Start*/

	/*icon-overlay Start*/
		// $('body').addClass('icon-overlay');
		// $('body').addClass('sidenav-toggled');
	/*icon-overlay Start*/
	
	/*Icon Text Sidemenu Start*/
		// $('body').addClass('icon-text');
		// icontext();
		// $('body').addClass('sidenav-toggled');
	/*Icon Text Sidemenu End*/


	/*Horizontal Style*/

		/*Light Hormenu Start*/
			// $('body').addClass('light-hormenu');
		/*Light Hormenu End*/

		/*Color Hormenu Start*/
			// $('body').addClass('color-hormenu');
		/*Color Hormenu End*/

		/*Dark Hormenu Start*/
			// $('body').addClass('dark-hormenu');
		/*Dark Hormenu End*/

		/*Gradient Hormenu Start*/
			// $('body').addClass('gradient-hormenu');
		/*Gradient Hormenu End*/

	/*Horizontal Style*/

	/*RTL Layout Style*/
		//  $('body').addClass('rtl');
	/*RTL Layout Style End*/


	
	

})(jQuery);


//______Success Notification
function not1(){
	notif({
		msg: "<b><i class='fa fa-check fs-20 me-2'></i></b> Well done Details Submitted Successfully",
		type: "success"
	});
}

