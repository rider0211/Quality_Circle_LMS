function createQue(id) {
	window.location.href = SITE_URL+"create-question"
}
function saveT() {
	var markup = $('.mayank').summernote('code');
	$('.mayank').summernote('destroy');
	$('.mayank').val(markup);
};

function editT() {
	var markupStr = $('.txtarea').val();
	$('.txtarea').summernote('code', markupStr);
	$('.txtarea').summernote({focus: true, height: 70});
};

$(document).on("click", function(event) {
	if(!$(event.target).hasClass('txtarea') ) {
       
        $('.txtarea').summernote('destroy'); 
       
        if($('.txtarea').text() == ''){
       		$('.txtarea').html('Which one do you like?');
        }
   	}

   	if(!$(event.target).hasClass('txtareafd') ) {
       
        $('.txtareafd').summernote('destroy'); 
       
        if($('.txtareafd').text() == ''){
       		$('.txtareafd').html('Add explanation shown after question is attempted.');
        }
   	}
});

$(document).ready(function(){
	$('#horizon-view').hide();
   	$('.updImg').on("click", function() {
		$('#imgupload').trigger('click');
	});
	$(document).on("click",".rmv",function(){ 
        swal({
     		title: 'Are you sure?',
		  	text: "Deleting an answer is permanent! Once you delete, you will not be able to get it back.",
	  		type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Yes, delete it!'
	    }).then((result) => {
        	$(this).closest('li').remove();
	    })
    });
    $(document).on("click",".rmvhz",function(){ 
	    swal({
     		title: 'Are you sure?',
		  	text: "Deleting an answer is permanent! Once you delete, you will not be able to get it back.",
	  		type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Yes, delete it!'
	    }).then((result) => {
        	$(this).closest('.show-drag').remove();
	    })
    });
    $('.txtareafd').on('click', function() {
		$('.txtareafd').summernote({focus: true,disableResizeEditor:true});
	});
	$('[data-toggle="tooltip"]').tooltip();
	$('#que_type').on("change", function() {
		if(this.value == 1){
			$( "#sortable" ).find( "input[type=checkbox]" ).prop('type', 'radio').attr("name", 'defaultExample2');
		} else {
			$( "#sortable" ).find( "input[type=radio]" ).prop('type', 'checkbox').attr("name", 'defaultExample2[]');
		}
	});

	$('#layout_type').on("change", function() {
		if(this.value == 3){
			$('.show-drag').attr('class', function(i, c){
			    return c.replace(/(^|\s)col-md-\S+/g, 'col-md-6');
			});

			$('input[type=text]').attr('class', function(i, c){
			    return c.replace(/(^|\s)wd\S+/g, ' wd2');
			});

		}
		if(this.value == 4){
			$('.show-drag').attr('class', function(i, c){
			    return c.replace(/(^|\s)col-md-\S+/g, 'col-md-4');
			});
			$('input[type=text]').attr('class', function(i, c){
			    return c.replace(/(^|\s)wd\S+/g, ' wd3');
			});
		}
		if(this.value == 2 || this.value == 5){
			$('.show-drag').attr('class', function(i, c){
			    return c.replace(/(^|\s)col-md-\S+/g, 'col-md-3');
			});
			$('input[type=text]').attr('class', function(i, c){
			    return c.replace(/(^|\s)wd\S+/g, ' wd4');
			});
		}
		if(this.value == 1){
			$('#sortable').css('display','block');
			$('#horizon-view').hide();
			$('.show-drag').attr('class', function(i, c){
			    return c.replace(/(^|\s)col-md-\S+/g, 'col-md-11');
			});
		} else{
			$('#sortable').css('display','none');
			$('#horizon-view').show();
		}
	});

	$('#tag_img').on("change", function() {
		if($('#tag_img').prop('checked')){
			$( "i.updImg" ).parent().css( "display", "block" );	
		} else {
			$( "i.updImg" ).parent().css( "display", "none" );
		}
		
	});
});



$(function(){
	$( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    $( "#horizon-view" ).sortable();
    $( "#horizon-view" ).disableSelection();
});
$(function(){
  $(".btn-copy").on('click', function(){
    $("#sortable").append('<li class="ui-state-default"><div class="row"><div class="col-md-11 input-group show-drag" onclick="editT()"><input type="radio" class="" id="defaultChecked2" name="defaultExample2" checked><span class="input-group-addon brd-gray pd-5"><i class="fa fa-camera updImg"></i></span><input type="file" id="imgupload" style="display:none"/><input type="text" class="form-control inp-que" name=""><span class="input-group-addon pd-5"><i class="fa fa-arrows mrt-5 drag-me"></i><i class="fa fa-trash mrt-5 drag-me mrl-10 rmv"></i></span></div></div></li>');
  });
});