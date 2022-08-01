<?php
$image = $image2 = $image3 = $image4 = '';
if($id != 0){
    $image = base_url().$img_path;
	$image2 = base_url().$objective_img;
	$image3 = base_url().$attend_img;
	$image4 = base_url().$agenda_img;
}
?>

<style>
    .datepicker> .datepicker-days{
        display: initial;
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
		<div class="col-sm-12">
			<section class="card">
                <form id="add-column-form" enctype="multipart/form-data" action="<?=base_url()?>admin/live/addLive" method="POST" novalidate="novalidate">
				<header class="card-header">
					<div class="card-actions">
                        <a class="modal-with-form" href="<?=base_url()?>admin/live">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-change-time"> <i class="fa fa-plus"></i> <?=$term["courselist"]?></button>
                        </a>
					</div>
					<h2 class="card-title"><?=$term["courseinfo"]?></h2>
				</header>
				<div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?php print $id; ?>">                  
                    <?php						
						if($img_path == ''){
							$img_path = 'assets/uploads/no-image-found.jpg';	
						}
						if($objective_img == ''){
							$objective_img = 'assets/uploads/no-image-found.jpg';	
						}
						if($attend_img == ''){
							$attend_img = 'assets/uploads/no-image-found.jpg';	
						}
						if($agenda_img == ''){
							$agenda_img = 'assets/uploads/no-image-found.jpg';	
						}
					?>
                    <input type="hidden" name="img_path_previous" id="img_path_previous" value="<?php echo $img_path; ?>">
                    <input type="hidden" name="objective_img_previous" id="objective_img_previous" value="<?php echo $objective_img; ?>">
                    <input type="hidden" name="attend_img_previous" id="attend_img_previous" value="<?php echo $attend_img; ?>">
                    <input type="hidden" name="agenda_img_previous" id="agenda_img_previous" value="<?php echo $agenda_img; ?>">
                    
                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-lg-right pt-2"><?=$term['course']?><span class="required">*</span></label>
                        <div class="col-sm-8">
                            <select data-plugin-selectTwo class="form-control" id="category_id" name="category_id">
                            	<option value="">Select Course</option>
                                <?php foreach($categoryCourse as $item){ ?>                                	
                                    <option value="<?php echo $item->id; ?>" <?php $category_id==$item->id?print 'selected':print ''; ?>> <?php echo $item->title; ?></option>
                                <?php }  ?>                               
                            </select>
                            <label class="error" id="category_id-error" for="category_id"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-5"><?=$term["title"]?><span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" value="<?php print $title ?>" id="title" name="title" class="form-control"  placeholder="Title" readonly="readonly">
                                    <label class="error" id="title-error" for="title"></label>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["subtitle"]?><span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" value="<?php print $subtitle ?>" id="subtitle" name="subtitle" class="form-control" placeholder="subtitle">
                                    <label class="error" id="subtitle-error" for="subtitle"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="p-4 border rounded text-center upload-file d-block" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload" name="img_path" id="img_path" type="file" accept="image/*"/>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>

                    <?php
						if(isset($start_at)){
							$timestamp = strtotime($start_at);
						}else{
							$timestamp = strtotime(date("Y-m-d H:i:s"));
						}
	
						$date = date('Y-m-d', $timestamp);
						$hour = date('H:i:s', $timestamp);
						$year = date('Y', $timestamp);
						$month = date('m', $timestamp);
						$sday = date('d', $timestamp);
                    ?>       
                        <?php /*?><div class="form-group row">
                         <label class="col-lg-2 control-label text-lg-right pt-2">Start Day</label>
                         <div class="col-lg-8">
                            <div class="input-group">
                               <span class="input-group-prepend">
                               <span class="input-group-text">
                               <i class="fas fa-calendar-alt"></i>
                               </span>
                               </span>
                               <input type="text" data-plugin-datepicker="" value="<?=$startday?>" class="form-control" id="startday" name="startday" data-date-format="yyyy-mm-dd">
                            </div>
                         </div>
                        </div>  
                      <div class="form-group row">
                         <label class="col-lg-2 control-label text-lg-right pt-2">End Day</label>
                         <div class="col-lg-8">
                            <div class="input-group">
                               <span class="input-group-prepend">
                               <span class="input-group-text">
                               <i class="fas fa-calendar-alt"></i>
                               </span>
                               </span>
                               <input type="text" data-plugin-datepicker="" value="<?=$endday?>" class="form-control" id="endday" name="endday" data-date-format="yyyy-mm-dd">
                            </div>
                         </div>
                      </div> <?php */?>            
                        <input type="hidden" name="course_type" id="course_type" value="<?=$course_type?>"/>
                        <div class="div-location" <?php if($course_type == 0){ ?>style="display:none;"<?php }else{ ?>style="display:block;"<?php } ?>>
                          <div class="form-group row">
                             <label class="col-sm-2 control-label text-lg-right pt-2">Location</label>
                             <div class="col-sm-8">
                                <input type="text" class="form-control" id="location" value="Online" readonly="readonly">
                             </div>
                          </div>
                        </div>
                      	<div id="div-address" <?php if($course_type == 1){ ?>style="display:none;"<?php }else{ ?>style="display:block;"<?php } ?>>
                          <div  class="form-group row">
                             <label class="col-sm-2 control-label text-lg-right pt-2">Address</label>
                             <div class="col-sm-8">
                                <textarea class="form-control" rows="3"  id="address" name="address"><?=$address?></textarea>
                             </div>
                          </div>
                          <div class="form-group row">
                             <label class="col-sm-2 control-label text-lg-right pt-2">Country</label>
                             <div class="col-sm-8">
                                <input type="text" class="form-control" id="country" value="<?=$country?>" name="country">
                             </div>
                          </div>
                          <div class="form-group row">
                             <label class="col-sm-2 control-label text-lg-right pt-2">State</label>
                             <div class="col-sm-8">
                                <input type="text" class="form-control" id="state" value="<?=$state?>" name="state">
                             </div>
                          </div>
                          <div class="form-group row">
                             <label class="col-sm-2 control-label text-lg-right pt-2">City</label>
                             <div class="col-sm-8">
                                <input type="text" class="form-control" id="city" value="<?=$city?>" name="city">
                             </div>
                          </div>
                      </div>                     
                      <div class="form-group row">
                         <label class="col-sm-2 control-label text-lg-right">Category</label>
                         <div class="col-sm-8">
                            <select class="form-control" id="category" onchange="getCategoryTitle()" name="category">
                               <?php foreach($category_ids as $items){ ?>
                                    <option <?php if($category == $items['id']){echo 'selected';} ?> value="<?php echo $items['id']; ?>"><?php echo $items['name']; ?></option>
                               <?php }  ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-sm-2 control-label text-lg-right"><?=$term['standard']?></label>
                       <div class="col-sm-8">
                          <select class="form-control" id="standard_id" name="standard_id[]" multiple="multiple"></select>
                       </div>
                    </div>
                    <input type="hidden" name="number" id="number" value="<?=$number?>">
                    <div class="form-group row">
                     <label class="col-sm-2 control-label text-lg-right pt-2">Number</label>
                     <div class="col-sm-8">
                        <input type="text" disabled="disabled" class="form-control number_value" value="<?=$number?>" />
                     </div>
                    </div>
                    <div class="form-group row">
                     <label class="col-sm-2 control-label text-lg-right pt-2">Highlights</label>
                     <div class="col-sm-7 addmorehigh">
                        <?php if(!empty($highlights)){
                            $highlights = json_decode($highlights);
                            foreach($highlights as $keys => $highlight){
                        ?>
                            <div id="deletebtn_<?php echo $keys ?>"><input type="text" placeholder="highlight" value="<?php echo $highlight ?>" required="required" class="highlights form-control" name="highlights[]"><a href="javascript:void(0)" onclick="deletehighlight(<?php echo $keys ?>)">Delete</a></div>
                        <?php } } ?>
                        <input type="text" placeholder="highlight" required="required" class="highlights form-control" name="highlights[]">
                        <input type="text" placeholder="highlight" required="required" class="highlights form-control" name="highlights[]">
                        <input type="text" placeholder="highlight" required="required" class="highlights form-control" name="highlights[]">                                    
                     </div>
                     <a href="javascript:void(0)"><div id="addmorebtn" class="col-sm-2 btn">ADD MORE</div></a>
                    </div>
                    <div class="form-group row" <?php $id==0?print '':print 'hidden'?>>
                        <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["starttime"]?></label>
                        <div class="col-sm-3">
                            <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-clock"></i>
                                </span>
                            </span>
                         	<input type="text" id="starttime" value="<?php print $hour ?>" name="starttime" data-plugin-timepicker="" class="form-control" data-plugin-options="{ &quot;showMeridian&quot;: false }">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault"><?=$term["description"]?></label>
                        <div class="col-sm-6">
                            <textarea  class="form-control" rows="8" data-plugin-markdown-editor data-plugin-maxlength="" id="about" name="about"><?php print $about ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row" style="display: none;">
                        <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["whocanattend"]?></label>
                        <div class="col-sm-4">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="user_type" id="user_type1" value="0" <?php if ($user_type == 0):?>checked<?php endif;?>>
                                    To all visitors and registered users of the academy
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="user_type" id="user_type2" value="1" <?php if ($user_type == 1):?>checked<?php endif;?>>
                                    Only to the users you enroll
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" style="display: none;">
                        <label class="col-sm-2 control-label text-sm-right pt-2">Class Pricing:</label>
                        <div class="col-sm-4">

                            <div class="radio">
                                <label>
                                    <input type="radio" name="pay_type" id="pay_type1" value="0" <?php if ($pay_type == 0):?>checked<?php endif;?>>
                                    Free Class
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="pay_type" id="pay_type2" value="1" <?php if ($pay_type == 1):?>checked<?php endif;?>>
                                    Paid Class
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row" style="display: none;">
                        <label class="col-sm-2 control-label text-sm-right pt-2">Record this class:</label>
                        <div class="col-sm-4">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="record_type" id="record_type1" value="0" <?php if ($record_type == 0):?>checked<?php endif;?>>
                                    yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="record_type" id="record_type2" value="1" <?php if ($record_type == 1):?>checked<?php endif;?>>
                                    no
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault">Learning Objectives</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="8" data-plugin-markdown-editor id="objective" name="objective"><?=$objective?></textarea>
                        </div>
                    </div>
					<div class="form-group row">
                    	<label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault">Learning Objectives File Upload</label>
                        <div class="col-sm-6">
                        <div class="p-4 border rounded text-center upload-file2 d-block" style="height: 30vh;width: 30vh;background-size: cover;" >
                            <i class="fa fa-picture-o fa-2x"></i>
                            <p class=""><small>Upload Image</small></p>
                        </div>
                        <input class="file-upload2" name="objective_img" id="objective_img" type="file" accept="image/*" style="display: none;"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault">Who Should Attend</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="8" data-plugin-markdown-editor id="attend" name="attend"><?=$attend?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    	<label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault">Who Should Attend File Upload</label>
                        <div class="col-sm-6">
                        <div class="p-4 border rounded text-center upload-file3 d-block" style="height: 30vh;width: 30vh;background-size: cover;" >
                            <i class="fa fa-picture-o fa-2x"></i>
                            <p class=""><small>Upload Image</small></p>
                        </div>
                        <input class="file-upload3" name="attend_img" id="attend_img" type="file" accept="image/*" style="display: none;"/>
                        </div>
                    </div>					
                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault">AGENDA</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="8" data-plugin-markdown-editor id="agenda" name="agenda"><?=$agenda?></textarea>
                        </div>
                    </div>
					<div class="form-group row">
                    	<label class="col-sm-2 control-label text-sm-right pt-2" for="textareaDefault">Agenda File Upload</label>
                        <div class="col-sm-6">
                        <div class="p-4 border rounded text-center upload-file4 d-block" style="height: 30vh;width: 30vh;background-size: cover;" >
                            <i class="fa fa-picture-o fa-2x"></i>
                            <p class=""><small>Upload Image</small></p>
                        </div>
                        <input class="file-upload4" name="agenda_img" id="agenda_img" type="file" accept="image/*" style="display: none;"/>
                        </div>
                    </div>
                	<div class="form-group row">
                     <label class="col-sm-2 control-label text-lg-right pt-2">Course Pre-Requisite</label>
                     <div class="col-sm-6">
                        <textarea class="form-control" data-plugin-markdown-editor rows="8" id="course_pre_requisite" name="course_pre_requisite"><?=$course_pre_requisite?></textarea>
                     </div>
                  	</div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-sm-right pt-2">Class Duration(Days)</label>
                        <div class="col-sm-4">
                            <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:0, &quot;min&quot;: 0, &quot;max&quot;: 30 }">
                                <div class="input-group" style="width:150px;">
                                    <input type="text" id="duration" name="duration" value="<?=$duration?>" class="spinner-input form-control" maxlength="2" >
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default spinner-up">
                                            <i class="fas fa-angle-up"></i>
                                        </button>
                                        <button type="button" class="btn btn-default spinner-down">
                                            <i class="fas fa-angle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-5" >
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-2" ><?=$term['selectinstructor']?></label>
                                <div class="col-sm-9">
                                    <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_instructor" >
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"  style="display: none;">
                            <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-left pt-1" ><?=$term['selectuser']?></label>
                            <div class="col-sm-9">
                                <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_user" >
                                </table>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label text-sm-right pt-2">Url<span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" value="<?php print $vilt_url ?>" id="vilt_url" name="vilt_url" class="form-control" placeholder="Url">
                        </div>
                    </div>


				</div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" id="btn_add" class="btn btn-default"><?php $id==0?print $term["add"]:print $term["update"]?></button>
                            <button type="reset" id="btn_reset" class="btn btn-default"><?=$term["reset"]?></button>
                        </div>
                    </div>
                </footer>
                </form>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
