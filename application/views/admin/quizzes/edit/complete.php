<?php $rand = rand() ?>
<div class="list-group">
	<?php if($question["answers"]) foreach($question["answers"] as $i=>$answer) : ?>
		<div id="answer-<?= $i ?>" class="list-group-item" onclick="active_row(this)">
			<table width="100%">
				<tr>
					<td width="<?= $question["partial"]?100:25 ?>px" align="center">
						<input type="radio" class="entire <?= $question["partial"]?"hidden":"" ?>" name="content[correct<?= $rand ?>]" <?= $correct==$i?checked:'' ?> value="<?= $i ?>">
						<input type="number" class="form-control input-sm partial <?= $question["partial"]?"":"hidden" ?>" min="0" max="100" class="form-control input-sm" name="content[answers][<?= $i ?>][points]" value="<?= $answer["points"] ?>" required>
					</td>
					<td>
						<input type="text" class="form-control input-sm" name="content[answers][<?= $i ?>][label]" value="<?= $answer[label] ?>" required/>
					</td>
					<td>
						<input type="text" class="form-control input-sm" name="content[answers][<?= $i ?>][html]" value="<?= $answer["html"] ?>" required/>
					</td>
				</tr>
			</table>
		</div>
	<?php endforeach ?>
</div>
<div class="row">
	<div class="item-handler pull-left">
		<label>
			<input name="content[partial]" type="checkbox" <?= $question["partial"]?"checked":"" ?> value="1" onchange="toggle_partial(this)">
			Item Marking
		</label>
	</div>
	<div class="item-handler btn-group  btn-group-sm pull-right">
		<button type="button" class="btn btn-default" onclick="add_row(this)">Add</button>
		<button type="button" class="btn btn-default" onclick="up_row(this)">Up</button>
		<button type="button" class="btn btn-default" onclick="down_row(this)">Down</button>
		<button type="button" class="btn btn-default" onclick="del_row(this)">Delete</button>
	</div>
</div>
