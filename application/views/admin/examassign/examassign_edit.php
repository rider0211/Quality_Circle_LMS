<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["examassignmanagement"]?></h2>
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
						<a class="btn btn-default" id="btn_list" href="<?php echo base_url(); ?>admin/examassign"><i class="fas fa-table"></i> <?=$term["examlist"]?></a>
					</div>

					<h2 class="card-title"><?=$term["assignlist"]?> </h2>
				</header>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-1 control-label text-sm-right pt-2"> <?=$term["type"]?>: <span class="required">*</span></label>
						<div class="col-sm-3">
							<select data-plugin-selectTwo class="form-control populate manual" id="user_type" required=""></select>
						</div>
						<label class="col-lg-1 control-label text-sm-right pt-2 company_list hidden"><?=$term["type"]?><span class="required">*</span></label>
						<div class="col-lg-3 col-sm-9 company_list hidden">
							<select data-plugin-selectTwo class="form-control populate manual" required="" id="sel_com"></select>
						</div>
						<label class="col-sm-1 control-label text-sm-right pt-2"> <?=$term["user"]?> <span class="required">*</span></label>
						<div class="col-sm-3">
							<select data-plugin-selectTwo class="form-control populate manual" name="assigned_user_id" id="select_assigned_user_id" required=""></select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-6">
							<fieldset>
								<legend><?=$term["selectableexams"]?></legend>
								<div>
    								<div class="row" style="margin-bottom: 10px;">
    									<label class="col-lg-4 control-label text-sm-right pt-2"><?=$term["category"]?></label>
	    								<div class="col-lg-6 input-group">
											<input type="text" class="form-control" id="search_selectable_text" placeholder="Search..." onchange="loadSelectableList()">
											<span class="input-group-append">
												<button type="button" class="btn btn-default" onclick="loadSelectableList()" ><i class="fas fa-search"></i></button>
											</span>
										</div>	
									</div>

    								<div id="selectable_exam" class="list-group" style="height:400px;overflow-y:auto"></div>
									<div class="col-lg-12" style="text-align: right;"><?=$term["addselected"]?><img src="<?php echo base_url();?>assets/img/selectable.png" />
									</div>										
								</div>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset>
								<legend><?=$term[selectedexams]?></legend>
									<div class="row" style="margin-bottom: 10px;">
    									<label class="col-lg-4 control-label text-sm-right pt-2"> <?=$term["category"]?> </label>
	    								<div class="col-lg-6 input-group">
											<input type="text" class="form-control" id="search_selected_text" placeholder="Search..." onchange="loadSelectedList()">
											<span class="input-group-append">
												<button type="button" class="btn btn-default" onclick="loadSelectedList()"><i class="fas fa-search"></i></button>
											</span>
										</div>	
									</div>
    								<div id="selected_exam" class="list-group" style="min-height: 400px;overflow-y:auto"></div>
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
	
	function loadSelectableList() {
		assigned_id = $("#select_assigned_user_id").val();
		cat = $("#search_selectable_text").val();
		utype = $('#user_type').val();

		$("#selectable_exam").load("<?php echo site_url("all/examassign/assign_select") ?>", {
			m_id:assigned_id,
			type:utype,
			category:cat,
			method: 'true',
		});
	}
	function loadSelectedList() {
		assigned_id = $("#select_assigned_user_id").val();
		cat = $("#search_selected_text").val();
		utype = $('#user_type').val();
		$("#selected_exam").load("<?php echo site_url("all/examassign/assign_select") ?>", {
			m_id:assigned_id,
			type:utype,
			category:cat,
			method: 'false',
		},function(res) {
			$("#selected_exam .datepicker").each(function() {
	            var $this = $( this );
	            opts = {'format':"yyyy-m-d"};

	            $this.themePluginDatePicker(opts);
	        });
		});
	}

	function selectTopic(btn) {
		row = $(btn).closest(".list-group-item");
		assigned_id = $("#select_assigned_user_id").val();
		utype = $('#user_type').val();
		$.post("<?php echo site_url("all/examassign/assign") ?>",
			{
				m_id: assigned_id,
				type:utype,
				exam_id: row.data("id")
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
		utype = $('#user_type').val();
		$.post("<?php echo site_url("all/examassign/release") ?>",
			{
				id: row.data("assign"),
				type:utype,
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
		utype = $('#user_type').val();
		$.post("<?php echo site_url("all/examassign/update") ?>", {
			id: row.data("assign"),
			type:utype,
			date: $(input).val()
		});
	}
	jQuery(document).ready(function() {

		$('#user_type').themePluginSelect2({
			allowClear: true,
			placeholder: "Select Type",
			minimumInputLength: 0,
			multiple: false,
			targs: false,
			ajax: { 
                type: "POST",
                url: '<?php echo base_url();?>all/user/gettypelist',
                data: function(d){
                	d.type = $('#user_type').val();
                	return d;
                },            
                dataType: 'json',                
                results: function(data) {
                	return data;
                }
            }
		}); 

		$('[data-plugin-selectTwo]').each(function() {
			var $this = $( this ),
					opts = {};

			var pluginOptions = $this.data('plugin-options');
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginSelect2(opts);
		});

		function setUserList(){
			$.ajax({
				type : "POST",
				url: "<?php echo base_url();?>all/user/getnamelistbytype",
				data : {
					type: $("#user_type").val(),
				},
				success : function(data) {
					var html = '';//'<option value="0"></option>';
					var datas = data.results;
					if (data != '') {
						for (var i = 0; i < datas.length; i++) {
							var option = '<option value="' + datas[i].id + '">' + datas[i].text + '</option>';
							html += option;
						}
					}
					$("#select_assigned_user_id").html(html);
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

					$("#select_assigned_user_id").html(html);
					loadSelectableList();
					loadSelectedList();
				}
			});
		}

		$('#sel_com').on('change', function(e){
			setUserList1();
		});

		<?php  if(isset($assign_row)) { /*print_r($assign_row);*/ ?>
			var default_select2_data = new Object;
		    default_select2_data.text = "<?php echo $assign_row['user_type'];?>";
		    default_select2_data.id = "<?php echo $assign_row['user_type'];?>";
		    var option = new Option(default_select2_data.text, default_select2_data.id, true, true);
			$("#user_type").append(option).trigger('change');

		    $("#user_type").trigger({
		    	type: 'select2:select',
		    	params: {
		    		data: default_select2_data
		    	}
		    });

			var default_select2_data = new Object;
			default_select2_data.text = "<?php echo $assign_row['salutation'];?> <?php echo $assign_row['first_name'];?> <?php echo $assign_row['last_name'];?><?php echo $assign_row["company_name"];?>";
			default_select2_data.id = "<?php echo $assign_row['assigner_id'];?>";
			var option = new Option(default_select2_data.text, default_select2_data.id, true, true);
			$("#select_assigned_user_id").append(option).trigger('change');

			$("#select_assigned_user_id").trigger({
				type: 'select2:select',
				params: {
					data: default_select2_data
				}
			});



		    $("#select_assigned_user_id").attr("disabled", "disabled");
			$("#user_type").attr("disabled", "disabled");

			loadSelectableList();
			loadSelectedList();

		<?php }else{ ?>
			$('#user_type').on('change', function(e){
				var type = $('#user_type').val();
				if (type == 'Employee'){
					$('.company_list').removeClass('hidden');
					setCompanyList();
					return;
				}else
					$('.company_list').addClass('hidden');

				setUserList();
			});

			$('#select_assigned_user_id').on('change', function(e){
				loadSelectableList();
				loadSelectedList();
			});
		<?php } ?>
		

		
	});
</script>
