	<style>
	.main-block ul li.active {
		background: #f30!important;
		color: white!important;
	}
	.main-block ul li {
		background-color: #FAFAF8;
	}
	.entry-logo {
		height: 100px !important;
	}
	h5{
		line-height: 1.2;
		color: #f30 !important;
	}
	.main-block ul li.active:hover a{
		color: white !important;
	}
	.main-block ul li.active a{
		color: yellow !important;
	}
	.main-block ul li a{
		color: #f30 !important;
	}
	.ui-pnotify-container {
		height: 130px;
	}
	.filter_div select {
	    width: 100%;
	    height: 50px;
	    padding: 0 15px;
	    margin: 0 0 15px 0;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["course"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
			</ol>

		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
                        <a href="<?=base_url()?>instructor/coursecreation/view_certificate_history" class="btn btn-default">Certificate History </a>
                        <a href="<?=base_url()?>instructor/coursecreation/view_course_history" class="btn btn-default">Course History </a>
						<a href="javascript:check_add()" class="btn btn-default"><i class="fas fa-plus"></i> <?=$term["createcourse"]?> </a>
						<a data-toggle="modal" data-target="#Type_Modal" class="btn btn-default"><i class="fas fa-plus"></i> Create Exam </a>
					</div>
					<h2 class="card-title"><?=$term["courselist"]?></h2>
				</header>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3" style="">
							<div class="sidebar clearfix m-b-20">
								<div class="main-block">
									<ul>
										<li class="<?php echo $status==1 ? 'active' : '' ?>"><a href="<?php echo site_url('instructor/coursecreation/getList?status=1')?>" class="scroll">Active</a></li>
										<li class="<?php echo $status==2 ? 'active' : '' ?>"><a href="<?php echo site_url('instructor/coursecreation/getList?status=2')?>" class="scroll">In Active</a></li>
										<li class="<?php echo $status==0 ? 'active' : '' ?>"><a href="<?php echo site_url('instructor/coursecreation/getList?status=0')?>" class="scroll">Draft</a></li>
									</ul>
									</form>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
							<div class="row">
								<div class="col-sm-4">
									<div class="filter_div">
                                        <label>Type</label>
                                        <select id="course_type" name="course_type">
                                            <option value="-1" <?php $course_type==-1?print 'selected':print ''; ?>> All </option>
                                            <option value="2" <?php $course_type==2?print 'selected':print ''; ?>> Demand </option>
                                            <option value="0" <?php $course_type==0?print 'selected':print ''; ?>> ILT </option>
                                            <option value="1" <?php $course_type==1?print 'selected':print ''; ?>> VILT </option>
                                         </select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="filter_div">
										<label>Category</label>
										<select id="category_id" name="category_id">
											<option value="0"> All </option>
											<?php foreach($category as $item){ ?>
												<option value="<?php echo $item['id']; ?>" <?php $category_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
											<?php }  ?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="filter_div">
										<label>Standard</label>
										<select id="standard_id" name="standard_id">
											<option value="0"> All </option>
											<?php foreach($standard as $stdS){ ?>
												<option value="<?php echo $stdS->id; ?>" <?php $standard_id==$stdS->id?print 'selected':print ''; ?>> <?php echo $stdS->name; ?></option>
											<?php }  ?>
										</select>
									</div>
								</div>
							</div>
							<?php foreach($course_data as $item): ?>
								<div class="bg-gray restaurant-entry" id="restaurant-entry-<?php echo $item['id'] ?>">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12 text-xs-center text-sm-left" style="padding: 20px;">
											<div style="float: left;margin-left: 20px;width: 20%;">
												<?php if($item['img_path']){ ?>
													<img style="max-width: 100%;" src="<?php echo base_url($item['img_path']) ?>" width="auto" height="120">
												<?php }else{ ?>
													<img style="max-width: 100%;" src="<?php echo base_url('assets/uploads/company/course/no-preview-available.jpg') ?>" width="auto" height="120">
												<?php } ?>
											</div>
											<div style="margin-left: 20px;float:left;width: 75%;padding-bottom: 10px;border-bottom: 1px solid;">
												<div>
													<h5><?= ucfirst($item['title']) ?></h5>
													<h6><?=$item['first_instructor']?></h6>
													<h6>
														<?php if ($item['time_type'] == 0)
														{
															echo $term["selfpaced"];
														}else{
															echo $term["timerestricted"];
														}?>
													</h6>
													<h6>
														<?php if ($item['course_type'] == 0){
															echo "ILT";
														}else if ($item['course_type'] == 1){
															echo "VILT";
														}else{
															echo "Demand";
														}?>
													</h6>
												</div>
											</div>
											<div style="width: 90%;text-align: right;">
												<a class="btn btn-default" style="margin-top: 10px;" href="javascript:inviteuser(<?=$item['id']?>)"><?=$term["inviteuser"] ?></a>
												<a class="btn btn-default" style="margin-top: 10px;" href="edit_course/<?=$item['id']?>"><?=$term["editcourse"] ?></a>
												<a class="btn btn-default" style="margin-top: 10px;" href="view_course/<?=$item['id']?>"><?=$term["viewcourse"] ?></a>
												<a class="btn btn-default" style="margin-top: 10px;" onclick="delete_course('<?=$item['id']?>')"><?=$term["delete"] ?></a>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<div class="row" style="margin-bottom:30px;">
								<div class="col-md-6 col-xs-12">
									<?php
									$start = $end = 0;
									if ($this->pagination->cur_page > 1) {
										$start = ($this->pagination->cur_page-1) * $this->pagination->per_page+1;
										$end = $start + count($course_data)-1;
									} else if (count($course_data) > 0) {
										$start = 1;
										$end = count($course_data);
									}
									echo "Showing $start - $end of $iTotalRecords total results";
									?>
								</div>
								<div class="col-md-6 col-xs-12">
									<?php echo $links ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
    <a class="modal-with-form invite_modal" href="#modalForm" hidden>
	</a>
	<div id="modalForm" class="modal-block modal-block-primary mfp-hide" style="max-width: 800px!important">
		<form id="modal_form" action="" method="POST" novalidate="novalidate">
		    <input type="hidden" id="sel_id" name="sel_id" class="form-control" >
		    <section class="card">
		        <header class="card-header">
		            <h2 class="card-title"><?=$term["inviteuser"]?></h2>

		        </header>
		        <div class="card-body">
		            <div class="form-group row">
		                <div class="col-sm-1"></div>
		                <div class="col-sm-10">
		                    <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_user">
		                    </table>
		                </div>
		            </div>
		        </div>
		        <footer class="card-footer">
		            <div class="row">
		                <div class="col-md-12 text-right">
							<a href="#add_modal" class="btn btn-default add_modal" style="color:#333"><i class="fas fa-plus"></i> <?=$term["add"]?> </a>
		                    <button class="btn btn-default modal-change-dismiss"><?=$term["cancel"]?></button>
		                </div>
		            </div>
		        </footer>
		    </section>
		</form>
	</div>
	<div id="add_modal" class="modal-block modal-block-primary mfp-hide">
		<form id="add_modal_form" action="" method="POST" novalidate="novalidate">
		    <input type="hidden" id="add_course_id" name="course_id" class="form-control" >
		    <input type="hidden" id="add_course_type" name="course_type" value="0" class="form-control" >
		    <section class="card">
		        <header class="card-header">
		            <h2 class="card-title"><?=$term["add"]?> <?=$term["inviteuser"]?></h2>
		        </header>
		        <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["firstname"]?></label>
                        <div class="col-sm-6">
                            <input type="text" id="first_name" name="first_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["lastname"]?></label>
                        <div class="col-sm-6">
                            <input type="text" id="last_name" name="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["email"]?></label>
                        <div class="col-sm-6">
                            <input type="text" id="send_email" name="email" class="form-control" required>
                        </div>
                    </div>                                        
		        </div>
		        <footer class="card-footer">
		            <div class="row">
		                <div class="col-md-12 text-right">
							<!--<a class="btn btn-default" style="color:#333"><?/*=$term["send"]*/?> </a>-->
							<a class="btn btn-default" href="javascript:add_invite_user()" style="color:#333"><i class="fas fa-plus"></i> <?=$term["add"]?> </a>
		                    <button class="btn btn-default modal-change-dismiss"><?=$term["cancel"]?></button>
		                </div>
		            </div>
		        </footer>
		    </section>
		</form>
	</div>
	<div id="Type_Modal" class="modal fade">
	    <div class="modal-dialog" style = "width: 300px;">
	        <div class="modal-content">
	            <div class="modal-header bg-default">
	                <h4 class="modal-title">Select Exam Type</h4>
	            </div>
	            <div class="modal-body">
	                    <div class="radio" >
	                        <label><input type="radio" class="styled" id="auto_exam" name="map" value="1" checked>Auto Exam</label>
	                    </div>
	                    <div class="radio" >
	                        <label><input type="radio" class="styled" id="manual_exam" name="map" value="2">Manual Exam</label>
	                    </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" onclick="createExam()">Create</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	            </div>
	        </div>
	    </div>
	</div>

	<?php echo form_open('instructor/exam/create', array("id"=>"frm_examlist")); ?>
		<input type="hidden" name="row_id" id="row_id">
		<input type="hidden" name="exam_type" id="exam_type">
	</form>
	<!-- end: page -->
</section>

<script>

	function createExam() {
		var exam_type = $('#auto_exam').prop("checked");
		$frm_category = $('#frm_examlist');
		if (exam_type == true){
			$('#exam_type').val("Auto");
		}else{
			$('#exam_type').val("Manual");
		}

		$frm_category.submit();
	}

    $("#category_id").on('change',(function () {
        window.location = '<?=base_url()?>instructor/coursecreation/getList?category=' + $("#category_id").val();
    }));

    $("#standard_id").on('change',(function () {
        window.location = '<?=base_url()?>instructor/coursecreation/getList?standard=' + $("#standard_id").val();
    }));


	$("#course_type").on('change',(function () {
	    if($("#course_type").val() == "-1"){
            window.location = '<?=base_url()?>instructor/coursecreation/getList' ;

        }
        else {
            window.location = '<?=base_url()?>instructor/coursecreation/getList?course_type=' + $("#course_type").val();
        }
	}));

	function delete_course(id) {
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
                url: 'delete',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {
					window.location.href = "getList?status=<?=$status?>";
				},
				error: function(){
					new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['youcantdeletethisitem']; ?>',
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

    $('.invite_modal').magnificPopup({
        type: 'inline',
        preloader: false,
        callbacks: {
            beforeOpen: function() {
            }
        }
    });
    $('.add_modal').magnificPopup({
        type: 'inline',
        preloader: false,
        callbacks: {
            beforeOpen: function() {
            }
        }
    });
    var inviteuser_table = $("#datatable_user");
    var ajaxData = {"id":0,'course_type':0};
    inviteuser_table.dataTable({
	    "ordering": true,
	    "info": true,
	    "searching": false,

	    "ajax": {
	        "type": "POST",
	        "async": true,
	        "url": "<?=base_url()?>instructor/inviteuser/getInviteUser",
	        "data":function(data) { // add request parameters before submit
                    $.each(ajaxData, function(key, value) {
                        data[key] = value;
                    });
            },
	        "dataSrc": "data",
	        "dataType": "json",
	        "cache": false
	    },

	    "columns": [
	        {"title": "#", "data": "no", "class": "center", "width": 50},
	        {"title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width": 100},
	        {"title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width": 100},
	        {"title": "<?=$term["email"]?>", "data": "email", "class": "text-left", "width": 100},
	        {"title": "<?=$term["action"]?>", "data": "", "class": "text-left", "width": 200,
	                mRender: function (data, type, row) {

                        return '<a class="btn btn-default" href="javascript:resend_inviteuser(this,'+row.id+',\''+row.first_name +'\',\''+row.last_name +'\',\''+row.email +'\')" style="color:#333;margin-right:5px!important"><?=$term["resend"]?> </a>'+
                            '<a class="btn btn-default" href="javascript:delete_inviteuser('+row.id+')" style="color:#333"><?=$term["delete"]?> </a>';
	                }
	    	}
	    ],
	    "scrollY": false,
	    "scrollX": true,
	    "scrollCollapse": false,
	    "jQueryUI": true,

	    "paging": true,
	    "pagingType": "full_numbers",
	    "pageLength": 10, // default record count per page
	    dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
	    bProcessing: true
	});
    var isShow = false;
	function inviteuser(id){
		
		$('#add_modal_form')[0].reset();
		$('#add_course_id').val(id);
		$('#add_course_type').val('0');

		$('#sel_id').val(id);
		//$("#datatable_user").show();
		ajaxData={
			'id':id,
		  	'course_type':0
		};
		inviteuser_table.DataTable().ajax.reload();
		$('.invite_modal').click();
	}

	function add_invite_user(){
		var formData = new FormData($('#add_modal_form')[0]);
        if ($('#first_name').val() == '' || $('#last_name').val() == '' || $('#send_email').val() == '') {
            new PNotify({
                title: 'Failed',
                text: 'Fill Data.',
                type: 'danger'
            });
            return;
        }else{
            $.magnificPopup.close();
            $.ajax({
                url: '<?=base_url()?>instructor/inviteuser/createInviteuser/demand/1',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data, status, xhr) {
                    $.magnificPopup.close();
                    new PNotify({
                        title: 'Success',
                        text: 'Add',
                        type: 'success'
                    });
                    //document.location.reload();
                },
                error: function () {


                }
            });
        }
    }

    function resend_inviteuser(obj, id , firstname, lastname, email){
        $(obj).attr("disabled",1);
        $.ajax({
            url: '<?=base_url()?>instructor/inviteuser/createInviteuser/demand',
            type: 'POST',
            data: {
                id:id,
                course_id: $("#add_course_id").val(),
                first_name: firstname,
                last_name: lastname,
                email: email
            },
            success: function (data, status, xhr) {
                $(obj).removeAttr("disabled");

                //$.magnificPopup.close();
                new PNotify({
                    title: 'Success',
                    text: 'Resend',
                    type: 'success'
                });
                //document.location.reload();
            },
            error: function () {

            }
        });
    }

    function delete_inviteuser(id){
        $.ajax({
	        url: '<?=base_url()?>instructor/inviteuser/deleteInviteuser',
	        type: 'POST',
	        data: {
	        	id:id
	        },
	        success: function (data, status, xhr) {
	            //$.magnificPopup.close();
	            new PNotify({
	                title: 'Success',
	                text: 'Delete',
	                type: 'success'
	            });
	    		ajaxData={
					'id':$('#add_course_id').val(),
				  	'course_type':0
				};
				inviteuser_table.DataTable().ajax.reload();
	            //document.location.reload();
	        },
	        error: function () {
	            new PNotify({
	                title: '<?php echo $term['error']; ?>',
	                text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
	                type: 'error'
	            });
	            $.magnificPopup.close();

	        }
	    });
    }
    function check_add(){
	      var url = "<?= base_url()?>instructor/coursecreation/check_add_view";
	      $.ajax({
	      url: url,
	      type: 'POST',
	      processData:false,
	      contentType: false,
	      success: function (data, status, xhr) {
	        if(data.success){
	              location.href="<?= base_url()?>instructor/coursecreation/edit_course";
	        }else{
	          swal({
	            text: data.msg,
	            icon:"warning",
	          }).then((willDelete) => {
	                if (willDelete) {
	                  location.href="<?php echo base_url('pricing')?>";
	                }
	              });
	        }
	      },
	      error: function(){
	       swal({
	            text: "Add Error",
	            icon:"warning",
	        })
	      }
	    });
    }
</script>