<style>
   td:hover{ background: grey; }
   .datepicker> .datepicker-days{ display: initial; }
</style>
<section role="main" class="content-body">
   <header class="page-header">
      <h2><?=$term["instructorledtraining"]?></h2>
      <div class="right-wrapper"></div>
   </header>
   <input type="hidden" id="base_url" value="<?= base_url()?>">
   <!-- start: page -->
   <div class="row">
      <div class="col-lg-12">
         <section class="card">
            <header class="card-header">
               <div class="card-actions">
                  <a class="modal-with-form add-column" href="#modalFormNewColumn"></a>                  
                  <button type="button" class="mb-1 mt-0 mr-1 btn btn-default modal-add-confirm" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["addnewcolumn"]?></button>
                  <a href="coursecreation/edit_course"><button type="button" class="btn btn-success" id="btn-add"> <i class="fa fa-plus"></i> Add New Course</button></a>
                  <div id="modalFormNewColumn" class="modal-block modal-block-primary mfp-hide">
                     <form id="new-form" action="" method="POST" novalidate="novalidate">
                        <section class="card">
                           <header class="card-header">
                              <h2 class="card-title"><?=$term["addnewcolumn"]?></h2>
                           </header>
                           <div class="card-body">
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["title"]?></label>
                                 <div class="col-sm-6">
                                    <select class="form-control" id="title_1" name="title_1" required>
                                       <?php foreach($category as $item){ ?>
                                       <option value="<?php echo $item->title; ?>">
                                          <?php echo $item->title; ?>
                                       </option>
                                       <?php }  ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">Duration(Days)</label>
                                 <div class="col-sm-6">
                                    <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 90 }">
                                       <div class="input-group" style="width:150px;">
                                          <input type="text" id="duration_1" name="duration_1" class="spinner-input form-control" maxlength="2" >
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
                           </div>
                           <footer class="card-footer">
                              <div class="row">
                                 <div class="col-md-12 text-right">
                                    <button class="btn btn-primary modal-add-confirm"><?=$term["add"]?></button>
                                    <button class="btn btn-default modal-add-dismiss"><?=$term["cancel"]?></button>
                                 </div>
                              </div>
                           </footer>
                        </section>
                     </form>
                  </div>
                  <a class="modal-with-form add-course-column" href="#modalFormNewCourse" hidden>
					<button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add-course"> <i class="fa fa-plus"></i> <?=$term["addnewcolumn"]?></button>
                  </a>
                  <div id="modalFormNewCourse" class="modal-block modal-block-lg mfp-hide">
                     <form id="new-course-form" action="" method="POST" novalidate="novalidate">
                        <input type="hidden" id="id" name="id" value="">
                        <section class="card">
                           <header class="card-header">
                              <h2 class="card-title"><?=$term["addnewcolumn"]?></h2>
                           </header>
                           <div class="card-body">
                              <div class="form-group row">
                                 <label class="col-sm-2 control-label text-lg-right pt-2"><?=$term['course']?></label>
                                 <div class="col-sm-6">
                                    <select class="form-control" id="category_id" name="category_id">
                                       <option value="">Select Course</option>
                                       <?php foreach($category as $item){ ?>
                                       <option value="<?php echo $item->id; ?>"><?php echo $item->title; ?></option>
                                       <?php }  ?>
                                    </select>
                                 </div>
                                 <label class="col-sm-2 control-label text-lg-right pt-2">Duration(day)</label>
                                 <div class="col-sm-2">
                                    <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 30 }">
                                       <div class="input-group" style="width:120px;">
                                          <input type="text" id="duration" name="duration" class="spinner-input form-control" maxlength="2" >
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
                                 <label class="col-sm-3 control-label text-lg-right"><?=$term['title']?></label>
                                 <div class="col-sm-9">
                                    <input type="text" id="title" name="title" readonly="readonly" class="form-control" required>                                    
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-lg-3 control-label text-lg-right pt-2">Subtitle</label>
                                 <div class="col-lg-9">
                                    <input type="text" id="subtitle" name="subtitle" class="form-control" required>
                                 </div>
                              </div>
                              <input type="hidden" name="course_type" id="course_type"/>
                              <div class="form-group row div-location" style="display:none;">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["location"]?></label>
                                 <div class="col-sm-9">
                                    <input type="text" class="form-control" id="location" name="location" value="Online" readonly="readonly">
                                 </div>
                              </div>
                              <div id="div-address" style="display:none;">
                                 <div class="form-group row">
                                    <label class="col-sm-3 control-label text-lg-right pt-2">Address</label>
                                    <div class="col-sm-9">
                                       <textarea class="form-control" rows="3"  id="address" name="address"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 control-label text-lg-right pt-2">Country</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="country" name="country">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 control-label text-lg-right pt-2">State</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="state" name="state">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 control-label text-lg-right pt-2">City</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="city" name="city">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">Highlights</label>
                                 <div class="col-sm-7 addmorehigh">
                                    <input type="text" placeholder="highlight" required="required" class="highlights form-control" name="highlights[]">
                                    <input type="text" placeholder="highlight" required="required" class="highlights form-control" name="highlights[]">
                                    <input type="text" placeholder="highlight" required="required" class="highlights form-control" name="highlights[]">                                    
                                 </div>
                                 <a href="javascript:void(0)">
                                    <div id="addmorebtn" class="col-sm-2 btn">ADD MORE</div>
                                 </a>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right">Category</label>
                                 <div class="col-sm-9">
                                    <select class="form-control" id="category" onchange="getCategoryTitle()" name="category">
                                       <?php foreach($category_ids as $items){ ?>
                                       <option value="<?php echo $items['id']; ?>"><?php echo $items['name']; ?></option>
                                       <?php }  ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right"><?=$term['standard']?></label>
                                 <div class="col-sm-9">
                                    <select class="form-control" id="standard_id" name="standard_id[]" multiple="multiple"></select>
                                 </div>
                              </div>
                              <input type="hidden" name="number" id="number">
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">Number</label>
                                 <div class="col-sm-9">
                                    <input type="text" disabled="disabled" class="form-control number_value" />
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["learningobjectives"]?></label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" data-plugin-markdown-editor rows="3" id="objective" name="objective"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-lg-3 control-label text-lg-right pt-2"><?=$term["learningobjectives"]?> File Upload</label>
                                 <div class="col-sm-3">
                                    <div class="p-4 border rounded text-center upload-file d-block" id="objective_img_preview">
                                       <i class="fa fa-picture-o fa-2x"></i>
                                       <p class=""><small>Upload Image</small></p>
                                    </div>
                                    <input class="file-upload" name="objective_img" id="objective_img" type="file" accept="image/*"/>
                                    <input type="hidden" id="objective_img_url" name="objective_img_url" class="form-control" value="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["whoshouldattend"]?></label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" data-plugin-markdown-editor rows="3" id="attend" name="attend"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-lg-3 control-label text-lg-right pt-2"><?=$term["whoshouldattend"]?> File Upload</label>
                                 <div class="col-sm-3">
                                    <div class="p-4 border rounded text-center upload-file d-block" id="attend_img_preview">
                                       <i class="fa fa-picture-o fa-2x"></i>
                                       <p class=""><small>Upload Image</small></p>
                                    </div>
                                    <input class="file-upload" name="attend_img" id="attend_img" type="file" accept="image/*"/>
                                    <input type="hidden" id="attend_img_url" name="attend_img_url" class="form-control" value="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">Course Pre-Requisite</label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" data-plugin-markdown-editor rows="3" id="course_pre_requisite" name="course_pre_requisite"></textarea>
                                 </div>
                              </div>
                              <div id="chapter_date_time"></div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["agenda"]?></label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" data-plugin-markdown-editor rows="3" id="agenda" name="agenda"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-lg-3 control-label text-lg-right pt-2"><?=$term["agend"]?> File Upload</label>
                                 <div class="col-sm-3">
                                    <div class="p-4 border rounded text-center upload-file d-block" id="agenda_img_preview">
                                       <i class="fa fa-picture-o fa-2x"></i>
                                       <p class=""><small>Upload Image</small></p>
                                    </div>
                                    <input class="file-upload" name="agenda_img" id="agenda_img" type="file" accept="image/*"/>
                                    <input type="hidden" id="agenda_img_url" name="agenda_img_url" class="form-control" value="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">Description</label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" data-plugin-markdown-editor rows="3" id="description" name="description"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-10">
                                    <table class="table table-responsive-md table-hover mb-0" id="datatable_instructor">
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <footer class="card-footer">
                              <div class="row">
                                 <div class="col-md-12 text-right">
                                    <button class="btn btn-primary modal-create-confirm"><?=$term["add"]?></button>
                                    <button class="btn btn-default modal-create-dismiss"><?=$term["reset"]?></button>
                                 </div>
                              </div>
                           </footer>
                        </section>
                     </form>
                  </div>
                  <a class="modal-with-form change-time" href="#modalFormChangeTime" hidden>
                  <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-change-time"> <i class="fa fa-plus"></i> <?=$term["changetime"]?></button>
                  </a>
                  <div id="modalFormChangeTime" class="modal-block modal-block-primary mfp-hide">
                     <form id="change-time-form" action="" method="POST" novalidate="novalidate">
                        <input type="hidden" id="change_id" name="change_id" class="form-control">
                        <input type="hidden" id="time_id" name="time_id" class="form-control">
                        <section class="card">
                           <header class="card-header">
                              <h2 class="card-title"><?=$term["changetime"]?></h2>
                           </header>
                           <div class="card-body">
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["location"]?></label>
                                 <div class="col-sm-6">
                                    <input type="text" readonly="readonly" id="change_location" name="change_location" class="form-control" required>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">Country</label>
                                 <div class="col-sm-6">
                                    <select class="form-control" required onchange="getStateByCountryId(this.value)" id="country" name="country" style="width:264px;">
                                        <option value="" >Select Country</option>
                                        <?php foreach ($countries as $countries){ ?>
                                            <option required value=<?php echo $countries['id']; ?>><?php echo $countries['name']; ?></option>
                                        <?php }?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">State</label>
                                 <div class="col-sm-6">
                                        <select class="form-control" required onchange="getCityByStateId(this.value)" id="state" name="state" style="width:264px;">
											<option value="" >Select State</option>
                                        </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2">City</label>
                                 <div class="col-sm-6">
                                     	<select class="form-control" required id="city" name="city" style="width:264px;">
											         <option value="" >Select City</option>
                                    	</select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["startday"]?></label>
                                 <div class="col-sm-6">
                                    <input data-plugin-datepicker id="startdays" name="startdays"  class="form-control" data-date-format="yyyy-mm-dd">
                                 </div>
                              </div>
                            <div class="form-group row">
                            	<label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["starttime"]?></label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="starttime" name="starttime" style="width:264px;">
                                       <option value="7:00 AM">7:00 AM</option>
                                       <option value="8:00 AM">8:00 AM</option>
                                       <option value="9:00 AM">9:00 AM</option>
                                       <option value="10:00 AM">10:00 AM</option>
                                    </select>
                                </div>
                            </div>
                              <input class="hidden" name="year" id="change_year">
                              <input class="hidden" name="month" id="change_month">
                              <input class="hidden" name="change_day" id="change_day">      
                              <input class="hidden" name = "year" id="change_year">
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
                                    <a class="btn btn-default" href="javascript:inviteuser()"><?=$term["inviteuser"] ?></a>
                                    <button class="btn btn-default modal-change-delete"><?=$term["delete"]?></button>
                                    <button class="btn btn-primary modal-change-confirm"><?php $id==0?print $term["add"]:print $term["update"]?></button>
                                    <a href="javascript:showPayUser()" class="btn btn-primary btn-user-list" hidden>Show User List</a>
                                    <button class="btn btn-default modal-change-dismiss"><?=$term["cancel"]?></button>
                                 </div>
                              </div>
                           </footer>
                        </section>
                     </form>
                  </div>
               </div>
               <h2 class="card-title"><?=$term["traininglist"]?></h2>
            </header>
            <div class="card-body">
               <footer class="card-footer">
                  <div class="row">
                     <div class="col-md-6 text-left">
                        <div class="row">
                           <div class="col-sm-6">
                              <select data-plugin-selectTwo class="form-control" id="courses_filter" name="courses_filter">
                                 <option value="" >Select Course</option>
                                 <?php foreach ($all_course_list as $ckey => $course_data){ ?>
                                 <option value=<?php echo $course_data['course_id']; ?>><?php echo $course_data['title']; ?></option>
                                 <?php }?>
                              </select>
                           </div>
                           <div class="col-sm-6">
                              <a id="filter" class="btn btn-primary">Search</a>
                              <a href="<?=base_url()?>admin/training/" class="btn btn-default">Reset</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 text-right">
                        <a id="preview" class="btn btn-primary" href="<?=base_url()?>admin/training/showTraining/-1"><<</a>
                        <a id="next" class="btn btn-primary" href="<?=base_url()?>admin/training/showTraining/1">>></a>
                     </div>
                  </div>
               </footer>
               <input type="hidden" name="dis_month" id="dis_month" value="<?=$dis_month?>">
               <table class="table table-responsive-md  mb-0 table-bordered">
                  <tr>
                     <th rowspan="2" colspan="2" width="20%" class="center">Name of Course</th>
                     <th rowspan="2" width="5%" class="center"><?=$term["courseduration"]?></th>
                     <th colspan="12" width="75%" class="center">Date of Course</th>
                  </tr>
                  <tr>
                     <?php
                        $current_month = intval(date("m"))+$dis_month;
                        $current_year = intval(date("Y"));
                        
                        for ($i=0;$i<8;$i++){
                            switch ($current_month){
                                case 1:
                                    echo "<th>Jan, $current_year</th>";
                                    break;
                                case 2:
                                    echo "<th>Feb, $current_year</th>";
                                    break;
                                case 3:
                                    echo "<th>March, $current_year</th>";
                                    break;
                                case 4:
                                    echo "<th>April, $current_year</th>";
                                    break;
                                case 5:
                                    echo "<th>May, $current_year</th>";
                                    break;
                                case 6:
                                    echo "<th>June, $current_year</th>";
                                    break;
                                case 7:
                                    echo "<th>July, $current_year</th>";
                                    break;
                                case 8:
                                    echo "<th>Aug, $current_year</th>";
                                    break;
                                case 9:
                                    echo "<th>Sept, $current_year</th>";
                                    break;
                                case 10:
                                    echo "<th>Oct, $current_year</th>";
                                    break;
                                case 11:
                                    echo "<th>Nov, $current_year</th>";
                                    break;
                                case 12:
                                    echo "<th>Dec, $current_year</th>";
                                    break;
                            }
                            $current_month++;
                            if($current_month > 12){
                                $current_month = $current_month - 12;
                                $current_year = $current_year + 1;
                            }                            
                        }
                        ?>
                  </tr>
                  <div id="getCourseAlllist">
                     <?php foreach($course_list as $key => $rows){ ?>
                     <tr>
                        <td width="15%">                                
                           <a class="btn btn-danger" onclick="deleteIltCourse(<?=$key?>)" href="javascript:void(0);">Delete</a>
                           
                           <a href="#republish_modal" class="btn btn-success republish_modal" onclick="republishCourse(<?=$rows['id']?>)" href="javascript:void(0);">Republish</a>
                        </td>
                        <td>
                           <a href="javascript:updateCourse(<?=$key?>,<?=$rows['course_id']?>)"><?=$rows['title']?></a>
                        </td>
                        <td><?=$rows['duration']?></td>
                        <?php
                           $current_month = intval(date("m")) +$dis_month;
                           $current_year = intval(date("Y"));
                           if($current_month < 1){
                               $current_month = 12;
                               $current_year = $current_year - 1;
                           }
                           $i = 0;
                           while($i < 8){
                               $i ++;
                               $is_exist = 0;
                               if($current_month > 12) $current_month = $current_month-12;
                               foreach ($training_list[$key] as $k => $r) {
                                   if($k == $current_month) {
                                       $is_exist = 1;
                           ?>
                        <td onclick="javascript:addTime(<?=$key?>,<?=$current_month?>,<?=$current_year?>)">
                           <?php foreach ($r  as $n => $j){                                                    
                              if($j['year'] == $current_year){?>                           
                           		<a class="btn btn-xs btn-primary " href="javascript:updateTime(<?=$key?>,<?=$j['month']?>,<?=$j['sday']?>, '<?=$j['location']?>', <?=$j['id']?>,<?=$current_year?>,'<?=$j['start_day']?>','<?=$j['start_time']?>','<?=$j['country_id']?>','<?=$j['state_id']?>','<?=$j['city_id']?>')" style="font-size: 8px; color: white">
                           <?= $j['sday'] ?> -
                           <?php
                              $timestamp = mktime(0, 0, 0, $current_month, 1, intval(date("y")));
                              $last_date = date('t', $timestamp);						   
                              if($j['sday']+$j['duration']>$last_date){
                                  echo $j['sday']+$j['duration']-$last_date-1;
                              }else{
                                  echo $j['sday']+$j['duration']-1;
                              }  ?>
                           :<?= $j['location'] ?>
                           </a></br>
                           <?php }} ?>
                        </td>
                        <?php
                           } }
                           if($is_exist == 0) {
                       	?>
                        <td onclick="javascript:addTime(<?=$key?>,<?=$current_month?>,<?=$current_year?>)"></td>
                        <?php
                           }
                           $current_month++;
                           if($current_month > 12){
                               $current_month = $current_month - 12;
                               $current_year = $current_year + 1;
                           } }
                       	?>
                     </tr>
                     <?php } ?>
                  </div>
               </table>
            </div>
            <footer class="card-footer">
               <div class="row">
                  <div class="col-md-12 text-right">
                     <a id="preview" class="btn btn-primary" href="<?=base_url()?>admin/training/showTraining/-1"><<</a>
                     <a id="next" class="btn btn-primary" href="<?=base_url()?>admin/training/showTraining/1">>></a>
                  </div>
               </div>
            </footer>
         </section>
      </div>
   </div>
   <div id="republish_modal" class="modal-block modal-block-primary mfp-hide" style="max-width: 800px!important">
		<form id="republish_form" action="" method="POST" novalidate="novalidate">
		    <input type="hidden" id="republish-id" name="republish-id" class="form-control" >
          <input type="hidden" id="republish-type" name="republish-type" class="form-control" >
		    <section class="card">
		        <header class="card-header">
		            <h2 class="card-title"><?=$term["republish"]?></h2>
		        </header>
		        <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["title"]?></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" readonly id="republish-title">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["price"]?></label>
                     <div class="col-sm-6">
                        <input id="republish-price" name="republish-price" onchange="changePrice()" class="form-control">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["discount"]?></label>
                     <div class="col-sm-6">
                        <input id="republish-discount" onchange="changePrice()" name= "republish-discount" class="form-control">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["amount"]?></label>
                     <div class="col-sm-6">
                        <input id="republish-amount" name="republish-amount" readonly class="form-control">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["startday"]?></label>
                     <div class="col-sm-6">
                     <input data-plugin-datepicker id="startdays" name="startdays"  class="form-control" data-date-format="yyyy-mm-dd">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["starttime"]?></label>
                     <div class="col-sm-6">
                        <select class="form-control" id="starttime" name="starttime" style="width:264px;">
                           <option value="7:00 AM">7:00 AM</option>
                           <option value="8:00 AM">8:00 AM</option>
                           <option value="9:00 AM">9:00 AM</option>
                           <option value="10:00 AM">10:00 AM</option>
                        </select>
                     </div>
                  </div>
		        </div>
		        <footer class="card-footer">
		            <div class="row">
		                <div class="col-md-12 text-right">
							<a class="btn btn-default" href="javascript:republish()" style="color:#333"><i class="fas fa-plus"></i> <?=$term["republish"]?> </a>
		                    <button class="btn btn-default modal-change-dismiss"><?=$term["cancel"]?></button>
		                </div>
		            </div>
		        </footer>
		    </section>
		</form>
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
                     <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_inviteuser">
                     </table>
                  </div>
               </div>
            </div>
            <footer class="card-footer">
               <div class="row">
                  <div class="col-md-12 text-right">
                     <a href="#add_exist_modal" class="btn btn-default add_exist_modal" style="color:#333"><i class="fas fa-plus"></i> <?=$term["inviteuser"]?> </a>
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
         <input type="hidden" id="add_course_time_id" name="add_ilt_time_id" value="" class="form-control" >
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
                     <!--    <a class="btn btn-default" style="color:#333"><?/*=$term["send"]*/?> </a>-->
                     <a class="btn btn-default" href="javascript:add_invite_user()" style="color:#333"><i class="fas fa-plus"></i> <?=$term["add"]?> </a>
                     <button class="btn btn-default modal-change-dismiss"><?=$term["cancel"]?></button>
                  </div>
               </div>
            </footer>
         </section>
      </form>
   </div>
   <div id="add_exist_modal" class="modal-block modal-block-primary mfp-hide" style="min-width: 900px;">
      <form id="add_exist_form" action="" method="POST" novalidate="novalidate">
         <input type="hidden" name="course_id" class="form-control" >
         <input type="hidden" name="course_type" value="0" class="form-control" >
         <input type="hidden" name="add_ilt_time_id" value="" class="form-control" >
         <section class="card">
            <header class="card-header">
               <h2 class="card-title"><?=$term["add"]?> <?=$term["inviteuser"]?></h2>
            </header>
            <div class="card-body">
               <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_addexistuser"></table>
            </div>
            <footer class="card-footer">
               <div class="row">
                  <div class="col-md-12 text-right">
                     <button class="btn btn-default modal-change-dismiss"><?=$term["cancel"]?></button>
                  </div>
               </div>
            </footer>
         </section>
      </form>
   </div>
   <!-- end: page -->
