<style type="text/css">
	.wowbook-container-full{
		position:relative!important;
	}
	body, html, .wowbook-container{
		background: white!important;
	}
</style>
<style>
    .main.mce-item-table{
        border: 4px solid #8f6cfb;
    }

    /* span.checkmark {
        display: none;
    } */
    label.cours-0 {
        cursor: not-allowed;
    }

</style>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" sizes="196x196" href="<?= base_url(); ?>assets/img_flipbook/touch/touch-icon-196x196.png">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img_flipbook/touch/apple-touch-icon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#222222">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css_flipbook/normalize.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/wow_book/wow_book.css" type="text/css" />
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css_flipbook/main.css"> -->
    <script src="<?= base_url(); ?>assets/js_flipbook/vendor/modernizr-2.7.1.min.js"></script>
<style>
	iframe{
		min-height: 30rem;
        overflow: scroll;
	}
</style>
<section class="sectionBox detailsWrapper">
	<div class="container" style="margin: 0px; width: 100%;">
		<div class="row">

            <div class="col-md-3" id="filter-Left-Bar">

                <button id="btn_sider" style="float: right; height: 30px; width: 30px"  onclick="showFilterLeft()"><i class="fas fa-bars"></i> </button>
                <div class="catalogBox" id="filter-Left">
					<ul class="filtersLeft">
						<li>
						<h3 class="titleH3 _mt-0"><i class="fa fa-book"></i> <?= $course_name;?>
						</h3>

                            <?php foreach($libraries as $chapter):?>
                                <?php if($chapter->parent == 0 && $chapter->exam_id == 0 /*&& $chapter->status == 1 */): ?>
                                    <label class="radioBox cours-<?=$chapter->status?>" style="margin-top:20px; font-size: 20px; font-family: Poppins, sans-serif ;<?= $chapter->status == 0?'color: #c5c5c5':''?>"><?= $chapter->title?>
                                        <input  <?= $chapter->status == 0?'disabled style="color: #c5c5c5"':''?>  onclick="changeSelect(this,<?= $chapter->id?>,<?= $chapter->exam_id?>,<?= $chapter->quiz_id?>)" id="library<?= $chapter->id?>" type="radio" name="radio" value="<?= $chapter->file_path?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?php endif;?>
                                <!-- <div style="padding:15px;padding-bottom:0;border-top:1px solid #ececeb;border-bottom:1px solid #ececeb"> -->
                                <?php foreach($libraries as $page):?>
                                    <?php if($page->parent != 0 && $page->parent == $chapter->id/* &&  $page->status == 1 */):?>
                                        <label class="radioBox cours-<?=$page->status?>" style="margin-left:20px; font-family: Poppins, sans-serif ; <?= $page->status == 0?'color: #c5c5c5':''?>"><?= $page->title?>
                                            <input <?= $page->status == 0?'disabled style="color: #c5c5c5"':''?> onclick="changeSelect(this,<?= $page->id?>,<?= $page->exam_id?>,<?= $page->quiz_id?>)" id="library<?= $page->id?>" type="radio" name="radio" value="<?= $page->file_path?>">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php endif;?>
                                <?php endforeach;?>
                                <!-- </div> -->
                            <?php endforeach;?>
                            <?php foreach ($libraries as $chapter):?>
                                <?php if($chapter->parent == 0 && $chapter->exam_id != 0 /*&& $chapter->status == 1*/): ?>
                                    <label class="radioBox cours-<?=$chapter->status?>" style="margin-top:20px; font-family: Poppins, sans-serif ; <?= $chapter->status == 0?'color: #c5c5c5':''?>"><?= $chapter->title?><i class="fas fa-star"></i>
                                        <input <?= $chapter->status == 0?'disabled style="color: #c5c5c5"':''?> onclick="changeSelect(this,<?= $chapter->id?>,<?= $chapter->exam_id?>,<?= $chapter->quiz_id?>)" id="library<?= $chapter->id?>" type="radio" name="radio" value="<?= $chapter->file_path?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?php endif;?>
                            <?php endforeach;?>
						</li>			

					</ul><!--filtersLeft-->
				</div>
			</div><!--col-3-->
			
			<div class="col-md-9 detailsBorderLeft">
                <header class="card-header" style="padding: 10px;padding-left: 1rem;">
                    <a class="btn btn-primary" onclick="finish_course(<?=$course_id?>);">Finish</a>
                    <a class="btn btn-primary" onclick="check_Assess()">Check</a>
                    <a class="btn btn-primary"  onclick="next_Lesson()">Next</a>
                    <a class="btn btn-primary"  onclick="preview_Lesson()">Preview</a>
                </header>
				<div class="catalogBox" style="padding: 0px">
					<div class="row">


                        <input type="hidden" name="book_path" id="book_path" value="">
						<div class="col-sm-12" id="div_container" ><!--whitePanel-->
						</div><!--col-12-->
					</div><!--row-->					
				</div><!--courseBox-->
			</div><!--col-12-->
			
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->

