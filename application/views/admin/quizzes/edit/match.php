<style>
	#result td.image img {
		margin-right: 10px;
	}
</style>
<script type="text/javascript">
	$(function() {
		$(window).resize(build_matchs);
		build_matchs();
	});
	function match_columns() {
		if($("#result :radio:checked").length==2) {
			var n1 = $("#result :radio[name='column1']:checked").parents(".list-group-item").prevAll(".list-group-item").length;
			var n2 = $("#result :radio[name='column2']:checked").parents(".list-group-item").prevAll(".list-group-item").length;
			$("#result span.match input:first-child[value='" + n1 + "']").parents("span.match").html("");
			$("#result span.match input:last-child[value='" + n2 + "']").parents("span.match").html("");
			var num = $("span.match").length;
			var match = $("<span class='match'/>")
				.append("<input name='content[answers][" + num + "][column1]' value='" + n1 + "' type='hidden'>")
				.append("<input name='content[answers][" + num + "][column2]' value='" + n2 + "' type='hidden'>");
			match.insertBefore($("canvas"));
			build_matchs();

			$("#result :radio").each(function() {
				this.checked = false;
			});
		}
	}
	function active_column(row) {
		var prev = $("#result .active");
		$("#result .active").removeClass('active');
		$(row).addClass('active');
	}
	function up_answer() {
		var cur = $("#result .list-group-item.active");
		var prev = cur.prev(".list-group-item");
		if(prev.length) {
			var n1 = prev.prevAll(".list-group-item").length;
			var n2 = n1+1;
			if(cur.parents(".column1").length) {
				var match1 = $("span.match input:first-child[value='"+n1+"']").parent();
				var match2 = $("span.match input:first-child[value='"+n2+"']").parent();
				$("input:first",match1).val(n2);
				$("input:first",match2).val(n1);
			} else {
				var match1 = $("span.match input:last-child[value='"+n1+"']").parent();
				var match2 = $("span.match input:last-child[value='"+n2+"']").parent();
				$("input:last",match1).val(n2);
				$("input:last",match2).val(n1);
			}
			cur.after(prev);
			build_matchs();
		}
	}
	function down_answer() {
		var cur = $("#result .list-group-item.active");
		var next = cur.next(".list-group-item");
		if(next.length) {
			var n1 = cur.prevAll(".list-group-item").length;
			var n2 = n1+1;
			if(cur.parents(".column1").length) {
				var match1 = $("span.match input:first-child[value='"+n1+"']").parent();
				var match2 = $("span.match input:first-child[value='"+n2+"']").parent();
				$("input:first",match1).val(n2);
				$("input:first",match2).val(n1);
			} else {
				var match1 = $("span.match input:last-child[value='"+n1+"']").parent();
				var match2 = $("span.match input:last-child[value='"+n2+"']").parent();
				$("input:last",match1).val(n2);
				$("input:last",match2).val(n1);
			}
			cur.before(next);
			build_matchs();
		}
	}
	function add_answer(col) {
		var num = $("#result .list-group.column" + col + " .list-group-item").length;
		var row = $("#result .list-group.column" + col + " .list-group-item:last").clone().removeClass("active");
		$("input", row).each(function() {
			$(this).attr("name", $(this).attr("name").replace("["+(num-1)+"]","["+num+"]"));
		});
		row.appendTo($("#result .list-group.column" + col));
	}
	function del_answer() {
		if(confirm("Delete?")) {
			var cur = $("#result .list-group-item.active");
			if(cur.parents(".column1").length) {
				$("#result span.match input:first-child[value='" + cur.prevAll(".list-group-item").length + "']").parents("span.match").html("");
			} else {
				$("#result span.match input:last-child[value='" + cur.prevAll(".list-group-item").length + "']").parents("span.match").html("");
			}
			cur.remove();
			build_matchs();
		}
	}
</script>
<div class="row">
	<div class="col-sm-5" style="padding-right: 0">
		<div class="list-group column1">
			<?php foreach($content["column1"] as $i=>$answer) : ?>
				<div class="list-group-item" onclick="active_column(this)">
					<table width="100%">
						<tr>
							<td>
								<input type="text" class="form-control input-sm" name="content[column1][<?= $i ?>][html]" value="<?= strip_tags($answer["html"]) ?>"/>
							</td>
							<td width="30px" align="right">
								<input type="radio" name="column1" onchange="match_columns()">
							</td>
						</tr>
					</table>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="col-sm-2" style="padding:0">
		<?php if($content["answers"]) foreach($content["answers"] as $i=>$match) { ?>
			<span class="match">
				<input type="hidden" name="content[answers][<?= $i ?>][column1]" value="<?= $match[column1] ?>">
				<input type="hidden" name="content[answers][<?= $i ?>][column2]" value="<?= $match[column2] ?>">
			</span>
		<?php } ?>
		<canvas>
			<script type="text/javascript">
				function clear_matchs() {
					var width = $("canvas").attr("width");
					var height = $("canvas").attr("height");
					var ctx = $("canvas").get(0).getContext("2d");
					ctx.clearRect(0,0,width,height);
					$("span.match").remove();
				}
				function build_matchs() {
					var width = $("canvas").parent().width();
					var height = $("#result div.row").height()-4;
					$("canvas").attr("width", width);
					$("canvas").attr("height", height);
					var ctx = $("canvas").get(0).getContext("2d");
					var pts1 = [], pts2 = [];
					$(".column1 .list-group-item").each(function() {
						var pos = $(this).position();
						pts1.push({
							x: 0, y: pos.top + $(this).height()/2 + 11
						});
					});
					$(".column2 .list-group-item").each(function(i) {
						var pos = $(this).position();
						pts2.push({
							x: width, y: pos.top + $(this).height()/2 + 11
						});
					});
					ctx.beginPath();
					$("span.match:has(input)").each(function() {
						var i = $("input:first",this).val();
						var j = $("input:last",this).val();
						ctx.moveTo(pts1[i].x,pts1[i].y);
						ctx.bezierCurveTo((pts1[i].x+pts2[j].x)/2,pts1[i].y,(pts1[i].x+pts2[j].x)/2,pts2[j].y,pts2[j].x,pts2[j].y);
					});
					ctx.stroke();
				};
			</script>
		</canvas>
	</div>
	<div class="col-sm-5" style="padding-left: 0">
		<div class="list-group column2">
			<?php foreach($content["column2"] as $i=>$answer) : ?>
				<div class="list-group-item" onclick="active_column(this)">
					<table width="100%">
						<tr>
							<td width="30px">
								<input type="radio" name="column2" onchange="match_columns()">
							</td>
							<td>
								<input type="text" class="form-control input-sm" name="content[column2][<?= $i ?>][html]" value="<?= strip_tags($answer["html"]) ?>"/>
							</td>
						</tr>
					</table>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<div class="item-handler btn-group  btn-group-sm pull-right">
	<button type="button" class="btn btn-default" onclick="add_answer(1)">Append Column1</button>
	<button type="button" class="btn btn-default" onclick="add_answer(2)">Append Column2</button>
	<button type="button" class="btn btn-default" onclick="clear_matchs()">Clear Links</button>
	<button type="button" class="btn btn-default" onclick="up_answer()">Up</button>
	<button type="button" class="btn btn-default" onclick="down_answer()">Down</button>
	<button type="button" class="btn btn-default" onclick="del_answer()">Remove</button>
</div>
