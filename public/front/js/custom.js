 

jQuery(document).ready(function($)
{

	$('.btn-search').click(function () {
		$('.clear-input').toggleClass('d-none  ');
	});
	
	/********************************التاجر******************************** */
    if (window.location.href==='http://127.0.0.1:5500/Store-Profile.html') {
      $(".header-index").css('display','none');
      $(".header-profile-user").css('display','none');
      $(".header-profile-store").css('display','block');
 
    }

    if (window.location.href==='http://127.0.0.1:5500/Pending-orders.html') {
      $(".header-index").css('display','none');
      $(".header-profile-user").css('display','none');
      $(".header-profile-store").css('display','block');
 
    }
    if (window.location.href==='http://127.0.0.1:5500/Store-notifications.html') {
      $(".header-index").css('display','none');
      $(".header-profile-user").css('display','none');
      $(".header-profile-store").css('display','block');
 
    }

	/********************************المستخدم******************************** */

	if (window.location.href==='http://127.0.0.1:5500/User-Profile.html') {
		$(".header-index").css('display','none');
		$(".header-profile-store").css('display','none');
		$(".header-profile-user").css('display','block');
	  }
  
	if (window.location.href==='http://127.0.0.1:5500/User-notifications.html') {
		$(".header-index").css('display','none');
		$(".header-profile-store").css('display','none');
		$(".header-profile-user").css('display','block');
	  }
  
  
	if (window.location.href==='http://127.0.0.1:5500/User-Pending-orders.html') {
		$(".header-index").css('display','none');
		$(".header-profile-store").css('display','none');
		$(".header-profile-user").css('display','block');
	  }
  


	// $('.btn-add-favorit').click(function() {
	// 	// $('icon-add-favorit').removeClass("active");
 
	// 	$('.icon-add-favorit').toggleClass('fa-heart-o fa-heart text-danger btn-add-favorit-i');

 
	// });

	$('.button-Products-like').click(function() {
		// $('icon-add-favorit').removeClass("active");
 
		$('.icon-add-favorit').toggleClass('fa-heart-o fa-heart text-danger btn-add-favorit-i');

 
	});
 
	document.getElementById("container-carousel").onmouseover = function() {mouseOver()};
	document.getElementById("container-carousel").onmouseout = function() {mouseOut()};


	function mouseOver() {
		document.getElementById("prev").style.display = "block";
		document.getElementById("next").style.display = "block";
	  }
	  
	  function mouseOut() {
		document.getElementById("prev").style.display = "none";
		document.getElementById("next").style.display = "none";
	  }

	"use strict";

	/* 

	1. Vars and Inits

	*/

	var header = $('.header');
	var topNav = $('.top_nav')
	var mainSlider = $('.main_slider');
	var hamburger = $('.hamburger_container');
	var menu = $('.hamburger_menu');
	var menuActive = false;
	var hamburgerClose = $('.hamburger_close');
	var fsOverlay = $('.fs_menu_overlay');

 


	 setHeader();

	$(window).on('resize', function()
	{
		initFixProductBorder();
		   setHeader();
	});

	$(document).on('scroll', function()
	{
		
	   setHeader();
	});

	initMenu();
	initTimer();
	initThumbnail();
	initQuantity();
	initStarRating();
	initFavorite();
	initFixProductBorder();
	initIsotopeFiltering();
	initProduct1Slider();
	initProduct2Slider();
	initProduct3Slider();
	initCatSlider();
	initPriceSlider();
	initCheckboxes();
	initTabs();

 

	/* 

	2. Set Header

	*/
	function setHeader()
	{
		if(window.innerWidth < 992)
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"0"});
				$('.dropdown-menu-right').css({'top':"138px"});
 			}
			else
			{
				header.css({'top':"0"});
				$('.dropdown-menu-right').css({'top':"138px"});
 			}
		}
		else
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"-75px"});
	 
				$('.dropdown-menu-right').css({'top':"62px"});
 			}
			else
			{
			
				header.css({'top':"0"});
				$('.dropdown-menu-right').css({'top':"138px"});
 			}
		}
		if(window.innerWidth > 991 && menuActive)
		{
			closeMenu();
		}
	}
 

	function initMenu()
	{
		if(hamburger.length)
		{
			hamburger.on('click', function()
			{
				if(!menuActive)
				{
					openMenu();
				}
			});
		}

		if(fsOverlay.length)
		{
			fsOverlay.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if(hamburgerClose.length)
		{
			hamburgerClose.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if($('.menu_item').length)
		{
			var items = document.getElementsByClassName('menu_item');
			var i;

			for(i = 0; i < items.length; i++)
			{
				if(items[i].classList.contains("has-children"))
				{
					items[i].onclick = function()
					{
						this.classList.toggle("active");
						var panel = this.children[1];
					    if(panel.style.maxHeight)
					    {
					    	panel.style.maxHeight = null;
					    }
					    else
					    {
					    	panel.style.maxHeight = panel.scrollHeight + "px";
					    }
					}
				}	
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		// menu.css('right', "0");
		fsOverlay.css('pointer-events', "auto");
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		fsOverlay.css('pointer-events', "none");
		menuActive = false;
	}

	/* 

	4. Init Timer

	*/

	function initTimer()
    {
    	if($('.timer').length)
    	{
    		// Uncomment line below and replace date
	    	// var target_date = new Date("Dec 7, 2017").getTime();

	    	// comment lines below
	    	var date = new Date();
	    	date.setDate(date.getDate() + 3);
	    	var target_date = date.getTime();
	    	//----------------------------------------
	 
			// variables for time units
			var days, hours, minutes, seconds;

			var d = $('#day');
			var h = $('#hour');
			var m = $('#minute');
			var s = $('#second');

			setInterval(function ()
			{
			    // find the amount of "seconds" between now and target
			    var current_date = new Date().getTime();
			    var seconds_left = (target_date - current_date) / 1000;
			 
			    // do some time calculations
			    days = parseInt(seconds_left / 86400);
			    seconds_left = seconds_left % 86400;
			     
			    hours = parseInt(seconds_left / 3600);
			    seconds_left = seconds_left % 3600;
			     
			    minutes = parseInt(seconds_left / 60);
			    seconds = parseInt(seconds_left % 60);

			    // display result
			    d.text(days);
			    h.text(hours);
			    m.text(minutes);
			    s.text(seconds); 
			 
			}, 1000);
    	}	
    }

    /* 

	5. Init Favorite

	*/

    function initFavorite()
    {
    	if($('.favorite').length)
    	{
    		var favs = $('.favorite');

    		favs.each(function()
    		{
    			var fav = $(this);
    			var active = false;
    			if(fav.hasClass('active'))
    			{
    				active = true;
    			}

    			fav.on('click', function()
    			{
    				if(active)
    				{
    					fav.removeClass('active');
    					active = false;
    				}
    				else
    				{
    					fav.addClass('active');
    					active = true;
    				}
    			});
    		});
    	}
    }

    /* 

	6. Init Fix Product Border

	*/

    function initFixProductBorder()
    {
    	if($('.product_filter').length)
    	{
			var products = $('.product_filter:visible');
    		var wdth = window.innerWidth;

    		// reset border
    		products.each(function()
    		{
    			$(this).css('border-right', 'solid 1px #e9e9e9');
    		});

    		// if window width is 991px or less

    		if(wdth < 480)
			{
				for(var i = 0; i < products.length; i++)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

    		else if(wdth < 576)
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 1; i < products.length; i+=2)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

    		else if(wdth < 768)
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 2; i < products.length; i+=3)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

    		else if(wdth < 992)
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 3; i < products.length; i+=4)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}

			//if window width is larger than 991px
			else
			{
				if(products.length < 5)
				{
					var product = $(products[products.length - 1]);
					product.css('border-right', 'none');
				}
				for(var i = 4; i < products.length; i+=5)
				{
					var product = $(products[i]);
					product.css('border-right', 'none');
				}
			}	
    	}
    }

    /* 

	7. Init Isotope Filtering

	*/

    function initIsotopeFiltering()
    {
    	if($('.grid_sorting_button').length)
    	{
    		$('.grid_sorting_button').click(function()
	    	{
	    		// putting border fix inside of setTimeout because of the transition duration
	    		setTimeout(function()
		        {
		        	initFixProductBorder();
		        },500);

		        $('.grid_sorting_button.active').removeClass('active');
		        $(this).addClass('active');
		 
		        var selector = $(this).attr('data-filter');
		        $('.product-grid').isotope({
		            filter: selector,
		            animationOptions: {
		                duration: 750,
		                easing: 'linear',
		                queue: false
		            }
		        });

		        
		         return false;
		    });
    	}
    }

    /* 

	8. Init Slider

	*/
    function initProduct1Slider()
    {
    	if($('.product_slider1').length)
    	{
    		var slider_prod1 = $('.product_slider1');

    		slider_prod1.owlCarousel({
    			loop:false,
    			dots:false,
    			nav:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.product_slider_nav_left1').length)
    		{
    			$('.product_slider_nav_left1').on('click', function()
    			{
    				slider_prod1.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.product_slider_nav_right1').length)
    		{
    			$('.product_slider_nav_right1').on('click', function()
    			{
    				slider_prod1.trigger('next.owl.carousel');
    			});
    		}
    	}

		if($('.product_slider21').length)
    	{
    		var slider_prod12 = $('.product_slider21');

    		slider_prod12.owlCarousel({
    			loop:false,
    			dots:false,
    			nav:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.product_slider_nav_left21').length)
    		{
    			$('.product_slider_nav_left21').on('click', function()
    			{
    				slider_prod12.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.product_slider_nav_right21').length)
    		{
    			$('.product_slider_nav_right21').on('click', function()
    			{
    				slider_prod12.trigger('next.owl.carousel');
    			});
    		}
    	}
    }
	
	function initProduct2Slider()
    {
    	if($('.product_slider2').length)
    	{
    		var slider_prod2 = $('.product_slider2');

    		slider_prod2.owlCarousel({
    			loop:false,
    			dots:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			nav:false,
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.product_slider_nav_left2').length)
    		{
    			$('.product_slider_nav_left2').on('click', function()
    			{
    				slider_prod2.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.product_slider_nav_right2').length)
    		{
    			$('.product_slider_nav_right2').on('click', function()
    			{
    				slider_prod2.trigger('next.owl.carousel');
    			});
    		}
    	}

		if($('.product_slider22').length)
    	{
    		var slider_prod22 = $('.product_slider22');

    		slider_prod22.owlCarousel({
    			loop:false,
    			dots:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			nav:false,
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.product_slider_nav_left22').length)
    		{
    			$('.product_slider_nav_left22').on('click', function()
    			{
    				slider_prod22.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.product_slider_nav_right22').length)
    		{
    			$('.product_slider_nav_right22').on('click', function()
    			{
    				slider_prod22.trigger('next.owl.carousel');
    			});
    		}
    	}
    }

	function initProduct3Slider()
    {
    	if($('.product_slider3').length)
    	{
    		var slider_prod3 = $('.product_slider3');

    		slider_prod3.owlCarousel({
    			loop:false,
    			dots:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			nav:false,
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.product_slider_nav_left3').length)
    		{
    			$('.product_slider_nav_left3').on('click', function()
    			{
    				slider_prod3.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.product_slider_nav_right3').length)
    		{
    			$('.product_slider_nav_right3').on('click', function()
    			{
    				slider_prod3.trigger('next.owl.carousel');
    			});
    		}
    	}

		if($('.product_slider23').length)
    	{
    		var slider_prod32 = $('.product_slider23');

    		slider_prod32.owlCarousel({
    			loop:false,
    			dots:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			nav:false,
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.product_slider_nav_left23').length)
    		{
    			$('.product_slider_nav_left23').on('click', function()
    			{
    				slider_prod32.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.product_slider_nav_right23').length)
    		{
    			$('.product_slider_nav_right23').on('click', function()
    			{
    				slider_prod32.trigger('next.owl.carousel');
    			});
    		}
    	}
    }

    function initCatSlider()
    {
    	if($('.category_slider').length)
    	{
    		var slider_cat1 = $('.category_slider');

    		slider_cat1.owlCarousel({
    			loop:false,
    			dots:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			nav:false,
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:2},
					991:{items:2},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.category_slider_nav_left').length)
    		{
    			$('.category_slider_nav_left').on('click', function()
    			{
    				slider_cat1.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.category_slider_nav_right').length)
    		{
    			$('.category_slider_nav_right').on('click', function()
    			{
    				slider_cat1.trigger('next.owl.carousel');
    			});
    		}
    	}

		if($('.category_slider2').length)
    	{
    		var slider_cat2 = $('.category_slider2');

    		slider_cat2.owlCarousel({
    			loop:false,
    			dots:false,
				rtl:$('body').hasClass('rtlcarousel'),
				ltr:$('body').hasClass('ltrcarousel'),
    			nav:false,
    			responsive:
				{
					0:{items:1},
					480:{items:2},
					768:{items:3},
					991:{items:4},
					1280:{items:5},
					1440:{items:5}
				}
    		});

    		if($('.category_slider_nav_left2').length)
    		{
    			$('.category_slider_nav_left2').on('click', function()
    			{
    				slider_cat2.trigger('prev.owl.carousel');
    			});
    		}

    		if($('.category_slider_nav_right2').length)
    		{
    			$('.category_slider_nav_right2').on('click', function()
    			{
    				slider_cat2.trigger('next.owl.carousel');
    			});
    		}
    	}
    }

	function initThumbnail()
	{
		if($('.single_product_thumbnails ul li').length)
		{
			var thumbs = $('.single_product_thumbnails ul li');
			var singleImage = $('.single_product_image_background');

			thumbs.each(function()
			{
				var item = $(this);
				item.on('click', function()
				{
					thumbs.removeClass('active');
					item.addClass('active');
					var img = item.find('img').data('image');
					singleImage.css('background-image', 'url(' + img + ')');
				});
			});
		}	
	}

	function initQuantity()
	{
		if($('.plus').length && $('.minus').length)
		{
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value');

			plus.on('click', function()
			{
				var x = parseInt(value.text());
				value.text(x + 1);
			});

			minus.on('click', function()
			{
				var x = parseInt(value.text());
				if(x > 1)
				{
					value.text(x - 1);
				}
			});
		}
	}




	function initStarRating()
	{
		if($('.user_star_rating li').length)
		{
			var stars = $('.user_star_rating li');

			stars.each(function()
			{
				var star = $(this);

				star.on('click', function()
				{
					var i = star.index();

					stars.find('i').each(function()
					{
						$(this).removeClass('fa-star');
						$(this).addClass('fa-star-o');
					});
					for(var x = 0; x <= i; x++)
					{
						$(stars[x]).find('i').removeClass('fa-star-o');
						$(stars[x]).find('i').addClass('fa-star');
					};
				});
			});
		}
	}

	function initTabs()
	{
		if($('.tabs').length)
		{
			var tabs = $('.tabs li');
			var tabContainers = $('.tab_container');

			tabs.each(function()
			{
				var tab = $(this);
				var tab_id = tab.data('active-tab');

				tab.on('click', function()
				{
					if(!tab.hasClass('active'))
					{
						tabs.removeClass('active');
						tabContainers.removeClass('active');
						tab.addClass('active');
						$('#' + tab_id).addClass('active');
					}
				});
			});
		}
	}

    function initPriceSlider()
    {
		$( "#slider-range" ).slider(
		{
			range: true,
			min: 0,
			max: 1000,
			values: [ 0, 580 ],
			slide: function( event, ui )
			{
				$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			}
		});
			
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    }

	function initCheckboxes()
    {
    	if($('.checkboxes li').length)
    	{
    		var boxes = $('.checkboxes li');

    		boxes.each(function()
    		{
    			var box = $(this);

    			box.on('click', function()
    			{
    				if(box.hasClass('active'))
    				{
    					box.find('i').removeClass('fa-square');
    					box.find('i').addClass('fa-square-o');
    					box.toggleClass('active');
    				}
    				else
    				{
    					box.find('i').removeClass('fa-square-o');
    					box.find('i').addClass('fa-square');
    					box.toggleClass('active');
    				}
    				// box.toggleClass('active');
    			});
    		});

    		if($('.show_more').length)
    		{
    			var checkboxes = $('.checkboxes');

    			$('.show_more').on('click', function()
    			{
    				checkboxes.toggleClass('active');
    			});
    		}
    	};
    }


});