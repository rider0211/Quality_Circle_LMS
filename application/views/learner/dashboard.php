<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["dashboard"]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-xl-3">
					<section class="card card-featured-left card-featured-tertiary">
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
										<a class="text-muted text-uppercase" href="<?php echo site_url('learner/examhistory/viewexam');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-3">
					<section class="card card-featured-left card-featured-tertiary">
						<div class="card-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-tertiary">
										<i class="fas fa-check"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title"><?=$term["courses"]?></h4>
										<div class="info">
											<strong class="amount"><?php echo $course_count;?></strong>
										</div>
									</div>
									<div class="summary-footer">
										<a class="text-muted text-uppercase" href="<?php echo site_url('learner/demand/viewCourseHistory');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
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
										<a class="text-muted text-uppercase" href="<?php echo base_url('learner/account/payment');?>">(<?=$term["viewall"]?>)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>							
		</div>
	</div>

<!-- 	<div class="row pt-4">
		<div class="col-lg-6 mb-4 mb-lg-0">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?=$term["sccstatus"]?></h2>
				</header>
				<div class="card-body">
	
					<div class="chart chart-md" id="flotBars"></div>
					<script type="text/javascript">
	
						var flotBarsData = [
							<?php foreach($scc_status as $monthname => $count) : ?>
							['<?=$monthname?>', '<?=$count?>'],
							<?php endforeach; ?>
							/*["Jan", 28],
							["Feb", 42],
							["Mar", 25],
							["Apr", 23],
							["May", 37],
							["Jun", 33],
							["Jul", 18],
							["Aug", 14],
							["Sep", 18],
							["Oct", 15],
							["Nov", 4],
							["Dec", 7]*/
						];
					</script>
				</div>
			</section>			
		</div>
	</div> -->
	
	<!-- end: page -->
<script>
	jQuery(document).ready(function() { 
		
		/*
		Flot: Bars
		*/
		
		var plot = $.plot('#flotBars', [flotBarsData], {
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
		});
	});
</script>
					