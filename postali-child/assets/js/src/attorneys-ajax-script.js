/** Ajax for media attorneys page */
jQuery(document).ready(function($) {
	var currentPage = 1;
    var category = 'all';

    $('.filter-select').on('click', function(e) {
        e.preventDefault();
		category = $(this).attr('data');
        currentPage = 1;

        $('.filter-select').removeClass('active');
        $(this).addClass("active");  
        $('.attorneys-holder').removeClass('fade');

        $(".attorneys-holder").empty();
        $(".attorneys-holder").append('<div class="loading-icon"></div>');

			$.ajax({
				type: "POST",
				dataType: "html",
				url: loadmore_params_attorneys.ajaxurl,
				data: {
					action: 'loadmore_attorneys',
					id: category,
				},
				success: function(data){

					var $data = $(data);
					if($data.length){
						$(".attorneys-holder").empty();
						$(".attorneys-holder").append(data);
                        $(".attorneys-holder").removeClass("fade");
                        $(".attorneys-holder").addClass("fade");


					}
				},

				error : function(jqXHR, textStatus, errorThrown) {
                    console.log('error: ' + errorThrown);
				}
			});

		return false;
	});

});