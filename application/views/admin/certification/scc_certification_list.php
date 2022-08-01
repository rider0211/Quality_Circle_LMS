
<style>

</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["certificationmanagement"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["certification"]?></span></li>
				
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

					<h2 class="card-title"><?=$term["certificationlist"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-striped table-hover mb-0" id="datatable_certificationlist" >
					</table>
				</div>
			</section>
		</div>
	</div>



	<div style="display: none;" class="col-lg-6">
		<a class="mb-1 mt-1 mr-1 modal-with-zoom-anim ws-normal btn btn-default" href="#modalAnim">Open with fade-zoom animation</a>
	</div>

	<div id="modalAnim" style="max-width: 500px;" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
		<section class="card">
			<header class="card-header">
				<h2 class="card-title"><?=$term["emailcontent"]?></h2>
			</header>
			<div class="card-body">
				<div class="modal-wrapper">
					<div class="modal-text">
						<input type="hidden" name="id">
						<div class="col-md-12">
							<div class="row">
								<label class="control-label col-md-3"><?=$term["email"]?></label>
								<div class="col-md-9">
									<input type="text" placeholder="" class="form-control" name="email">
								</div>
							</div>
						</div>
						<!--<div class="col-md-12" style="margin-top:20px">
							<div class="row">
								<label class="control-label col-md-3">Content</label>
								<div class="col-md-9">
									<textarea class="form-control" name="content" style="width:100%; height:200px;">
										You received ceritifcation from administrator.
										Please click blow link to open certification.
										http://
									</textarea>
								</div>
							</div>
						</div>-->
					</div>
				</div>
			</div>
			<footer class="card-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<!--<button class="btn btn-default modal-dismiss">Close</button>-->

						<a id="sendBtn" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }" href="javascript: send();" class="btn btn-primary">

							<?=$term["send"]?>
						</a>

						<!--<button class="btn btn-default" onclick="javascript:send()">Send</button>-->
					</div>
				</div>
			</footer>
		</section>
	</div>

	<!-- end: page -->
</section>

<script>
	var $table = $('#datatable_certificationlist');

	$(function () {
		$('.modal-with-zoom-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in',
			modal: false
		});
	});

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
                url: '<?php echo base_url(); ?>admin/certification/delete',
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


	function sendExportMail(id, email){
		$('input[name="email"').val(email);
		$('input[name="id"').val(id);
		$(".modal-with-zoom-anim").click();
	}

    function  scc_approve(id,status) {

        (new PNotify({
            title: "Confirm",
            text: "Are you sure?",
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
                url: "<?php echo base_url('admin/certification/scc_approve'); ?>",
                type: 'POST',
                data: {'id': id, 'status': status},
                success: function (data, status, xhr) {
                    $table.DataTable().ajax.reload('', false);
                },
                error: function(){
                    new PNotify({
                        title: 'Error!',
                        text: 'There is some issues on network. Please try again later. ',
                        type: 'error'
                    });
                }
            });
        });

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
				    var status = 0;
				    var fa_icon = 'fa fa-ban';

				    if(rowData['check_status'] == '1'){
				        status = 0;
                        fa_icon = 'fa fa-ban';
                    }
                    else{
                        if(rowData['check_status'] == '0'){
                            status = 1;
                            fa_icon = 'fa fa-check-square';
                        }
                    }
					$(td).html('<a href="javascript:scc_approve('+cellData+','+status+')" title="SCC Approve"><i class="'+fa_icon+'"></i></a><span class="w-20"></span>' +
					    '<a href="javascript:viewCertification('+cellData+')" title="View"><i class="fa fa-eye"></i></a><span class="w-20"></span>' +
                        '<a href="javascript:sendExportMail('+cellData+', \'' + rowData.email + '\')" title="Send Email"><i class="fas fa-envelope"></i></a><span class="w-20"></span>' +
                        '<a href="javascript:deleteCertification('+cellData+')" class="delete-row" title="Delete"><i class="far fa-trash-alt"></i></a>');
					//$(td).addClass('actions-hover actions-fade');								
				}
			} ],     
            "columns": [
                { "title": "<?=$term["cn"]?>", "data": "cn_num", "class": "left", "width":"30" },
            /*	{ "title": "Certification Type", "data": "certification_type", "class": "text-center", "width":50 },*/
            	{ "title": "<?=$term["companyname"]?>", "data": "company_name", "class": "left", "width":"100" },
				{ "title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width":"50" },
				{ "title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width":"50" },
            	/*{ "title": "Certification Title", "data": "cert_title", "class": "text-left", "width":"100" },*/
				{ "title": "<?=$term["exam"]?>", "data": "exam_title", "class": "text-left", "width":"*" },
				/*{ "title": "Pass Date", "data": "created_at", "class": "text-left", "width":150 },*/
                { "title": "<?=$term["datepassed"]?>", "data": "created_at", "class": "text-left", "width":100 },
				{ "title": "<?=$term["dateexpires"]?>", "data": "validate", "class": "text-left", "width":100 },
				{ "title": "<?=$term["status"]?>", "data": "status", "class": "text-left", "width":50 },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":100 },
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