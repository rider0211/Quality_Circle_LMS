
$(document).ready(function(){
    // Checkbox page RTE
    $('#checkbox').summernote({
    	height: 70,
    	popover: {
			image: [],
			link: [],
			air: []
		}
    });

    $(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	});

	/*$("#saveque").click(function() {
		var actionUrl = base_url + 'welcome/saveQuestion';
		$("#questionForm").attr("action",actionUrl);
	});*/


	$(".preview").click(function() {
		var actionUrl = base_url + 'admin/exam/showPreviewQuestion';
		var id = $(this).data('id');

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: {id:id},
            success: function (data, status, xhr) {
                $("#showSideQue").html(data);
                $(".previewQue").width('50%');
            }
        });

        // $.post( actionUrl, {id:id},function( data ) {
			// $("#showSideQue").html(data);
        //     $(".previewQue").width('50%');
        // });
		
	});


	$(".edit-ques").click(function() {

		var actionUrl = base_url + 'admin/exam/editQuestion/';
		var id = $(this).data('id');

		window.location = actionUrl + id;
		
	});


    //set image
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-file').css("background-image", "url("+e.target.result+")"); 
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
        $(".upload-file").children().hide();
    });
    
    $(".upload-file").on('click', function() {
       $(".file-upload").click();
    });


});

function closeNav() {
    $(".previewQue").width('0');
    location.reload();
}

