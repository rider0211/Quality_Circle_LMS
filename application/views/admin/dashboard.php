<section role="main" id="mainpage" class="content-body">
	<header class="page-header">
		<h2><?=$term["dashboard"]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-xl-3">
					<section class="card card-featured-left card-featured-quaternary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-quaternary">
										<i class="fas fa-user"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["instructors"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $instructor_count; ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('admin/user/admin');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-3">
					<section class="card card-featured-left card-featured-quaternary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-quaternary">
										<i class="fas fa-user"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["learners"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $learner_count; ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('admin/user/admin');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
<!-- 				<div class="col-sm-12 col-md-6 col-xl-3">
					<section class="card card-featured-left card-featured-tertiary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-tertiary">
										<i class="fas fa-check"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["exams"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $exam_count;?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('admin/exam');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div> -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <section class="card card-featured-left card-featured-tertiary mb-3">
                        <div class="card-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 style="font-size: 0.8rem;" class="title"><?=$term["onlinelearners"]?></h4>
                                        <div class="info">
                                            <strong class="amount"><?php echo $logined_usercount; ?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase" href="<?php echo base_url('admin/user')?>">(<?=$term["viewall"]?>)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
				<div class="col-sm-12 col-md-6 col-xl-3">
					<section class="card card-featured-left card-featured-tertiary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-tertiary">
										<i class="fas fa-graduation-cap"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["certification"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $certification_count;?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('admin/demand/view_certificate_history');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>							
		</div>
	</div>

	<div class="row pt-0">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-xl-6">
					<section class="card card-featured-left card-featured-secondary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-secondary">
										<i class="fas fa-euro-sign"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["totalinvoice"]?></h4>
										<div class="info">
											<strong class="amount">$ <?= $amount?$amount:0;?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('admin/account/payment');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row pt-0">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title">On-Demand Online Learner Details</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="online_learner_details" >
					</table>
				</div>
			</section>
		</div>
	</div>
    
    <div class="row pt-0">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title">ILT Online Learner Details</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="ilt_online_learner_details" >
					</table>
				</div>
			</section>
		</div>
	</div>
    
    <div class="row pt-0">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title">VILT Online Learner Details</h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="vilt_online_learner_details" >
					</table>
				</div>
			</section>
		</div>
	</div>
    
    
	
	<div class="row pt-0">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?=$term["certificationstatus"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_exam_history" >
					</table>
				</div>
			</section>
		</div>
	</div>
	<div id="modalSign" class="modal fade">
        <div class="modal-dialog" style = "width: 50%;max-width: 50%;">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <h3 class="modal-title">Sign Image</h3>
                </div>
                    <div class="modal-body">
                        <div class="col-lg-12" style="display: flex;">
                            <img id="userSignImg" style="width:100%;" src="" />
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


	<!-- end: page -->
<script>
	jQuery(document).ready(function() { 
		
		/*
		Flot: Bars
		*/
		
		/*var plot = $.plot('#flotBars', [flotBarsData], {
			colors: ['#8CC9E8'],
			series: {
				bars: {
					show: true,
					barWidth: 0.8,
					align: 'center'
				}
			},
			xaxis: {
				mode: 'categories',
				tickLength: 0
			},
			grid: {
				hoverable: true,
				clickable: true,
				borderColor: 'rgba(0,0,0,0.1)',
				borderWidth: 1,
				labelMargin: 15,
				backgroundColor: 'transparent'
			},
			tooltip: true,
			tooltipOpts: {
				content: '%y',
				shifts: {
					x: -10,
					y: 20
				},
				defaultTheme: false
			}
		});*/

		if( $('#morrisBar').get(0) ) {
			Morris.Bar({
				resize: true,
				element: 'morrisBar',
				data: morrisBarData,
				xkey: 'y',
				ykeys: ['a', 'b'],
				labels: ['Training Employees', 'Certificated Employees'],
				hideHover: true,
				barColors: ['#0088cc', '#2baab1']
			});
		}
		<!-----------------on demand learner details------------>
		var $history_table = $('#online_learner_details');
		var tbdata = $history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "<?=base_url()?>admin/demand/getTodayOnlineLearner/demand",
				"data": {'type':'general'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	         "columnDefs": [
                {         //http://localhost/ols/admin/examhistory/preview_history/24
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
						//console.log(rowData);
                                               
							$(td).html('<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/' + + rowData['id'] + '">View Assessment</a>');
                       
                    }
                }],
	        "columns": [				
				{ "title": "First Name", "data": "first_name", "class": "text-left", "width":200 },
	        	{ "title": "Last Name", "data": "last_name", "class": "text-left", "width":200 }, 
				{ "title": "Course ID", "data": "course_id", "class": "text-left", "width":200 },
				{ "title": "Course Title", "data": "course_title", "class": "text-left", "width":200 }, 
				{ "title": "Email", "data": "email", "class": "text-left", "width":200},
				{ "title": "Last Login", "data": "last_login", "class": "text-left", "width":200 },
				{ "title": "Action", "data": "id", "class": "text-left", "width":200 }
                
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
	        "pageLength": 	5, // default record count per page
			dom: '<"row"<"col-lg-6"><"col-lg-6">><"table-responsive"t>',
			bProcessing: true,			
		    "order": [
		        [3, "desc"]
		    ] 
		});
		
		<!--------------------ilt learner details-------------->
		var $history_table_ilt = $('#ilt_online_learner_details');
		var tbdatailt = $history_table_ilt.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "<?=base_url()?>admin/demand/getTodayOnlineLearner/ilt",
				"data": {'type':'general'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	         "columnDefs": [
                {         //http://localhost/ols/admin/examhistory/preview_history/24
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
						//console.log(rowData);
                                               
							$(td).html('<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/' + + rowData['id'] + '">View Assessment</a>');
                       
                    }
                }],
	        "columns": [				
				{ "title": "First Name", "data": "first_name", "class": "text-left", "width":200 },
	        	{ "title": "Last Name", "data": "last_name", "class": "text-left", "width":200 }, 
				{ "title": "Course ID", "data": "course_id", "class": "text-left", "width":200 },
				{ "title": "Course Title", "data": "course_title", "class": "text-left", "width":200 }, 
				{ "title": "Email", "data": "email", "class": "text-left", "width":200},
				{ "title": "Last Login", "data": "last_login", "class": "text-left", "width":200 },
				{ "title": "Action", "data": "id", "class": "text-left", "width":200 }
                
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
	        "pageLength": 	1000, // default record count per page
			dom: '<"row"<"col-lg-6"><"col-lg-6">><"table-responsive"t>',
			bProcessing: true,			
		    "order": [
		        [3, "desc"]
		    ] 
		});
		
		<!--------------------vilt learner details-------------->
		var $history_table_vilt = $('#vilt_online_learner_details');
		var tbdatavilt = $history_table_vilt.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "<?=base_url()?>admin/demand/getTodayOnlineLearner/vilt",
				"data": {'type':'general'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	         "columnDefs": [
                {         //http://localhost/ols/admin/examhistory/preview_history/24
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
						//console.log(rowData);
                                               
							$(td).html('<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_row_assess/'+rowData['course_id']+'/' + + rowData['id'] + '">View Assessment</a>');
                       
                    }
                }],
	        "columns": [				
				{ "title": "First Name", "data": "first_name", "class": "text-left", "width":200 },
	        	{ "title": "Last Name", "data": "last_name", "class": "text-left", "width":200 }, 
				{ "title": "Course ID", "data": "course_id", "class": "text-left", "width":200 },
				{ "title": "Course Title", "data": "course_title", "class": "text-left", "width":200 }, 
				{ "title": "Email", "data": "email", "class": "text-left", "width":200},
				{ "title": "Last Login", "data": "last_login", "class": "text-left", "width":200 },
				{ "title": "Action", "data": "id", "class": "text-left", "width":200 }
                
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
	        "pageLength": 	5, // default record count per page
			dom: '<"row"<"col-lg-6"><"col-lg-6">><"table-responsive"t>',
			bProcessing: true,			
		    "order": [
		        [3, "desc"]
		    ] 
		});
		
		
		
		var $history_table = $('#datatable_exam_history');
		var tbdata = $history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "<?=base_url()?>admin/demand/getCertificateHistoryList",
				"data": {'type':'general'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	        "columnDefs": [
                {         //http://localhost/ols/admin/examhistory/preview_history/24
                    "targets": [4],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if(rowData['exam_title'] != '') {
                            $(td).html('<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_row_assess/' + rowData['course_id'] + '/' + rowData['user_id'] + '">View Assessment</a>' +
                                '<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_exam_history/' + rowData['course_id'] + '/' + rowData['user_id'] + '">View Exam</a>' +
                                '<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_exam_certificate/' + rowData['course_id'] + '/' + rowData['course_id'] + '">View Certificate</a>' +
								'<a class="btn btn-default btn-sm" onclick = "view_sign('+rowData['course_id']+', '+rowData['user_id']+')">View Sign</a><span class="w-20"></span>');
                        }
                        else {
                            $(td).html('<a class="btn btn-default btn-sm" href="<?= base_url()?>admin/demand/view_exam_certificate/' + rowData['course_id'] + '/' + rowData['user_id'] + '">View Certificate</a>');
                        }
                    }
                }],
	        "columns": [
				{ "title": "Learner Name", "data": "name", "class": "text-left", "width":200 },
	        	{ "title": "Course Title", "data": "title", "class": "text-left", "width":200 },
				{ "title": "Exam Title", "data": "exam_title", "class": "text-left", "width":200},
				{ "title": "Date", "data": "end_date", "class": "text-left", "width":200 },
                { "title": "Action", "data": "status", "class": "text-left", "width":200 }
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
	        "pageLength": 	5, // default record count per page
			dom: '<"row"<"col-lg-6"><"col-lg-6">><"table-responsive"t>',
			bProcessing: true,			
		    "order": [
		        [3, "desc"]
		    ] 
		});

	
	});
	function view_sign(course_id, user_id){
		$.ajax({
			url: '<?=base_url()?>admin/examhistory/getSign',
			type: 'POST',
			data: { 'user_id': user_id, 'course_id': course_id},
			success: function (data, status, xhr) {
				if (data.success){
					$("#userSignImg").attr("src",data.data.sign);
        			$("#modalSign").modal();
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
        
    }
</script>