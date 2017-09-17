(function ($) {

	'use strict';
	
	$(function() {

		var activeIcon = $("#wp-icons").attr("data-icon");

		if ( activeIcon != '') {
			$(".icon-wrap ." + activeIcon ).addClass("icon-color");
			$("#" + activeIcon ).attr('checked', true);
		}

		$(".icon-wrap input").each(function (argument) {
			
			$(this).click(function () {
				$( ".icon-wrap .dashicons").removeClass("icon-color");
				var iconSelect_parent = $(this).attr("id");
				$( ".icon-wrap ." + iconSelect_parent ).addClass("icon-color");
			})
		});
	})


})(jQuery)