<script src="<?= base_url(); ?>assets/js_flipbook/vendor/jquery-1.11.2.min.js"></script>
<script src="<?= base_url(); ?>assets/js_flipbook/helper.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/wow_book/pdf.combined.min.js"></script>
<script src="<?= base_url(); ?>assets/wow_book/wow_book.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script type="text/javascript">

    var is_show = 1;
    window.onbeforeunload = function (e) {
        e = e || window.event;
        // For IE and Firefox prior to version 4
        if (e) {
            e.returnValue = 'Sure?';
        }
        // For Safari
        return 'Sure?';
    };
    
    function setSelfPace(){
        var course_id = '<?= $course_id?>';
        var user_id = '<?= $user_id ?>';
        $.ajax({
            url: '<?= base_url($company['company_url']);?>/demand/setSelfPace',
            type: 'POST',
            data: {
                'course_id': course_id,
                'user_id' : user_id
            },
            success: function (data, status, xhr) {

            },
            error: function () {
                new PNotify({
                    title: '<?= $term['error']; ?>',
                    text: 'You can not select this Session.',
                    type: 'error'
                });
            }
        });

    }
    function next_Lesson() {
        var radios = $(':radio');
        var el = radios[0].lastElementChild;
        for(var i = 0 ; i < radios.length; i++){
            if($(radios[i]).prop('checked') == true)
            {

                if(i+1 < radios.length) {
                    $(radios[i]).prop('checked', false);
                    $(radios[i+1]).prop('checked','checked');
                    radios[i+1].onclick();
                }
                break;
            }
        }
    }

    function check_Assess() {
        window.location.reload();
    }

    function preview_Lesson() {
        var radios = $(':radio');
        var el = radios[0].lastElementChild;
        for(var i = 0 ; i < radios.length; i++){
            if($(radios[i]).prop('checked') == true)
            {

                if(i-1 >= 0) {
                    $(radios[i]).prop('checked', false);
                    $(radios[i-1]).prop('checked','checked');
                    radios[i-1].onclick();
                }
                break;
            }
        }
    }

    function showFilterLeft() {
        if(is_show == 0){
            $('#filter-Left').removeClass('hidden');
            $('#filter-Left-Bar').css('padding','0');
            $('#filter-Left-Bar').addClass('col-md-3');
            $('#filter-Left-Bar').removeClass('col-md-12');
            $('.detailsBorderLeft').removeClass('col-md-12');
            $('.detailsBorderLeft').addClass('col-md-9');
            $('#btn_sider').css('float', 'right');
            is_show = 1;
        }else{
            $('#filter-Left').addClass('hidden');
            $('#filter-Left-Bar').css('padding','30px');
            $('#filter-Left-Bar').removeClass('col-md-3');
            $('#filter-Left-Bar').addClass('col-md-12');
            $('.detailsBorderLeft').removeClass('col-md-9');
            $('.detailsBorderLeft').addClass('col-md-12');
            $('#btn_sider').css('float', 'left');
            is_show = 0;
        }

    }


	var html_container = "<div class='whitePanel'><div class='book_container'><div id='book'></div></div></div>";
	$("#div_container").html(html_container);
    function finish_course(id){
        swal({
            title: "Are you sure?",
            buttons: true
        })
            .then((willDelete) => {
            if (willDelete) {
                location.href = "<?=base_url()?><?=$company['company_url']?>/demand/view/"+id;
            }
        });
    }
    var company_url = "<?= base_url($company['company_url'])?>";
    var base_url = "<?= base_url()?>";

