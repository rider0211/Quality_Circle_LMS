
<style>
    body{
        background-image: none !important;
        background-color: white;
    }
    .card.mt-3{
        border: 1px solid rgba(0,0,0,.125) !important;
    }
    .table-border-th{
        border-bottom: 1px solid #B7BCB7 !important;
    }
    .table-border-td{
        border-bottom: 1px solid #E9EBE9 !important;
        width:25% !important;
    }
    div>i{
        font-size: 0px;
    }
</style>

<header class="page-header">
    <h2><?=$term["exammanagement"]?></h2>
    <?php if ($result == "Pass"):?>
        <h5 style="text-align: right; margin-right: 10px"><a href="javascript:pagePrint()" class="btn btn-primary ml-3"><i class="fas fa-print"></i> Print and Download</a></h5>
    <?php endif;?>
</header>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <div class="content-body">
                <?php if ($exam_type != "Manual"):?><h5 style="line-height: 30px;">Thank you for completing this quiz. Your certificate is below.</h5><?php endif;?>
            </div>
        </div>
        <main role="main" class="content-body">
        <style>

            .cert_span{
                text-align: center;
                font-size: 40px;
                color: red;
                padding: 20px;
               
            }
            @font-face { 
                font-family: GlacialIndifference-Regular; src: url('<?php echo base_url(); ?>assets/img/GlacialIndifference-Regular.otf'); 
              } 
            @font-face { 
               font-family: GlacialIndifference-Bold; src: url('<?php echo base_url(); ?>assets/img/GlacialIndifference-Bold.otf'); 
            } 
            h6 {
               font-family: GlacialIndifference-Regular
            }
            h6.a {
              font-family: GlacialIndifference-Bold
            }    

            html { background-color: white; }
            .solid { 
                border-style: solid;
                margin-top:270px;
                position: relative;
                bottom:270px;  
                background-color: #38b6ff
                 }
            hr {
               margin-top: 0.5rem;
               border: 1px;
            }
        </style>
            <div class="container" style="height:640px;    width: 815px;">

                <div class="row" style="height:640px;    width: 815px;">
                &nbsp;
                    <div class="col-md-9" style="height:640px;    width: 815px;">                
                        
                        <div class="solid" style="height:640px;    width: 815px;">
                          <div>
                             <img src="<?php echo base_url(); ?>assets/img/download.jpg" alt="Certificate" align="left" style="width:202px;height:638px;">                    
                          </div>
                          <div>                                 
                            <img src="<?php echo base_url(); ?>assets/img/logo-top.png" alt="Certificate" align="right" style="position: absolute;left:540px;top:10px;">
                            <h1 style="color:white; position:relative; left:80px;font-family:merriweather;" ><font size="6"><b><I><?php echo strtoupper($certificate['COMPANY NAME']);?></I></b></font></h1>
                            <h6 class="a" style="color:white;" align="center"><font size="2">HEREBY CERTIFIES THAT</font></h6>
                            <h1 style="color:white; font-family:merriweather;" align="center"><font size="6"><?php echo strtoupper($certificate['PARTICIPANT NAME']);?></font></h1>
                            <h6 style="color:white;" align="center"><font size="2">Participated in And Completed</font></h6>
                            <h6 class="a" style="color:white;" align="center"><font size="2"><b><?php echo strtoupper($certificate['COURSE NAME']);?></b></font></h6>
                            <h6 style="color:white;" align="center"><font size="2">Given on</font></h6>
                            <h6 style="color:white;" align="center"><font size="2"><?php echo strtoupper($certificate['CERTIFICATION DATE']);?></font></h6>
                            <h6 style="color:white;" align="center"><font size="2">AT</font></h6>
                            <h6 style="color:white;" align="center"><font size="2"><?php echo $certificate['LOCATION'];?></font></h6>
                            <h6 style="color:white;" align="center"><font size="2">And Has Been Awarded</font></h6>
                            <h6 style="color:white;" align="center"><font size="2"><?php echo strtoupper($certificate['NUMBER']);?> CEU</font></h6>
                            <h6 style="color:white;" align="center"><font size="2">Certificate #  00001111</font></h6>
                            <!--<img src="<?php echo base_url(); ?>assets/img/output-onlinepngtools.png" alt="Certificate" align="right" style="position: absolute; left: 450px; bottom:15px; ">
                            -->
                            <div alt="Certificate" align="right" style="position: absolute; left: 450px; bottom:35px; ">
                              <?php echo $certificate['SIGNATURE'];?> 
                            </div>                  
                            <hr width="25%" style="position: absolute;left: 560px; bottom: 50px; height: 2px; background: white; ">
                            <hr width="79.5%" style="position: absolute;right: 285px;top: 308px; height: 5px; background: white; -webkit-transform:rotate(90deg);">
                            <h6 style="color:white; position:absolute; left:630px; bottom:15px; "align="right"><font size="2">President</font></h6>
                          </div>  
                       </div>
                      
                    </div>
                </div>
            </div>
            <form id="print_form" method="POST" action="<?= base_url()?>admin/demand/print_exam_certificate">
                <input type="hidden" id="content" name="content">
            </form>
        </main>
                    
                </div>
                <?php endif;?>
                <?php if ($exam_type != "Manual"):?>
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-responsive-md table-borderless">
                            <tr>
                                <th class="table-border-th" colspan="4"><?=$term["yourscore"]?></th>
                            </tr>
                            <tr>
                                <td class="table-border-td"><?=$term["name"]?></td>
                                <td class="table-border-td"><?=$user_name?></td>
                                <td class="table-border-td"><?=$term["score"]?></td>
                                <td class="table-border-td"><?=$score?> / 100 Points (<?=$score?> %)</td>
                            </tr>
                            <tr>
                                <td class="table-border-td"><?=$term["correctanswers"]?></td>
                                <td class="table-border-td"><?=$correct_count?></td>
                                <td class="table-border-td"><?=$term["incorrectanswers"]?></td>
                                <td class="table-border-td"><?=$wrong_count?></td>
                            </tr>
                            <tr>
                                <td class="table-border-td"><?=$term["passinggrade"]?></td>
                                <td class="table-border-td"><?=round($pass_grade,2)?> %</td>
                                <td class="table-border-td"><?=$term["timetaken"]?></td>
                                <td class="table-border-td"><?=$time_taken?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-responsive-md table-borderless">
                            <tr>
                                <th class="table-border-th" colspan="4"><?=$term["yourresult"]?></th>
                            </tr>
                            <tr>
                                <td class="table-border-td"style="color: green;"><?=$result?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php endif;?>
                <div class="row">
                    <div class="col-md-9">
                        <?php if(!empty($questions)):?>
                                <?php $qnum = 0;
                                foreach($questions as $question):?>
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <?php 
                                            if (isset($question['ques_file']) && !empty($question['ques_file'])) {
                                                echo '<img src="'.base_url('assets/uploads/exam/quiz/').$question['ques_file'].'" height="100" width="200" class="img-fluid rounded img-thumbnail border float-right" />';
                                            }
                                            echo $qnum+1;
                                            echo ". ";
                                            echo empty($question['ques_title'])?'Title is not provided':$question['ques_title']; 
                                        ?>
                                    </div>
                                <div class="card-body">
                                    <?php foreach ($answers as $answer):?>
                                        <?php if ($answer['quiz_id'] == $question['id']):?>
                                            <?php $userAns = $answer;?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    <?php
                                    $userAns['description'] = json_decode($userAns['description'],true);
                                        switch ($question['type']) {
                                            case 'multi-choice':
                                                $checkData = array(
                                                                'correctCheck'=>json_decode($question['content'],true)['correctCheck'],
                                                                'checkbox'=>json_decode($question['content'],true)['checkbox'],
                                                                'userAns'=>$userAns['description']
                                                            );

                                                $this->load->view('admin/exam/reportcard/multichoice', $checkData);
                                                break;
                                            case 'checkbox':
                                                $checkData = array(
                                                                'correctCheck'=>json_decode($question['content'],true)['correctCheck'],
                                                                'checkbox'=>json_decode($question['content'],true)['checkbox'],
                                                                'userAns'=>$userAns['description']
                                                            );
                                                $this->load->view('admin/exam/reportcard/checkbox', $checkData);
                                                break;
                                            case 'true-false':
                                                $checkData = array(
                                                            'tftext'=>json_decode($question['content'],true)['tf'],
                                                            'settrue'=>json_decode($question['content'],true)['settrue'],
                                                            'userAns'=>$userAns['description']
                                                        );
                                                $this->load->view('admin/exam/reportcard/true_false', $checkData);
                                                break;
                                            case 'fill-blank':
                                                $checkData = array('blank'=>json_decode($question['content'],true)['blank'],'userAns'=>$userAns['description']);
                                                $this->load->view('admin/exam/reportcard/fill_blank', $checkData);
                                                break;
                                            case 'essay':
                                                $checkData = array('userAns'=>$userAns['description']);
                                                $this->load->view('admin/exam/reportcard/essay', $checkData);
                                                break;
                                            case 'matching':
                                                $this->load->view(
                                                    'admin/exam/reportcard/matching',
                                                    array(
                                                        'content'=>json_decode($question['content'],true)['choice'],
                                                        'match'=>json_decode($question['content'],true)['match'],
                                                        'userAns'=>$userAns['description']
                                                    )
                                            );
                                                break;
                                            default:
                                                echo 1;
                                        }
                                    ?>
                                </div>
                                <?php ++$qnum; endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
        <script>
            var  baseurl = "<?php echo base_url(); ?>";
            $(function(){
                if(!$("html").hasClass("sidebar-left-collapsed"))
                {
                    $("html").addClass("sidebar-left-collapsed");
                    $("html").removeClass("sidebar-left-opened");
                }
            });

            function pagePrint() {
        
                var content = $('.content-body').html();
                //alert(content); 
                $('#content').val(content);
                $('#print_form').submit(); 

                $.ajax({
                    //url: "<?= base_url()?>admin/demand/print_exam_certificate",
                    url:"",
                    type: 'POST',
                    data: {                
                        content: content,

                      },  
                    success: function (data, status, xhr) {              
                      new PNotify({
                          title: 'Success',
                          text: 'Certificate Print and Download',
                          type: 'success'
                      });               
                    },
                    error: function(){ 
                        new PNotify({
                            title: 'Error',
                            text: 'Failed!',
                            type: 'error'
                        });
                    }
                }); 
            }
        </script>
        <script src="<?php echo base_url(); ?>assets/js/user.js"></script>