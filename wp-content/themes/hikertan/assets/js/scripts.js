(function ($, root, undefined) {
	
	$(function () {
		
		

		init = function(){
			components();
		
			
		}

		


		components = function(){
			mobilemenu();
			
		}

		mobilemenu = function(){
			$('#menu-btn').click(function(){
				$(this).toggleClass('open');
				$('header ul').toggleClass('open');
				$('body').toggleClass('disable');
				
			});
		}

		


		/* PAGE SPECIFIC JS GOES HERE */

		/* FIELD REPORTS */

		if ($("body").hasClass("single-field_reports")) {
			// Code to handle field testing section of page
			// 
			$(document).ready(function() {
				//add focus to first element in field testing
			    $('.fieldtesting_menu>div>a:first').addClass('focus');
			});

			$(".fieldtesting_link").click(function() {
				// link target
				var link = $(this).attr("href");
				$('.fieldtesting_menu>div>a:first').removeClass('focus');
				$(this).focus();
				$(link).addClass("show");
				$("#fieldtesting-content>div").removeClass("show");

			});
		}

		

		

		init();
		
	});
	
})(jQuery, this);
