
<style>

</style>
<section role="main" class="content-body">
	<header class="page-header">
        <h2><?php echo $term['certificationmanagement']; ?></h2>

        <div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
                <li><span><?php echo $term['certification']; ?></span></li>

            </ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
					<!--	<button id="btn_view" class="btn btn-default"><i class="fas fa-file"></i> View </button>-->
						<form id="cert_form" action="<?php echo base_url();?>all/certification/view" method="POST">
							<input type="hidden" name="cid" id="cert_id">
						</form>
					</div>

					<h2 class="card-title"><?php echo $term['certificationlist']; ?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_certificationlist" >
					</table>
				</div>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_certificationlist');

	function deleteCertification(id) {
		(new PNotify({
			title: "<?php echo $term['confirmation']; ?>",
			text: "<?php echo $term['areyousuretodelete']; ?>",
			type: 'custom',
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
				'dir1': 'up',
				'dir2': 'right',
				'modal':true
			}
		})).get().on('pnotify.confirm', function(){
			$.ajax({
                url: '<?php echo base_url(); ?>fasi/certification/delete',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {	
                	$table.DataTable().ajax.reload('', false);	
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
		/*.on('pnotify.cancel', function(){
			//console.log("cancel");
		});
		*/
	}

	function viewCertification(id)
	{
		$('#cert_id').val(id);
		$('#cert_form').submit();
	}

	jQuery(document).ready(function() { 
		
		var tbdata = $table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?php echo base_url('all/certification/getlist'); ?>",
                "data": {
                    'type': 'SCC'
                },
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            "columnDefs": [
                {
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if(cellData == '0000-00-00 00:00:00'){
                            $(td).html('<span>---</span>');
                        }
                    }
                },
                {
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {

                    if(cellData == '2' || cellData == '3'){
                        $(td).html('<span class="badge badge-danger">'+rowData['status_content']+'</span>');
                    } else   if(cellData == '1'){
                        $(td).html('<span class="badge badge-success">'+rowData['status_content']+'</span>');
                    }
                }
            }, {
				"targets": [8],
                "createdCell": function (td, cellData, rowData, row, col) {
                    var icon = "fa fa-eye";
                    if(rowData['status'] == '1' || rowData['status'] == '3'){
                        icon = "fa fa-eye";
                        $(td).html('<a href="javascript:viewCertification('+cellData+')" title="View"><i class="fa fa-eye"></i></a><span class="w-20"></span>');

                    }
                    else if(rowData['status'] == '2'){
                        icon = "fa fa-eye-slash";
                        $(td).html('<a style="color: gray;cursor: not-allowed;" href="#" title="View"><i class="fa fa-eye-slash"></i></a><span class="w-20"></span>');

                    }
                    //$(td).addClass('actions-hover actions-fade');
                }
			} ],     
            "columns": [
                { "title": "<?php echo $term['cn']; ?>", "data": "cn_num", "class": "left", "width":"30" },
            /*	{ "title": "Certification Type", "data": "certification_type", "class": "text-center", "width":50 },*/
            	{ "title": "<?php echo $term['company']; ?>", "data": "company_name", "class": "left", "width":"100" },
				{ "title": "<?php echo $term['firstname']; ?>", "data": "first_name", "class": "text-left", "width":"50" },
				{ "title": "<?php echo $term['lastname']; ?>", "data": "last_name", "class": "text-left", "width":"50" },
            	/*{ "title": "Certification Title", "data": "cert_title", "class": "text-left", "width":"100" },*/
				{ "title": "<?php echo $term['exam']; ?>", "data": "exam_title", "class": "text-left", "width":"*" },
				/*{ "title": "Pass Date", "data": "created_at", "class": "text-left", "width":150 },*/
                { "title": "<?php echo $term['datepassed']; ?>", "data": "created_at", "class": "text-left", "width":100 },
				{ "title": "<?php echo $term['dateexpires']; ?>", "data": "validate", "class": "text-left", "width":100 },
				{ "title": "<?php echo $term['status']; ?>", "data": "status", "class": "text-left", "width":50 },
				{ "title": "<?php echo $term['action']; ?>", "data": "id", "class": "text-left", "width":100 },
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
            "pageLength": 150, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,			
		});

		$('#datatable_certificationlist tbody').on( 'click', 'tr', function () {			
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				tbdata.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		} );



		$('#btn_view').on('click', function(){			
			var selected_rowdata = tbdata.api( true ).row( '.selected' ).data() ;			
			if(selected_rowdata == null ) {
				new PNotify({
					title: 'Warning!',
					text: 'Select row!',
					type: 'warning'
				});		
				return false;
			} else {
				$('#cert_id').val(selected_rowdata['id']);
				$('#cert_form').submit();
			}
		});
	});
</script>