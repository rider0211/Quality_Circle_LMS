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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <?php if (empty($edit_course)):?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
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
    </style>

    <body id="iframe_body" style="height: auto;">


        <main role="main" class="container">
            <div class="container">
                <div class="card mt-5">
                    <div class="card-body">
                        <form method="post" id="user_submission">
                            <input type="hidden" id="quiz_id" value="<?=$quiz_id?>">
                            <input type="hidden" name="current_q_id" value="<?php if(isset($question['id'])) echo $question['id']; ?>">

                        <?php
                            if (isset($question['ques_file']) && !empty($question['ques_file'])) {
                                echo '<img src="'.base_url('assets/uploads/exam/quiz/').$question['ques_file'].'" height="100" width="200" class="img-fluid rounded img-thumbnail border " />';
                            }
                            if ($question['type'] != 'fill-blank') {
                                if (empty($question['ques_title'])) {
                                    echo '<h5 class="card-title">Title is not provided</h5>';
                                } else {
                                    echo '<h5 class="card-title">' . $question['ques_title'] . '</h5>';
                                }
                            }
                            switch ($question['type']) {
                                case 'multi-choice':
                                    $checkData = array(
                                                    'total'=>$total,
                                                    'correctCheck'=>$question['content']['correctCheck'],
                                                    'checkbox'=>$question['content']['checkbox'],
                                                );
                                    $this->load->view('admin/exam/subviews/multichoice', $checkData);
                                    break;
                                case 'checkbox':
                                    $checkData = array(
                                                    'total'=>$total,
                                                    'correctCheck'=>$question['content']['correctCheck'],
                                                    'checkbox'=>$question['content']['checkbox'],
                                                );
                                    $this->load->view('admin/exam/subviews/checkbox', $checkData);
                                    break;
                                case 'true-false':
                                    $checkData = array(
                                                'total'=>$total,
                                                'tftext'=>$question['content']['tf'],
                                                'settrue'=>$question['content']['settrue'],
                                            );
                                    $this->load->view('admin/exam/subviews/true_false', $checkData);
                                    break;
                                case 'fill-blank':
                                    $checkData = array(
                                        'title'=>$question['ques_title'],
                                        'blank'=>$question['content']['blank'],
                                    );
                                    $this->load->view('admin/exam/subviews/preview_fill_blank', $checkData);
                                    break;
                                case 'essay':
                                    
                                    $this->load->view('admin/exam/subviews/essay');
                                    break;
                                case 'matching':
                                    $this->load->view(
                                        'admin/exam/subviews/matching',
                                        array(
                                            'content'=>$question['content']['choice'],
                                            'match'=>$question['content']['match'],
                                        )
                                );
                                    break;
                                default:
                                    echo 1;
                            }

                        ?>
                        </form>
                    </div>
                    <div class="card-body" id="solution_div">

                    </div>
                </div>


                <button type="button" class="btn btn-success mt-5 nextquestion" data-submit="1" data-url="<?php echo base_url($company['company_url'])?>/demand/showPreviewQuestion/<?php echo $question['exam_id'];?>?next=<?=$next?>">
                    Done
                </button>


            </div>
        </main>


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

        var show_type = "<?=$exam_show_type?>";

        var  base_url = "<?php echo base_url(); ?>learner/demand/";

//        $('.quiz_done').click(function (e) {
//            e.preventDefault();
//            var formData = $("#user_submission").serialize();
//            $.ajax({
//                url: base_url+'saveUserAnswers',
//                type: 'POST',
//                data: {'formData': formData},
//                processData:false,
//                contentType: false,
//                success: function (data, status, xhr) {
//
//                },
//                error: function(){
//
//                }
//            });
//        })

        $(".nextquestion").click(function() {
            var url = $(this).data('url');
            var submit = $(this).data('submit');

            var datastring = $("#user_submission").serialize();

            $.post( base_url+'saveUserAnswers', {formData:datastring,submit:submit},function( data ) {
                if (show_type == "0"){
                    $("#solution_div").html(data);
                    change_parent_height();
                    $(".nextquestion").click(function() {
                        if(submit == '0'){

                        } else {
                            //window.location = base_url+'reportCard/'+$("#exam_id").val();
                        }
                    });
                }else{
                    if(submit == '0'){

                    } else {
                        //window.location = base_url+'reportCard/'+$("#exam_id").val();
                    }
                }
            });
        });

    </script>

</html>