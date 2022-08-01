<style type="text/css">
    blockquote {
        border-color: transparent;
    }
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["sccquestionpreview"]?></h2>
	</header>
	<div>
		<h5>
			<?php print $question[0]["question"];	?>
		</h5>
		<blockquote class="preview" id="<?= $question["id"] ?>">
			<form class="form-inline list-group" id="frm_solution">
				<table width="100%">
				<?php 
					foreach ($answers as $key => $ans) {
						print sprintf('<tr><td>
							<input type="radio" name="solution" value="%s">%s
						</td></tr>', $ans["answer_possibility"], $ans["answer"]);
					}
				?>				
				</table>
			</form>
		</blockquote>
		<div class="form-group" style="padding-top:20px">
			<button type="button" class="btn btn-default" onclick="check()">
				<i class="fa fa-check"></i>
				<?=$term["check"]?>
			</button>
			<a class="btn btn-default" href="<?= site_url("admin/sccquestions") ?>">
				<i class="fa fa-arrow-left"></i>
				<?=$term["back"]?>
			</a>
		</div>
	</div>
</section>
<script type="text/javascript">
   function check() {
   		var formData = new FormData($('#frm_solution')[0]);
   		formData.append('sgu_id', <?= intval($question[0]["sgu_id"]) ?>);
   		$.ajax({
            url: '<?php echo base_url();?>admin/sccquestions/check',
            type: 'POST',
            data: formData,
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {
            	if(data == "Right") {
            		new PNotify({
	                    title: 'Right!',
	                    text: data,
	                    type: 'success'
	                });
            	} else {
            		new PNotify({
	                    title: 'Incorrect!',
	                    text: data,
	                    type: 'warning'
	                });
            	}
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
    
</script>