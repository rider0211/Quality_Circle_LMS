<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Question</title>

    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style1.css">

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
            padding: 1.25rem;
        }
        .mt-5{
            border-color: #FAFAFA !important;
            border: 1px dotted !important;
            margin-top: 3rem !important;
        }
    </style>

    <body>
    <header class="page-header">
        <h2><?=$term["exammanagement"]?></h2>
    </header>
        <?php if($show_button): ?>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                <h5>Question : 
                    <?php
                        $current = $id;
                        $total = $end + 1;
                        $percent = $current/$total;

                        $percent_friendly = round($percent * 100);

                        echo $current.' / '.$total;
                    ?>
                </h5>
                    </div>
                    <div class="col-md-9">
                        <label>Remain Time : </label>
                        <label id="show_time"></label>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $percent_friendly;?>%;" aria-valuenow="<?php echo $percent_friendly;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percent_friendly;?>%</div>
                </div>

            </div>
        </div>
        <?php endif; ?>

        <main role="main" class="container">
            <div class="container">
                <div class="card mt-5">
                    <div class="card-body">
                        <form method="post" id="user_submission">
                            <input type="hidden" id="exam_id" value="<?=$question['exam_id']?>">
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

                <?php
                if($show_button):
                if($next == $end+2):
                ?>
                <button type="button" class="btn btn-success mt-5 nextquestion" data-submit="1" data-url="<?php echo base_url()?>learner/demand/showPreviewQuestion/<?php echo $question['exam_id'];?>?next=<?=$next?>">
                    Done
                </button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary mt-5 nextquestion" data-submit="0" data-url="<?php echo base_url()?>learner/demand/showPreviewQuestion/<?php echo $question['exam_id'];?>?next=<?=$next?>">
                        Next <i class="fa fa-arrow-circle-right"></i>
                    </button>
                <?php endif; ?>
                <?php endif; ?>

            </div>
        </main>
        <script>
            var  base_url = "<?php echo base_url(); ?>learner/demand/";
            var show_type = "<?=$exam_show_type?>";
            $(function(){
                if(!$("html").hasClass("sidebar-left-collapsed"))
                {
                    $("html").addClass("sidebar-left-collapsed");
                    $("html").removeClass("sidebar-left-opened");
                }
            });
            var start_seconds = parseInt("<?=strtotime($exam_start_at)?>");
            var now_seconds = 0;
            $.post('<?=base_url()?>learner/demand/getTime',function( data ) {
                now_seconds = parseInt(data);
            });
            var time_taken = 0;
            setInterval(myTimer, 1000);
            function myTimer() {
                $.post('<?=base_url()?>learner/demand/getTime',function( data ) {
                    now_seconds = parseInt(data);
                });
                time_taken = start_seconds + 60*parseInt(<?=$limit_time?>) - now_seconds;
                show_time = "";
                if (time_taken/3600 >= 1){
                    show_time = show_time+""+parseInt(time_taken/3600)+" h:";
                    $("#show_time").html(show_time);
                }
                if (time_taken%3600/60 >= 1){
                    show_time = show_time+""+parseInt(time_taken%3600/60)+" m:";
                    $("#show_time").html(show_time);
                }
                if (time_taken%3600%60 > 0){
                    show_time = show_time+""+parseInt(time_taken%3600%60)+" s";
                    $("#show_time").html(show_time);
                }
                if (now_seconds > start_seconds + 60*parseInt(<?=$limit_time?>)){
                    $("#show_time").html("");
                    swal({
                        text: "Time is over!",
                        icon: "info"
                    }).then((value) => {
                        window.location = base_url+'reportCard/'+$("#exam_id").val();
                    });
                }
            }
        </script>
        <script src="<?php echo base_url(); ?>assets/js/user.js"></script>
    </body>
</html>