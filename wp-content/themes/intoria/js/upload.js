jQuery(document).ready(function($){
	"use strict";
	var intoria_upload;
	var intoria_selector;

	function intoria_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		intoria_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( intoria_upload ) {
			intoria_upload.open();
			return;
		} else {
			// Create the media frame.
			intoria_upload = wp.media.frames.intoria_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			intoria_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = intoria_upload.state().get('selection').first();

				intoria_upload.close();
				intoria_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					intoria_selector.find('.intoria_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		intoria_upload.open();
	}

	function intoria_remove_file(selector) {
		selector.find('.intoria_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.intoria_upload_image_action .remove-image', function(event) {
		intoria_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.intoria_upload_image_action .add-image', function(event) {
		intoria_add_file(event, $(this).parent().parent());
	});

});