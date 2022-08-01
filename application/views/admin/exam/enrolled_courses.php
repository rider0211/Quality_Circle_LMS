<style>
.ui-pnotify-container {
	height: 130px;
}
</style>
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Enrolled Courses</h2>
    <div class="right-wrapper">
      <ol class="breadcrumbs">
        <li> <a href="<?= base_url(); ?>home"> <i class="fas fa-home"></i> </a> </li>
        <li><span>
          <?=$term["exam"]?>
          </span></li>
        <li><span>
          <?=$term["examlist"]?>
          </span></li>
      </ol>
    </div>
  </header>
  
  
  <!-- start: page -->
  <div class="row">
    <div class="col-lg-12">
      <section class="card">
        <header class="card-header">
          <h2 class="card-title">Enrolled Courses</h2>
        </header>
        <div class="card-body">
        
        <footer class="card-footer">
            <div class="row">
            	<div class="col-md-6"></div>
                <div class="col-md-6">
                	<form id="searchForm" type="post">
                    <div class="row">
                       <div class="col-sm-4">
                            <select class="form-control" id="course_type" name="course_type">
                                <option value="">Select Course Type</option>                                                                                
                                <option value="0">ILT</option>                                        
                                <option value="1">VILT</option>
                                <option value="2">ON-DEMAND</option>
                  			</select>
                       </div>
                       <div class="col-sm-5">
                            <select data-plugin-selecttwo="" class="form-control" id="course_title" name="course_title">
                                <option value="">Select Course</option>  
                                <?php if(isset($mydata['data']) && !empty($mydata['data'])){ ?>
              					<?php foreach($mydata['data'] as $myenrollsearch){ ?>
                                	<option value="<?= $myenrollsearch['id'] ?>"><?= $myenrollsearch['title'] ?></option>
                                <?php } } ?>
                  			</select>
                       </div>
                       <div class="col-sm-3">
                            <a onclick="searchData();" class="btn btn-primary" id="searchBTN">Search</a>
                            <a href="<?= base_url('admin/examhistory/enrolledcourse');?>" class="btn btn-default">Reset</a>
                       </div>
                   	</div>
                   	</form>
                </div>
            </div>
        </footer>
  		
        <div id="replaceHtml">
          <table class="table table-responsive-md table-striped table-hover mb-0 dataTable no-footer" id="datatable_examlist" style="width:100%" role="grid">

            <thead style="background-color:#1D2127; color:#FFF">
              <td><b>S.No.</b></td>
              <td><b>Course Title</b></td>
              <td><b>Course Type</b></td>
              <td><b>Total Count</b></td>
              <td><b>Action</b></td>
            </thead>
            <tbody>
              <?php if(isset($mydata['data']) && !empty($mydata['data'])){ ?>
              <?php foreach($mydata['data'] as $mkey => $myenroll){
                    if($myenroll['type'] == 0){
                        $course_type = 'ILT';
                    }elseif($myenroll['type'] == 1){
                        $course_type = 'VILT';
                    }else{
                        $course_type = 'Demand';
                    }
                ?>
              <tr role="row" class="odd">
                <td class="center sorting_<?php $myenroll['no']  ?>"><?= $myenroll['no'] ?></td>
                <td class="text-left"><?= $myenroll['title'] ?></td>
                <td class="text-left"><?= $course_type; ?></td>
                <td class="text-left"><?= $myenroll['count'] ?></td>
                <td class=" text-left">
                  <?php if($myenroll['type'] == 2){ ?>
                      <a style="background-color:#1D2127; color:#FFF; border:0px;" target="_blank" class="btn btn-default btn-sm" id="append_view_<?= $myenroll['id'] ?>" href="<?= base_url()?>admin/examhistory/enrolled_course_users/<?= $myenroll['id'] ?>/0">View</a>
                    <?php if($user['user_type'] == "Admin"){ ?>
                      <a style="background-color:#e81b06; color:#FFF; border:0px;"  class="btn btn-default btn-sm"  href="javascript:deleteEnroll('<?= $myenroll['id'] ?>')">Delete</a>
                    <?php }?>
                  <?php }else{ ?>
                      <a style="background-color:#1D2127; color:#FFF; border:0px;" class="btn btn-default btn-sm" id="append_view_<?= $myenroll['id'] ?>" href="javascript:void(0)" onclick="getEnrolled(<?= $myenroll['id'] ?>)">View</a>
                    <?php if($user['user_type'] == "Admin"){ ?>
                      <a style="background-color:#e81b06; color:#FFF; border:0px;"  class="btn btn-default btn-sm"  href="javascript:deleteEnroll('<?= $myenroll['id'] ?>')">Delete</a>
                    <?php }?>
                  <?php } ?>
                </td>

                
              </tr>
              <?php $course_times = getCourseDetail($myenroll['id'],$myenroll['type']); 
                    if($course_times != ''){							
                  ?>
              <tr style="display:none;" role="row" class="odd" id="sub_tr_<?= $myenroll['id'] ?>">
                <td colspan="5"><table width="100%">
                    <thead style="background-color:#1D2127; color:#FFF">
                      <td><b>S.No.</b></td>
                      <td><b>Course Title</b></td>
                      <td><b>Schedule Date</b></td>
                      <td><b>Total Count</b></td>
                      <td><b>Action</b></td>
                    </thead>
                    <?php foreach($course_times as $keys => $courseSchedule){ 
                      $totalEnCount = getScheTotalCount($myenroll['id'],$courseSchedule['time_id']); 
                    ?>
                    <tr role="row" class="odd">
                      <td><?= $keys+1; ?></td>
                      <td class="text-left"><?= $courseSchedule['title'] ?></td>
                      <?php if($myenroll['type'] == 1){ ?>
                        <td class="text-left"><?= date('F d,Y',strtotime($courseSchedule['start_at'])) ?></td>
                      <?php } else if($myenroll['type'] == 0){ ?>
                        <td class="text-left"><?= date('F d,Y',strtotime($courseSchedule['start_day'])) ?></td>
                      <?php } else{ ?>
                        <td class="text-left">Not Available</td>
                      <?php } 
                      } ?>
                      <td class="text-left"><?= $totalEnCount;?></td>
                      <td class="text-left">
                        <a target="_blank" class="btn btn-default btn-sm" id="append_view_<?= $courseSchedule['id'] ?>" href="<?= base_url()?>admin/examhistory/enrolled_course_users/<?= $myenroll['id'] ?>/<?= $courseSchedule['time_id'] ?>/<?= $stringDate;?>">View</a>
                      <?php if($user['user_type'] == "Admin"){ ?>
                        <a style="background-color:#e81b06; color:#FFF; border:0px;" target="_blank" class="btn btn-default btn-sm"  href="javascript:deleteEnroll('<?= $myenroll['id'] ?>')">Delete</a>
                      <?php }?>
                      </td>
                    </tr>
                    <?php } ?>
                  </table></td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
          </div>
        </div>
      </section>
    </div>
  </div>
  
  <!-- end: page --> 
</section>
<script type="text/javascript">
	function getEnrolled(div_id){
		if($('#sub_tr_'+div_id).is(':visible')){
			$('#sub_tr_'+div_id).hide();
		}else{
			$('#sub_tr_'+div_id).show();
		}
	}
  function deleteEnroll(id){
    (new PNotify({
            title: "<?= $term['confirmation']; ?>",
            text: "<?= $term['areyousuretodelete']; ?>",
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
				'dir1': 'down',
				'dir2': 'right',
				'modal':true
			}
		})).get().on('pnotify.confirm', function(){
      $.ajax({
        type: 'POST',
        url: "<?= base_url()?>admin/examhistory/deleteCourse",
        data: {
          id : id
        },
        success: function(msg){
          location.reload();
          
        },
				error: function(){
					new PNotify({
                        title: '<?= $term['error']; ?>',
                        text: '<?= $term['youcantdeletethisitem']; ?>',
						type: 'error'
					});		
				}
			});				
		});
  }
	
	function searchData(){
		$('#searchBTN').html('Searching');
		$.ajax({
			type: 'POST',
			url: "<?= base_url()?>admin/examhistory/searchResult/",
			data: $('#searchForm').serialize(),
			success: function(msg){
				$('#replaceHtml').html(msg);
				$('#searchBTN').html('Search');
				return false;
				
			},error: function(ts){
				$('#searchBTN').html('Search'); 
				console.log(ts);
			}
		});
	}
</script> 
