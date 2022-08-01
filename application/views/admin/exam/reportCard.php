<style>
   body {
   background-image: none !important;
   background-color: white;
   }
   .card.mt-3 {
   border: 1px solid rgba(0,0,0,.125) !important;
   }
   .table-border-th {
   border-bottom: 1px solid #B7BCB7 !important;
   }
   .table-border-td {
   border-bottom: 1px solid #E9EBE9 !important;
   width: 25% !important;
   }
   div>i {
   font-size: 0px;
   }
</style>
<header class="page-header">
   <h2>
      <?=$term["exammanagement"]?>
   </h2>
   <h5 style="text-align: right; margin-right: 10px"><a href="javascript:pagePrint()" class="btn btn-primary ml-3"><i class="fas fa-print"></i> Print and Download</a></h5>
</header>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
   <div class="content-body">
      <?php if ($exam_type != "Manual"):?>
      <h5 style="line-height: 30px;">Thank you for completing this quiz. Your certificate is below.</h5>
      <?php endif;?>
      <a class="btn btn-primary" href="<?php echo base_url()?>admin/exam/create?row_id=<?=$exam_id?>" style="position:absolute;top: 2rem;right: 30rem;margin-right: 10px;">Done</a> 
   </div>
</div>
<main role="main" class="content-body-print">
   <div class="container">
   <div class="row">
      <?php if ($result == "Pass" && $exam_type != "Manual"): ?>
      <div class="row">
         <main role="main" class="content-body">
            <table align="center">
               <tr>
                  <td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>header.jpg" /></td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['COMPANY NAME']);?></td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Hereby Certifies</td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">That</td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><i><?php echo strtoupper($certificate['PARTICIPANT NAME']);?></i></td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Has Successfully Completed</td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['COURSE NAME']);?></td>
               </tr>
               <tr>
                  <td style="font-size:18px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Given on</td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['CERTIFICATION DATE']);?></td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">in</td>
               </tr>
               <tr>
                  <td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo $certificate['LOCATION'];?></td>
               </tr>
               <tr>
                  <td width="100">&nbsp;</td>
                  <td width="100" style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45"><?php echo strtoupper($certificate['NUMBER']);?> CEU</td>
                  <td align="right" width="100"><?php echo $certificate['SIGNATURE']; ?></td>
               </tr>
               <tr>
                  <td style="font-size:15px;font-family:tahoma;" align="center">5001 <br />
                     Certificate Number
                  </td>
                  <td style="font-size:15px;font-family:tahoma;" align="center"><?php echo date_format(date_create($certificate['CERTIFICATION DATE']),"M d, Y")?> <br />
                     Certificate Date
                  </td>
                  <td style="font-size:15px;font-family:tahoma;" align="center"><?php echo($certificate['CATEGORY']);?></td>
               </tr>
               <tr>
                  <td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>footer.jpg" /></td>
               </tr>
            </table>
            <form id="print_form" method="POST" action="<?= base_url()?>admin/demand/print_exam_certificate">
               <input type="hidden" id="content" name="content">
            </form>
         </main>
      </div>
      <?php endif;?>
   </div>
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
               <td class="table-border-td"><?=$score?> / 100 Points ( <?=$score?> %)
               </td>
            </tr>
            <tr>
               <td class="table-border-td"><?=$term["correctanswers"]?></td>
               <td class="table-border-td"><?=$correct_count?></td>
               <td class="table-border-td"><?=$term["incorrectanswers"]?></td>
               <td class="table-border-td"><?=$wrong_count?></td>
            </tr>
            <tr>
               <td class="table-border-td"><?=$term["passinggrade"]?></td>
               <td class="table-border-td"><?=round($pass_grade,2)?> % </td>
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
   	var baseurl = "<?php echo base_url(); ?>";

	function pagePrint() {
        var newWin = window.open();
        newWin.focus();
        newWin.document.write($('.content-body-print').html());
        newWin.print();
        newWin.close();
        
    }
	
	function pagePrintOld(){
	
		var content = $('.content-body-print').html();
		$('#content').val(content);
		$('#print_form').submit();
	
		$.ajax({
			//url: "<?= base_url()?>admin/demand/print_exam_certificate",
			url: "",
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
			error: function () {
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