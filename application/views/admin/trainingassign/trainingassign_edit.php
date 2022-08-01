<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["trainingmanagement"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>admin/home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span><?=$term["trainings"]?></span></li>

				<li><span><?=$term["assign"]?></span></li>
			</ol>

		</div>
	</header>
	<style type="text/css">
		fieldset { 
		    display: block;
		    margin-left: 2px;
		    margin-right: 2px;
		    padding-top: 0.35em;
		    padding-bottom: 0.625em;
		    padding-left: 0.75em;
		    padding-right: 0.75em;
		    border: 2px solid #DDD;
		}
	</style>
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<a class="btn btn-default" href="<?php echo base_url(); ?>admin/trainingassign" ><i class="fa fa-table"></i> <?=$term["topiclist"]?> </a>
					</div>
					<h2 class="card-title"> <?=$term["trainingassignform"]?></h2>
				</header>
				<div class="card-body">	
					<div class="form-group row">
						<label class="col-lg-1 control-label text-sm-right pt-2"><?=$term["type"]?><span class="required">*</span></label>
						<div class="col-lg-3 col-sm-9">
							<select class="form-control populate manual" required="" id="select_type_id"></select>
						</div>

						<label class="col-lg-1 control-label text-sm-right pt-2 company_list hidden"><?=$term["type"]?><span class="required">*</span></label>
						<div class="col-lg-3 col-sm-9 company_list hidden">
							<select data-plugin-selectTwo class="form-control populate manual" required="" id="sel_com"></select>
						</div>

						<label class="col-lg-1 control-label text-sm-right pt-2"><?=$term["user"]?><span class="required">*</span></label>
						<div class="col-lg-3 col-sm-9">
							<select data-plugin-selectTwo class="form-control populate manual" required="" name="fasi_id" id="select_fasi_id"></select>
						</div>
					</div>	
					<div class="form-group row">
						<div class="col-lg-6">
							<fieldset>
								<legend><?=$term["selectabletrainings"]?></legend>
								<div>
    								<div class="row" style="margin-bottom: 10px;">
    									<label class="col-lg-4 control-label text-sm-right pt-2"> <?=$term["category"]?> </label>
	    								<div class="col-lg-6 input-group">
											<input type="text" class="form-control" id="search_selectable_text" placeholder="Search..." onchange="loadSelectableList()">
											<span class="input-group-append">
												<button type="button" class="btn btn-default" id="btn_search_training" disabled="disabled"><i class="fas fa-search"></i></button>
											</span>
										</div>	
									</div>

    								<div id="selectable_training" class="list-group" style="height:400px;overflow-y:auto"></div>
									<div class="col-lg-12" style="text-align: right;"><?=$term["addselected"]?> <img src="<?php echo base_url();?>assets/img/selectable.png" />
									</div>										
								</div>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset>
								<legend><?=$term["selectedtrainings"]?></legend>
									<div class="row" style="margin-bottom: 10px;">
    									<label class="col-lg-4 control-label text-sm-right pt-2"> <?=$term["category"]?> </label>
	    								<div class="col-lg-6 input-group">
											<input type="text" class="form-control" id="search_selected_text" placeholder="Search..." onchange="loadSelectedList()">
											<span class="input-group-append">
												<button type="button" class="btn btn-default" id="btn_search_assign" disabled="disabled"><i class="fas fa-search"></i></button>
											</span>
										</div>	
									</div>
    								<div id="selected_training" class="list-group" style="min-height: 400px;overflow-y:auto"></div>
									<div class="col-lg-12" style="text-align: left;"><img src="<?php echo base_url();?>assets/img/selected.png" /> <?=$term["removeselected"]?> </div>
							</fieldset>
						</div>							
					</div>
				</div>					
			</section>			
		</div>
		
	</div>
	
	<!-- end: page -->
</section>
	

<script>
	function loadSelectableList_default() {
		fid = $("#select_fasi_id").val();
		cat = $("#search_selectable_text").val();
		$("#selectable_training").load("<?php echo site_url("admin/trainingassign/selectable") ?>",{
			fasi_id:fid,
			category:cat
		});
	}

	function loadSelectableList() {
		fid = $("#select_fasi_id").val();
		cat = $("#search_selectable_text").val();
		$("#selectable_training").load("<?php echo site_url("all/trainingassign/assign_select") ?>",{
			m_id:fid,
			category:cat,
			type: $("#select_type_id").val(),
			method: 'true',
		});
	}

	function loadSelectedList() {
		fid = $("#select_fasi_id").val();
		cat = $("#search_selected_text").val();
		$("#selected_training").load("<?php echo site_url("all/trainingassign/assign_select") ?>",{
			m_id:fid,
			category:cat,
			type: $("#select_type_id").val(),
			method: 'false',
		},function(res) {
			$("#selected_training .datepicker").each(function() {
	            var $this = $( this );
	            opts = {'format':"yyyy-m-d"};

	            $this.themePluginDatePicker(opts);
	        });
		});
	}

	function selectTopic(btn) {
		row = $(btn).closest(".list-group-item");
		fid = $("#select_fasi_id").val();
		$.post("<?php echo site_url("all/trainingassign/assign") ?>",
			{
				m_id: fid,
				topic_id: row.data("id"),
				type: $("#select_type_id").val(),
			},
			function(res) {
				if(res.success) {
					row.remove();
					loadSelectedList();
				}
			}
		);
	}

	function deselectTopic(btn) {
		row = $(btn).closest(".list-group-item");
		$.post("<?php echo site_url("all/trainingassign/release") ?>",
			{
				id: row.data("assign"),
				type: $("#select_type_id").val(),
			},
			function(res) {
				if(res.success) {
					row.remove();
					loadSelectableList();
				}
			}
		);
	}

	function updateDate(input) {
		row = $(input).closest(".list-group-item");
		$.post("<?php echo site_url("all/trainingassign/update") ?>", {
			id: row.data("assign"),
			type: $("#select_type_id").val(),
			date: $(input).val()
		});
	}

	jQuery(document).ready(function() {

		$('[data-plugin-selectTwo]').each(function() {
			var $this = $( this ),
					opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginSelect2(opts);
		});

		$("#select_type_id").themePluginSelect2({
			 allowClear: true,
			 placeholder: "Type",
			 minimumInputLength: 0,
			 ajax: {
				 "type": "POST",
				 url: "<?php echo base_url();?>all/user/gettypelist",
				 dataType: 'json',
				 results: function(data) {
					 return data;
				 }
			 }
		});

		function setUserList(){
			$.ajax({
				type : "POST",
				url: "<?php echo base_url();?>all/user/getnamelistbytype",
				data : {
					type: $("#select_type_id").val(),
				},
				success : function(data) {
					var html = '';//'<option value="0"></option>';
					if (data != '') {
						var datas = data.results;
						for (var i = 0; i < datas.length; i++) {
							var option = '<option value="' + datas[i].id + '">' + datas[i].text + '</option>';
							html += option;
						}
					}
					$("#select_fasi_id").html(html);
					loadSelectableList();
					loadSelectedList();
				}
			});
		}

		function setCompanyList(){
			$.ajax({
				type : "POST",
				url: "<?php echo base_url();?>all/user/getnamelistbytype",
				data : {
					type: 'Company',
				},
				success : function(data) {
					var html = '';//'<option value="0"></option>';
					var datas = data.results;
					for(var i = 0 ; i < datas.length ; i++){
						var option = '<option value="' + datas[i].id + '">' + datas[i].text + '</option>';
						html += option;
					}
					$("#sel_com").html(html);
					setUserList1();
					/*loadSelectableList();
					 loadSelectedList();*/
				}
			});
		}

		function setUserList1(){
			$.ajax({
				type : "POST",
				url: "<?php echo base_url();?>all/user/getemployeelistbycompany",
				data : {
					company_id: $("#sel_com").val(),
				},
				success : function(data) {
					var html = '';//'<option value="0"></option>';
					if (data != ''){
						var datas = data.results;
						for(var i = 0 ; i < datas.length ; i++){
							var option = '<option value="' + datas[i].id + '">' + datas[i].text + '</option>';
							html += option;
						}
					}

					$("#select_fasi_id").html(html);
					loadSelectableList();
					loadSelectedList();
				}
			});
		}

		$('#sel_com').on('change', function(e){
			setUserList1();
		});


	    <?php  if(isset($assign_row)) { ?>
			var default_select2_data = new Object;
			default_select2_data.text = "<?php echo $assign_row["user_type"];?>";
			default_select2_data.id = "<?php echo $assign_row["user_type"];?>";
			var option = new Option(default_select2_data.text, default_select2_data.id, true, true);
			$("#select_type_id").append(option).trigger('change');

			$("#select_type_id").trigger({
				type: 'select2:select',
				params: {
					data: default_select2_data
				}
			});

			var default_select2_data = new Object;
		    default_select2_data.text = "<?php echo $assign_row["salutation"];?> <?php echo $assign_row["first_name"];?> <?php echo $assign_row["last_name"];?><?php echo $assign_row["company_name"];?>";
		    default_select2_data.id = <?php echo $assign_row["assigner_id"];?>;
		    var option = new Option(default_select2_data.text, default_select2_data.id, true, true);
			$("#select_fasi_id").append(option).trigger('change');

		    $("#select_fasi_id").trigger({
		    	type: 'select2:select',
		    	params: {
		    		data: default_select2_data
		    	}
		    });

		    $("#select_fasi_id").attr("disabled", "disabled");
			$("#select_type_id").attr("disabled", "disabled");

			loadSelectableList();
			loadSelectedList();


		<?php } else{?>
			$('#select_type_id').on('change', function(e){
				var type = $('#select_type_id').val();
				if (type == 'Employee'){
					$('.company_list').removeClass('hidden');
					setCompanyList();
					return;
				}else
					$('.company_list').addClass('hidden');

				setUserList();
			});

			$('#select_fasi_id').on('change', function(e){
				loadSelectableList();
				loadSelectedList();
			});
		<?php } ?>
	    

	});

</script>