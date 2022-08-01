<section role="main" class="content-body">
    <header class="page-header">
        <h2>Certificate template settings</h2>

        <div class="right-wrapper">
        </div>
    </header>

    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
    	<div class="col-md-12">
	        <div class="row">
	        	<div class="col">
	        		
	            <section class="card">
	                <header class="card-header">
	                    <div class="card-actions">
	                        <a class="modal-with-form add-user" href="<?= base_url()?>instructor/settings/certificateview">
	                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i>Add</button>
	                        </a>
	                    </div>
	
	                    <h2 class="card-title">Certificate template</h2>
	                </header>
	                <div class="card-body">
	                    <table class="table table-responsive-md table-hover mb-0" id="datatable" >
	                    </table>
	                </div>
	            </section>
	     
	        	</div>
	        </div>
	    </div>
    </div>

    <!-- end: page -->
</section>

<script>
    var $table = $('#datatable');

    function deleteCategory(id) {

        (new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
            icon: 'fas fa-question',
            confirm: {
                confirm: true
            },
            button: {
                closer: false,
                sticker: false
            },
            addclass: 'stack-modal',
            stack: {
                'dir1': 'down',
                'dir2': 'right',
                'modal':true
            }
        })).get().on('pnotify.confirm', function(){
            $.ajax({
                url: $('#base_url').val()+'instructor/settings/certificatedelete',
                type: 'POST',
                data: {id:id},
                success: function (data, status, xhr) {
                    if(status == "success") {
                        $table.DataTable().ajax.reload('', false);
                    } else {
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'danger'
                        });
                    }
                },
                error: function(){
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        });
    }



    jQuery(document).ready(function() {

        $table.dataTable({
            "ordering": false,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url":$('#base_url').val() +"instructor/settings/getcertificate",
                "data": {},
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [
//                {
//                "targets": [1],
//                "createdCell": function (td, cellData, rowData, row, col) {
//                    $(td).html('<img class="img-fluid" src="<?//=base_url()?>//'+cellData+'" width="28" height="28"></a>');
//
//                }
//            }, {
//                "targets": [2],
//                "createdCell": function (td, cellData, rowData, row, col) {
//                    $(td).html('<img class="img-fluid" src="<?//=base_url()?>//'+cellData+'" width="28" height="28"></a>');
//
//                }
//            },{
//                "targets": [3],
//                "createdCell": function (td, cellData, rowData, row, col) {
//                    $(td).html('<img class="img-fluid" src="<?//=base_url()?>//'+cellData+'" width="28" height="28"></a>');
//
//                }
//            },{
//                "targets": [4],
//                "createdCell": function (td, cellData, rowData, row, col) {
//                    $(td).html('<img class="img-fluid" src="<?//=base_url()?>//'+cellData+'" width="28" height="28"></a>');
//
//                }
//            },
                {
                "targets": [1],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="<?=base_url()?>instructor/settings/certificateview/'+cellData+'"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteCategory('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
                }
            }],
            "columns": [
                { "title": "Title", "data": "title", "class": "left", "width":80 },
//                { "title": "Logo", "data": "logo", "class": "left", "width":80 },
//                //{ "title": "Content", "data": "content", "class": "left", "width":"*" },
//                { "title": "Left_sign", "data": "left_sign", "class": "center", "width":110 },
//                { "title": "Right_sign", "data": "right_sign", "class": "center", "width":50 },
//                //{ "title": "Left_des", "data": "left_des", "class": "center", "width":50 },
//                //{ "title": "Right_des", "data": "right_des", "class": "center", "width":80 },
//                /*{ "title": "Watermark", "data": "watermark", "class": "center", "width":80 },*/
//                { "title": "Middle_logo", "data": "middle_logo", "class": "center", "width":80 },
                { "title": "Option", "data": "id", "class": "center", "width":80 },
            ],
            "lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
            "scrollX": true,
            "scrollCollapse": false,
            "jQueryUI": true,

            "paging": true,
            "pagingType": "full_numbers",
            "pageLength": 10, // default record count per page

            dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
            bProcessing: true,
        });
    });

</script>