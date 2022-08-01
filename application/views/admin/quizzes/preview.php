<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.core.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.widget.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.mouse.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.sortable.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/vendor/jquery.forms-2.12.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jqxcore.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jqxdragdrop.js") ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= site_url("assets/css/question.css") ?>"/>
<script type="text/javascript" src="<?= site_url("assets/js/question.js") ?>"></script>
<style type="text/css">
    blockquote {
        border-color: transparent;
    }
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["quizpreview"]?></h2>
	</header>
	<div>
		<h5>
			<?php
				$this->view("admin/quizzes/check/direction",$question);
			?>
		</h5>
		<blockquote class="preview" type="<?= $question["quiz_type"] ?>" id="<?= $question["id"] ?>">
			<?php
				if($question["quiz_type"]=='TrueFalse')
					$this->view("admin/quizzes/check/truefalse",$question);
				else if($question["quiz_type"]=='MultipleChoice')
					$this->view("admin/quizzes/check/multichoice",$question);
				else if($question["quiz_type"]=='MultipleResponse' || $question["quiz_type"]=='MultipleSwitch')
					$this->view("admin/quizzes/check/multicheck",$question);
				else if($question["quiz_type"]=='FillInTheBlank')
					$this->view("admin/quizzes/check/typein",$question);
				else if($question["quiz_type"]=='Sequence')
					$this->view("admin/quizzes/check/sequence",$question);
				else if($question["quiz_type"]=='Matching')
					$this->view("admin/quizzes/check/match",$question);
				else if($question["quiz_type"]=='FillInTheBlankEx')
					$this->view("admin/quizzes/check/fill",$question);
				else if($question["quiz_type"]=='MultipleChoiceText' || $question["quiz_type"]=='MultipleChoiceLine')
					$this->view("admin/quizzes/check/multiselect",$question);
				else if($question["quiz_type"]=='Correct')
					$this->view("admin/quizzes/check/correct",$question);
				else if($question["quiz_type"]=='WordBank')
					$this->view("admin/quizzes/check/wordbank",$question);
				else if($question["quiz_type"]=='Numeric')
					$this->view("admin/quizzes/check/numeric",$question);
				else if($question["quiz_type"]=='Grouping')
					$this->view("admin/quizzes/check/group",$question);
				else if($question["quiz_type"]=='Translate')
					$this->view("admin/quizzes/check/translate",$question);
				else if($question["quiz_type"]=='RecordAudio' || $question["quiz_type"]=='RecordVideo')
					$this->view("admin/quizzes/check/record",$question);
			?>
		</blockquote>
		<div class="form-group" style="padding-top:20px">
			<button type="button" class="btn btn-default" onclick="check()">
				<i class="fa fa-check"></i>
				<?=$term["check"]?>
			</button>
			<a class="btn btn-default" href="<?= site_url("admin/quizzes/edit") ?>/<?= $question["id"] ?>">
				<i class="fa fa-arrow-left"></i>
				<?=$term["back"]?>
			</a>
		</div>
	</div>
</section>
<script type="text/javascript">
   $(function() {
        init_quiz($(".preview"));
   });
   function check() {
        $(".preview form").attr("action","<?= site_url("admin/quizzes/check") ?>").ajaxSubmit({
			type: "POST",
            data: {
                id: <?= intval($question["id"]) ?>
            },
            success: function(res) {
				if(!res)
					res = 0;
                alert("Your score is " + res);
            }
        });
    }
    
</script>