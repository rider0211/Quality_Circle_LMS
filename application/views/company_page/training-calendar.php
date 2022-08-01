
<style>
    td:hover{
        background: grey;
    }
    .datepicker> .datepicker-days{
        display: initial;
    }

    .btn-primary {
        color: #fff !important;
        background-color: #337ab7 !important;
        border-color: #2e6da4 !important;
    }

</style>

<section role="main" class="content-body">
    <!--<header class="page-header">
        <h2><?=$term["instructorledtraining"]?></h2>

        <div class="right-wrapper">
        </div>
    </header>-->

    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">

                        <!--<a class="modal-with-form add-column" href="#modalFormNewColumn" >
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["addnewcolumn"]?></button>
                        </a>-->
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
                                                <input type="text" id="title_1" name="title_1" class="form-control" required>
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
                                            <label class="col-sm-2 control-label text-lg-right pt-2"><?=$term["title"]?></label>
                                            <div class="col-sm-4">
                                                <input type="text" id="title" name="title" class="form-control" required>
                                            </div>
                                            <label class="col-sm-2 control-label text-lg-right pt-2">Duration(day)</label>
                                            <div class="col-sm-4">
                                                <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 30 }">
                                                    <div class="input-group" style="width:150px;">
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

                                        <div class="form-group row div-startday">
                                            <label class="col-lg-3 control-label text-lg-right pt-2"><?=$term["startday"]?></label>
                                            <div class="col-lg-9">
                                                <div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="fas fa-calendar-alt"></i>
															</span>
														</span>
                                                    <input type="text" data-plugin-datepicker="" value="" class="form-control" id="startday" name="startday" data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term['course']?></label>
                                            <div class="col-sm-9">

                                                <select  class="form-control" id="category_id" name="category_id">
                                                    <?php foreach($category as $item){ ?>
                                                        <option value="<?php echo $item->id; ?>">
                                                            <?php echo $item->title; ?>
                                                         </option>
                                                    <?php }  ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row div-location">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["location"]?></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3"  id="location" name="location"></textarea>

                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["learningobjectives"]?></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" data-plugin-markdown-editor rows="3"   id="objective" name="objective"></textarea>

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
                                                <textarea class="form-control" data-plugin-markdown-editor rows="3"   id="attend" name="attend"></textarea>

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
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["agend"]?></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" data-plugin-markdown-editor rows="3"   id="agenda" name="agenda"></textarea>

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
                                            <label class="col-sm-3 control-label text-lg-right pt-2">description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" data-plugin-markdown-editor rows="3"   id="description" name="description"></textarea>

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
                                                <button class="btn btn-default modal-create-dismiss"><?=$term["cancel"]?></button>
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
                                <input type="hidden" id="change_id" name="change_id" class="form-control" >
                                <input type="hidden" id="time_id" name="time_id" class="form-control" >
                                <section class="card">
                                    <header class="card-header">
                                        <h2 class="card-title"><?=$term["changetime"]?></h2>
                                    </header>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["location"]?></label>
                                            <div class="col-sm-6">
                                                <input type="text" id="change_location" name="change_location" class="form-control" required>
                                            </div>

                                        </div>
                                        <input class="hidden" name = "year" id="change_year">
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["month"]?></label>
                                            <div class="col-sm-6">
                                                <select class="form-control mb3" id="change_month" name="change_month" >
                                                    <option value='1'>Jan</option>
                                                    <option value='2'>Feb</option>
                                                    <option value='3'>Mar</option>
                                                    <option value='4'>Apr</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>Jun</option>
                                                    <option value='7'>Jul</option>
                                                    <option value='8'>Aug</option>
                                                    <option value='9'>Sep</option>
                                                    <option value='10'>Oct</option>
                                                    <option value='11'>Nov</option>
                                                    <option value='12'>Dec</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label text-lg-right pt-2">Start Day</label>
                                            <div class="col-sm-6">
                                                <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 30 }">
                                                    <div class="input-group" style="width:150px;">
                                                        <input type="text" id="change_day" name="change_day" class="spinner-input form-control" maxlength="2" >
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
                    <input type="hidden" name="dis_month" id="dis_month" value="<?=$dis_month?>">
                    <table class="table table-responsive-md  mb-0 table-bordered">
                        <tr>
                            <th rowspan="2" width="20%" class="center"><?=$term["nameofprogramme"]?></th>
                            <th rowspan="2" width="5%" class="center"><?=$term["courseduration"]?></th>
                            <th colspan="12" width="75%" class="center"><?=$term["dateofprogramme"]?></th>
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
                                if ($current_month > 12){
                                    $current_month = $current_month - 12;
                                    $current_year = $current_year + 1;
                                }
                                
                            }
                            ?>
                        </tr>
                        <?php
                        foreach ($course_list as $key => $rows) {
                            ?>
                            <tr>
                                <td><a href="javascript:updateCourse(<?=$key?>, '<?=$rows['title']?>', <?=$rows['duration']?>, '<?=$rows['objective']?>','<?=base_url($rows['objective_img'])?>','<?=$rows['objective_img']?>', '<?=$rows['attend']?>', '<?=base_url($rows['attend_img'])?>','<?=$rows['attend_img']?>', '<?=$rows['agenda']?>','<?=base_url($rows['agenda_img'])?>', '<?=$rows['agenda_img']?>', '<?=$rows['course_id']?>', '<?=$rows['description']?>')"><?=$rows['title']?></a></td>
                                <td><?=$rows['duration']?></td>
                                <?php
                                $current_month = intval(date("m")) +$dis_month;
                                $current_year = intval(date("Y"));
                                if ($current_month < 1){
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
                                            <td  onclick="javascript:addTime(<?=$key?>,<?=$current_month?>,<?=$current_year?>)">

                                                <?php foreach ($r  as $n => $j){
                                                    
                                                    if($j['year'] == $current_year){?>

                                                    <a class="btn btn-xs btn-primary " href="javascript:updateTime(<?=$key?>,<?=$j['month']?>,<?=$j['sday']?>, '<?=$j['location']?>', <?=$j['id']?>,<?=$current_year?>)" style="font-size: 8px; color: white">
                                                        <?= $j['sday'] ?> -
                                                        <?php
                                                        $timestamp = mktime(0, 0, 0, $current_month, 1, intval(date("y")));
                                                        $last_date = date('t', $timestamp);
                                                        if($j['sday']+$j['duration']>$last_date){
                                                            echo $j['sday']+$j['duration']-$last_date;
                                                        }else{
                                                            echo $j['sday']+$j['duration'];
                                                        }  ?>
                                                        :<?= $j['location'] ?>
                                                    </a></br>
                                                <?php }}?>
                                            </td>
                                            <?php
                                        }
                                    }
                                    if($is_exist == 0) {
                                        ?>
                                        <td onclick="javascript:addTime(<?=$key?>,<?=$current_month?>,<?=$current_year?>)"></td>
                                        <?php
                                    }
                                    $current_month++;
                                    if ($current_month > 12){
                                        $current_month = $current_month - 12;
                                        $current_year = $current_year + 1;
                                    }
                                }

                                ?>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </div>

                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a id="preview" class="btn btn-primary" href="<?=base_url()?><?= $company['company_url'] ?>/calendar/showTraining/-1"><<</a>
                            <a id="next" class="btn btn-primary" href="<?=base_url()?><?= $company['company_url'] ?>/calendar/showTraining/1">>></a>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
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
    <!-- end: page -->
</section>
