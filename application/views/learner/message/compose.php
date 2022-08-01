<style>
    .select2-results__group{
        font-size: 16px !important;
        color:#0088CC !important;
    }
</style>

<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['message']; ?></h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
            <section class="content-with-menu mailbox">
                <div class="content-with-menu-container" data-mailbox="" data-mailbox-view="folder">
                    <div class="inner-menu-toggle">
                        <a href="#" class="inner-menu-expand" data-open="inner-menu">
                            <?php echo $term['showmenu']; ?> <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>

                    <menu id="content-menu" class="inner-menu" role="menu">
                        <div class="nano has-scrollbar hovered">
                            <div class="nano-content" tabindex="0" style="right: -17px;">

                                <div class="inner-menu-toggle-inside">
                                    <a href="#" class="inner-menu-collapse">
                                        <i class="fas fa-chevron-up d-inline-block d-md-none"></i><i class="fas fa-chevron-left d-none d-md-inline-block"></i> <?php echo $term['hidemenu']; ?>
                                    </a>

                                    <a href="#" class="inner-menu-expand" data-open="inner-menu">
                                        <?php echo $term['showmenu']; ?> <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>

                                <div class="inner-menu-content">
                                    <a href="<?php echo base_url('learner/message/compose');?>" class="btn btn-block btn-primary btn-md pt-2 pb-2 text-3">
                                        <i class="fas fa-envelope mr-1"></i>
                                        <?php echo $term['compose']; ?>
                                    </a>

                                    <ul class="list-unstyled mt-3 pt-3">
                                        <li>
                                            <a href="<?php echo base_url('learner/message');?>" class="menu-item"> <i class="fa fa-inbox" style="margin-right: 9px;"></i><?php echo $term['inbox']; ?> <span class="badge badge-primary font-weight-normal float-right"><?php echo $new_ms_nums; ?></span></a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url('learner/message/sent');?>" class="menu-item"><i class="fa fa-paper-plane" style="margin-right: 9px;"></i><?php echo $term['sent']; ?></a>
                                        </li>
<!--                                        <li>
                                            <a href="<?php /*echo base_url('company/message/favourite');*/?>" class="menu-item">Favourites</a>
                                        </li>
                                        <li>
                                            <a href="<?php /*echo base_url('company/message/trash');*/?>" class="menu-item">Trash</a>
                                        </li>-->
                                    </ul>

                                    <hr class="separator">

                                </div>
                            </div>
                            <div class="nano-pane" style="opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 82px; transform: translate(0px, 0px);"></div></div></div>
                    </menu>
                    <div class="inner-body" style="margin-top: 0px;">
                        <div class="inner-toolbar clearfix" style="left: 470px;">
                            <ul>
                                <li>
                                    <a ><?php echo $term['sendmessage']; ?></a>
                                </li>
                             <!--   <li id="sendMsgLoading" style="display: none;">
                                    <a style="min-width: 65px;min-height: 16px;" data-loading-overlay data-loading-overlay-options='{ "startShowing": true }'>
                                    </a>
                                </li>-->
                             </ul>
                        </div>


                        <div class="mailbox-compose">
                            <form class="form-horizontal form-bordered form-bordered">

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2"><?php echo $term['selectuser']; ?> <em class="red" style="color:red;">*</em></label>
                                    <div class="col-lg-6">
                                        <select id="receiverList" data-plugin-selectTwo class="form-control populate">
                                            <optgroup label="Administrator">
                                                <?php foreach($company_receiver_list as $item){ ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['fullname'];?></option>
                                                <?php } ?>
                                            </optgroup>
                                            <optgroup label="Instructor">
                                                <?php foreach($instructor_receiver_list as $item){ ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['fullname'];?></option>
                                                <?php } ?>
                                            </optgroup>
                                            <optgroup label="Learner">
                                                <?php foreach($learner_receiver_list as $item){ ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['fullname'];?></option>
                                                <?php } ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div style="color:red;text-align: center;display: none;" id="messageErr"><?php echo $term['pleaseputmessage']; ?></div>
                                <div class="form-group row">

                                    <label class="col-lg-2 control-label text-lg-right pt-2"><?php echo $term['message']; ?> <em class="red" style="color:red;">*</em></label>
                                    <div class="col-lg-9">
                                        <div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></div>
                                    </div>
                                </div>

                                <div class="text-right mt-3 col-md-10" style="margin-bottom: 1rem !important;">
                                    <a id="sendBtn" data-loading-overlay data-loading-overlay-options='{ "startShowing": false }' href="javascript: sendMsg();" class="btn btn-primary">
                                        <i class="fas fa-paper-plane mr-1"></i>
                                        <?php echo $term['send']; ?>
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
		</div>
	</div>

	<!-- end: page -->
</section>


<script>

    function sendMsg(){
        var receiver_id = $("#receiverList").val();
        var markupStr = $('.summernote').summernote('code');
        if(markupStr == "" || markupStr == "<p><br></p>"){
            $("#messageErr").css('display', 'block');
            return;
        }
        $("#messageErr").css('display', 'none');

        //$("#sendBtn").attr('data-loading-overlay-options','{ "startShowing": true }');
        $("#sendBtn").trigger('loading-overlay:show');
        $.ajax({
            url: '<?php echo base_url(); ?>/learner/message/send_message',
            type: 'POST',
            data: {
                'receiver_id': receiver_id,
                'content': markupStr
            },
            success: function (data, status, xhr) {
                $("#sendBtn").trigger('loading-overlay:hide');
                new PNotify({
                    title: '<?php echo $term['success']; ?>',
                    text: '<?php echo $term['themessagesenttousersuccess']; ?>',
                    type: 'success'
                });
                setTimeout(function(){
                    window.location.href="<?php echo base_url(); ?>/learner/message/sent";
                }, 2500);
            },
            error: function(){
                $("#sendBtn").trigger('loading-overlay:hide');
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                    type: 'error'
                });

                setTimeout(function(){
                    window.location.href="<?php echo base_url(); ?>/learner/message/compose";
                }, 2500);
            }
        });
    }

</script>