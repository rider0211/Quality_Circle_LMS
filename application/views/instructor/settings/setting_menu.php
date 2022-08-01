<section role="main" class="content-body">

	<header class="page-header">
		<h2>Menu Settings</h2>
        <div class="right-wrapper">
        </div>
	</header>

	<!-- start: page -->
	<div class="row">
		<?php $this->load->view('instructor/settings/settings_sidebar'); ?>
		<div class="inner-body">	
			<div class="row">
				<div class="col-lg-12">
					<form action="" method="post" name="menulist">					
						<section class="card">
							<header class="card-header">		
			                    <h2 class="card-title">Menu List</h2>
			                </header>
							<div class="card-body">
								<div class="row">
									<div class="col">
										<div class="tabs tabs-dark">
											<ul class="nav nav-tabs">
												<li class="nav-item active">
													<a class="nav-link" href="#superadmin" data-toggle="tab">Super Admin</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#admin" data-toggle="tab">Admin</a>
												</li>
												<li class="nav-item ">
													<a class="nav-link" href="#company" data-toggle="tab">Company</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#fasi" data-toggle="tab">FASI</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#employee" data-toggle="tab">Employee</a>
												</li>
											</ul>
											<div class="tab-content">
												<div id="superadmin" class="tab-pane active">
													<table class="table table-striped mb-0" id="datatable-default">
														<thead>
															<tr>
																<th>ID</th>
