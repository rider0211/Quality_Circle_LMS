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
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>On Demand Course</h2>
	
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
                        <a href="<?=base_url()?>instructor/demand/view_certificate_history" class="btn btn-default">Certificate History </a>
                        <a href="<?=base_url()?>instructor/demand/view_course_history" class="btn btn-default">Course History </a>
						<?php /*?><a href="edit_course" class="btn btn-default"><i class="fas fa-plus"></i> <?=$term["createcourse"]?> </a><?php */?>
					</div>
					<h2 class="card-title">On Demand Course List</h2>
				</header>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3" style="padding-top: 40px;">
							<div class="sidebar clearfix m-b-20">
								<div class="main-block">
									<ul>
										<li class="<?php echo $status==1 ? 'active' : '' ?>"><a href="<?php echo site_url('instructor/demand/getList?status=1')?>" class="scroll">Active</a></li>
										<li class="<?php echo $status==2 ? 'active' : '' ?>"><a href="<?php echo site_url('instructor/demand/getList?status=2')?>" class="scroll">In Active</a></li>
										<li class="<?php echo $status==0 ? 'active' : '' ?>"><a href="<?php echo site_url('instructor/demand/getList?status=0')?>" class="scroll">Draft</a></li>
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
                                        <label>Course</label>
                                        <select data-plugin-selectTwo class="form-control" id="courses_filter" name="courses_filter">
                                            <option value="" >Select Course</option>
                                            <?php foreach($course_data_all as $coursefilter){ ?>
                                            <?php if($coursefilter['title'] != '' && $coursefilter['course_type'] == 2){ ?>
                                                    <option value="<?php echo $coursefilter['id']; ?>" <?php $id==$coursefilter['id']?print 'selected':print ''; ?>> <?php echo $coursefilter['title']; ?></option>
                                            <?php } } ?>  
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
                                
                                <?php /*?><div class="col-sm-4">
										<label>Type</label>
										<select id="course_type" name="course_type">
											<option value="0" <?php $course_type==0?print 'selected':print ''; ?>> ILT </option>
											<option value="1" <?php $course_type==1?print 'selected':print ''; ?>> VILT </option>
											<option value="2" <?php $course_type==2?print 'selected':print ''; ?>> Demand </option>
										</select>
									</div><?php */?>
							</div>
                            
							<?php foreach($course_data as $item): ?>
								<div class="bg-gray restaurant-entry" id="restaurant-entry-<?php echo $item['id'] ?>">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12 text-xs-center text-sm-left" style="padding: 20px;">
											<div style="float: left;margin-left: 20px;width: 20%;">
												<?php													
													$imgName = end(explode('/', $item['img_path']));
													if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){
												?>
                                                	<img style="max-width: 100%;" src="<?php echo base_url($item['img_path']) ?>" width="auto" height="120">
												<?php } else{ ?>
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
												<a class="btn btn-default" style="margin-top: 10px;" href="<?=base_url()?>instructor/coursecreation/edit_course/<?=$item['id']?>"><?=$term["editcourse"] ?></a>
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
	
	<!-- end: page -->
</section>

<script>

    $("#category_id").on('change',(function () {
        window.location = '<?=base_url()?>instructor/demand/getList?category=' + $("#category_id").val();
    }));
	$("#course_type").on('change',(function () {
		window.location = '<?=base_url()?>instructor/demand/getList?course_type=' + $("#course_type").val();
	}));
	
	$("#courses_filter").on('change',(function () {
        window.location = '<?=base_url()?>instructor/demand/getList?course=' + $("#courses_filter").val();
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

</script>