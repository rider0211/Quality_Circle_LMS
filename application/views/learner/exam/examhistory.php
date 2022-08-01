<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["examhistory"]?></h2>

	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?=$term["examhistory"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover table-bordered mb-0" id="datatable_exam_history" >
					</table>
				</div>
			</section>
		</div>
	</div>

    <div style="display: none;" class="col-lg-6">
        <a class="mb-1 mt-1 mr-1 modal-with-zoom-anim ws-normal btn btn-default" href="#modalAnim">Open with fade-zoom animation</a>
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

    <form id="detail_form" method="POST" action="<?php echo base_url(); ?>all/examhistory/view">
        <input type="hidden" name="exam_history_id">
    </form>

<script>
	var $history_table = $('#datatable_exam_history');
    var sign = "";
    function view_sign(){
        $("#userSignImg").attr("src",sign);
        $("#modalSign").modal();
    }
	jQuery(document).ready(function() {

		var tbdata = $history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "getexamhistorylist",
				"data": {'type':'general'},
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },

	        "columnDefs": [{
                "targets": [3],
                "createdCell": function (td, cellData, rowData, row, col) {
                    var time_taken = "";
                    if((rowData["start_seconds"] != '0') && (rowData["end_seconds"] != '0') && (parseInt(rowData["end_seconds"]) - parseInt(rowData["start_seconds"])) != 0){
                        var hour = parseInt((parseInt(rowData["end_seconds"]) - parseInt(rowData["start_seconds"])) / 3600);
                        if (hour != 0){
                            time_taken = time_taken+""+hour+"h : ";
                        }
                        var minute = parseInt(parseInt((parseInt(rowData["end_seconds"]) - parseInt(rowData["start_seconds"])) % 3600) / 60);
                        if (minute != 0){
                            time_taken = time_taken+""+minute+"m : ";
                        }
                        var second = parseInt(parseInt(parseInt((parseInt(rowData["end_seconds"]) - parseInt(rowData["start_seconds"])) % 3600) % 60));
                        time_taken = time_taken+""+second+"s";
                        $(td).html(time_taken);
                    } else {
                        $(td).html('---');
                    }
                }
            },{
                "targets": [4],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if (parseInt(parseFloat(cellData).toFixed(2)) == parseFloat(cellData).toFixed(2)){
                        $(td).html(parseInt(parseFloat(cellData).toFixed(2)));
                    }else if (parseFloat(cellData).toFixed(1) == parseFloat(cellData).toFixed(2)){
                        $(td).html(parseFloat(cellData).toFixed(1));
                    }else{
                    $(td).html(parseFloat(cellData).toFixed(2));
                     }
                }
            },
            {
                "targets": [6],
                "createdCell": function (td, cellData, rowData, row, col) {
                    sign = rowData["sign"];
                    if (rowData["exam_status"] == "Not Determine"){
                        $(td).html('');
                    }else{
                        $(td).html('<a class="btn btn-default btn-sm" href="<?php echo base_url()?>learner/demand/preview_exam/'+cellData+'">Preview</a><span class="w-20"></span>');
                    }
                    $(td).append('<a class="btn btn-default btn-sm" href="feedback/'+cellData+'">Feedback</a><span class="w-20"></span>');
                    $(td).append('<a class="btn btn-default btn-sm" onclick = "view_sign()">View Sign</a><span class="w-20"></span>');
                }
            }],
	        "columns": [
	        	{ "title": "<?=$term["examtitle"]?>", "data": "title", "class": "text-left", "width":100 },
				{ "title": "<?=$term["examtype"]?>", "data": "type", "class": "text-left", "width":60 },
	        	{ "title": "<?=$term["examdate"]?>", "data": "exam_start_at", "class": "text-left", "width":60 },
				{ "title": "<?=$term["timetaken"]?>", "data": "exam_start_at", "class": "text-right", "width":60 },
				{ "title": "<?=$term["totalmarks"]?>", "data": "total_marks", "class": "text-right", "width":100 },
				{ "title": "<?=$term["status"]?>", "data": "exam_status", "class": "text-center", "width":60 },
                { "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":60 },
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