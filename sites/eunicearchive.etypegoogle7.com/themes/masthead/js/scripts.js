(function ($) {

 	Drupal.behaviors.bonesSuperfish = {
	
	  attach: function(context, settings) {
			  
	  $('#user-menu ul.menu', context).superfish({
		  delay: 400,											    
		  animation: {height:'show'},
		  speed: 500,
		  easing: 'easeOutBounce', 
		  autoArrows: false,
		  dropShadows: false /* Needed for IE */
	  });
		  
	  }
    }	
				
	$(function() {
		
		$('.postscript-wrapper img').hover(function() {
		  $(this).animate({
			  backgroundColor: "#ff7800", opacity: "1.0"
		  }, 'fast'); }, function() {
		  $(this).animate({
			  backgroundColor: "#555", opacity: "0.9"
		  }, 'normal');
		});
	
	});


})(jQuery);  