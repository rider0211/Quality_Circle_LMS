
<section role="main" id="mainpage" class="content-body">
	<header class="page-header">
		<h2><?=$term["dashboard"]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-xl-4">
					<section class="card card-featured-left card-featured-primary mb-3">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-primary">
										<i class="fas fa-building"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["companies"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $company_count; ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('superadmin/company');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-4">
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
										<h4 class="title"><?=$term["users"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $employee_count; ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('superadmin/user');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-4">
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
										<h4 style="font-size: 0.8rem;" class="title"><?=$term["onlineusers"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $logined_usercount; ?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('superadmin/user');?>">(<?=$term["viewall"]?>)</a>
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
											<strong class="amount">$ <?= $amount->total_amount!=null?$amount->total_amount:0;?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo base_url('superadmin/account');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-6">
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
										<a class="text-muted text-uppercase" href="#">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
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
		
	});
</script>