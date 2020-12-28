jQuery( document ).ready( function($) {
	$("body").on( 'click', '.xdocs-zip', function(e) {
        e.preventDefault();
		var id = $(this).data('id');
		var theme = $(this).data('theme');
		var nonce = $(this).data('nonce');
		var download_url = $(this).data('url');
		//var post = $(this).parents('.post:first');


		$.ajax({
			type: 'post',
			 url : myAjax.ajaxurl,
			data: {
				action: 'xdocs_zip_operation',
				nonce: nonce,
				id: id,
				theme: theme
			},
			success: function( result ) {
				console.log(result);
				window.location = download_url;
			}
		});
		return false;
	});

	$("body").on( 'click', '.xdocs-pdf', function(e) {
		e.preventDefault();
		$('#loader').css('display', 'block');
		var id = $(this).data('id');
		var theme = $(this).data('theme');
		var nonce = $(this).data('nonce');
		var download_url = $(this).data('url');
		//var post = $(this).parents('.post:first');


		$.ajax({
			type: 'post',
			url : myAjax.ajaxurl,
			data: {
				action: 'xdocs_pdf_operation',
				nonce: nonce,
				id: id,
				theme: theme
			},
			success: function( result ) {
			$('#loader').css('display', 'none');
			 window.location = download_url;

			}
		});
		return false;
	});



        // Was needed a timeout since RTE is not initialized when this code run.
        // setTimeout(function () {
        //     for (var i = 0; i < tinymce.editors.length; i++) {
        //         tinymce.editors[i].onChange.add(function (ed, e) {
        //             // Update HTML view textarea (that is the one used to send the data to server).
        //             ed.save();
        //             console.log('xxxxxxxx');
        //         });
        //     }
        // }, 1000);


});