</section>
<script>
   function republish(){
      var formData = new FormData($('#republish_form')[0]);
      $.ajax({
         url: $('#base_url').val() + 'admin/coursecreation/republishCourse',
         type: 'POST',
         data: formData,
         processData: false,
         contentType: false,
         success: function (data, status, xhr){
            $.magnificPopup.close();
            new PNotify({
               title: 'Success',
               text: 'Upload',
               type: 'success'
            });
            document.location.reload();
         },
         error: function(){
            new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
            });
            $.magnificPopup.close();
         }
      });
   }
   function changePrice(){
      var price = $("#republish-price").val();
      var discount = $("#republish-discount").val();
      var amount = price * (100 - discount) / 100;
      $("#republish-amount").val(amount);
   }
   function getCategoryTitle(){
		$('#number').val($( "#category option:selected" ).text());
   }
   $('#addmorebtn').on('click',function(){
		$('.addmorehigh').append('<input type="text" placeholder="highlight" class="highlights form-control" name="highlights[]">');
   });

   
   function deletehighlight(delid){
		$('#deletebtn_'+delid).remove();
   }

   function republishCourse(course_id){
      var url = '<?= base_url()?>admin/coursecreation/getCourse';
      $.ajax({
         url: url,
         type: 'POST',
         data: {
            id:course_id,
            type : 0
         },
         success: function (data, status, xhr){
            $("#republish-title").val(data.title);
            $("#republish-price").val(data.pay_price);
            $("#republish-discount").val(data.discount);
            $("#republish-amount").val(data.amount);
            $("#republish-id").val(data.id);
            $("#republish-type").val(data.course_type);
            $("#republishForm").modal('show');
         },
         error: function(){
            new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['youcantdeletethisitem']; ?>',
               type: 'error'
            });
         }
      });
   }
   
   function deleteIltCourse(deleteId){
		(new PNotify({
			  title: "<?php echo $term['confirmation']; ?>",
			  text: "<?php echo $term['areyousuretodelete']; ?>",
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
   				
   		var url = '<?= base_url()?>admin/training/deleteIltCourse/'+deleteId;
   		
              $.ajax({
                  url: url,
                  type: 'POST',
                  data: {id:deleteId},
                  success: function (data, status, xhr){
                      if(status == "success") {
                          document.location.href = '';
                      } else {
                          new PNotify({
                              title: 'Fail!',
                              text: status,
                              type: 'danger'
                          });
                      }
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
   
      }
   
   $(document).on('click','#filter',function(){
		var courseId = $('#courses_filter').val();
		window.location.href="<?=base_url()?>admin/training/showTrainingFilter/"+courseId;
   });
   var $user_table = $('#datatable_user');
   var $add_exist_table = $('#datatable_addexistuser');
   var $instructor_table = $('#datatable_instructor');
   var enroll_users = '';
   var instructors = '';
   var isShowList = false;
     
   jQuery(document).ready(function() {
      $('[data-plugin-selectTwo]').each(function() {
            var $this = $( this ),
               opts = {};
   
            var pluginOptions = $this.data('plugin-options');
            if(pluginOptions)
               opts = pluginOptions;
   
            $this.themePluginSelect2(opts);
      });
   
      $('[data-plugin-ios-switch]').each(function () {
            var $this = $(this);
   
            $this.themePluginIOS7Switch();
      });
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
   
      $('[data-plugin-markdown-editor]').each(function() {
            var $this = $( this ),
               opts = {};
   
            var pluginOptions = $this.data('plugin-options');
            if(pluginOptions)
               opts = pluginOptions;
   
            $this.themePluginMarkdownEditor(opts);
      });
      $add_exist_table.dataTable({
         "ordering": true,
         "info": true,
         "searching": true,

         "ajax": {
               "type": "POST",
               "async": true,
               "url":$('#base_url').val() +"admin/user/view",
               "data": {
                  'user_type': 'Learner',
                  'active': 1
               },
               "dataSrc": "data",
               "dataType": "json",
               "cache":    false,
         },
         "columnDefs": [{
               "targets": [4],
               "createdCell": function (td, cellData, rowData, row, col) {
                  $(td).html('<a href="javascript:add_exist_user('+rowData['id']+')" class="add-row"><i class="fas fa-plus"></i></i></a>');
               }
         }],
         "columns": [
               { "title": "#", "data": "no", "class": "center" },
               { "title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left"},
               { "title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left"},
               { "title": "<?=$term["email"]?>", "data": "email", "class": "text-left"},
               { "title": "<?=$term["action"]?>", "data": "id", "class": "text-center"},
         ],
         "lengthMenu": [
               [5, 10, 20, 50, 150, -1],
               [5, 10, 20, 50, 150, "All"] // change per page values here
         ],
         "scrollY": false,
         "scrollX": true,
         "scrollCollapse": false,
         "jQueryUI": true,

         "paging": true,
         "pagingType": "full_numbers",
         "pageLength": 50, // default record count per page
         dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
         bProcessing: true,
      });
   
   });
   
   $instructor_table.dataTable({
   
         "ordering": true,
         "info": true,
         "searching": false,
   
         "ajax": {
            "type": "POST",
            "async": true,
            "url": "<?=base_url()?>admin/training/getinstructor",
            "data": '',
            "dataSrc": "data",
            "dataType": "json",
            "cache":    false,
         },
         "columnDefs": [{
            "targets": [0],
            "createdCell": function (td, cellData, rowData, row, col) {
               if(instructors.indexOf(cellData) > 0){
                     $(td).html('<input type="checkBox" name="instructor[]" checked required value="'+rowData.id+'">');
               }else{
                     $(td).html('<input type="checkBox" name="instructor[]" required value="'+rowData.id+'">');
               }
            }
         } ],
         "columns": [
            { "title": "", "data": "id", "class": "text-left", "width":10 },
            { "title": "#", "data": "no", "class": "center", "width":50 },
            { "title": "<?=$term["name"]?>", "data": "fullname", "class": "text-left", "width":"*" }
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
   
   var readURL_attendImg = function(input) {
         if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
               $('#attend_img_preview').css("background-image", "url("+e.target.result+")");
            }   
            reader.readAsDataURL(input.files[0]);
         }
   }
   
   $("#attend_img").on('change', function(){
         readURL_attendImg(this);
         $("#attend_img_preview").children().hide();
   });
   
   $("#attend_img_preview").on('click', function() {
         $("#attend_img").click();
   });    
   
   var readURL_agendaImg = function(input) {
         if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
               $('#agenda_img_preview').css("background-image", "url("+e.target.result+")");
            }
            reader.readAsDataURL(input.files[0]);
         }
   }
   
   $("#agenda_img").on('change', function(){
         readURL_agendaImg(this);
         $("#agenda_img_preview").children().hide();
   });
   
   $("#agenda_img_preview").on('click', function() {
         $("#agenda_img").click();
   });   
   
   var readURL_objectiveImg = function(input) {
         if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
               $('#objective_img_preview').css("background-image", "url("+e.target.result+")");
            }
            reader.readAsDataURL(input.files[0]);
         }
   }
   
   $("#objective_img").on('change', function(){
         readURL_objectiveImg(this);
         $("#objective_img_preview").children().hide();
   });
   
   $("#objective_img_preview").on('click', function() {
         $("#objective_img").click();
   });  
   
   function addTime(id, month, year) {
         $('#change_day').val(1);
         $('#change_id').val(id);
         for(var i = 0;i < document.getElementById("change_month").length;i++){
            if(document.getElementById("change_month").options[i].value == month ){
               document.getElementById("change_month").selectedIndex = i;
            }
         }
         $('#change_year').val(year);
         $('#change_location').val();
         $('.modal-change-confirm').html("Add");
         $('.change-time').click();
         enroll_users = '<?=$enroll_users?>';
   }
   
   function showPayUser() {
         if($('.btn-user-list').html() == 'Show User List'){
            $('.btn-user-list').html('Hide User List')
            $user_table.show();
            var ajaxData = {"id":0,'course_type':0};
            if(!isShowList) {
               $user_table.dataTable({     
                     "ordering": true,
                     "info": true,
                     "searching": false,
   
                     "ajax": {
                        "type": "POST",
                        "async": true,
                        //  "url": "<?=base_url()?>admin/training/getPayUser",
                        "url": "<?=base_url()?>admin/inviteuser/getInviteUser",
                        //  "data": {
                        //      'id': $('#change_id').val(),
                        //      'tid': $('#time_id').val()
                        //  },
                        "data":{ // add request parameters before submit
                           'id': $('#change_id').val(),
                           'course_type': 0
                        },
                        "dataSrc": "data",
                        "dataType": "json",
                        "cache": false
                     },
   
                     // "columns": [
                     //     {"title": "#", "data": "no", "class": "center", "width": 50},
                     //     {"title": "<?=$term["name"]?>", "data": "fullname", "class": "text-left", "width": "*"}
                     // ],
                     "columns": [
                        {"title": "#", "data": "no", "class": "center", "width": 50},
                        {"title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width": 100},
                        {"title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width": 100},
                        {"title": "<?=$term["email"]?>", "data": "email", "class": "text-left", "width": 100},
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
               isShowList = true;
            }else{
               $user_table.DataTable().ajax.reload('', false);
            }
   
         }else{
            $('.btn-user-list').html('Show User List')
            $user_table.hide();
         }
   }
   
   $('#category_id').on('change',function(){
      var selectedText = $(this).find("option:selected").text();
      var course_id = $(this).find("option:selected").val();		
      if(course_id != '' && selectedText != ''){
         $.ajax({
         url: $('#base_url').val()+'admin/training/getCourseDetail',
         type: 'POST',
         data: {course_id:course_id},
         success: function (data, status, xhr){
            //console.log(data['course']);
            $('#chapter_date_time').html('');
            /*chapter_date_time*/
               $('#attend_img_preview').css("background-image", "url("+'../'+data['course']['attend_img']+")");
            $('#agenda_img_preview').css("background-image", "url("+'../'+data['course']['agenda_img']+")");
            $('#objective_img_preview').css("background-image", "url("+'../'+data['course']['objective_img']+")");
               $('#course_type').val(data['course']['course_type']);
            $('#duration').val(data['course']['duration']);
            $('#course_pre_requisite').val($.trim(data['course']['prerequisite']));
            //$('#startday').val($.trim(data['course']['start_at']));
            $('#duration').val($.trim(data['course']['duration']));
            //$('#endday').val($.trim(data['course']['end_at']));
            $('#category').val($.trim(data['course']['category_id']));					
            $('#title').val($.trim(selectedText));
            $('#description').val($.trim(data['course']['about'])); 
            $('#subtitle').val(data['course']['subtitle']);
            $('#objective').val($.trim(data['course']['learning_objective']));
            $('#attend').val($.trim(data['course']['attend']));
            $('#agenda').val($.trim(data['course']['agenda']));
            $('#objective_img_url').val(data['course']['objective_img']);
            $('#attend_img_url').val(data['course']['attend_img']);
            $('#agenda_img_url').val(data['course']['agenda_img']);
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
            get_standard_list($.trim(data['course']['category_id']));
            $.each(data['chapter'], function(key, value){
                  if(value['session_dateTime'] != ''){							
                  /*$('#chapter_date_time').append('<div class="form-group row"><label class="col-sm-3 control-label text-lg-right pt-2">Chapter</label><div class="col-sm-9"><input type="text" class="form-control" readonly value="'+value['title']+'" id="chapter_title" name="chapter_title"></div></div><div class="form-group row"><label class="col-sm-3 control-label text-lg-right pt-2">Session</label><div class="col-sm-9"><input type="text" class="form-control" value="'+value['session_dateTime']+'" readonly id="chapter_session" name="chapter_session"></div></div>');*/
                  $('#agenda').val($('#agenda').val()+"\n\n"+value['session_dateTime']);
                  return false;
               }					   
            });
         }
      });
      return false;
   }   
   });
   
   function updateCourse(id,course_id){
      $.ajax({
            url: $('#base_url').val()+'admin/training/getCourseInstructor',
            type: 'POST',
            data: {id:id},
            success: function (data, status, xhr) {
               instructors = data;
               $instructor_table.DataTable().ajax.reload('', false);
            }
      });
   
      $.ajax({
         url: $('#base_url').val()+'admin/training/getCourseByTrainingId',
         type: 'POST',
         data: {id:id},
         success: function (data, status, xhr){
               //console.log(data);
            var myHighlights = jQuery.parseJSON(data['highlights']);
            if(myHighlights != null){
               $('.addmorehigh').html('');
            $.each(myHighlights, function (index, value){
               $('.addmorehigh').append('<div id="deletebtn_'+index+'"><input type="text" value="'+value+'" class="highlights form-control" name="highlights[]"><a href="javascript:void(0)" onclick="deletehighlight('+index+')">Delete</a></div>');
            });
            }
            $('#attend_img_preview').css("background-image", "url("+'../'+data['attend_img']+")");
            $('#agenda_img_preview').css("background-image", "url("+'../'+data['agenda_img']+")");
            $('#objective_img_preview').css("background-image", "url("+'../'+data['objective_img']+")");
            $('#id').val(id);
            $('#title').val(data['title']);
            $('#subtitle').val(data['subtitle']);
            //$('#startday').val(data['startday']);
            //$('#endday').val(data['endday']);
            $('.number_value').val($.trim(data['number']));
            $('#category').val(data['category']);
            $('#standard_id').val(data['standard_id']);
            $('#category_id').val($.trim(data['course_id']));
            $('#endday').val(data['endday']);
            $('#duration').val(data['duration']);
            $('#objective_img_url').val(data['objective_img']);
            $('#description').val(data['about']);
            $('#attend').val(data['attend']);
            $('#attend_img_url').val(data['attend_img']);
            $('#agenda').val(data['agenda']);
            $('#agenda_img_url').val(data['agenda_img']);
            $('#description').val(data['description']);
            $('#address').val(data['address']);
            $('#country').val(data['country']);
            $('#state').val(data['state']);
            $('#city').val(data['city']);
            $('#objective').val($.trim(data['objective']));
            $('#course_pre_requisite').val(data['course_pre_requisite']);
            get_standard_list_chk($.trim(data['category']));				
            $('.div-startday').hide();
            if(data['course_type'] == 0){
               $('#div-address').show();
               $('.div-location').hide();
            }else{						
               $('#div-address').hide();
               $('.div-location').show();
            }
            for(var i = 0;i < document.getElementById("standard_id").length;i++){					
               if(document.getElementById("standard_id").options[i].value == standard_id ){
                  document.getElementById("standard_id").selectedIndex = i;
               }
            }
               $('.modal-create-confirm').html('Change');
               $('.add-course-column').click();
         }
         });
      return false;
   }
   
   function updateTime(id, month, day, location, time_id,year,startDays,startTime,country,state,city){
      $('#change_day').val(day);
      for(var i = 0;i < document.getElementById("change_month").length;i++){
            if(document.getElementById("change_month").options[i].value == month ){
               document.getElementById("change_month").selectedIndex = i;
            }
      }
   
      $('.btn-user-list').prop('hidden', false);
      $('#change_id').val(id);
      $('#change_year').val(year);
      $('#time_id').val(time_id);
      $('#add_course_time_id').val(time_id);
      $('#change_location').val(location);
      $('#startdays').val(startDays);
      $('#starttime').val(startTime);		
      $('#country').val(country);
      getStateByCountryId(country,state);
      getCityByStateId(state,city);
      $('.modal-change-confirm').html("Change");
      $('.change-time').click();
   }
   
   $('.add-column').magnificPopup({
      type: 'inline',
      preloader: false,
      modal: true,
   
      // When elemened is focused, some mobile browsers in some cases zoom in
      // It looks not nice, so we disable it:
      callbacks: {
            beforeOpen: function() {
   
            }
      }
   });
   
   $('.change-time').magnificPopup({
      type: 'inline',
      preloader: false,
      modal: true,
   
      // When elemened is focused, some mobile browsers in some cases zoom in
      // It looks not nice, so we disable it:
      callbacks: {
            beforeOpen: function() {
   
            }
      }
   });
   
   $('.add-course-column').magnificPopup({
      type: 'inline',
      preloader: false,
      modal: true,
   
      // When elemened is focused, some mobile browsers in some cases zoom in
      // It looks not nice, so we disable it:
      callbacks: {
            beforeOpen: function() {
               $instructor_table.DataTable().ajax.reload('', false);
            },
   
   
      }
   });
   
   $('.modal-add-confirm').click(function (e) {
      e.preventDefault();
      $('.div-location').hide();
      
      if($('#title_1').val() == '' || $('#duration_1').val() == '') {
            new PNotify({
               title: 'Failed',
               text: 'Fill Data.',
               type: 'danger'
            });
            return;
      }else{
            $.magnificPopup.close();
            $('#title').val($('#title_1').val());
            $('#duration').val($('#duration_1').val());
            $('.add-course-column').click();     
      }     
   
   });
   
   $('.modal-change-delete').click(function (e){
      e.preventDefault();
      (new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
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
               url: $('#base_url').val()+'admin/training/deleteTime',
               type: 'POST',
               data: {id:$('#time_id').val()},
               success: function (data, status, xhr) {
                  if(status == "success") {
                        document.location.reload();
                  } else {
                        new PNotify({
                           title: 'Fail!',
                           text: status,
                           type: 'danger'
                        });
                  }
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
   
   });
   
   $('.modal-create-confirm').click(function(e){
      e.preventDefault();
   $('.div-location').hide();		
     
   var formData = new FormData($('#new-course-form')[0]);		
   $.magnificPopup.close();		
      if($('.modal-create-confirm').html().indexOf('<?=$term["add"]?>') >= 0){
             //if($('#start_day').val() == '' || $('#location').val() == '') {				
   if($('#start_day').val() == '' || $('#startday').val() == '' || $('#title').val() == '' || $('#category_id').val() == ''){
   	   new PNotify({
   		   title: 'Failed',
   		   text: 'Fill Data.',
   		   type: 'danger'
   	   });
   	   return;
      }else{
   	   $.ajax({
   		   url: $('#base_url').val() + 'admin/training/createCourse',
   		   type: 'POST',
   		   data: formData,
   		   processData: false,
   		   contentType: false,
   		   success: function (data, status, xhr){
   			   $.magnificPopup.close();
   			   new PNotify({
   				   title: 'Success',
   				   text: 'Upload',
   				   type: 'success'
   			   });
   			   document.location.reload();
   		   },
   		   error: function(){
   
   			   new PNotify({
   				   title: '<?php echo $term['error']; ?>',
   				   text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
   				   type: 'error'
   			   });
   			   $.magnificPopup.close();
   
   		   }
   	   });
      }
   }else{
   if($('#title').val() == '' || $('#category_id').val() == ''){
      new PNotify({
   	   title: 'Failed',
   	   text: 'Fill Data.',
   	   type: 'danger'
      });
   }else{
      $.ajax({
   		url: $('#base_url').val()+'admin/training/updateCourse',
   		type: 'POST',
   		data: formData,
   		processData:false,
   		contentType: false,
   		success: function (data, status, xhr){
   			$.magnificPopup.close();
   			new PNotify({
   				title: 'Success',
   				text: 'Upload',
   				type: 'success'
   			});
   			document.location.reload();
   		},
   		error: function(err){
   	   	console.log(err);
   			new PNotify({
   				title: '<?php echo $term['error']; ?>',
   				text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
   				type: 'error'
   			});
   			$.magnificPopup.close();
   		}
   	   });
     	}
         }
      });
      
      $('.modal-change-confirm').click(function(e){
            e.preventDefault();
            var formData = new FormData($('#change-time-form')[0]);
            if($('#startdays').val() == '' || $('#starttime').val() == '' || $('#country').val() == ''){
               new PNotify({
                  title: 'Failed',
                  text: 'Fill Data.',
                  type: 'danger'
               });
               return;
            }else{
               $.magnificPopup.close();
               if($('.modal-change-confirm').html().indexOf('<?=$term["add"]?>') >= 0) {
      
                  $.ajax({
                        url: $('#base_url').val()+'admin/training/add_time',
                        type: 'POST',
                        data: formData,
                        processData:false,
                        contentType: false,
                        success: function (data, status, xhr) {						 
                           document.location.reload();
                           $.magnificPopup.close();
                           new PNotify({
                              title: 'Success',
                              text: 'Upload',
                              type: 'success'
                           });
                        },
                        error: function(){
                           new PNotify({
                              title: '<?php echo $term['error']; ?>',
                              text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                              type: 'error'
                           });
                           $.magnificPopup.close();
                        }
                  });
               } else {
                  $.ajax({
                        url: $('#base_url').val()+'admin/training/update_time',
                        type: 'POST',
                        data: formData,
                        processData:false,
                        contentType: false,
                        success: function (data, status, xhr) {
                           document.location.reload();
                           $.magnificPopup.close();
                           new PNotify({
                              title: 'Success',
                              text: 'Upload',
                              type: 'success'
                           });
                        },
                        error: function(error){
                           new PNotify({
                              title: '<?php echo $term['error']; ?>',
                              text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                              type: 'error'
                           });
                           $.magnificPopup.close();
                        }
                  });
               }
            }
      
      
      });
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
      $('.add_exist_modal').magnificPopup({
            type: 'inline',
            preloader: false,
            callbacks: {
               beforeOpen: function() {
               }
            }
      });
      $('.republish_modal').magnificPopup({
            type: 'inline',
            preloader: false,
            callbacks: {
               beforeOpen: function() {
               }
            }
      });
      var inviteuser_table = $("#datatable_inviteuser");
      var ajaxData = {"id":0,'course_type':0};
      inviteuser_table.dataTable({
            "ordering": true,
            "info": true,
            "searching": false,
      
            "ajax": {
               "type": "POST",
               "async": true,
               "url": "<?=base_url()?>admin/inviteuser/getInviteUser",
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
               mRender: function (data, type, row){   
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
      
      function inviteuser(){
         var id = $("#change_id").val();
         $('#add_modal_form')[0].reset();
         $('#add_course_id').val(id);
         $('#add_course_type').val('0');
         $('#add_course_time_id').val($('#time_id').val());

         // $('#add_invite_form')[0].reset();
         // $('#add_invite_form name=[add_course_id]').val(id);
         // $('#add_invite_form name=[add_course_type]').val('0');
         // $('#add_invite_form name=[add_course_time_id]').val($('#time_id').val());

         $('#sel_id').val(id);
         //$("#datatable_user").show();
         ajaxData={  'id':id, 'course_type':0 };
         inviteuser_table.DataTable().ajax.reload();
         $('.invite_modal').click();
      }
     
      function add_exist_user(id){
         var formData = new FormData($('#add_modal_form')[0]);
         formData.append('user_id',id);
         $.ajax({
            url: '<?=base_url()?>admin/inviteuser/addExistUser/training/1',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data, status, xhr) {
               if(data.success){
                  $.magnificPopup.close();
                  new PNotify({
                     title: 'Success',
                     text: data.msg,
                     type: 'success'
                  });
                  // document.location.reload();
               }else{
                  new PNotify({
                     title: 'Failed',
                     text: data.msg,
                     type: 'error'
                  });
               }
            },
            error: function(){   
            }
         });
      }
      function add_invite_user(){
         var formData = new FormData($('#add_modal_form')[0]);
         if($('#first_name').val() == '' || $('#last_name').val() == '' || $('#send_email').val() == '') {
             new PNotify({
                 title: 'Failed',
                 text: 'Fill Data.',
                 type: 'danger'
             });
             return;
         }else{
            $.magnificPopup.close();
            $.ajax({
               url: '<?=base_url()?>admin/inviteuser/createInviteuser/training/1',
               type: 'POST',
               data: formData,
               processData: false,
               contentType: false,
               success: function (data, status, xhr) {
                  if(data.succss){
                     $.magnificPopup.close();
                     new PNotify({
                        title: 'Success',
                        text: data.msg,
                        type: 'success'
                     });
                     document.location.reload();
                  }else{
                     new PNotify({
                        title: 'Failed',
                        text: data.msg,
                        type: 'error'
                     });
                  }
               },
               error: function(){   
               }
            });
         }
     }
     
     function resend_inviteuser(obj, id , firstname, lastname, email){
         $(obj).attr("disabled",1);
         $.ajax({
             url: '<?=base_url()?>admin/inviteuser/createInviteuser/training/0',
             type: 'POST',
             data: {
                 	id:id,
   		   			add_ilt_time_id: $('#add_course_time_id').val(),
                 	course_id: $("#add_course_id").val(),
                 	first_name: firstname,
   		   			course_type: 0,
                 	last_name: lastname,
                 	email: email
             },
             success: function (data, status, xhr) {
                 $(obj).removeAttr("disabled");
                  if(data.success){
                     new PNotify({
                        title: 'Success',
                        text: 'Resend',
                        type: 'success'
                     });
                  }else{
                     new PNotify({
                        title: 'Failed',
                        text: data.msg,
                        type: 'error'
                     });
                  }
                 //$.magnificPopup.close();
                 
                 //document.location.reload();
             },
             error: function(){   
             }
         });
     }
	 
     function delete_inviteuser(id){
         $.ajax({
             url: '<?=base_url()?>admin/inviteuser/deleteInviteuser',
             type: 'POST',
             data: { id:id },
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
     
     $('#category').on('change',function(){
   		get_standard_list($('#category').val());
     });
     
 	function get_standard_list_chk(id){
      	//$('#standard_id').empty();
   	var standard_array = <?php echo isset($course_data['standard_id'])?$course_data['standard_id']:0;?>;
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
	 
   function getStateByCountryId(CountryID,state=0){
      if(CountryID != ''){
         var appendrow = '';
         $('#state').html('<option value="">Select State</option>');
      $('#city').html('<option value="">Select City</option>');
         $.ajax({
            url: "<?=base_url()?>admin/coursecreation/getStateById",
            type: 'POST',
            dataType: 'JSON',
            data: {'country': CountryID},
            success: function(data){
                  appendrow += '<option value="">Select State</option>';
                  $.each(data, function(index, value){
                  selected = '';
                  if(state == value.id){
                  selected = 'selected';
               }
                     appendrow += '<option '+selected+' value="'+value.id+'">'+value.name+'</option>';
                  });
                  $('#state').html(appendrow);
            }
         });
      }
   }
	
	function getCityByStateId(StateID,city=0){
       if(StateID != ''){
           var appendrow2 = '';
           $('#city').html('<option value="">Select State</option>');
           $.ajax({
               url: "<?=base_url()?>admin/coursecreation/getCityById",
               type: 'POST',
               dataType: 'JSON',
               data: {'state': StateID},
               success: function(data){
                   appendrow2 += '<option value="">Select City</option>';
                   $.each(data, function(index, value){
					   	selected2 = '';
					   	if(city == value.id){
							selected2 = 'selected';
						}
                       appendrow2 += '<option '+selected2+' value="'+value.id+'">'+value.name+'</option>';
                   });
                   $('#city').html(appendrow2);
   				}
           });
       }
   	}
     
</script>