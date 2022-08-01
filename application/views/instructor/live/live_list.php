<style>
    td:hover{
        background: grey;
    }

    .datepicker> .datepicker-days{
        display: initial;
    }
</style>

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Virtual Instructor Led Training</h2>
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

                        <a class="modal-with-form" href="<?=base_url()?>instructor/live/editLive">
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-change-time"> <i class="fa fa-plus"></i> <?=$term["addnewcolumn"]?></button>
                        </a>
                        <a href="coursecreation/edit_course"><button type="button" class="btn btn-success" id="btn-add"> <i class="fa fa-plus"></i> Add New Course</button></a>

                        <a class="modal-with-form change-time" href="#modalFormChangeTime" hidden>
                            <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-change-time"> <i class="fa fa-plus"></i> <?=$term["changetime"]?></button>
                        </a>
                        <div id="modalFormChangeTime" class="modal-block modal-block-primary mfp-hide">
                            <form id="change-time-form" action="" method="POST" novalidate="novalidate">
                                <input type="hidden" id="change_id" name="change_id" value="" class="form-control" >
                                <input type="hidden" id="time_id" name="time_id" value="" class="form-control" >
                                <section class="card">
                                    <header class="card-header">
                                        <h2 class="card-title"><?=$term["changetime"]?></h2>
                                    </header>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label text-lg-right pt-2"><?=$term["startday"]?></label>
                                            <div class="col-sm-8">
                                            <input data-plugin-datepicker="" id="startday" name="startday"  class="form-control" data-date-format="yyyy-mm-dd">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label text-lg-right pt-2"><?=$term["starttime"]?></label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                            <!-- <span class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-clock"></i>
                                                                </span>
                                                            </span>
                                                    <input type="text" id="starttime" name="starttime" data-plugin-timepicker="" class="form-control" data-plugin-options="{ &quot;showMeridian&quot;: true }"> -->
                                                    <select class="form-control" id="starttime" name="starttime" style="width:264px;">
                                                        <option value="7:00 AM">7:00 AM</option>
                                                        <option value="8:00 AM">8:00 AM</option>
                                                        <option value="9:00 AM">9:00 AM</option>
                                                        <option value="10:00 AM">10:00 AM</option>
                                                    </select>
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
                	<footer class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <div class="row">
                                   <div class="col-sm-6">
                                        <select data-plugin-selectTwo class="form-control" id="courses_filter" name="courses_filter">
                                        	<option value="">Select Course</option>
											<?php foreach($category as $item){ ?>                                                
                                                <option value="<?php echo $item->id; ?>" <?php $category_id==$item->id?print 'selected':print ''; ?>> <?php echo $item->title; ?></option>
                                            <?php }  ?>
                                        </select>
                                   </div>
                                   <div class="col-sm-6">
                                        <a id="filter" class="btn btn-primary">Search</a>
                                        <a href="<?=base_url()?>instructor/live/" class="btn btn-default">Reset</a>
                                   </div>
                               </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a id="preview" class="btn btn-primary" href="<?=base_url()?>instructor/live/showLive/-1"><<</a>
                                <a id="next" class="btn btn-primary" href="<?=base_url()?>instructor/live/showLive/1">>></a>
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
                                <td width="15%">                                
                                	<a class="btn btn-danger" onclick="deleteLiveClass(<?=$key?>)" href="javascript:void(0);">Delete</a>
                                    <a href="#republish_modal" class="btn btn-success republish_modal" onclick="republishCourse(<?=$key?>)" href="javascript:void(0);">Republish</a>
                                </td>
                                <td>
                                	<a href="<?= base_url()?>instructor/live/editLive/<?=$key?>"><?=$rows['title']?></a>
                                </td>
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
                                            <td  onclick="javascript:addTime(<?=$key?>,<?=$current_month?>)">
                        
                                                <?php foreach ($r  as $n => $j){
                                                    $timestamp = strtotime($j['start_at']);
                                                    $date = date('Y-m-d', $timestamp);
                                                    $hour = date('H:i:s', $timestamp);
                                                    $year = date('Y', $timestamp);
                                                    $month = date('m', $timestamp);
                                                    $sday = date('d', $timestamp);
                                                    if($year == $current_year){?>
                        
                                                    <a class="btn btn-xs btn-primary " href="javascript:updateTime(<?=$key?>,'<?=$j['start_at']?>','<?=$j['start_time']?>',<?=$j['id']?>)" style="font-size: 8px; color: white">
                                                    
                                                        <?= $rows['instructor_email'] ?>
                                                        </br>
                                                        <?= $sday ?>
                                                        :
                                                        <?= $j['start_time'] ?>
                                                    </a></br>
                                                <?php }}?>
                                            </td>
                                            <?php
                                        }
                                    }
                                    if($is_exist == 0) {
                                        ?>
                                        <td onclick="javascript:addTime(<?=$key?>,<?=$current_month?>)"></td>
                                        <?php
                                    }
                                    $current_month++;
                                }
                        
                        ?>
                                </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <a class="modal-with-form invite_modal" href="#modalForm" hidden>
    </a>
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
                        <input id="republish-price" name = "republish-price" class="form-control">
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
            <input type="hidden" id="add_course_id" name="course_id" value="" class="form-control" >
            <input type="hidden" id="add_course_type" name="course_type" value="0" class="form-control" >
            <input type="hidden" id="add_course_time_id" name="add_course_time_id" value="" class="form-control" >
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
                           <!-- <a class="btn btn-default" style="color:#333"><?/*=$term["send"]*/?> </a>-->
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
    function changePrice(){
        var price = $("#republish-price").val();
        var discount = $("#republish-discount").val();
        var amount = price * (100 - discount) / 100;
        $("#republish-amount").val(amount);
    }
    function republish(){
      var formData = new FormData($('#republish_form')[0]);
        $.ajax({
            url: $('#base_url').val() + 'instructor/coursecreation/republishCourse',
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
    function republishCourse(course_id){
        var url = '<?= base_url()?>instructor/coursecreation/getCourse';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id:course_id,
                type : 1
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
    var isShowList = false;
    var $user_table = $('#datatable_user');
    function showPayUser() {
        var id = $("#time_id").val();
        if($('.btn-user-list').html() == 'Show User List'){
            $('.btn-user-list').html('Hide User List')
            $user_table.show();
            var ajaxData = {"id":id,'course_type':1};
            if(!isShowList) {
                $user_table.dataTable({     
                    "ordering": true,
                    "info": true,
                    "searching": false,

                    "ajax": {
                    "type": "POST",
                    "async": true,
                    //  "url": "<?=base_url()?>instructor/training/getPayUser",
                    "url": "<?=base_url()?>instructor/inviteuser/getInviteUserVirtual",
                    //  "data": {
                    //      'id': $('#change_id').val(),
                    //      'tid': $('#time_id').val()
                    //  },
                    "data":function(data) { // add request parameters before submit
                        $.each(ajaxData, function(key, value) {
                            data[key] = value;
                        });
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
	function deleteLiveClass(deleteId){
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
						
			var url = '<?= base_url()?>instructor/live/deleteVirtualCourse/'+deleteId;
			
            $.ajax({
                url: url,
                type: 'POST',
                data: {id:deleteId},
                success: function (data, status, xhr) {
                    if(status == "success") {
                        document.location.href = document.location.href;
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
		window.location.href="<?=base_url()?>instructor/live/showLiveFilter/"+courseId;
	});

    var $table = $('#datatable');
    var $add_exist_table = $('#datatable_addexistuser');

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
        $add_exist_table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url":$('#base_url').val() +"instructor/user/view",
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


    function addTime(id, month) {

        var d = new Date();
        if(month < 10){
            month = '0' + month;
        }
        var sel_date = d.getFullYear() +'-' + month + '-01';
        
        $('#startday').val(sel_date);
        $('#change_id').val(id);
        $('.modal-change-confirm').html("Add");
        $('.change-time').click();
    }

    function updateTime(id, date,start_time, time_id) {
        $('.btn-user-list').prop('hidden', false);
		$('#add_course_id').val(id);
        $('#startday').val(date);
        $('#starttime').val(start_time);
        $('#change_id').val(id);
        $('#time_id').val(time_id);
		$('#add_course_time_id').val(time_id);
        $('.modal-change-confirm').html("Change");
        $('.change-time').click();
    }

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
                url: $('#base_url').val()+'instructor/live/deleteTime',
                type: 'POST',
                data: {id:$('#time_id').val()},
                success: function (data, status, xhr) {
                    if(status == "success") {
                        document.location.href = document.location.href;
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

    $('.modal-change-confirm').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#change-time-form')[0]);
        if ($('#startday').val() == '' || $('#starttime').val() == '') {
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
                    url: $('#base_url').val()+'instructor/live/add_time',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {
                        document.location.href = document.location.href;
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
                    url: $('#base_url').val()+'instructor/live/update_time',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {
                        document.location.href = document.location.href;
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
    var ajaxData = {"id":0,'course_type':1};
    inviteuser_table.dataTable({
        "ordering": true,
        "info": true,
        "searching": false,

        "ajax": {
            "type": "POST",
            "async": true,
            "url": "<?=base_url()?>instructor/inviteuser/getInviteUserVirtual",
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
                    mRender: function (data, type, row) {

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
        
        var id = $("#time_id").val();
        $('#add_modal_form')[0].reset();
        //$('#add_course_id').val(id);
        $('#add_course_type').val('1');
		$('#add_course_time_id').val($('#time_id').val());
		
        $('#sel_id').val(id);
        ajaxData={
            'id':id,
            'course_type':1
        };
        inviteuser_table.DataTable().ajax.reload();
        $('.invite_modal').click();
    }
    function add_exist_user(id){
        var formData = new FormData($('#add_modal_form')[0]);
        formData.append('user_id',id);
        $.ajax({
        url: '<?=base_url()?>instructor/inviteuser/addExistUser/classes/1',
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
        if ($('#first_name').val() == '' || $('#last_name').val() == '' || $('#send_email').val() == '') {
            new PNotify({
                title: 'Failed',
                text: 'Fill Data.',
                type: 'danger'
            });
            return;
        }else{
            $.magnificPopup.close();
            $.ajax({
                url: '<?=base_url()?>instructor/inviteuser/createInviteuser/classes/1',
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
                error: function () {


                }
            });
        }
    }

    function resend_inviteuser(obj, id , firstname, lastname, email){
        $(obj).attr("disabled",1);
        $.ajax({
            url: '<?=base_url()?>instructor/inviteuser/createInviteuser/classes/0',
            type: 'POST',
            data: {
				add_course_time_id: $('#add_course_time_id').val(),
                id:id,
                course_id: $("#add_course_id").val(),
				course_type: 1,
                first_name: firstname,
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
                //document.location.reload();
            },
            error: function () {

            }
        });
    }

    function delete_inviteuser(id){
        $.ajax({
            url: '<?=base_url()?>instructor/inviteuser/deleteInviteuser',
            type: 'POST',
            data: {
                id:id
            },
            success: function (data, status, xhr) {
                //$.magnificPopup.close();
                new PNotify({
                    title: 'Success',
                    text: 'Delete',
                    type: 'success'
                });
                ajaxData={
                    'id':$('#add_course_id').val(),
                    'course_type':1
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

</script>
