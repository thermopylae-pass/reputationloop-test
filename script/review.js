var NUMBER_OF_REVIEWS = 10;
	$(document).ready(function(){

		$('.page_no').click(function(){
			/** this event method is not being used... **/
			var page_no = $(this).attr('id');
			//var num_of_reviews = NUMBER_OF_REVIEWS*page_no;
			var currentLocation = window.location;
			var offset = (page_no - 1) ;
			offset = (offset * 10) + 1;
		});
		
	});