<script>
	function getCategoryTitle(){
		$('#number').val($( "#category option:selected" ).text());
	}
	$(document).ready(function(e) {
		getCategoryTitle();
        get_standard_list_chk(<?php echo $category ?>);
    });
   $('#category').on('change',function(){
		get_standard_list($('#category').val());
   });
   
   $('#addmorebtn').on('click',function(){
		$('.addmorehigh').append('<input type="text" placeholder="highlight" class="highlights form-control" name="highlights[]">');
	});
	
	function deletehighlight(delid){
		$('#deletebtn_'+delid).remove();
	}
   
   function get_standard_list_chk(id){
	   	$('#standard_id').empty();
		var standard_array = <?php echo isset($standard_id)?$standard_id:0;?>;
	   	$.ajax({
		   url: '<?php echo base_url() ?>admin/category/getStandardList',
		   type: 'POST',
		   data: {category_id:id},
		   dataType : 'json',
		   success: function (data, status, xhr){
			   var standard = data.data;
			   html = '';
			   for(var i = 0; i < standard.length; i++){
			   		selected = '';
				   	if(jQuery.inArray(standard[i].id, standard_array)!= -1){
						selected = 'selected';
					}
					html += '<option '+selected+' value="'+standard[i].id+'">'+standard[i].name+'</option>';
			   };
			   $('#standard_id').append(html);
		   },
	   });
   }
   
   function get_standard_list(id){
	   	$('#standard_id').empty();
		//var standard_id = <?php echo isset($course_data['standard_id'])?$course_data['standard_id']:0;?>;
	   	$.ajax({
		   url: '<?php echo base_url() ?>admin/category/getStandardList',
		   type: 'POST',
		   data: {category_id:id},
		   dataType : 'json',
		   success: function (data, status, xhr){
			   var standard = data.data;
			   html = '';
			   for(var i = 0; i < standard.length; i++){
					html += '<option value="'+standard[i].id+'">'+standard[i].name+'</option>';
			   };
			   $('#standard_id').append(html);
		   },
	   });
   }
   
	$('#category_id').on('change',function(){		
   		var selectedText = $(this).find("option:selected").text();
   		var course_id = $(this).find("option:selected").val();		
		$('.upload-file').css("background-image", "url('')");
		$('.upload-file').html('');
	   	if(course_id != '' && selectedText != ''){		
		var baseurl = '<?=base_url()?>';		
		   $.ajax({
			   url: '<?=base_url()?>admin/training/getCourseDetail',
			   type: 'POST',
			   data: {course_id:course_id},
			   success: function (data, status, xhr){
				   	//console.log(data['course']);
				   	var imgsrc = '<img style="height: 100%;width: 100%;" class="img-responsive" src="'+baseurl+data['course']['img_path']+'">';	
					var imgattend = '<img style="height: 100%;width: 100%;" class="img-responsive" src="'+baseurl+data['course']['attend_img']+'">';	
					var imgagenda = '<img style="height: 100%;width: 100%;" class="img-responsive" src="'+baseurl+data['course']['agenda_img']+'">';	
					var imgobject = '<img style="height: 100%;width: 100%;" class="img-responsive" src="'+baseurl+data['course']['objective_img']+'">';					
					get_standard_list(data['course']['category_id']);
					$('#chapter_date_time').html('');
					if(data['course']['img_path'] != ''){
						$('.upload-file').css("background-image", "url("+baseurl+data['course']['img_path']+")");
						$('#img_path_previous').val(data['course']['img_path']);
					}
					if(data['course']['attend_img'] != ''){
						$('.upload-file2').css("background-image", "url("+baseurl+data['course']['attend_img']+")");
						$('#attend_img_previous').val(data['course']['attend_img']);
					}
					if(data['course']['agenda_img'] != ''){
						$('.upload-file3').css("background-image", "url("+baseurl+data['course']['agenda_img']+")");
						$('#attend_img_previous').val(data['course']['agenda_img']);
					}
					if(data['course']['objective_img'] != ''){
						$('.upload-file4').css("background-image", "url("+baseurl+data['course']['objective_img']+")");
						$('#objective_img_previous').val(data['course']['objective_img']);
					}
				   	$('#course_type').val(data['course']['course_type']);
					content = data['course']['prerequisite'];
					$('#course_pre_requisite').val(data['course']['prerequisite']);
					$('#subtitle').val(data['course']['subtitle']);
					//$('#startday').val(data['course']['start_at']);
					//$('#endday').val(data['course']['end_at']);
					$('#category').val(data['course']['category_id']);
					$('#about').val(data['course']['about']);
					$('#agenda').val(data['course']['agenda']);
					$('#attend').val(data['course']['attend']);
					$('#duration').val(data['course']['duration']);
					$('#title').val($.trim(selectedText));
					$('#agenda').val($('#agenda').html());
					get_standard_list($.trim(data['category']));
				   	if(data['course']['course_type'] == 0){
						$('#address').val(data['course']['address']);
						$('#country').val(data['course']['country']);
						$('#state').val(data['course']['state']);
						$('#city').val(data['course']['city']);				
						$('#div-address').show();
						$('.div-location').hide();
					}else{						
						$('#div-address').hide();
						$('.div-location').show();
					}
					$.each(data['chapter'], function(key, value){
					   	if(value['session_dateTime'] != ''){						
						 	/*$('#chapter_date_time').append('<div class="form-group row"><label class="col-sm-3 control-label text-lg-right pt-2">Chapter</label><div class="col-sm-9"><input type="text" class="form-control" readonly value="'+value['title']+'" id="chapter_title" name="chapter_title"></div></div><div class="form-group row"><label class="col-sm-3 control-label text-lg-right pt-2">Session</label><div class="col-sm-9"><input type="text" class="form-control" value="'+value['session_dateTime']+'" readonly id="chapter_session" name="chapter_session"></div></div>');*/
							$('#agenda').val($('#agenda').html()+"\n\n"+value['session_dateTime']);
							return false;
						}					   
					});
			   }
		   });
		   return false;
	   }  
	});
    jQuery(document).ready(function() {
        $('[data-plugin-ios-switch]').each(function () {
            var $this = $(this);

            $this.themePluginIOS7Switch();
        });

        $('[data-plugin-datepicker]').each(function () {
            var $this = $(this);

            $this.themePluginDatePicker();
        });
        $('[data-plugin-masked-input]').each(function() {
            var $this = $( this );

            $this.themePluginMaskedInput();
        });

        $(".file-upload").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-file').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".upload-file").children().hide();
        });

        $(".upload-file").on('click', function() {
            $(".file-upload").click();
        });

        <?php
        if(!empty($image)): ?>
			$(".upload-file").children().hide();
			$('.upload-file').css("background-image", "url(<?php echo $image; ?>)");
        <?php endif; ?>
		
		<!--------------------------------------------->
		 $(".file-upload2").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-file2').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".upload-file2").children().hide();
        });

        $(".upload-file2").on('click', function() {
            $(".file-upload2").click();
        });

        <?php
        if(!empty($image2)): ?>
			$(".upload-file2").children().hide();
			$('.upload-file2').css("background-image", "url(<?php echo $image2; ?>)");
        <?php endif; ?>
		
		<!------------------------------------------->
		 $(".file-upload3").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-file3').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".upload-file3").children().hide();
        });

        $(".upload-file3").on('click', function() {
            $(".file-upload3").click();
        });

        <?php
        if(!empty($image3)): ?>
			$(".upload-file3").children().hide();
			$('.upload-file3').css("background-image", "url(<?php echo $image3; ?>)");
        <?php endif; ?>
		
		<!----------------------------------------------->
		 $(".file-upload4").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-file4').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".upload-file4").children().hide();
        });

        $(".upload-file4").on('click', function() {
            $(".file-upload4").click();
        });

        <?php
        if(!empty($image4)): ?>
			$(".upload-file4").children().hide();
			$('.upload-file4').css("background-image", "url(<?php echo $image4; ?>)");
        <?php endif; ?>
		
    });

    //modal-add-confirm


    var $table = $('#datatable_instructor');
    var $user_table = $('#datatable_user');
    var instructors = '<?=$instructors?>';
    var enroll_users = '<?=$enroll_users?>';

    $table.dataTable({

        "ordering": true,
        "info": true,
        "searching": false,

        "ajax": {
            "type": "POST",
            "async": true,
            "url": "<?=base_url()?>admin/live/getinstructor",
            "data": '',
            "dataSrc": "data",
            "dataType": "json",
            "cache":    false,
        },
        "columnDefs": [{
            "targets": [0],
            "createdCell": function (td, cellData, rowData, row, col) {
                if (instructors.indexOf(cellData) > 0){
                    $(td).html('<input type="checkBox" name="instructor[]" checked required value="'+rowData.id+'">');
                }else{
                    $(td).html('<input type="checkBox" name="instructor[]" required value="'+rowData.id+'">');
                }
            }
        } ],
        "columns": [
            { "title": "", "data": "id", "class": "text-left", "width":10 },
            { "title": "#", "data": "no", "class": "center", "width":50 },
            { "title": "<?=$term["name"]?>", "data": "fullname", "class": "text-left", "width":200 }
        ],

        "scrollY": false,
        "scrollX": true,
        "scrollCollapse": false,
        "jQueryUI": true,

        "paging": false,
        "pagingType": "full_numbers",
        "pageLength": 10, // default record count per page

        dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
        bProcessing: true,
    });
    $user_table.dataTable({

        "ordering": true,
        "info": true,
        "searching": false,

        "ajax": {
            "type": "POST",
            "async": true,
            "url": "<?=base_url()?>admin/live/getuser",
            "data": '',
            "dataSrc": "data",
            "dataType": "json",
            "cache":    false,
        },
        "columnDefs": [{
            "targets": [0],
            "createdCell": function (td, cellData, rowData, row, col) {
                if (enroll_users.indexOf(cellData) > 0){
                    $(td).html('<input type="checkBox" name="user[]" checked value="'+rowData.id+'">');
                }else{
                    $(td).html('<input type="checkBox" name="user[]" value="'+rowData.id+'">');
                }
            }
        } ],
        "columns": [
            { "title": "", "data": "id", "class": "text-left", "width":10 },
            { "title": "#", "data": "no", "class": "center", "width":50 },
            { "title": "<?=$term["name"]?>", "data": "fullname", "class": "text-left", "width":200 }
        ],

        "scrollY": false,
        "scrollX": true,
        "scrollCollapse": false,
        "jQueryUI": true,

        "paging": false,
        "pagingType": "full_numbers",
        "pageLength": 10, // default record count per page

        dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
        bProcessing: true,
    });
	
	$(document).on('click','#btn_add',function(){
		var temp = 1;
		if($('#title').val() == ''){
			$('#title-error').text('This field is required');
			$('#title').focus();
			temp = 0;
		}
		if($('#subtitle').val() == ''){
			$('#subtitle-error').text('This field is required');
			$('#subtitle').focus();
			temp = 0;
		}
		if($('#category_id').val() == ''){
			$('#category_id-error').text('This field is required');
			$('#category_id').focus();
			temp = 0;
		}
		if(temp == 1){
			$('#add-column-form').submit();
		}else{
			return false;	
		}
	});
</script>