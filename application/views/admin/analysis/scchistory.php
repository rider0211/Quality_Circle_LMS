<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["analysisstatistics"]?></h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?=$term["sccexamhistory"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_exam_history" >
					</table>
				</div>
			</section>
		</div>
	</div>

    <div style="display: none;" class="col-lg-6">
        <a class="mb-1 mt-1 mr-1 modal-with-zoom-anim ws-normal btn btn-default" href="#modalAnim">Open with fade-zoom animation</a>
    </div>

    <div id="modalAnim" style="max-width: 800px;" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title"><?=$term["examsignature"]?></h2>
            </header>
            <div class="card-body">
                <div class="modal-wrapper">
                    <div class="modal-text">
                        <img id="userSignImg" style="width:100%;" src="" />
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default modal-dismiss"><?=$term["close"]?></button>
                    </div>
                </div>
            </footer>
        </section>
    </div>

    <form id="detail_form" method="POST" action="<?php echo base_url(); ?>all/examhistory/view">
        <input type="hidden" name="exam_history_id">
    </form>

<script>
	var $history_table = $('#datatable_exam_history');

	jQuery(document).ready(function() { 	

		var tbdata = $history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "getexamhistorylist",
				"data": {'type':'SCC'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },

            "columnDefs": [{
                "targets": [9],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData != '0000-00-00 00:00:00'){
                        $(td).html(rowData['exam_end_at']);
                    } else {
                        $(td).html('---');
                    }
                }
            }, {
                "targets": [10],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == 'pass'){
                        $(td).html('<span class="badge badge-success">'+cellData.toUpperCase()+'</span>');
                    }else if(cellData == 'unpass'){
                        $(td).html('<span class="badge badge-danger">'+'FAIL'+'</span>');
                    } else {
                        $(td).html('<span class="badge badge-warning">'+cellData.toUpperCase()+'</span>');
                    }
                }
            }, {
                "targets": [11],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="javascript:openSign('+cellData+')"><i class="fas fa-eye"></i></a><span class="w-20"></span>');

                }
            }],
            "columns": [
                { "title": "<?=$term["companyname"]?>", "data": "company_name", "class": "text-left", "width":100 },
                { "title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width":60 },
                { "title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width":60 },
                { "title": "<?=$term["categoryname"]?>", "data": "exam_category_name", "class": "text-left", "width":100, "visible": true },
                { "title": "<?=$term["title"]?>", "data": "exam_title", "class": "text-left", "width":"*" },
                { "title": "<?=$term["quizcount"]?>", "data": "quiz_count", "class": "text-right", "width":60 },
                { "title": "<?=$term["price"]?>", "data": "exam_price", "class": "text-right", "width":100 },
                { "title": "<?=$term["repeatdays"]?>", "data": "repeat_days", "class": "text-right", "width":100},
                { "title": "<?=$term["startdate"]?>", "data": "exam_start_at", "class": "text-left", "width":100 },
                { "title": "<?=$term["enddate"]?>", "data": "exam_end_at", "class": "text-left", "width":100 },
                { "title": "<?=$term["status"]?>", "data": "exam_status", "class": "text-center", "width":60 },
                { "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":50 },
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

	});
	</script>

    <script>
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

        $(document).on('click', '.modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });

        function openSign(id){

            $('input[name="exam_history_id"]').val(id);
            $('#detail_form').submit();
            
        }
    </script>

	<!-- end: page -->
</section>