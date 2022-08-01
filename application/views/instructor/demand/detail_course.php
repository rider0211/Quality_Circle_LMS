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
<link href="<?php echo base_url(); ?>assets/css_company/animate.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_company/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_company/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_company/owl.theme.default.min.css">
<link href="<?php echo base_url(); ?>assets/css_company/all.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_company/responsive.css" rel="stylesheet">
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
<script src="<?php echo base_url(); ?>assets/js_company/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/filterable.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/jquery.simplyscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.js"></script>
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-144x144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-57x57-precomposed.png">
<link rel="shortcut icon" sizes="196x196" href="<?php echo base_url(); ?>assets/img_flipbook/touch/touch-icon-196x196.png">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon.png">

<!-- Tile icon for Win8 (144x144 + tile color) -->
<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/img_flipbook/touch/apple-touch-icon-144x144-precomposed.png">
<meta name="msapplication-TileColor" content="#222222">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_flipbook/normalize.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/wow_book/wow_book.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_flipbook/main.css">
<script src="<?php echo base_url(); ?>assets/js_flipbook/vendor/modernizr-2.7.1.min.js"></script>
<style>
    iframe{
        
        min-height: 30rem;
    }
</style>
<script type="text/javascript">
var first_id = "";
var first_id_checked = "";
</script>
<section role="main" class="content-body">

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header" style="padding: 10px;padding-left: 24rem;">
                    <a class="btn btn-primary" onclick="finish_course(<?=$course_id?>);">Finish</a>
                </header>
                <div style="margin-top: 20px;">
                    <div class="row" style="width: 80%;padding-left: 20px;">
                        <div class="col-md-3" id="filter-Left-Bar">

                            <button id="btn_sider" style="float: right; height: 30px; width: 30px"  onclick="showFilterLeft()"><i class="fas fa-bars"></i> </button>
                            <div class="catalogBox" id="filter-Left">
                                <ul class="filtersLeft">
                                    <li>
                                        <h3 class="titleH3 _mt-0"><i class="fa fa-book"></i> <?php echo $course_name;?>
                                        </h3>
					<?php $first_chapter = 0;
                                        foreach($libraries as $chapter):?>

                                            <?php if($chapter->parent == 0 && $chapter->exam_id == 0):
					     						$first_chapter++;?>
                                                <label class="radioBox" style="margin-top:20px"><h5 <?php if($chapter->status != 1){ ?> style="color:#999;" <?php } ?>><?php echo $chapter->title?></h5>
                                                <?php if($chapter->status == 1){ ?>
                                                    <input <?php if($chapter->status != 1){ ?> disabled="disabled" <?php } ?> onclick="changeSelect(this,<?php echo $chapter->id?>,<?php echo $chapter->exam_id?>)" id="library<?php echo $chapter->id?>" type="radio" name="radio" value="<?php echo $chapter->file_path?>">
                                                    <span class="checkmark"></span>
                                                <?php } ?>
                                                </label>
						
                                                <?php if($first_chapter==1) {?>
													<script type="text/javascript">
                                                    first_id = "<?php echo $chapter->id?>";
                                                    //alert(first_id);
                                                    </script>
                                                <?php }?>
                                                <?php if($chapter->status==1){ ?>
													<script type="text/javascript">
                                                        if(first_id_checked == ''){
                                                            first_id_checked = "<?php echo $chapter->id ?>";
                                                        }
                                                    </script>
                                                <?php }?>
                                            <?php endif;?>
                                            <!-- <div style="padding:15px;padding-bottom:0;border-top:1px solid #ececeb;border-bottom:1px solid #ececeb"> -->
                                            <?php foreach($libraries as $page):?>
                                                <?php if($page->parent != 0 && $page->parent == $chapter->id && $page->quiz_id == 0):?>
                                                    <label class="radioBox" style="margin-left:20px"><span <?php if($page->status != 1){ ?> style="color:#999;" <?php } ?>><?php echo $page->title?></span>
                                                    <?php if($page->status == 1){ ?>
                                                        <input <?php if($page->status != 1){ ?> disabled="disabled" <?php } ?> onclick="changeSelect(this,<?php echo $page->id?>,<?php echo $page->exam_id?>)" id="library<?php echo $page->id?>" type="radio" name="radio" value="<?php echo $page->file_path?>">
                                                        <span class="checkmark"></span>
                                                        <?php } ?>
                                                    </label>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                            <!-- </div> -->
                                        <?php endforeach;?>
                                    </li>
                                </ul><!--filtersLeft-->
                            </div>
                        </div><!--col-3-->

                        <div class="col-md-9 detailsBorderLeft">
                            <div class="catalogBox">
                                <div class="row">
                                    <button style="float: right; height: 30px; width: 90px"  onclick="next_Lesson()">Next</button>
                                    <button style="float: right; height: 30px; width: 90px; margin-right:5px "  onclick="preview_Lesson()">Preview</button>
                                    <input type="hidden" name="book_path" id="book_path" value="">
                                    <div class="col-sm-12" id="div_container"><!--whitePanel-->
                                    </div><!--col-12-->
                                </div><!--row-->
                            </div><!--courseBox-->
                        </div><!--col-12-->
                    </div><!--row-->
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script src="<?php echo base_url(); ?>assets/js_flipbook/vendor/jquery-1.11.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_flipbook/helper.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/wow_book/pdf.combined.min.js"></script>
<script src="<?php echo base_url(); ?>assets/wow_book/wow_book.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script type="text/javascript">
    var is_show = 1;

    var base_url = "<?php echo base_url()?>";

    var active_id = 0;
    var chapter_id = 0;
    if (active_id == 0){
        $('#library'+first_id_checked).prop('checked','checked');
        $("#book_path").val(base_url+$('#library'+first_id).val());
    }else{
        $('#library'+active_id).prop('checked','checked');
        $("#book_path").val(base_url+$('#library'+active_id).val());
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
                location.href = "<?=base_url()?>instructor/demand/view_course/"+id;
            }
        });
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
            $("#div_container").html("<iframe id='course_container' src = "+$("#book_path").val()+"></iframe>");
        }
    })

    function changeSelect(el,id,exam_id){
        if (exam_id == "0"){
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
                $("#div_container").html("<iframe id='course_container' src = "+base_url+$('#library'+id).val()+"></iframe>");
            }
        }else{
            swal({
                text: "This is a exam, quiz page!",
                icon: "info"
            });
        }
    }
</script>