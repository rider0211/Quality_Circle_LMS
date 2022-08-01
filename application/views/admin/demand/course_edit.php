<style>
   .control-label{
   font-size: 16px !important;
   padding-bottom: 25px;
   }
   .radioBox {
   padding-top: 0px !important;
   }
   html .wizard-progress.wizard-progress-lg ul li a, html.dark .wizard-progress.wizard-progress-lg ul li a {
   font-size: 15px;
   }
   .radioBox{
   float: left;
   }
   .input-form{
   line-height: 22px !important;
   float: left;
   }
   .control-label{
   font-weight: bold !important;
   }
   .highlight-input{
   margin-bottom: 10px;
   }
</style>
<style type="text/css">
   .wowbook-container-full{
   position:relative!important;
   }
   body, html, .wowbook-container{
   background: white!important;
   }
   .logo img{
   height: 40px;
   }
</style>
<style>
   iframe{
   min-height: 30rem;
   }
</style>
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
   <input type="hidden" id="base_url" value="<?= base_url()?>">
   <!-- start: page -->
   <div class="row">
      <div class="col-lg-12">
         <section class="card">
            <header class="card-header">
               <div class="card-actions">
               </div>
               <h2 class="card-title"><?=$term["courseinfo"]?></h2>
            </header>
            <div class="card-body">
               <div class="row">
                  <div class="col">
                     <section class="card form-wizard" id="w4">
                        <div class="card-body">
                           <div class="wizard-progress wizard-progress-lg">
                              <div class="steps-progress">
                                 <div class="progress-indicator"></div>
                              </div>
                              <ul class="nav wizard-steps">
                                 <li id="li_id1" class="nav-item">
                                    <a class="nav-link" href="#w4-setting" data-toggle="tab"><span>1</span><?=$term['coursesettings']?></a>
                                 </li>
                                 <li id="li_id2" class="nav-item">
                                    <a class="nav-link" href="#w4-content" data-toggle="tab"><span>2</span><?=$term['coursecontent']?></a>
                                 </li>
                                 <li id="li_id3" class="nav-item">
                                    <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>3</span><?=$term['courseprofile']?></a>
                                 </li>
                              </ul>
                           </div>
                           <form id="form_course" name="form_course" method="post" class="form-horizontal p-3" novalidate="novalidate" enctype="multipart/form-data">
                              <div class="tab-content">
                                 <input type="hidden" name="id" id="id" value="<?=$course_data['id']?>">
                                 <input type="hidden" name="state_now" id="state_now" value="">
                                 <input type="hidden" name="page_id" id="page_id" value="">
                                 <input type="hidden" name="chapter_id" id="chapter_id" value="">
                                 <input type="hidden" name="page_view_opt" id="page_view_opt" value="">
                                 <div id="w4-setting" class="tab-pane"  style="border: 1px solid;padding: 20px;">
                                    <div class="form-group row" style="display: none;">
                                       <label class="col-sm-12 control-label text-sm-left pt-1" for="w4-username"><?=$term['coursetype']?></label>
                                       <div class="col-sm-12">
                                          <label class="radioBox col-sm-4"><?=$term['selfpaced']?>
                                          <input type="radio" name = "time_type" value="0" <?php if ($course_data['time_type'] == 0):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="radioBox col-sm-3"><?=$term['timerestricted']?>
                                          <input type="radio" name = "time_type" value="1" <?php if ($course_data['time_type'] == 1):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <input type="number" class="form-control col-sm-1 input-form" style="width: 75px;" name="limit_time" value="0">
                                          <label class="col-sm-1" style="padding-top: 5px;">/Min</label>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-12 control-label text-sm-left pt-1" for="w4-username"><?=$term['selecttypeofcourse']?></label>
                                       <div class="col-sm-12">
                                          <label class="radioBox col-sm-3"><?=$term['freecourse']?>
                                          <input type="radio" name = "pay_type" value="0" <?php if ($course_data['pay_type'] == 0):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="radioBox col-sm-4"><?=$term['paidonetimepurchase']?>
                                          <input type="radio" name = "pay_type" value="1" <?php if ($course_data['pay_type'] == 1):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="col-sm-1" style="padding-top: 5px;float: left;"><?=$term['usd']?></label>
                                          <input type="text" class="form-control col-sm-1 input-form" style="width: 75px;" id="payy_pricee" name="pay_price" value="<?= $course_data['pay_price'] ?>">
                                       </div>
                                    </div>
                                    <div class="form-group row" style="display: none;">
                                       <label class="col-sm-12 control-label text-sm-left pt-1" for="w4-username"><?=$term['courseswillbevisiblefor']?></label>
                                       <div class="col-sm-12">
                                          <label class="radioBox col-sm-3"><?=$term['toallvisitors']?>
                                          <input type="radio" id="show_user1" name = "show_user" onclick="change_usertable()" value="0" <?php if ($course_data['show_user'] == 0):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="radioBox col-sm-5"><?=$term['onlytotheregisteredusers']?>
                                          <input type="radio" id="show_user2" name = "show_user" onclick="change_usertable()" value="1" <?php if ($course_data['show_user'] == 1):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="radioBox col-sm-4"><?=$term['onlytotheusersyouenroll']?>
                                          <input type="radio" id="show_user3" name = "show_user" onclick="change_usertable()" value="2" <?php if ($course_data['show_user'] == 2):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <div class="col-sm-6">
                                          <div class="form-group row">
                                             <label class="col-sm-7" style="vertical-align: middle;line-height: 35px;">Assessment pass mark</label>
                                             <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 100 }">
                                                <div class="input-group" style="width:150px;">
                                                   <input type="text" id="pass_mark" name="pass_mark" class="spinner-input form-control" maxlength="3" value="<?=$course_data['pass_mark']?>">
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
                                       <div class="col-sm-6">
                                          <div class="form-group row">
                                             <label class="col-sm-6" style="vertical-align: middle;line-height: 35px;">Assessment at the end</label>
                                             <div class="switch switch-primary">
                                                <input type="checkbox" name="is_ass_end" id="is_ass_end" data-plugin-ios-switch <?php echo $course_data['is_ass_end']==1?'checked="checked"':'';?> />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <div class="col-sm-6">
                                          <div class="form-group row">
                                             <label class="col-sm-6 control-label text-sm-left pt-1" for="w4-username">Assesment End Date
                                             </label>
                                             <div class="assesment_end_course_date">
                                                <input placeholder="Select Date" value="<?= isset($course_data['assesment_end_course_date']) ? date('m/d/Y', strtotime($course_data['assesment_end_course_date'])) : '' ?>" type="text" name="assesment_end_course_date" id="assesment_end_course_date" class="datepicker form-control">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                       <div class="col-sm-6">
                                          <div class="form-group row">
                                             <label class="col-sm-6 control-label text-sm-left pt-1" for="w4-username">Number Of Participants
                                             </label>
                                             <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 100 }">
                                                <div class="input-group" style="width:150px;">
                                                   <input type="text" id="number_of_participants" name="number_of_participants" class="spinner-input form-control" maxlength="3" value="<?=$course_data['number_of_participants']?>">
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
                                    
                                    
                                    <div class="form-group row">
                                       <div class="col-sm-8" style="padding-left: 0px;">
                                          <label class="col-sm-12 control-label text-sm-left pt-1" for="w4-username"><?=$term['selectinstructor']?></label>
                                          <div class="col-sm-12">
                                             <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_instructor" >
                                             </table>
                                          </div>
                                       </div>
                                       <div class="col-sm-6" style="padding-left: 0px;" id="user_table">
                                          <label class="col-sm-8 control-label text-sm-left pt-1" for="w4-username"><?=$term['selectuser']?></label>
                                          <div class="col-sm-12">
                                             <table class="table table-responsive-md table-striped table-bordered mb-0" id="datatable_user" >
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="w4-content" class="tab-pane">
                                    <div class="form-group row">
                                       <div class="col-sm-11"></div>
                                       <a class="col-sm-1 btn btn-primary modal-with-form" href="<?=base_url()?>admin/demand/preview_course/<?=$course_data['id']?>">Preview</a>
                                    </div>
                                    <div class="form-group row border" style="padding: 10px">
                                       <div class="col-sm-2">
                                          <div class="list-group">
                                             <a href="javascript:void(0);" onclick="btnCreateChapter()" class="btn btn-primary modal-with-form">New Session</a></br>
                                             <a href="#modalFormCreatePage" class="create-page btn btn-info modal-with-form">New Page</a> </br>
                                             <a href="#modalFormCreateExam" class="create-exam btn btn-warning modal-with-form">New Exam</a></br>
                                             <a href="#modalFormCreateQuiz" class="create-quiz btn modal-with-form" style="background-color: #ff6628; color: white">New Quiz</a>
                                          </div>
                                          <div id="modalFormCreatePage" class="modal-block modal-block-primary mfp-hide">
                                             <section class="card">
                                                <header class="card-header">
                                                   <h2 class="card-title">New Page</h2>
                                                </header>
                                                <div class="card-body">
                                                   <div class="form-group row">
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Page Type</label>
                                                      <div class="col-sm-9">
                                                         <select class="form-control" id="page_type" name="page_type">
                                                            <option value="1" >Exercise</option>
                                                            <option value="2" >Evening Work</option>
                                                            <option value="3" >Precourse Work</option>
                                                            <option value="4" >Handout</option>
                                                            <option value="5" >Case Study</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                </div>
                                                <footer class="card-footer">
                                                   <div class="row">
                                                      <div class="col-md-12 text-right">
                                                         <button class="btn btn-primary" onclick="btnCreatePage()"><?=$term["create"]?></button>
                                                         <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                                      </div>
                                                   </div>
                                                </footer>
                                             </section>
                                          </div>
                                          <div id="modalFormCreateExam" class="modal-block modal-block-primary mfp-hide">
                                             <section class="card">
                                                <header class="card-header">
                                                   <h2 class="card-title">Exam Edit</h2>
                                                </header>
                                                <div class="card-body">
                                                   <div class="form-group row">
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Exam Page Title</label>
                                                      <div class="col-sm-9">
                                                         <input type="text" id="exam_page_title" name="exam_page_title" class="form-control">
                                                      </div>
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Exam Maximum Num</label>
                                                      <div class="col-sm-9">
                                                         <input type="text" id="exam_max_num" name="exam_max_num" class="form-control" value="3">
                                                      </div>
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Exam</label>
                                                      <div class="col-sm-9">
                                                         <select class="form-control" id="exam_id" name="exam_id">
                                                         <?php foreach ($exam_data as $data) {
                                                            print '<option value="'.$data['id'].'" >'.$data['title'].'</option>';
                                                            } ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                </div>
                                                <footer class="card-footer">
                                                   <div class="row">
                                                      <div class="col-md-12 text-right">
                                                         <button class="btn btn-primary modal-create-confirm"><?=$term["create"]?></button>
                                                         <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                                      </div>
                                                   </div>
                                                </footer>
                                             </section>
                                          </div>
                                          <div id="modalFormCreateQuiz" class="modal-block modal-block-primary mfp-hide">
                                             <section class="card">
                                                <header class="card-header">
                                                   <h2 class="card-title">Quiz Edit</h2>
                                                </header>
                                                <div class="card-body">
                                                   <div class="form-group row">
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Quiz Page Title</label>
                                                      <div class="col-sm-9">
                                                         <input type="text" id="quiz_page_title" name="quiz_page_title" class="form-control">
                                                      </div>
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Chapter</label>
                                                      <div class="col-sm-9">
                                                         <select class="form-control" id="quiz_chapter_id" name="quiz_chapter_id">
                                                         <?php foreach ($chapter_data as $data) {
                                                            print '<option value="'.$data['id'].'" >'.$data['title'].'</option>';
                                                            }?>
                                                         </select>
                                                      </div>
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Page</label>
                                                      <div class="col-sm-9">
                                                         <select class="form-control" id="relative_page_id" name="relative_page_id">
                                                            <option value="0" >none</option>
                                                         </select>
                                                      </div>
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Attempt Num</label>
                                                      <div class="col-sm-9">
                                                         <input type="text" id="attempt_num" name="attempt_num" class="form-control" value="1">
                                                      </div>
                                                      <label class="col-sm-3 control-label text-lg-right pt-2">Quiz Group</label>
                                                      <div class="col-sm-9">
                                                         <select class="form-control" id="quiz_id" name="quiz_id">
                                                         <?php foreach ($quiz_data as $data) {
                                                            print '<option value="'.$data['id'].'" >'.$data['title'].'</option>';
                                                            } ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                </div>
                                                <footer class="card-footer">
                                                   <div class="row">
                                                      <div class="col-md-12 text-right">
                                                         <button class="btn btn-primary modal-create-quiz"><?=$term["create"]?></button>
                                                         <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                                      </div>
                                                   </div>
                                                </footer>
                                             </section>
                                          </div>
                                       </div>
                                       <div class="col-sm-10">
                                          <h3 style="text-align: center">Course</h3>
                                          <div class="all_cp_page">
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" id="getscid" value="0">
                                    <input type="hidden" id="getspid" value="0">
                                    <input type="hidden" id="setscid" value="0">
                                    <input type="hidden" id="setspid" value="0">
                                 </div>
                                 <div id="w4-content-new-page" class="tab-pane">
                                    <div class="form-group row">
                                       <div class="col-sm-5"></div>
                                       <a class="col-sm-1 btn btn-primary modal-with-form" href="javascript:void(0)" onclick="viewList()">View List</a>
                                       <div class="col-sm-1"></div>
                                       <a class="col-sm-1 btn btn-primary modal-with-form" href="<?=base_url()?>admin/demand/preview_course/<?=$course_data['id']?>">Preview</a>
                                       <div class="col-sm-1"></div>
                                       <div class="col-sm-1">
                                          <div class="btn-group flex-wrap" >
                                             <button type="button" style="margin: 0px !important;" class="mb-1 mt-1 mr-1 btn btn-default dropdown-toggle" data-toggle="dropdown">Add New <span class="caret"></span></button>
                                             <div class="dropdown-menu" role="menu" >
                                                <a class="dropdown-item text-1" href="javascript:void(0)" onclick="btnCreateChapter()">Session</a>
                                                <a class="dropdown-item text-1 create-page-id modal-with-form" href="#modalFormCreatePageWithID" id="chng_id">Page</a>
                                             </div>
                                             <div id="modalFormCreatePageWithID" class="modal-block modal-block-primary mfp-hide">
                                                <section class="card">
                                                   <header class="card-header">
                                                      <h2 class="card-title">New Page</h2>
                                                   </header>
                                                   <div class="card-body">
                                                      <div class="form-group row">
                                                         <label class="col-sm-3 control-label text-lg-right pt-2">Page Type</label>
                                                         <div class="col-sm-9">
                                                            <select class="form-control" id="page_type_with" name="page_type_with">
                                                               <option value="1" >Exercise</option>
                                                               <option value="2" >Evening Work</option>
                                                               <option value="3" >Precourse Work</option>
                                                               <option value="4" >Handout</option>
                                                               <option value="5" >Case Study</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <footer class="card-footer">
                                                      <div class="row">
                                                         <div class="col-md-12 text-right">
                                                            <button class="btn btn-primary" onclick="btnCreatePageWithID(1)"><?=$term["create"]?></button>
                                                            <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
                                                         </div>
                                                      </div>
                                                   </footer>
                                                </section>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-sm-1"></div>
                                       <a class="col-sm-1 btn btn-primary modal-with-form" href="javascript:void(0)" onclick="save_now()">Save</a>
                                    </div>
                                    <div class="form-group row border" style="padding: 10px">
                                       <div class="col-sm-3" style="margin-top:2%; border-color: #212529;">
                                          <div class="list-group allchapter">
                                             <div class="col-sm-12">
                                                <input type="checkbox" id="cptitle_btn" value="1">
                                                <span class="cptitile">Session Title</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-sm-9 ch_detail">
                                          <div class="form-group page_v" >
                                             <input class="form-control incl ctitle ptitle" type="text" value="" id="text_from_title" name="text_from_title" placeholder="Page Title" data-id="0" onblur="save_chapter(this.id)" required>
                                             <button type="button" id="library_btn" class="mb-1 mt-1 mr-1 btn btn-primary" onclick="library_modal()"><i class="fa fa-plus-square"></i> Insert Library File</button>
                                             <button type="button" style="text-align: right" id="show_library_btn" class="mb-1 mt-1 mr-1 btn btn-primary" onclick="show_library_btn_func()">X</button>                                             
                                             <input size="16" type="text" value="" readonly id="form_datetimeId" class="form_datetime" name="session_dateTime"> <a href="javascript:void(0)" onclick="remove_sessionDateTime()">x</a>
                                             <div class="col-sm-12" id="div_container"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" id="set_pre_title">
                                    <input type="hidden" id="session_p" value="">
                                    <input type="hidden" id="cp_id" value="0">
                                    <input type="hidden" id="p_id" value="0">
                                    <input type="hidden" id="session_c" value="">
                                    <input type="hidden" id="txt_detail_id" value="0">
                                    <input type="hidden" id="new_chap" value="<?php if(isset($new_chapters) && $new_chapters >= 1){ echo $new_chapters; }else{ echo 0;}?>">
                                 </div>
                                 <div id="w4-profile" class="tab-pane">
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;"><?=$term["title"]?></label>
                                       <div class="col-sm-7">
                                          <input type="text" class="form-control" name="title" value="<?=$course_data['title']?>" required>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;"><?=$term["subtitle"]?></label>
                                       <div class="col-sm-7">
                                          <input type="text" class="form-control" name="subtitle" value="<?=$course_data['subtitle']?>" required>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                     <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Duration(day)</label>
                                     <div class="col-sm-7">
                                     <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 100 }">
                                        <div class="input-group" style="width:150px;">
                                           <input type="text" id="duration" name="duration" class="spinner-input form-control" maxlength="3" value="<?=$course_data['duration']?>">
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
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Start Date</label>
                                       <div class="col-sm-7">
                                          <input type="text" data-plugin-datepicker=""  data-date-format="yyyy-mm-dd" class="form-control" name="start_at" value="<?=$course_data['start_at']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">End Date</label>
                                       <div class="col-sm-7">
                                          <input type="text" data-plugin-datepicker=""  data-date-format="yyyy-mm-dd" class="form-control" name="end_at" value="<?=$course_data['end_at']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Learning Objective</label>
                                       <div class="col-sm-7">
                                          <textarea class="form-control" name="learning_objective" data-plugin-markdown-editor rows="8" id="learning_objective"><?=nl2br($course_data['learning_objective'])?></textarea>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Who Should Attend</label>
                                       <div class="col-sm-7">
                                          <textarea class="form-control" name="attend" data-plugin-markdown-editor rows="8" id="attend"><?=nl2br($course_data['attend'])?></textarea>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Agenda</label>
                                       <div class="col-sm-7">
                                          <textarea class="form-control" name="agenda" data-plugin-markdown-editor rows="8" id="agenda"><?=nl2br($course_data['agenda'])?></textarea>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <div class="col-sm-2"></div>
                                       <div class="col-sm-10">
                                          <label class="radioBox col-sm-3">Demand
                                          <input type="radio" class="course_type_radio" name="course_type" value="2" <?php if ($course_data['course_type'] == 2):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="radioBox col-sm-4">ILT
                                          <input type="radio" class="course_type_radio" name="course_type" value="0" <?php if ($course_data['course_type'] == 0):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                          <label class="radioBox col-sm-3">VILT
                                          <input type="radio" class="course_type_radio" name="course_type" value="1" <?php if ($course_data['course_type'] == 1):?>checked<?php endif;?>>
                                          <span class="checkmark"></span>
                                          </label>
                                       </div>
                                    </div>
                                    <?php /* ?><div id="course_self_div" <?php if($course_data['course_type'] == 2){ ?> style="display:block" <?php } else { ?>style="display:none"<?php } ?>><?php */ ?>
                                        <div class="form-group row col-sm-12">
                                           <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Course Self Time</label>
                                           <div class="col-sm-7">
                                              <select name="course_self_time" class="form-control">                                           	
                                                <option <?php if($course_data['course_self_time'] == 'Self Pace'):?>selected<?php endif;?> value="Self Pace">Self Pace</option>
                                                <option <?php if($course_data['course_self_time'] == 'Time Restricted'):?>selected<?php endif;?> value="Time Restricted">Time Restricted</option>
                                                
                                              </select>
                                           </div>
                                        </div>
                                    <?php /* ?></div>
                                    <?php /* ?><div id="course_time_div" <?php if($course_data['course_type'] == 1 || $course_data['course_type'] == 0){ ?> style="display:block" <?php } else { ?>style="display:none"<?php } ?>>
                                        <div class="form-group row col-sm-12">
                                           <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Course Self Time</label>
                                           <div class="col-sm-7">
                                              <select name="course_self_time" class="form-control">                                              	
                                                <option <?php if($course_data['course_self_time'] == 'Time Restricted'):?>selected<?php endif;?> value="Time Restricted">Time Restricted</option>
                                                <option <?php if($course_data['course_self_time'] == 'Self Pace'):?>selected<?php endif;?> value="Self Pace">Self Pace</option>
                                              </select>
                                           </div>
                                        </div>
                                    </div><?php */ ?>
                                    <div id="course_type_div_online" <?php if($course_data['course_type'] == 2 || $course_data['course_type'] == 1){ ?> style="display:block" <?php } else { ?>style="display:none"<?php } ?>>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Location</label>
                                       <div class="col-sm-7">
                                          <input type="text" class="form-control" value="Online" disabled>
                                       </div>
                                    </div>
                                    </div>
                                    <div id="course_type_div" <?php if($course_data['course_type'] == 2 || $course_data['course_type'] == 1){ ?> style="display:none" <?php } else { ?>style="display:block"<?php } ?>>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Address</label>
                                       <div class="col-sm-7">
                                          <textarea class="form-control" required name="address" rows="5" id="address"><?=nl2br($course_data['address'])?></textarea>
                                       </div>
                                    </div>                                   
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Country</label>
                                       <div class="col-sm-7">
                                            <select data-plugin-selectTwo class="form-control" required onchange="getStateByCountryId(this.value)" id="country" name="country">
                                                <option value="" >Select</option>
                                                <?php foreach ($countries as $countries){ ?>
                                                    <option required <?php if($course_data['country'] == $countries['id']){echo "selected";} ?> value=<?php echo $countries['id']; ?>><?php echo $countries['name']; ?></option>
                                                <?php }?>
                                            </select>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">State</label>
                                       <div class="col-sm-7">
                                            <select data-plugin-selectTwo class="form-control" required onchange="getCityByStateId(this.value)" id="state" name="state">
                                                <option value="" >Select</option>
                                                <?php foreach ($states as $state){ ?>
                                                    <option required <?php if($course_data['state'] == $state['id']){echo "selected";} ?> value=<?php echo $state['id']; ?>><?php echo $state['name']; ?></option>
                                                <?php }?>
                                            </select>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">City</label>
                                       <div class="col-sm-7">
                                            <select data-plugin-selectTwo class="form-control" required id="city" name="city">
                                                <option value="" >Select</option>
                                                <?php foreach ($cities as $city){ ?>
                                                    <option required <?php if($course_data['city'] == $city['id']){echo "selected";} ?> value=<?php echo $city['id']; ?>><?php echo $city['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                       </div>
                                    </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="number" id="number"/>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;">Number</label>
                                       <div class="col-sm-7">
                                          <input type="text" disabled="disabled" class="form-control" value="<?=$course_data['number']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;"><?=$term['category']?></label>
                                       <div class="col-sm-7">
                                          <select data-plugin-selectTwo class="form-control" id="category_id" onchange="getCategoryTitle()" name="category_id">
                                          		<option value="">Select Category</option>
                                             <?php foreach($category as $item){ ?>
                                             <option value="<?php echo $item['id']; ?>" <?php $category_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
                                             <?php }  ?>
                                          </select>
                                       </div>
                                    </div>
                                    <?php $standardArr = explode(',',$course_data['standard_id']); ?>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-2 control-label text-sm-right pt-1" style="text-align: left !important;"><?=$term['standard']?></label>
                                       <div class="col-sm-7">
                                          <select data-plugin-selectTwo class="form-control" id="standard_id" name="standard_id[]" multiple="multiple">
                                          <?php foreach($category_standard_list as $itemstandard){ ?>
                                             <option value="<?php echo $itemstandard['id']; ?>" <?php in_array($itemstandard['id'],$standardArr)?print 'selected':print ''; ?>> <?php echo $itemstandard['name']; ?></option>
                                             <?php }  ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                    <label class="col-sm-2 control-label text-sm-left pt-1" for="w4-username" style="text-align: left !important;">Status</label>
                                        <div class="col-sm-7">
                                             <div class="switch switch-primary">
                                                <input type="checkbox" name="status" id="status" data-plugin-ios-switch <?php echo $course_data['active']!=2?'checked="checked"':'';?> />
                                             </div>
                                         </div>
                                    </div>                                    
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-6"><?=$term["coursehighlights"]?></label>
                                       <a class="btn btn-default" onclick="add_highlight()"><i class="el el-plus-sign"></i>&nbsp;<?=$term["addhighlight"]?></a>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <div class="col-sm-1"></div>
                                       <div id="highlight_div" class="col-sm-5">
                                          <input type="text" class="form-control highlight-input" name="highlight[]" required value="<?=$highlight[0]['content']?>">
                                          <input type="text" class="form-control highlight-input" name="highlight[]" required value="<?=$highlight[1]['content']?>">
                                          <input type="text" class="form-control highlight-input" name="highlight[]" required value="<?=$highlight[2]['content']?>">
                                          <?php
                                             if (count($highlight) > 3){
                                                 for ($i=3;$i<count($highlight);$i++){
                                                     echo '<input type="text" class="form-control highlight-input" name="highlight[]" required value="'.$highlight[$i]['content'].'">';
                                                 }
                                             }
                                             ?>
                                       </div>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-6"><?=$term["aboutthecourse"]?></label>
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add</button>
                                    </div>
                                    <hr />
                                    <?php /* ?>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-6">Course Pre-Requisite Highlights : (Min. 3 highlights required)</label>
                                       <a class="btn btn-default" onclick="add_prerequisite_highlight()"><i class="el el-plus-sign"></i>&nbsp;<?=$term["addhighlight"]?></a>
                                    </div>
                                    <div class="form-group row col-sm-12">
                                       <div class="col-sm-1"></div>
                                       <div id="prerequisite_highlight_div" class="col-sm-5">
                                          <input type="text" class="form-control highlight-input" name="prerequisitehighlight[]" required value="<?=$prerequisitehighlight[0]['content']?>">
                                          <input type="text" class="form-control highlight-input" name="prerequisitehighlight[]" required value="<?=$prerequisitehighlight[1]['content']?>">
                                          <input type="text" class="form-control highlight-input" name="prerequisitehighlight[]" required value="<?=$prerequisitehighlight[2]['content']?>">
                                          <?php
                                             if (count($prerequisitehighlight) > 3){
                                                 for ($i=3;$i<count($prerequisitehighlight);$i++){
                                                     echo '<input type="text" class="form-control highlight-input" name="prerequisitehighlight[]" required value="'.$prerequisitehighlight[$i]['content'].'">';
                                                 }
                                             }
                                             ?>
                                       </div>
                                    </div>
									<?php */ ?>
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-6">Course Pre-Requisite</label>
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalPre">Add</button>
                                    </div>
                                    <input type  = "hidden" name="prerequisite" id="prerequisitedata" value="<?php echo isset($course_data)&&isset($course_data['prerequisite'])?$course_data['prerequisite']:''; ?>">
                                    <input type  = "hidden" name="about" id="aboutdata" value="<?php echo isset($course_data)&&isset($course_data['about'])?$course_data['about']:''; ?>"><!-- 
                                       <div class="form-group row col-sm-12">
                                           <textarea class="ckeditor form-control" name="about" id="about" rows="5" ><?php echo isset($course_data)&&isset($course_data['about'])?$course_data['about']:''; ?></textarea>
                                       </div> -->
                                    <hr />
                                    <div class="form-group row col-sm-12">
                                       <label class="col-sm-6"><?=$term["courselogo"]?>:</label>
                                    </div>
                                    <div class="col-lg-12">
                                       <input type="file" class="file-input-overwrite" name="image_path" value="">
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="card-footer">
                           <ul class="pager">
                              <li class="previous disabled">
                                 <a><i class="fas fa-angle-left"></i> Previous</a>
                              </li>
                              <li class="finish hidden float-right">
                                 <a>Finish</a>
                              </li>
                              <li class="next">
                                 <a>Next <i class="fas fa-angle-right"></i></a>
                              </li>
                           </ul>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- Modal -->
   <div id="myModalPre" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Course Pre-Requisite</h4>
            </div>
            <div class="modal-body">
               <textarea class="ckeditor form-control" name="prerequisite" id="prerequisite" rows="5" ><?php echo isset($course_data)&&isset($course_data['prerequisite'])?$course_data['prerequisite']:''; ?></textarea>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default addPreRequisiteContent" data-dismiss="modal" >Add</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- end: page -->
   <!-- Modal -->
   <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">About course</h4>
            </div>
            <div class="modal-body">
               <textarea class="ckeditor form-control" name="about" id="about" rows="5" ><?php echo isset($course_data)&&isset($course_data['about'])?$course_data['about']:''; ?></textarea>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default addCourseContent" data-dismiss="modal" >Add</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- end: page -->
</section>
<div id="library_modal" class="modal fade">
   <div class="modal-dialog" style = "width: 70%;max-width: 70%;">
      <div class="modal-content">
         <div class="modal-header bg-default">
            <h3 class="modal-title"><?=$term["library"]?></h3>
         </div>
         <form id="exam_title_form" class="form-horizontal">
            <div class="modal-body">
               <div class="col-lg-12" style="display: flex;">
                  <table class="table table-responsive-md table-hover mb-0" id="datatable" >
                  </table>
               </div>
            </div>
         </form>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
<form id="form_library_insert" action="<?=base_url()?>admin/demand/insert_library" method="post" target="blank_iframe">
   <input type="hidden" id="course_id" name="course_id" value="<?php (isset($course_id)) ? print $course_id:print '0';?>">
   <input type="hidden" id="course_price" name="course_price" value="<?php (isset($course_price)) ? print $course_price:print '0';?>">
   <input type="hidden" id="select_id" name="chapter_id" value="0">
   <input type="hidden" id="library_id" name="library_id" value="0">
</form>
<form>
   <input type="hidden" id="lid" value="0">
</form>
<iframe name="blank_iframe" id="blank_iframe" style="display: none;">
</iframe>

<script type="text/javascript">
	function getCategoryTitle(){
		$('#number').val($( "#category_id option:selected" ).text());
	}
   	$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
   	
	function getStateByCountryId(CountryID){
       if(CountryID != ''){
           var appendrow = '';
           $('#state').html('<option value="">Select State</option>');
		   $('#city').html('<option value="">Select City</option>');
           $.ajax({
               url: "<?=base_url()?>admin/demand/getStateById",
               type: 'POST',
               dataType: 'JSON',
               data: {'country': CountryID},
               success: function(data){
                   appendrow += '<option value="">Select State</option>';
                   $.each(data, function(index, value){
                       appendrow += '<option value="'+value.id+'">'+value.name+'</option>';
                   });
                   $('#state').html(appendrow);
   				}
           });
       }
   	}
	
	function getCityByStateId(StateID){
       if(StateID != ''){
           var appendrow2 = '';
           $('#city').html('<option value="">Select State</option>');
           $.ajax({
               url: "<?=base_url()?>admin/demand/getCityById",
               type: 'POST',
               dataType: 'JSON',
               data: {'state': StateID},
               success: function(data){
                   appendrow2 += '<option value="">Select City</option>';
                   $.each(data, function(index, value){
                       appendrow2 += '<option value="'+value.id+'">'+value.name+'</option>';
                   });
                   $('#city').html(appendrow2);
   				}
           });
       }
   	}
   
   	$('.addCourseContent').click(function(){
   		var about = CKEDITOR.instances['about'].getData();
   		$('#aboutdata').val(about);
   	});
	
	$('.addPreRequisiteContent').click(function(){
   		var prerequisite = CKEDITOR.instances['prerequisite'].getData();
   		$('#prerequisitedata').val(prerequisite);
   	});
</script>
<script> 
	$(document).on('click','.course_type_radio',function(){
		var type = this.value;
		if(type == 2){
			$('#course_self_div').show();
			$('#course_time_div').hide();
		}else{
			$('#course_self_div').hide();
			$('#course_time_div').show();
		}
		if(type == 1 || type == 2){
			$('#course_type_div').hide();
			$('#course_type_div_online').show();
		}else{
			$('#course_type_div').show();
			$('#course_type_div_online').hide();
		}
	});
		
	jQuery(document).ready(function(){
		getCategoryTitle();
		$('.form_datetime').change(function() {
			var date = $(this).val();
			var courseId = $('#course_id').val();
			var pageTitle = $('#text_from_title').val();
			   $.ajax({
				type: "POST",
				url: "<?=base_url()?>admin/demand/saveSessionDateTime", 
				data: {"dateTime":date,"courseId":courseId,"pageTitle":pageTitle},
				success: function (data) {
					
				}   		
			}); 
	   });
	});
   
   function remove_sessionDateTime(){
   	var SessionDateTime = $( "#form_datetimeId" ).val();
   	if(SessionDateTime){
   		var courseId = $('#course_id').val();
   		var pageTitle = $('#text_from_title').val();
   		$.ajax({
   			type: "POST",
   			url: "<?=base_url()?>admin/demand/removeSessionDateTime",  
   			data: {"courseId":courseId,"pageTitle":pageTitle},
   			success: function (data) {
   				if(data == 1){
   					$( "#form_datetimeId" ).val('');
   					alert('Successfully removing the value')
   				}else{
   					alert('Error in removing the value')
   				}
   				
   			}
   			
   		}); 
   	}else{
   		alert('Error in removing the value')
   	}
   	 
   }
   
   jQuery(document).ready(function() {
   $('[data-plugin-selectTwo]').each(function() {
   var $this = $( this ),
       opts = {};
   
   var pluginOptions = $this.data('plugin-options');
   if (pluginOptions)
       opts = pluginOptions;
   
   $this.themePluginSelect2(opts);
   });
   
   $('[data-plugin-ios-switch]').each(function () {
   var $this = $(this);
   
   $this.themePluginIOS7Switch();
   });
   
   $('[data-plugin-masked-input]').each(function() {
   var $this = $( this );
   
   $this.themePluginMaskedInput();
   });
   
   $('[data-plugin-markdown-editor]').each(function() {
   var $this = $( this ),
       opts = {};
   
   var pluginOptions = $this.data('plugin-options');
   if (pluginOptions)
       opts = pluginOptions;
   
   $this.themePluginMarkdownEditor(opts);
   });
   });
   
   jQuery(document).ready(function() {
   
	   $('[data-plugin-datepicker]').each(function () {
	   var $this = $(this);
	   $this.themePluginDatePicker();
	   
   });
   
   });
   
   
   function library_modal(){
   $("#library_modal").modal();
   $('#datatable').DataTable().ajax.reload('', false);
   }
   
   var base_url = "<?php echo base_url()?>";
   var first_id = '<?php echo $libraries[0]->id;?>';
   var active_id = <?=$active_id?>;
   var chapter_id = 0;
   var create_type = "chapter"
   if (active_id == 0){
   $('#up_library'+first_id).prop('checked','checked');
   }
   else{
   $('#up_library'+active_id).prop('checked','checked');
   }
   var $table = $('#datatable_instructor');
   var $user_table = $('#datatable_user');
   var instructors = '<?=$course_data['instructors']?>';
   var enroll_users = '<?=$course_data['enroll_users']?>';
   var tab_id = 1;
   var relative_page_id = 0;
   
   tab_id = <?=$tab_active_id?>;
   
   if (tab_id == 1){
   $("#li_id1").addClass("active");
   $("#w4-setting").addClass("active show");
   }
   else if (tab_id == 2){
   $("#li_id2").addClass("active");
   $("#w4-content").addClass("active show");
   $("#state_now").val('');
   }
   else{
   $("#li_id3").addClass("active");
   $("#w4-profile").addClass("active show");
   }
   
   
   $("#quiz_chapter_id").change(function(){
   $.ajax({
	   type: "POST",
	   url: "<?=base_url()?>admin/demand/getPageByChapterId",
	   data: {"chapter_id":Number($(this).val())},
		   success: function (data, status, xhr) {
			   var html = "<option value='0' selected>none</option>";
			   for(var i = 0; i<data.length;i++){
				   html +="<option value='"+data[i]['id']+"'>"+data[i]['title']+"</option>";
			   }
			   $("#relative_page_id").html(html);
		   },
		   error: function(){
			   new PNotify({
				   title: '<?php echo $term['error']; ?>',
				   text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
				   type: 'error'
			   });
		   }
	   });
   });
   
   function add_highlight(){
		$("#highlight_div").append('<input type="text" class="form-control highlight-input" name="highlight[]">');
   }
   
   function add_prerequisite_highlight(){
		$("#prerequisite_highlight_div").append('<input type="text" class="form-control highlight-input" name="prerequisitehighlight[]">');
   }
   
   (function($){
   change_usertable();
   var active_next = $("ul.pager li.next");
   active_next.on('click', function (ev) {
	   if(!$("#w4 form").valid()){
		   return false;
	   }
   ev.preventDefault();
   var formData = new FormData($('#form_course')[0]);
   var price  = $("#payy_pricee").val();
   var class_name_setting = $("#w4-setting")[0].className;
   var class_name_content = $("#w4-content")[0].className;
   var class_name_profile = $("#w4-profile")[0].className;
   
   if (class_name_setting.indexOf("active") > 0){   ////////////////////////////Setting////////////////////////////
       $.ajax({
           url: $('#base_url').val()+'admin/demand/save_course_setting',
           type: 'POST',
           data: formData,
           processData:false,
           contentType: false,
           success: function (data, status, xhr) {
               $('#id').val(data);
               $('#course_id').val(data);
   
               new PNotify({
                   title: '<?php echo $term['success']; ?>',
                   text: '<?php echo 'Successfully Save Setting'; ?>',
                   type: 'success'
               });
           },
           error: function(){
               new PNotify({
                   title: '<?php echo $term['error']; ?>',
                   text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                   type: 'error'
               });
           }
       });
   }
   
   if (class_name_content.indexOf("active") > 0){    ////////////////////////////Content////////////////////////////
       <?php if($course_data['img_path'] == null) echo "$('.fileinput-remove-button').click();";?>
   
   }
   
   if (class_name_profile.indexOf("active") > 0){   ////////////////////////////Profile////////////////////////////
       var price = $("#payy_pricee").val();
       $.ajax({
           url: $('#base_url').val()+'admin/demand/save_course_profile?price='+price,
           type: 'POST',
           data: formData,
           processData:false,
           contentType: false,
           success: function (data, status, xhr) {
               new PNotify({
                   title: '<?php echo $term['success']; ?>',
                   text: '<?php echo 'Successfully Save Profile'; ?>',
                   type: 'success'
               });
           },
           error: function(){
               $("#sendBtn").trigger('loading-overlay:hide');
               new PNotify({
                   title: '<?php echo $term['error']; ?>',
                   text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                   type: 'error'
               });
           }
       });
   }
   
   });
   var $w4finish = $('#w4').find('ul.pager li.finish'),
   $w4validator = $("#w4 form").validate({
       highlight: function (element) {
           $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
       },
       success: function (element) {
           $(element).closest('.form-group').removeClass('has-error');
           $(element).remove();
       },
       errorPlacement: function (error, element) {
           element.parent().append(error);
       }
   });
   
   $w4finish.on('click', function (ev) {
   ev.preventDefault();
   var price = $("#payy_pricee").val();
   $("#form_course").attr("action", "<?=base_url()?>admin/demand/save_course_profile?price="+price);
   $("#form_course").submit();
   });
   
    
   $('#w4').bootstrapWizard({
   tabClass: 'wizard-steps',
   nextSelector: 'ul.pager li.next',
   previousSelector: 'ul.pager li.previous',
   firstSelector: null,
   lastSelector: null,
   onNext: function (tab, navigation, index, newindex) {
       var validated = $('#w4 form').valid();
       if (!validated) {
           $w4validator.focusInvalid();
           return false;
       }
   },
   onTabClick: function (tab, navigation, index, newindex) {
       if (newindex == index + 1) {
           $("ul.pager li.next").click();
           return this.onNext(tab, navigation, index, newindex);
       } else if (newindex > index + 1) {
           return false;
       } else {
           return true;
       }
   },
   onTabChange: function (tab, navigation, index, newindex) {
       var $total = navigation.find('li').length - 1;
       $w4finish[newindex != $total ? 'addClass' : 'removeClass']('hidden');
       $('#w4').find(this.nextSelector)[newindex == $total ? 'addClass' : 'removeClass']('hidden');
   },
   onTabShow: function (tab, navigation, index) {
       var $total = navigation.find('li').length - 1;
       var $current = index;
       var $percent = Math.floor(( $current / $total ) * 100);
   
       navigation.find('li').removeClass('active');
       navigation.find('li').eq($current).addClass('active');
   
       $('#w4').find('.progress-indicator').css({'width': $percent + '%'});
       tab.prevAll().addClass('completed');
       tab.nextAll().removeClass('completed');
   }
   });
   
   
   }).apply(this, [jQuery]);
   
   jQuery(document).ready(function() {
   
   $('[data-plugin-selectTwo]').each(function() {
   var $this = $( this ),
       opts = {};
   
   var pluginOptions = $this.data('plugin-options');
   if (pluginOptions)
       opts = pluginOptions;
   
   $this.themePluginSelect2(opts);
   });
   
   CKEDITOR.on( 'instanceReady', function( ev ) {
   editor = ev.editor;
   });
   $table.dataTable({
   "ordering": true,
   "info": true,
   "searching": true,
   
   "ajax": {
       "type": "POST",
       "async": true,
       "url": "<?=base_url()?>admin/demand/getinstructor",
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
   "pageLength": 150, // default record count per page
   
   dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
   bProcessing: true,
   });
   $user_table.DataTable({
   "ordering": true,
   "info": true,
   "searching": true,
   
   "ajax": {
       "type": "POST",
       "async": true,
       "url": "<?=base_url()?>admin/demand/getuser",
       "data": '',
       "dataSrc": "data",
       "dataType": "json",
       "cache":    false,
   },
   "columnDefs": [{
       "targets": [0],
       "createdCell": function (td, cellData, rowData, row, col) {
           if(cellData != "-1") {
               if (enroll_users.indexOf(cellData) > 0) {
                   $(td).html('<input type="checkBox" name="user[]" checked value="' + rowData.id + '">');
               } else {
                   $(td).html('<input type="checkBox" name="user[]" value="' + rowData.id + '">');
               }
           }
           else{
               $(td).html('');
           }
       }
   } ],
   "columns": [
       { "title": "", "data": "id", "class": "text-left", "width":10 },
       { "title": "#", "data": "no", "class": "center", "width":50 },
       { "title": "<?=$term["name"]?>", "data": "fullname", "class": "text-left", "width":200 }
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
   "pageLength": 150, // default record count per page
   
   dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
   bProcessing: true,
   });
   });
   
   $(function() {
   // Modal template
   var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
   '  <div class="modal-content">\n' +
   '    <div class="modal-header">\n' +
   '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
   '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
   '    </div>\n' +
   '    <div class="modal-body">\n' +
   '      <div class="floating-buttons btn-group"></div>\n' +
   '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
   '    </div>\n' +
   '  </div>\n' +
   '</div>\n';
   
   // Buttons inside zoom modal
   var previewZoomButtonClasses = {
   toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
   fullscreen: 'btn btn-default btn-icon btn-xs',
   borderless: 'btn btn-default btn-icon btn-xs',
   close: 'btn btn-default btn-icon btn-xs'
   };
   
   // Icons inside zoom modal classes
   var previewZoomButtonIcons = {
   prev: '<i class="icon-arrow-left32"></i>',
   next: '<i class="icon-arrow-right32"></i>',
   toggleheader: '<i class="icon-menu-open"></i>',
   fullscreen: '<i class="icon-screen-full"></i>',
   borderless: '<i class="icon-alignment-unalign"></i>',
   close: '<i class="icon-cross3"></i>'
   };
   
   // File actions
   var fileActionSettings = {
   zoomClass: 'btn btn-link btn-xs btn-icon',
   zoomIcon: '<i class="icon-zoomin3"></i>',
   dragClass: 'btn btn-link btn-xs btn-icon',
   dragIcon: '<i class="icon-three-bars"></i>',
   removeClass: 'btn btn-link btn-icon btn-xs',
   removeIcon: '<i class="icon-trash"></i>',
   indicatorNew: '<i class="icon-file-plus text-slate"></i>',
   indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
   indicatorError: '<i class="icon-cross2 text-danger"></i>',
   indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
   };
   $('.file-input').fileinput({
   browseLabel: 'Browse',
   browseIcon: '<i class="icon-file-plus"></i>',
   uploadIcon: '<i class="icon-file-upload2"></i>',
   removeIcon: '<i class="icon-cross3"></i>',
   layoutTemplates: {
       icon: '<i class="icon-file-check"></i>',
       modal: modalTemplate
   },
   initialCaption: "No file selected",
   previewZoomButtonClasses: previewZoomButtonClasses,
   previewZoomButtonIcons: previewZoomButtonIcons,
   fileActionSettings: fileActionSettings
   });
   $(".file-input-overwrite").fileinput({
   browseLabel: 'Browse',
   browseIcon: '<i class="icon-file-plus"></i>',
   uploadIcon: '<i class="icon-file-upload2"></i>',
   removeIcon: '<i class="icon-cross3"></i>',
   layoutTemplates: {
       icon: '<i class="icon-file-check"></i>',
       modal: modalTemplate
   },
   initialPreview: [
       "<?php if($course_data['img_path'] != null) echo base_url().$course_data['img_path']; else echo'';?>"
   ],
   initialPreviewConfig: [
       {caption: "", key: 1, showDrag: false}
   ],
   initialPreviewAsData: true,
   overwriteInitial: true,
   previewZoomButtonClasses: previewZoomButtonClasses,
   previewZoomButtonIcons: previewZoomButtonIcons,
   fileActionSettings: fileActionSettings
   });
   
   });
   
   function change_usertable(){
   var status = $("#show_user3").prop("checked");
   if (status == true){
   $("#user_table").css("display","block");
   }else{
   $("#user_table").css("display","none");
   }
   }
   
</script>
<script>
   add_new_chap = add_new_detail = '';
   
   $('.create-exam').magnificPopup({
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
   
   $('.create-page').magnificPopup({
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
   
   $('.create-page-id').magnificPopup({
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
   
   $('.create-quiz').magnificPopup({
   type: 'inline',
   preloader: false,
   modal: true,
   
   // When elemened is focused, some mobile browsers in some cases zoom in
   // It looks not nice, so we disable it:
   callbacks: {
   beforeOpen: function() {
       $("#quiz_chapter_id").trigger('change');
   }
   }
   });
   
   $('.modal-create-confirm').click(function (e) {
   e.preventDefault();
   if($('.modal-create-confirm').html().indexOf('<?=$term["create"]?>') >= 0)
   {
   $.ajax({
       url: $('#base_url').val()+'admin/demand/save_exam_page',
       type: 'POST',
       data: {'chapter_id':$('#chapter_id').val(),
           'course_id':$('#course_id').val(),
           'exam_id':$('#exam_id').val(),
           'exam_page_title':$('#exam_page_title').val(),
           'exam_max_num':$('#exam_max_num').val()
       },
       success: function (data, status, xhr) {
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: '<?php echo 'Successfully Save Exam'; ?>',
               type: 'success'
           });
           $.magnificPopup.close();
           viewList();
       },
       error: function(){
           $("#sendBtn").trigger('loading-overlay:hide');
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
           });
       }
   });
   }
   else
   {
   $.ajax({
       url: $('#base_url').val()+'admin/demand/update_exam_page',
       type: 'POST',
       data: {'chapter_id':$('#chapter_id').val(),
           'exam_id':$('#exam_id').val(),
           'exam_page_title':$('#exam_page_title').val(),
           'exam_max_num':$('#exam_max_num').val()
       },
       success: function (data, status, xhr) {
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: '<?php echo 'Successfully Save Exam'; ?>',
               type: 'success'
           });
           $.magnificPopup.close();
           viewList();
       },
       error: function(){
           $("#sendBtn").trigger('loading-overlay:hide');
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
           });
       }
   });
   }
   
   
   })
   
   $('.modal-create-quiz').click(function (e) {
   e.preventDefault();
   if($('.modal-create-quiz').html().indexOf('<?=$term["create"]?>') >= 0)
   {
   $.ajax({
       url: $('#base_url').val()+'admin/demand/save_quiz_page',
       type: 'POST',
       data: {'chapter_id':$('#quiz_chapter_id').val(),
           'course_id':$('#course_id').val(),
           'quiz_id':$('#quiz_id').val(),
           'quiz_page_title':$('#quiz_page_title').val(),
           'relative_page_id':$('#relative_page_id').val(),
           'attempt_num':$('#attempt_num').val()
       },
       success: function (data, status, xhr) {
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: '<?php echo 'Successfully Save Quiz'; ?>',
               type: 'success'
           });
           $.magnificPopup.close();
           viewList();
       },
       error: function(){
           $("#sendBtn").trigger('loading-overlay:hide');
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
           });
       }
   });
   }
   else
   {
   $('#quiz_chapter_id').prop('disabled', false);
   $.ajax({
       url: $('#base_url').val()+'admin/demand/update_quiz_page',
       type: 'POST',
       data: {'page_id':$('#page_id').val(),
           'quiz_id':$('#quiz_id').val(),
           'quiz_page_title':$('#quiz_page_title').val(),
           'relative_page_id':$('#relative_page_id').val(),
           'attempt_num':$("#attempt_num").val()
       },
       success: function (data, status, xhr) {
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: '<?php echo 'Successfully Save Quiz'; ?>',
               type: 'success'
           });
   
           $.magnificPopup.close();
           viewList();
       },
       error: function(){
           $("#sendBtn").trigger('loading-overlay:hide');
   
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
           });
       }
   });
   }
   
   
   })
   
   $('.modal-create-dismiss').click(function (e) {
   e.preventDefault();
   $.magnificPopup.close();
   })
   
   function first_select(){
   pid = $('.st_test_0').first().attr('id');
   $('#'+pid).click();
   }
   
   $( document ).ready(function() {
   
   delete_self_page();
   delete_self();
   
   $('#session_p').val($('#page_id').val());
   $('#session_c').val($('#chapter_id').val());
   
   if($('#course_id').val()!=''&&$('#course_id').val()!=null){
   formData = "activity=view_chapter_and_page&course_id="+$('#course_id').val();
   view_function(formData, 'view_chapter_and_page', 'all_cp_page');  
   }
   
   $('#text_from_title').on('click', function(){
   pre_title = $('#text_from_title').val();
   $('#set_pre_title').val(pre_title);
   });
   
   $('.sidemenuhead').on('click', function(){
   formData = "activity=view_chapter";
   view_function(formData, 'view_chapter_page', 'allchapter');
   });
   
   $('.sidemenuhead').on('click', function(){
   
   formData = "activity=view_chapter";
   view_function(formData, 'view_chapter', 'allchapter');
   });
   
   });
   
   
   function view_function(formData, functionName, className){
   
   if(functionName == 'view_chapter_and_page'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: {'course_id':$('#course_id').val()},
       success: function(data){
           //alert($('#course_id').val());
           loaderStop();
           $('.'+className).html(data);
           mysortable();
           addblackchapter();
       }
   });
   }
   
   if(functionName == 'view_chapter'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       success: function(data){
           loaderStop();
           $('.'+className).html(data);
           cid = $('#chapter_id').val();
           chapter_id = cid;
           if(cid > 0){
               $('#'+cid).click();
           }else{
               sid = $('input:radio').last().attr('id');
               $('#'+sid).click();
           }
       }
   });
   }
   
   if(functionName == 'view_chapter_page'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       success: function(data){
           loaderStop();
           $('.'+className).html(data);
           first_select();
           pid = $('#page_id').val();
           chapter_id = pid;
           if(pid > 0){
   
               $('#'+pid).click();
               //$('#page_id').val(0);
               //clearSeesion = $('#page_id');
           }
       }
   });
   }
   
   if(functionName == 'view_exam_page'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       success: function(data){
           loaderStop();
           $('#exam_page_title').val(data.title);
           for(var i = 0;i < document.getElementById("exam_id").length;i++){
               if(document.getElementById("exam_id").options[i].value == data.exam_id ){
                   document.getElementById("exam_id").selectedIndex = i;
               }
           }
           $('#exam_max_num').val(data.exam_max_num);
           $('.modal-create-confirm').html('Update');
           $('.create-exam').click();
       }
   });
   }
   
   if(functionName == 'view_quiz_page'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       success: function(data){
           loaderStop();
           $('#quiz_page_title').val(data.title);
           for(var i = 0;i < document.getElementById("quiz_id").length;i++){
               if(document.getElementById("quiz_id").options[i].value == data.quiz_id ){
                   document.getElementById("quiz_id").selectedIndex = i;
               }
           }
           for(var i = 0;i < document.getElementById("quiz_chapter_id").length;i++){
               if(document.getElementById("quiz_chapter_id").options[i].value == data.parent ){
                   document.getElementById("quiz_chapter_id").selectedIndex = i;
               }
           }
   
           $("#quiz_chapter_id").trigger('change');
           for(var i = 0;i < document.getElementById("relative_page_id").length;i++){
               if(document.getElementById("relative_page_id").options[i].value == data.relative_page_id ){
                   document.getElementById("relative_page_id").selectedIndex = i;
               }
           }
           $('#attempt_num').val(data.attempt_num);
           $('.modal-create-quiz').html('Update');
           $('#quiz_chapter_id').prop('disabled', true);
           $('.create-quiz').click();
       }
   });
   }
   
   if(functionName == 'view_only_chapter_page'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       success: function(data){
           $('.'+className).html(data);
           pid = $('#page_id').val();
           chapter_id = pid;
           if(pid > 0){
               $('#'+pid).click();
               //$('#page_id').val(0);
   
           }
   
       }
   });
   }
   
   if (functionName == 'view_only_chapter_page1'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       success: function(data){
           $('.'+className).html(data);
   
           cid = $('#chapter_id').val();
           if(cid > 0){
               $('#chbtn_'+cid).click();
               //$('#chapter_id').val(0);
   
           }
       }
   });
   }
   
   }
   
   function single_view_function(formData, functionName, className){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
   url: url,
   type: 'POST',
   data: formData,
   dataType : 'json',
   success: function(data) {
       loaderStop();
       $('#text_from_title').val(data.title);
       $('#text_from_title').attr('data-id', data.chapter_id);
       $('#txt_detail_id').val(data.chapter_id);
       $('#chapter_id').val(data.chapter_id);
   
       chapter_id = data.chapter_id;
   
   //                CKEDITOR.instances['editor1'].setData(data.description);
   }
   });
   }
   
   function btnCreateChapter(){
   create_type = "chapter";
   $.ajax({
   url: "<?php echo base_url() ?>admin/demand/create_temp_chapter",
   type: 'POST',
   data: {'course_id':$('#course_id').val()},
   dataType : 'json',
   success: function(data){
       //  console.log(data);
       if(data.status == "success"){
           //location.reload();
           if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
           $("#w4-content-new-page").addClass("active show");
           $("#state_now").val('chapter');
           chaps = $('#new_chap').val();
           if(chaps){
               add_new_chap = 'Chapter ';
               add_new_detail = '';
           }
           formData = "activity=view_chapter&add_new_chap="+add_new_chap+"&course_id="+$('#course_id').val();
           view_function(formData, 'view_chapter', 'allchapter');
       }else{
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
           });
       }
   }
   });
   }
   
   function btnCreatePage(){
   create_type = "page";
   $.ajax({
   url: '<?php echo base_url() ?>admin/demand/create_temp_page',
   type: 'POST',
   data: {'course_id':$('#course_id').val(), 'page_type':$('#page_type').val()},
   dataType : 'json',
   success: function(data){
       // console.log(data);
       if(data.status == "success"){
           if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
           $("#w4-content-new-page").addClass("active show");
           $("#state_now").val('page');
           formData = "activity=view_chapter&course_id="+$('#course_id').val();
           view_function(formData, 'view_chapter_page', 'allchapter');
           $.magnificPopup.close();
       }else{
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
               type: 'error'
           });
           $.magnificPopup.close();
       }
   }
   });
   
   }
   
   function btnCreatePageWithID(){
   loaderStart();
   $.ajax({
   url: '<?php echo base_url() ?>admin/demand/create_temp_page_id',
   type: 'POST',
   data: {'parent':$('#chapter_id').val(), 'course_id':$('#course_id').val(), 'page_type':$('#page_type_with').val()},
   dataType : 'json',
   success: function(data){
       loaderStop();
       $("#state_now").val('page');
       if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
		   $("#w4-content-new-page").addClass("active show");
		   formData = "activity=view_chapter&course_id="+$('#course_id').val();
		   view_function(formData, 'view_chapter_page', 'allchapter');
		   $.magnificPopup.close();
	   }
   });
   
   }
   
   function btnEditChapter(){
   
   if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
   $("#w4-content-new-page").addClass("active show");
   
   $("#state_now").val('chapter');
   
   chaps = $('#new_chap').val();
   if(chaps){
   add_new_chap = 'Chapter ';
   add_new_detail = '';
   }
   formData = "activity=view_chapter&add_new_chap="+add_new_chap+"&course_id="+$('#course_id').val();
   view_function(formData, 'view_chapter', 'allchapter');
   
   }
   
   function btnEditpage(){
   
   if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
   $("#w4-content-new-page").addClass("active show");
   $("#state_now").val('page');
   formData = "activity=view_chapter&course_id="+$('#course_id').val()
   view_function(formData, 'view_chapter_page', 'allchapter');
   }
   
   function btnEditexampage(){
   
   if($("#w4-content-new-page").hasClass("active show")) $("#w4-content").removeClass("active show");
   $("#w4-content").addClass("active show");
   $("#state_now").val('');
   formData = "activity=view_chapter&course_id="+$('#course_id').val()+"&page_id="+$('#chapter_id').val();
   view_function(formData, 'view_exam_page', 'allchapter');
   }
   
   function btnEditquizpage(){
   $("#quiz_chapter_id").trigger('change');
   if($("#w4-content-new-page").hasClass("active show")) $("#w4-content").removeClass("active show");
   $("#w4-content").addClass("active show");
   $("#state_now").val('');
   formData = "activity=view_chapter&course_id="+$('#course_id').val()+"&page_id="+$('#page_id').val()+"&relative_page_id="+$('#relative_page_id').val();
   view_function(formData, 'view_quiz_page', 'allchapter');
   }
   
   function loaderStart(){
   jQuery("#status").fadeIn();
   jQuery("#preloader").fadeIn();
   }
   
   function loaderStop(){
   jQuery("#status").fadeOut();
   jQuery("#preloader").delay(1000).fadeOut("slow");
   }
   
   mysortable();
   function mysortable(){
   $(function() {
   var oldList, newList, item;
   $('.my-sortable').sortable({
       start: function(event, ui) {
           item = ui.item;
           newList = oldList = ui.item.parent().parent();
           ui.item.startPos = ui.item.index();
       },
       stop: function(event, ui) {
   
           var chap_id = ui.item.attr('data-cid');
           var start_pos = ui.item.startPos;
           var new_pos = ui.item.index();
           updateChapterPostion(chap_id,start_pos,new_pos);
       },
       change: function(event, ui) {
           if(ui.sender) newList = ui.placeholder.parent().parent();
       },
       connectWith: ".my-sortable"
   }).disableSelection();
   });
   
   $(function() {
   var oldList, newList, item;
   $('.my-sortable1').sortable({
       start: function(event, ui) {
           item = ui.item;
           newList = oldList = ui.item.parent().parent();
           ui.item.startPos = ui.item.index();
   
           cpList = ui.item.parent().parent().index();
           ui.item.startpos1 = ui.item.parent().parent().index();
           //   console.log(ui.item.startpos1);
       },
       stop: function(event, ui) {
   
           var newpos1 = ui.item.parent().parent().index();
           var startpos1 = ui.item.startpos1;
           var chapid = ui.item.attr('data-cid');
           var pageid = ui.item.attr('data-id');
           var startpos = ui.item.startPos;
           var newpos = ui.item.index();
           //	console.log(startpos1 +' ==  '+newpos1);
           if(newpos1 == startpos1){
               updatePagePostion(pageid,chapid,startpos,newpos);
           }else{
   
               var newchapid = ui.item.parent().parent().attr('data-cid');
               updatePageOtherChapterPostion(pageid,chapid,newchapid,startpos,newpos);
   
           }
   
       },
       change: function(event, ui) {
           if(ui.sender) newList = ui.placeholder.parent().parent();
       },
       connectWith: ".my-sortable1"
   }).disableSelection();
   });
   
   //onhover
   $( ".items" ).hover(
   function() {
   
       $( this ).prepend( $( '<span style=" width: 20%; float:right; margin-right:-250px; border: 1px solid;margin: auto;padding: 0px 5px 8px 3px; background: #fbfbfb;border-color: #d7d7d7; float:right; margin-left:20px">'+
	   ' <a href="javascript:void(0)" onclick="statusFun(this);" style="font-size:10px">'+$(this).closest('li').attr("data-status")+'</a>'+
           ' <a href="javascript:void(0)" onclick="editFun(this);" style="font-size:10px"><img src="<?php echo base_url()?>assets/img/edit.png" style="width:12%"> Edit Page</a>'+
           ' <a href="javascript:void(0)" onclick="removeFun(this);" style="font-size:10px"><img src="<?php echo base_url()?>assets/img/garbage.png" style="width:12%">Delete Page</a>'+
           '</span>' ) );
	   }, function() {
		   $( this ).find( "span:last" ).remove();
	   }
   );
   
   }
   
	function statusFun(elm){
	   loaderStart();
	   var rowstatus = 'Deactivate';
	   var pageid = $(elm).closest('li').attr("data-id");
	   var chapid = $(elm).closest('li').attr("data-cid");
	   if(pageid !='' && pageid > 0)  {
	   
		   $('#page_id').val(pageid);
		   chapter_id = pageid;
		   
		   $.ajax({
			   url: $('#base_url').val()+'admin/demand/update_row',
			   type: 'POST',
			   data: {'page_id':pageid},
			   success: function (data, status, xhr) {
					if(data == 0){
						rowstatus = 'Activate';
					}			  	
					$(elm).closest('li').attr("data-status",rowstatus);
					alert("Status change successfully"); 
				   },
		   });
		   
		}else{
		   
		   $('#chapter_id').val(chapid);
		   chapter_id = chapid;
		   
		   $.ajax({
			   url: $('#base_url').val()+'admin/demand/update_row',
			   type: 'POST',
			   data: {'page_id':chapid},
			   success: function (data, status, xhr) {
					if(data == 0){
						rowstatus = 'Activate';
					}			  	
					$(elm).closest('li').attr("data-status",rowstatus);
					alert("Status change successfully"); 
			   },
		   });
		   
		}
	}
   
   function editFun(elm){
   loaderStart();
   var pageid = $(elm).closest('li').attr("data-id");
   var chapid = $(elm).closest('li').attr("data-cid");
   if(pageid !='' && pageid > 0)  {
   
   $('#page_id').val(pageid);
   chapter_id = pageid;
   
   $.ajax({
       url: $('#base_url').val()+'admin/demand/check_exam_page',
       type: 'POST',
       data: {'page_id':pageid},
       success: function (data, status, xhr) {
           if(data == '2'){
               btnEditquizpage();
           }else{
               btnEditpage();
           }
       },
   });
   
   
   }else{
   
   $('#chapter_id').val(chapid);
   chapter_id = chapid;
   
   $.ajax({
       url: $('#base_url').val()+'admin/demand/check_exam_page',
       type: 'POST',
       data: {'page_id':chapid},
       success: function (data, status, xhr) {
           if(data == '1'){
               btnEditexampage();
           }else{
               btnEditChapter();
           }
       },
   });
   
   }
   }
   
   function removeFun(elm){
   loaderStart();
   var pageid = $(elm).closest('li').attr("data-id");
   var chapid = $(elm).closest('li').attr("data-cid");
   if(pageid !='' && pageid > 0)  {
   formData = "activity=remove_page&pid="+pageid+'&cid='+chapid+"&course_id="+$('#course_id').val();
   save_function(formData, 'remove_page', 'ptitle');
   }else{
   formData = "activity=remove_chapter&cid="+chapid+"&course_id="+$('#course_id').val();
   save_function(formData, 'remove_chapter', 'ptitle');
   }
   }
   
   function copyFun(elm){
   //loaderStart();
   var pageid = $(elm).closest('li').attr("data-id");
   var chapid = $(elm).closest('li').attr("data-cid");
   if(pageid !='' && pageid > 0)  {
   formData = "activity=copied_page&pid="+pageid+"&course_id="+$('#course_id').val();
   
   save_function(formData, 'copied_page', 'ptitle');
   }else{
   formData = "activity=copied_chapter&cid="+chapid+"&course_id="+$('#course_id').val();
   
   save_function(formData, 'copied_chapter', 'ptitle');
   }
   }
   
   function previewFun(elm) {
   var pageid = $(elm).closest('li').attr("data-id");
   var chapid = $(elm).closest('li').attr("data-cid");
   if(pageid !='' && pageid > 0)  {
   $('#page_id').val(pageid);
   chapter_id = pageid;
   btnCreateChapter();
   }else{
   $('#chapter_id').val(chapid);
   chapter_id = chapid;
   btnCreateChapter();
   }
   }
   
   function view_Pages() {
   if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
   $("#w4-content-new-page").addClass("active show");
   $("#state_now").val('page');
   formData = "activity=view_chapter&course_id="+$('#course_id').val();
   view_function(formData, 'view_only_chapter_page', 'allchapter');
   }
   
   function view_Chapters(){
   if($("#w4-content").hasClass("active show")) $("#w4-content").removeClass("active show");
   $("#w4-content-new-page").addClass("active show");
   $("#state_now").val('chapter');
   formData = "activity=view_chapter&course_id="+$('#course_id').val();
   view_function(formData, 'view_only_chapter_page1', 'allchapter');
   }
   
   function new_page(cid, pid = 0){
   $('input').removeClass('active');
   $('.cptitle_btn').attr('type', 'radio');
   $('.cpPage_btn').attr('type', 'radio');
   $('.cptitle_btn').prop('checked', false);
   
   $('.cpPage_btn').prop('checked', false);
   
   $('.page_v').show();
   $('#chbtn_'+cid). prop("checked", true);
   $('#text_from_title').attr('data-id', pid);
   $('#text_from_title').val('Page Title');
   //        CKEDITOR.instances['editor1'].setData('Add txt here...');
   //$("#chng_id").attr('onclick','btnCreatePage('+cid+')');
   $('#cp_id').val(cid);
   $('#p_id').val(0);
   }
   
   function new_page_view(cid, pid = 0){
   $('input').removeClass('active');
   $('.cptitle_btn').attr('type', 'radio');
   $('.cpPage_btn').attr('type', 'radio');
   //$('.cptitle_btn').prop('checked', false);
   $('.cpPage_btn').prop('checked', false);
   //$('.cpPage_btn').prop('checked', false);
   
   $('.page_v').show();
   $('#chbtn_'+cid). prop("checked", true);
   $('#text_from_title').attr('data-id', pid);
   $('#text_from_title').val('Page Title');
   $('#chapter_id').val(cid);
   chapter_id = cid;
   
   $('#chbtn_'+cid).addClass('active');
   //        CKEDITOR.instances['editor1'].setData('Add txt here...');
   //$("#chng_id").attr('onclick','btnCreatePage('+cid+')');
   $('#cp_id').val(cid);
   $('#p_id').val(0);
   }
   
   function new_chapter(id){
   btn_func(id);
   var chapter_title = $('#added_'+id).attr('data-title');
   var chapter_detail = $('#added_'+id).attr('data-detail');
   
   $('#text_from_title').val(chapter_title);
   $('#text_from_title').attr('data-id', id);
   if(chapter_detail){
   //            CKEDITOR.instances['editor1'].setData(chapter_detail);
   }
   
   }
   
   function show_library_btn_func() {
   $('#library_btn').removeClass('hidden');
   $("#div_container").addClass('hidden');
   $("#show_library_btn").addClass('hidden');
   }
   
   function page_view(id){
   //chapter_id = id;
   
   create_type = "page";
   
   $("#lid").val(0);
   $('#datatable').DataTable().ajax.reload('', false);
   $('input').removeClass('active');
   
   $('.cptitle_btn').attr('type', 'radio');
   $('.cpPage_btn').attr('type', 'radio');
   
   $('.cptitle_btn').prop('checked', false);
   
   //$('.cptitle_btn').prop('checked', false);
   //$('.cpPage_btn').prop('checked', false);
   $('.page_v').show();
   $('#page_id').val(id);
   $('#p_id').val(id);
   pageTitle = $('#'+id).attr('data-title');
   cid = $('#'+id).attr('data-cid');
   $('#'+id).addClass('active');
   pageDetail = $('#'+id).attr('data-detail');
   $('#text_from_title').attr('data-id', id);
   $('#text_from_title').val(pageTitle);
   $('#chapter_id').val(cid);
   chapter_id = cid;
   $('#cp_id').val(cid);
   //        CKEDITOR.instances['editor1'].setData(pageDetail);
   library_id = $('#'+id).attr('data-library');
   var html_container = "<div class='whitePanel'><div class='book_container'><div id='book'></div></div></div>";
   
   $.ajax({
   url: '<?php echo base_url() ?>admin/library/getPathById',
   type: 'POST',
   data: {'id': library_id},
   success: function (data, status, xhr) {
       if(data != "" && data != null){
           $("#div_container").html(html_container);
           $('#library_btn').addClass('hidden');
           $("#div_container").removeClass('hidden');
           $("#show_library_btn").removeClass('hidden');
           if (data.indexOf(".pdf") > 0){
               $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>admin/flipbook/view_book/'+library_id+"></iframe>");
           }else{
               $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>'+data+"></iframe>");
           }
       }else{
           $('#library_btn').removeClass('hidden');
           $("#div_container").addClass('hidden');
           $("#show_library_btn").addClass('hidden');
       }
   
   },
   
   });
   
   
   }
   
   function chapter_view(cid){
   $.ajax({
   url: '<?php echo base_url() ?>admin/demand/getSessionDateTime',
   type: 'POST',
   data: {'id':cid},
   dataType : 'json',
   success: function(data){
       var len = data.length;
               for(var i=0; i<len; i++){
   				var session_dateTime = data[i].session_dateTime;
   				if(session_dateTime){
   					document.getElementById("form_datetimeId").value = session_dateTime;
   				}else{
   					document.getElementById("form_datetimeId").value = '';
   				}
   				
   			}
   } 
   });
   create_type = "chapter";
   
   chapter_id = cid;
   $("#lid").val(0);
   $('#datatable').DataTable().ajax.reload('', false);
   btn_func(cid);
   loaderStart();
   formData = "activity=select_chapter&cid="+cid+"&course_id="+$('#course_id').val();
   single_view_function(formData, 'single_view_chapter', 'ch_detail');
   //$("#chng_id").attr('onclick','btnCreatePage('+cid+')');
   library_id = $('#'+cid).attr('data-library');
   var html_container = "<div class='whitePanel'><div class='book_container'><div id='book'></div></div></div>";
   
   $.ajax({
   url: '<?php echo base_url() ?>admin/library/getPathById',
   type: 'POST',
   data: {'id': library_id},
   success: function (data, status, xhr) {
       if(data != "" && data != null){
           $("#div_container").html(html_container);
           $('#library_btn').addClass('hidden');
           $("#div_container").removeClass('hidden');
           $("#show_library_btn").removeClass('hidden');
           if (data.indexOf(".pdf") > 0){
               $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>admin/flipbook/view_book/'+library_id+"></iframe>");
           }else{
               $("#div_container").html("<iframe style='width: 100%' id='course_container' src = "+'<?php echo base_url()?>'+data+"></iframe>");
           }
       }else{
           $('#library_btn').removeClass('hidden');
           $("#div_container").addClass('hidden');
           $("#show_library_btn").addClass('hidden');
       }
   
   },
   
   });
   }
   
   function page_view_demo_page(id){
   $('#p_id').val(id);
   pageTitle = $('#'+id).attr('data-title');
   cid = $('#'+id).attr('data-cid');
   $('#chbtn_'+cid). prop("checked", true);
   
   pageDetail = $('#'+id).attr('data-detail');
   
   $('#text_from_title').attr('data-id', id);
   $('#text_from_title').val(pageTitle);
   $('#cp_id').val(cid);
   $('#txt_form_detail').html(pageDetail);
   
   
   }
   
   function page_view_demo_chpater(id){
   $('input').removeClass('active');
   
   $('.cptitle_btn').attr('type', 'radio');
   $('.cpPage_btn').attr('type', 'radio');
   $('.cptitle_btn').prop('checked', false);
   $('.cpPage_btn').prop('checked', false);
   
   $('#'+id).addClass('active');
   
   ctitle = $('#'+id).attr('data-title');
   cdetail = $('#'+id).attr('data-detail');
   
   $('#text_from_title').val(ctitle);
   $('#txt_from_detail').html(cdetail);
   
   }
   
   function updatePagePostion(pageid,chapid,startpos,newpos){
   //loaderStart();
   formData = "activity=page_moved&pid="+pageid+'&cid='+chapid+'&startpos='+startpos+'&newpos='+newpos+"&course_id="+$('#course_id').val();
   save_function(formData, 'page_moved', 'ptitle');
   }
   
   function updateChapterPostion(chapid,startpos,newpos){
   //	loaderStart();
   formData = 'activity=chapter_moved&cid='+chapid+'&startpos='+startpos+'&newpos='+newpos+"&course_id="+$('#course_id').val();
   save_function(formData, 'chapter_moved', 'ptitle');
   }
   
   function updatePageOtherChapterPostion(pageid,chapid,newchapid,startpos,newpos){
   //	loaderStart();
   formData = "activity=page_moved&pid="+pageid+'&cid='+chapid+'&startpos='+startpos+'&newpos='+newpos+'&newcid='+newchapid+"&course_id="+$('#course_id').val();
   save_function(formData, 'page_chapter_moved', 'ptitle');
   
   }
   
   function remove_chapter(cid){
   loaderStart();
   formData = "activity=remove_chapter&cid="+cid+"&course_id="+$('#course_id').val();
   save_function(formData, 'remove_chapter', 'ptitle');
   }
   
   function remove_page(pid, cid){
   loaderStart();
   formData = "activity=remove_page&pid="+pid+'&cid='+cid+"&course_id="+$('#course_id').val();
   save_function(formData, 'remove_page', 'ptitle');
   }
   
   function save_function(formData, functionName, className){
   
   if($('#state_now').val() == 'page'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       dataType : 'json',
       success: function(data){
           loaderStop();
           if(data.status == "success"){
               // $('.'+className).html(data.response);
               formData = "activity=view_chapter&course_id="+$('#course_id').val();;
               view_function(formData, 'view_chapter_page', 'allchapter');
   
           }else{
               //console.log(data.msg);
           }
       }
   
   });
   
   }
   if($('#state_now').val() == 'chapter'){
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       dataType : 'json',
       success: function(data){
           loaderStop();
           if(data.status == "success"){
               //$('.'+className).html(data.response);
               formData = "activity=view_chapter&course_id="+$('#course_id').val();;
               view_function(formData, 'view_chapter', 'allchapter');
           }else{
               console.log(data.msg);
           }
       }
   });
   }
   if($('#state_now').val() == ''){
   if($("li").hasClass("box_area2")){
       $('.box_area2').removeClass('box_area1');
       $('.box_area2').html('');
   }
   var url = "<?php echo base_url() ?>admin/demand/"+functionName;
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       dataType : 'json',
       success: function(data){
           loaderStop();
           if(data.status == "success"){
               formData = "activity=view_chapter_and_page&course_id="+$('#course_id').val();
               view_function(formData, 'view_chapter_and_page', 'all_cp_page');
           }else{
           }
       }
   });
   }
   
   }
   
   function delete_self(){
   $.ajax({
   url: '<?php echo base_url() ?>admin/demand/delete_self',
   type: 'POST',
   data: {'create_chapter':'chapter', 'course_id':$('#course_id').val()},
   dataType : 'json',
   success: function(data){
       if(data.success === "true"){
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: '<?php echo $term['succesfullyadded']; ?>',
               type: 'success'
           });
       }else{
           new PNotify({
               title: '<?php echo $term['error']; ?>',
               text: 'There is some error.',
               type: 'failed'
           });
       }
   }
   });
   }
   
   function delete_self_page(){
   $.ajax({
   url: '<?php echo base_url() ?>admin/demand/delete_self_page',
   type: 'POST',
   data: {'create_chapter':'chapter','course_id':$('#course_id').val()},
   dataType : 'json',
   success: function(data){
       if(data.success === "true"){
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: '<?php echo $term['succesfullyadded']; ?>',
               type: 'success'
           });
       }else{
       }
       new PNotify({
           title: '<?php echo $term['error']; ?>',
           text: 'There is some error.',
           type: 'failed'
       });
   }
   });
   }
   
   function save_page(id){
   loaderStart();
   pageTitle = $('#'+id).val();
   pid = $('#'+id).attr('data-id');
   cid = $('#cp_id').val();
   formData = "activity=add_page&page_title="+pageTitle+"&cid="+cid+"&pid="+pid+"&course_id="+$('#course_id').val();
   save_function(formData, 'save_page', 'ptitle');
   }
   
   function save_chapter(id){
   loaderStart();
   chapter = $('#'+id).val();
   cid = $('#'+id).attr('data-id');
   pre_title = $('#set_pre_title').val();
   
   formData = "activity=add_chapter&title="+chapter+"&cid="+cid+"&pre_title="+pre_title+"&course_id="+$('#course_id').val();
   save_function(formData, 'save_chapter', 'ctitle');
   }
   
   function save_now(){
   loaderStart();
   
   var url = "<?php echo base_url() ?>admin/demand/update_chapter_detail";
   $.ajax({
   url: url,
   type: 'POST',
   data: {'course_id':$('#course_id').val(),'session_dateTime':$('.form_datetime').val()},
   dataType : 'json',
   success: function(data){
       new PNotify({
           title: '<?php echo $term['success']; ?>',
           text: '<?php echo $term['succesfullyadded']; ?>',
           type: 'success'
       });
       page_updated();
   }
   });
   }
   
   function addblackchapter(){
   
   formData = "activity=page_available&course_id="+$('#course_id').val();
   var url = "<?php echo base_url() ?>admin/demand/page_available";
   $.ajax({
   url: url,
   type: 'POST',
   data: formData,
   dataType : 'json',
   success: function(data){
       console.log(data);
       if(data.status == 'success'){
           if($("li").hasClass("box_area2")){
               $('.box_area2').addClass('box_area1');
               $('.box_area2').html('<p style="margin-top: 22px;"> <img src="<?php echo base_url() ?>assets/img/arrow_left.png" style="height:24px;width:24px;">Click or drag &amp; drop a page type from the left menu to add pages</p>');
           }
       }else{
           $('.box_area2').removeClass('box_area1');
           $('.box_area2').html('');
       }
   }
   });
   }
   
   function viewList() {
   window.location.href= '<?php echo base_url() ?>admin/demand/edit_course_tab/'+$('#course_id').val()+'/2';
   }
   
   function btn_func(id){
   $('.cpPage_btn').removeClass('active');
   $('input').removeClass('active');
   $('.cptitle_btn').attr('type', 'radio');
   $('.cpPage_btn').attr('type', 'radio');
   
   $('#'+id).addClass('active');
   }
   
   function page_updated(){
   formData = "activity=update_chapterpage_detail&course_id="+$('#course_id').val();
   var url = "<?php echo base_url() ?>admin/demand/update_page_detail";
   $.ajax({
   url: url,
   type: 'POST',
   data: formData,
   dataType : 'json',
   success: function(data){
       loaderStop();
       new PNotify({
           title: '<?php echo $term['success']; ?>',
           text: 'Success Page Added.',
           type: 'success'
       });
       viewList();
   }
   });
   }
   
   function library_reload(id){
   $("#lid").val(id);
   $('#datatable').DataTable().ajax.reload('', false);
   }
   
   function library_insert(id){
   if ($("#chapter_id").val() == 0 && $("#chapter_id").val() == "" && $("#page_id").val() == 0 && $("#page_id").val() == ""){
   swal({
       text: "At first you have to add a chapter or page!",
       icon: "warning"
   });
   return;
   }else{
   $("#library_id").val(id);
   if (create_type == "chapter"){
       $("#select_id").val($("#chapter_id").val());
   }else{
       $("#select_id").val($("#page_id").val());
   }
   
   var library_form_data = new FormData($("#form_library_insert")[0]);
   $.ajax({
       url:  '<?=base_url()?>admin/demand/insert_library',
       type: 'POST',
       data: library_form_data,
       processData:false,
       contentType: false,
       success: function(data){
           new PNotify({
               title: '<?php echo $term['success']; ?>',
               text: 'Success Library Insert.',
               type: 'success'
           });
       }
   });
   $("#library_modal").modal("hide");
   save_now();
   
   }
   }
   
   jQuery(document).ready(function() {
   
   $('#datatable').DataTable({
   "ordering": false,
   "info": false,
   "searching": false,
   "fnServerParams": function (aoData) {
       aoData.push({"name": "parent_id", "value": $("#lid").val()});
   },
   "ajax": {
       "type": "POST",
       "async": true,
       "url":$('#base_url').val() +"admin/library/view",
       "dataSrc": "data",
       "dataType": "json",
       "cache":    false
   },
   "columnDefs": [
       {
           "targets": [1],
           "createdCell": function (td, cellData, rowData, row, col) {
               if(rowData.file_type == 'DIRECTORY'){
                   $(td).html('<a href="javascript:library_reload('+rowData.id+')">'+rowData.name+'</a>') ;
               } else {
                   $(td).html('<a>'+rowData.name+'</a>');
               }
   
           }
       },{
           "targets": [4],
           "createdCell": function (td, cellData, rowData, row, col) {
               if(rowData.file_type == 'DIRECTORY'){
                   $(td).html('');
               } else {
                   $(td).html('<a onclick="library_insert('+rowData.id+')" class="btn btn-default"><?=$term["add"]?></a>');
               }
           }
   
       }],
   "columns": [
       { "title": "#", "data": "no", "class": "center", "width":20 },
       { "title": "<?=$term["name"]?>", "data": "name", "class": "text-left", "width":"*" },
       { "title": "<?=$term["filetype"]?>", "data": "file_type", "class": "text-left", "width":80},
       { "title": "<?=$term["date"]?>", "data": "reg_date", "class": "text-center", "width":110 },
       { "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":80 }
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
   "pageLength": 10, // default record count per page
   sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
   bProcessing: true
   });
   
   $('.datepicker').datepicker({
       minDate:new Date(),
       autoclose: true
   });
   
   
   });
   
   $('#category_id').on('change',function(){
   	get_standard_list($('#category_id').val());
   });
   //get_standard_list($("#category_id option:selected" ).val());
   
   function get_standard_list(id){
	   $('#standard_id').empty();
	   //var standard_id = <?php echo isset($course_data['standard_id'])?$course_data['standard_id']:0;?>;
	   $.ajax({
	   url: '<?php echo base_url() ?>admin/category/getStandardList',
	   type: 'POST',
	   data: {category_id:id},
	   dataType : 'json',
	   success: function (data, status, xhr) { 
		   var standard = data.data;
		   html = '';
		   for (var i = 0; i < standard.length; i++) {
				html += '<option value="'+standard[i].id+'">'+standard[i].name+'</option>';			   
		   };
		   $('#standard_id').append(html);
	   },
   });   
}   
</script>