//    var first_id = '<?php //foreach ($libraries as $li) {
//                        if($li->exam_id == 0) {
//                            echo $li->id;
//                            break;
//                        }
//                    }?>//';
    var first_id = <?= $last_history_ch_id?>;
    $('#library'+first_id).prop('checked','checked');
    
    if($('#library'+first_id).val() == ''){
        new PNotify({
            title: '<?= $term['error']; ?>',
            text: 'There is no Content.',
            type: 'error'
        });

    }else{
        $("#book_path").val(base_url+$('#library'+first_id).val());
    
    }
    $(function(){
		if ($("#book_path").val().indexOf(".pdf") > 0){
			var bookOptions = {
				height   : 500
				,width    : 800
				,maxHeight : 600
				,centeredWhenClosed : true
				,hardcovers : true
				,pageNumbers: false
				,toolbarPosition: 'top'
				,toolbar : "lastLeft, left, right, lastRight, toc, zoomin, zoomout, slideshow, flipsound, fullscreen, thumbnails, download"
				,thumbnailsPosition : 'left'
				,responsiveHandleWidth : 50
				,container: window
				,containerPadding: "20px"
				,pdf: $("#book_path").val()
			};
			$('#book').wowBook( bookOptions );
		}else{
		if ($("#book_path").val().indexOf(".png") > 0 || $("#book_path").val().indexOf(".jpg") > 0) {
            $("#div_container").html("<img style='width: 78%;' id='course_container' src = " + $("#book_path").val()+ "></img>");
        }
        else{
			$("#div_container").html("<iframe id='course_container' src = "+$("#book_path").val()+"></iframe>");
		}}
        
        <?php if($course_self_time == 'Self Pace') { ?>
        setInterval(() => {
            var course_id = '<?= $course_id?>';
            var user_id = '<?= $user_id ?>';
            $.ajax({
                url: '<?= base_url($company['company_url']);?>/demand/setSelfPace',
                type: 'POST',
                data: {
                    'course_id': course_id,
                    'user_id' : user_id
                },
                success: function (data, status, xhr) {

                },
                error: function () {
                    new PNotify({
                        title: '<?= $term['error']; ?>',
                        text: 'You can not select this Session.',
                        type: 'error'
                    });
                }
            });
        }, 5000);
        <?php  } ?>
    })



    function changeSelect(el,id,exam_id, quiz_id){
        
        if($('#library'+id).val() == '' && exam_id == 0 && quiz_id == 0){
            new PNotify({
                title: '<?= $term['error']; ?>',
                text: 'There is no Content.',
                type: 'error'
            });

        }else {
            $.ajax({
                url: '<?= base_url($company['company_url']);?>/demand/checkAssessment',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {
                    if (data.check_num === 0) {
                        if(data.msg == null){
                            new PNotify({
                                title: '<?= $term['error']; ?>',
                                text: 'You can not select this Session.',
                                type: 'error'
                            });
                        }else if(data.msg == 'exam'){
                            (new PNotify({
                                title: "<?= $term['confirmation']; ?>",
                                text: "You exceed the Exam Maximum Num., Restart This Course?",
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
                                    url: '<?= base_url($company['company_url']);?>/demand/restartCourse',
                                    type: 'POST',
                                    data: {id:id},
                                    success: function (data, status, xhr) {

                                        new PNotify({
                                            title: 'Success',
                                            text: 'You can restart course.',
                                            type: 'success'
                                        });

                                    },
                                    error: function(){
                                        new PNotify({
                                            title: '<?= $term['error']; ?>',
                                            text: 'You cannot restart.',
                                            type: 'error'
                                        });
                                    }
                                });
                            });
                        }
                        else{
                            new PNotify({
                                title: '<?= $term['error']; ?>',
                                text: data.msg,
                                type: 'error'
                            });
                        }
                        $('#library' + data.last_id).prop('checked', 'checked');
                    } else {
                        if (exam_id == "0"){
                            if(quiz_id == '0'){
                                if ($('#library'+id).val().indexOf(".pdf") > 0){
                                    $("#div_container").html(html_container);
                                    $('.book_container').html('');
                                    $('.book_container').html('<input type="hidden" name="book_path" id="book_path" value="">\
								    <div id="book"></div>');
                                    var bookOptions = {
                                        height   : 500
                                        ,width    : 800
                                        ,maxHeight : 600
                                        ,centeredWhenClosed : true
                                        ,hardcovers : true
                                        ,pageNumbers: false
                                        ,toolbarPosition: 'top'
                                        ,toolbar : "lastLeft, left, right, lastRight, toc, zoomin, zoomout, slideshow, flipsound, fullscreen, thumbnails, download"
                                        ,thumbnailsPosition : 'left'
                                        ,responsiveHandleWidth : 50
                                        ,container: window
                                        ,containerPadding: "20px"
                                        ,pdf: base_url+$('#library'+id).val()
                                    };
                                    $('#book').wowBook( bookOptions );
                                }else{
                                    if ($('#library'+id).val().indexOf(".png") > 0 || $('#library'+id).val().indexOf(".jpg") > 0) {
                                        $("#div_container").html("<img style='width: 78%;' id='course_container' src = " + base_url + $('#library' + id).val() + "></img>");
                                    }
                                    else{
                                        $("#div_container").html("<iframe style='' id='course_container' src = " + base_url + $('#library' + id).val() + "></iframe>");

                                    }
                                }
                            }else{

                                $.ajax({
                                    url: '<?= base_url($company['company_url']);?>/demand/checkQuizExist',
                                    type: 'POST',
                                    data: {'exam_id': exam_id,'chapter_id':id,'quiz_id':quiz_id,'course_id':'<?= $course_id?>'},
                                    success: function (data, status, xhr) {

                                        if(data.quiz_num > 0)
                                        {
                                            if(data.exist_num >0){
                                                exam_url = '<?= base_url($company['company_url']);?>/demand/view_QuizGroup/'+quiz_id+'/'+id;
                                                //alert(exam_url);
                                               $('#div_container').html('<iframe id="course_container" style="width: 100%;" src = '+exam_url+'></iframe>');
                                            }else{
                                                new PNotify({
                                                    title: '<?= $term['error']; ?>',
                                                    text: 'You exceed the Attempt Num.',
                                                    type: 'error'
                                                });
                                            }

                                        }else{
                                            new PNotify({
                                                title: '<?= $term['error']; ?>',
                                                text: 'There is no Content.',
                                                type: 'error'
                                            });
                                        }
                                    },
                                    error: function () {
                                        new PNotify({
                                            title: '<?= $term['error']; ?>',
                                            text: 'There is no Content.',
                                            type: 'error'
                                        });
                                    }
                                });
                            }

                        }
                        else{
                            $.ajax({

                                url: '<?= base_url($company['company_url']);?>/demand/checkExamExist',
                                type: 'POST',
                                data: {'exam_id': exam_id,'chapter_id':id,'course_id':'<?= $course_id?>'},
                                success: function (data, status, xhr) {
                                    if(data.exam_num > 0)
                                    {

                                        if(data.exist_num >0){
                                            exam_url = '<?= base_url($company['company_url']);?>/demand/examInstruction/' + exam_id+'/<?= $course_id?>?chapter_id='+id;
                                            $('#div_container').html('<input id="s_course_id" value="<?= $course_id?>" type="hidden"><iframe id="course_container" style="width: 100%;" src = ' + exam_url + '></iframe>');
                                        }else{
                                            new PNotify({
                                                title: '<?= $term['error']; ?>',
                                                text: 'You exceed the Exam Maximum Num.',
                                                type: 'error'
                                            });
                                        }

                                    }else{
                                        new PNotify({
                                            title: '<?= $term['error']; ?>',
                                            text: 'There is no Content.',
                                            type: 'error'
                                        });
                                    }
                                },
                                error: function () {
                                    new PNotify({
                                        title: '<?= $term['error']; ?>',
                                        text: 'There is no Content.',
                                        type: 'error'
                                    });
                                }
                            });

                        }
                    }

                },
                error: function () {
                    new PNotify({
                        title: '<?= $term['error']; ?>',
                        text: 'You can not select this Session.',
                        type: 'error'
                    });
                }
            });

        }

    }


</script>
