<section role="main" class="content-body">
	<header class="page-header">
		<h2>Certification Management</h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
	<?php
		//print_r($certification);
	?>
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">	
						<a href="<?php echo base_url();?>admin/certification" class="btn btn-default"><i class="fas fa-table"></i> List </a>
					</div>
					<h2 class="card-title">Certification </h2>
				</header>
				<div class="card-body">
					<div class="col-lg-12 export_content">
						<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12" style="border: 9px #CCC solid; height: auto; padding: 15px; font-size: 1.2em;">
							<div style="border: 3px #ccc solid; width:100%; height: 100%; padding-left: 80px; padding-right: 80px;">
								<div class="row" style="padding-top: 20px;">
									<div class="col-lg-12">
										<div id="div_date" class="col-lg-2 col-md-4 col-sm-4 col-6" style="float: right;">
											Date: <br /><?php echo $certification["created_at"];?>
										</div>
									</div>
								</div>
								<div class="col-lg-12" style="text-align: center">
									<img src="<?php echo site_url($certification_template["logo"]);?>" width="20%">
									<h2 id="c_title" class="cert_title"><?php echo $certification_template["title"];?></h2>
								<hr style="width: 90%; color: #ccc; height: 2px;"  />
								</div>
								<div class="col-lg-12" style="text-align: center; padding-top: 45px; font-style: italic; font-size: 1.3em; line-height: 1.7em;">
									<?php echo $certification_template["content"];?>
								</div>
								<div class="row" style="vertical-align: bottom; padding-top: 30px; font-size: 1.4em; color: #333; padding-bottom: 30px;">
									<div class="col-lg-4">
										<div style=""><img src="<?php echo site_url($certification_template["left_sign"]);?>"></div>
										<div style="font-weight: bold; font-size: 1.2em;"><?php echo $certification_template["left_des"];?></div>
										<div style="font-size: 1em; color: #bbb; line-height: 40px;">Course Teacher</div>
									</div>
									<div class="col-lg-4" style="text-align: center;"><img src="<?php echo site_url($certification_template["middle_logo"]);?>"></div>
									<div class="col-lg-4" >
										<div style="text-align: right;"><img src="<?php echo site_url($certification_template["right_sign"]);?>"></div>
										<div style="font-weight: bold; font-size: 1.2em; text-align: right;"><?php echo $certification_template["right_des"];?></div>
										<div style="font-size: 1em; color: #bbb; line-height: 40px; text-align: right;" >Admin</div>
									</div>
								</div>
							</div>						
						</div>
					</div>
					<div class="col-lg-12" style="padding-top: 30px;">
						<div class="col-lg-8" style="text-align: center;">
                                <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-export"><i class="fa fa-download"></i>Export Excel</button>
                        </div>
					</div>	
				</div>
			</section>
            <form method="post" id="certification_export_form" action="<?= base_url()?>admin/certification/export">
                <input type="hidden" id="certifi_content" name="certifi_content" value="">
            </form>
		</div>
	</div>
	
	<!-- end: page -->
    <script>

        $('#btn-export').on('click', function(){
            var body = $('.export_content').html();
            $('#certifi_content').val(body);
            $('#certification_export_form').submit();
        });
    </script>

</section>
