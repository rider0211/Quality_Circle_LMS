<section role="main" class="content-body">
    <header class="page-header">
        <h2>Scheduler Course</h2>

        <div class="right-wrapper">
        </div>
    </header>

    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">

                      
                    </div>

                    <h2 class="card-title">Scheduler Course</h2>
                </header>
                <div class="card-body">
                   <table id="book-table" class="table table-responsive-md table-hover mb-0">
						<thead>
							<tr>
								<td>Course</td>
								<td>User Count</td>
								<td>Cron Status</td>
								<td>Details</td> 
							</tr>
						</thead>
						<?php 
						echo '<pre>'; print_r($course);
						foreach($courses as $course) {  ?>
						<tbody>
							
								<td><?php if($course['title']){echo $course['title'];}else{echo 'Course Name';} ?></a></td>
								<td>2</td>
								<td><a href=""><span class="badge badge-success">Success</span></a></td>
								<td><a href="/scheduler/course/view"><i class="fa fa-users" aria-hidden="true"></i></a></td>
						
						</tbody>
							<?php } ?>
					</table>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script>
$(document).ready(function() {
    $('#book-table').DataTable();
});
   

</script>
