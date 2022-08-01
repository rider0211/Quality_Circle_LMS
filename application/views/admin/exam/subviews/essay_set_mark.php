<div class="row">
    <div class="form-group col-md-9">
        <textarea class="form-control" placeholder="Write Essay" name="essay" rows="3"><?=$answer?></textarea>
    </div>
    <div class="form-group row col-md-3">
	    <div class="input-group mb-3" style="height:40px">
			<input type="text" class="form-control" id="mark_<?=$id?>">
			<span class="input-group-append">
				<button class="btn btn-success" type="button" onclick="javascript:setMark('<?=$id?>')">Set Mark!</button>
			</span>
		</div>
	</div>
	<!--
    <div class="form-group row col-md-4">
		<label class="col-lg-3 control-label text-lg-right pt-2">Mark</label>
		<div class="col-lg-6">
			<div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:0, &quot;min&quot;: 0}">
				<div class="input-group" style="width:150px;">
					<input type="text" class="spinner-input form-control" maxlength="5" >
					<div class="input-group-append">
						<button type="button" class="btn btn-default spinner-up">
							<i class="fas fa-angle-up"></i>
						</button>
						<button type="button" class="btn btn-default spinner-down">
							<i class="fas fa-angle-down"></i>
						</button>
					</div>
				</div>
			</div>			
		</div>
	</div>
	-->
</div>