<!-- 																<th>Icon</th>										 -->
																<th>Menu</th>
																<th>Visible</th>
															</tr>
														</thead>
														<tbody>
															<?php
                                                            $i = 0;
															if($menuData_superAdmin) {

															    foreach ($menuData_superAdmin as $mData) :

                                                                    $i ++;
																	$class = ($mData['status'] == 1) ? 'btn-success' : 'btn-danger';
																	$title = ($mData['status'] == 1) ? 'Visible' : 'Invisible';
																?>
																<tr>

																	<td><?php echo $i;?></td>
																	<?php /*?><td><?php echo $mData['icon'];?></td>*/?>
																	<td><?php echo $mData['name'];?></td>
																	<td>
																		<a  id="menu<?php echo $mData['id'];?>" href="javascript: changeSettingStatus(<?php echo $mData['id']; ?>);" class="menu-view-toggle btn btn-xs <?php echo $class?>" title="<?php echo $title?>">
																			<i class="fa fa-eye"></i>
																		</a>
																	</td>

																</tr>		
																<?php 
																endforeach;
															}
															else
																echo '<tr class="text-center"><td colspan="3">No record found!</td></tr>';
															?>							
														</tbody>
													</table>
												</div>
												<div id="admin" class="tab-pane">
													<table class="table table-striped mb-0" id="datatable-default">
														<thead>
															<tr>
																<th>ID</th>
																<?php /*?><th>Icon</th><?php */?>										
																<th>Menu</th>
																<th>Visible</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															if($menuData_admin) {

															    $i = 0;
																foreach ($menuData_admin as $mData) :

                                                                    $i ++;
																	$class = ($mData['status'] == 1) ? 'btn-success' : 'btn-danger';
																	$title = ($mData['status'] == 1) ? 'Visible' : 'Invisible';
																?>
																<tr>
																	<td><?php echo $i;?></td>
																	<?php /*?><td><?php echo $mData['icon'];?></td><?php */?>
																	<td><?php echo $mData['name'];?></td>
																	<td>
																		<a href="<?php echo base_url('admin/settings/menustatus')?>?id=<?php echo $mData['id'];?>&action=<?php echo $mData['status']?>" class="menu-view-toggle btn btn-xs <?php echo $class?>" title="<?php echo $title?>">
																			<i class="fa fa-eye"></i>
																		</a>
																	</td>
																</tr>		
																<?php 
																endforeach;
															}
															else
																echo '<tr class="text-center"><td colspan="3">No record found!</td></tr>';
															?>							
														</tbody>
													</table>
												</div>
												<div id="company" class="tab-pane">
													<table class="table table-striped mb-0" id="datatable-default">
														<thead>
															<tr>
                                                                <th>ID</th>
																<?php /*?><th>Icon</th><?php */?>										
																<th>Menu</th>
																<th>Visible</th>
															</tr>
														</thead>
														<tbody>
															<?php
                                                            $i = 0;
															if($menuData_company) {
																foreach ($menuData_company as $mData) :

                                                                    $i ++;
																	$class = ($mData['status'] == 1) ? 'btn-success' : 'btn-danger';
																	$title = ($mData['status'] == 1) ? 'Visible' : 'Invisible';
																?>
																<tr>
																	<td><?php echo $i ;?></td>
																	<?php /*?><td><?php echo $mData['icon'];?></td><?php */?>
																	<td><?php echo $mData['name'];?></td>
																	<td>
																		<a href="<?php echo base_url('admin/settings/menustatus')?>?id=<?php echo $mData['id'];?>&action=<?php echo $mData['status']?>" class="menu-view-toggle btn btn-xs <?php echo $class?>" title="<?php echo $title?>">
																			<i class="fa fa-eye"></i>
																		</a>
																	</td>
																</tr>		
																<?php 
																endforeach;
															}
															else
																echo '<tr class="text-center"><td colspan="4">No record found!</td></tr>';
															?>							
														</tbody>
													</table>
												</div>
												<div id="fasi" class="tab-pane">
													<table class="table table-striped mb-0" id="datatable-default">
														<thead>
															<tr>
                                                                <th>ID</th>
																<?php /*?><th>Icon</th>	<?php */?>									
																<th>Menu</th>
																<th>Visible</th>
															</tr>
														</thead>
														<tbody>
															<?php
                                                            $i = 0;
															if($menuData_fasi) {
																foreach ($menuData_fasi as $mData) :

                                                                    $i ++;
																	$class = ($mData['status'] == 1) ? 'btn-success' : 'btn-danger';
																	$title = ($mData['status'] == 1) ? 'Visible' : 'Invisible';

																?>
																<tr>
																	<td><?php echo $i;?></td>
																	<?php /*?><td><?php echo $mData['icon'];?></td><?php */?>
																	<td><?php echo $mData['name'];?></td>
																	<td>
																		<a href="<?php echo base_url('admin/settings/menustatus')?>?id=<?php echo $mData['id'];?>&action=<?php echo $mData['status']?>" class="menu-view-toggle btn btn-xs <?php echo $class?>" title="<?php echo $title?>">
																			<i class="fa fa-eye"></i>
																		</a>
																	</td>
																</tr>		
																<?php 
																endforeach;
															}
															else
																echo '<tr class="text-center"><td colspan="4">No record found!</td></tr>';
															?>							
														</tbody>
													</table>
												</div>
												<div id="employee" class="tab-pane">
													<table class="table table-striped mb-0" id="datatable-default">
														<thead>
															<tr>
																<th>Id</th>
																<?php /*?><th>Icon</th>	<?php */?>									
																<th>Menu</th>
																<th>Visible</th>
															</tr>
														</thead>
														<tbody>
															<?php
                                                            $i = 0;
															if($menuData_employee) {
																foreach ($menuData_employee as $mData) :

                                                                    $i ++;
																	$class = ($mData['status'] == 1) ? 'btn-success' : 'btn-danger';
																	$title = ($mData['status'] == 1) ? 'Visible' : 'Invisible';
																?>
																<tr>
																	<td><?php echo $i;?></td>
																	<?php /*?><td><?php echo $mData['icon'];?></td><?php */?>
																	<td><?php echo $mData['name'];?></td>
																	<td>
																		<a href="<?php echo base_url('admin/settings/menustatus')?>?id=<?php echo $mData['id'];?>&action=<?php echo $mData['status']?>" class="menu-view-toggle btn btn-xs <?php echo $class?>" title="<?php echo $title?>">
																			<i class="fa fa-eye"></i>
																		</a>
																	</td>
																</tr>		
																<?php 
																endforeach;
															}
															else 
																echo '<tr class="text-center"><td colspan="4">No record found!</td></tr>';
															?>							
														</tbody>
													</table>
												</div>
											
											
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</section>
					
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- end: page -->
</section>
<script type="text/javascript">
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	$(this).parents('.nav-tabs').find('.active').removeClass('active');
	$(this).parents('.nav-pills').find('.active').removeClass('active');
	$(this).addClass('active').parent().addClass('active');
});


function changeSettingStatus(id){

    $.ajax({
        url: "<?php echo base_url('instructor/settings/menustatus'); ?>",
        type: 'POST',
        data: {
            'id' : id
        },
        success: function (data, status, xhr) {

            var className = $("#menu" + id).attr("class");
         //   alert(className);
            if(className.indexOf("btn-danger") >= 0){
                className = className.replace("btn-danger", "btn-success");
                $("#menu" + id).attr("class", className);
            }
            else{
                if(className.indexOf("btn-success") >= 0){
                    className = className.replace("btn-success", "btn-danger");
                    $("#menu" + id).attr("class", className);
                }
            }

        },
        error: function(){

        }
    });

}
</script>
<?php /*?>
<script src="<?php echo base_url(); ?>assets/js/examples.datatables.default.js"></script>
<script src="<?php echo base_url(); ?>js/examples.datatables.row.with.details.js"></script>
<script src="<?php echo base_url(); ?>js/examples.datatables.tabletools.js"></script>
<?php */?>