<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Specific Page vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-multi-select/css/multi-select.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/basic.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/media/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris/morris.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.checkboxes.css"  />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/elusive-icons/css/elusive-icons.css">
    <!-- Theme CSS -->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/theme.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/style.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/styles.css">-->
    <?php if (empty($edit_course)):?>
<!--        <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/components.css">-->
    <?php endif;?>
    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css_company/main-style.css">-->

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
    <script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>

    <title>Question</title>
</head>
    <style>
        .sidenav .closebtn {
            position: relative !important;
            float: right;
        }
        html .bg-light, html .background-color-light {
            background-color: #f8f9fa!important;
        }
        .card-title {
            text-transform: none;
            margin-bottom: 0.75rem;
        }
        .card-body{
            padding: 2.25rem;
        }
        .mt-5{
            border-color: #FAFAFA !important;
            border: 1px dotted !important;
            margin-top: 3rem !important;
        }
        .card-footer{
             padding-top:10px;
         }
        .card-footer div{
            padding-top:10px;
        }
        ol{
            padding-bottom: 10px;
        }
        .card2-title{
            padding-left: 20px;
            margin-top: 10px !important;
            margin-bottom: 10px !important;
            font-size: 1.6rem;
        }
        .card3-title{
            padding-left: 20px;
            margin-bottom: 0px !important;
            font-size: 1.3rem;
        }
    </style>

    <body id="iframe_body" style="height: auto;">
        <section role="main" class="content-body">
            <!-- start: page -->
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="card2-header">
                        <h2 class="card2-title">Exam : <?php echo $exam['title']; ?>(<?php echo $exam['title']; ?>)</h2>
                    </div>
                    <section id="exam_instruction" class="card">
                        <header class="card-header">
                            <h2 class="card3-title">INSTRUCTION</h2>
                        </header>
                        <div class="card-body">
                            <div id="" class="row">
                                <div class="col-lg-12">
                                    <?php echo $exam['instruction']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12">
                                <button type="button" id="btn_agree" class="mb-1 mt-1 mr-1 btn btn-info" onclick="exam_agree()">Agree</button>
                            </div>
                        </div>
                    </section>
                </div>
        </section>
    </body>

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
    <script>

        $('body').imagesLoaded().always(function () {
            change_parent_height();
        });

        function change_parent_height() {
            var height = $('#iframe_body').height() + 50;
            $(window.top.document.getElementById('course_container')).height(height);
        }
        function exam_agree(){
            swal({
                title: "Please start your exam.",
                buttons: true
            })
                .then((willDelete) => {
                if (willDelete) {
                exam_url = '<?php echo base_url($company['company_url'])?>/demand/show_exam_feedback/<?=$exam_id?>/<?php echo $course_id?>';
                location.href = exam_url;
            } else {
                return;
            }
        });
        }

        var  base_url = "<?php echo base_url($company['company_url'])?>/demand/";
    </script>
    <script src="<?php echo base_url(); ?>assets/js/user.js"></script>
</html>