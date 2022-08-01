<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['sent']; ?></h2>
	
	</header>

    <input type="hidden" id="msg_id" value="<?php echo $msg_id; ?>" />

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
                                    <a href="<?php echo base_url('admin/message/compose');?>" class="btn btn-block btn-primary btn-md pt-2 pb-2 text-3">
                                        <i class="fas fa-envelope mr-1"></i>
                                        <?php echo $term['compose']; ?>
                                    </a>

                                    <ul class="list-unstyled mt-3 pt-3">
                                        <li>
                                            <a href="<?php echo base_url('admin/message');?>" class="menu-item"> <i class="fa fa-inbox" style="margin-right: 9px;"></i><?php echo $term['inbox']; ?> <span class="badge badge-primary font-weight-normal float-right"><?php echo $new_ms_nums; ?></span></a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url('admin/message/sent');?>" class="menu-item"><i class="fa fa-paper-plane" style="margin-right: 9px;"></i><?php echo $term['sent']; ?></a>
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
                    <div class="inner-body mailbox-email">
                        <div class="mailbox-email-header mb-3">
                             <p class="mt-2 mb-0 text-5">  <?php if($f_sent_flag == 0) echo $term["From"]; ?> <a href="#"><?php echo $f_sender_name; ?></a> <?php echo $term['to']; ?> <a href="#"><?php echo $f_receiver_name; ?></a>, <?php echo $term['startedon']; ?> <?php echo $f_created_at; ?></p>

                        </div>
                        <div class="mailbox-email-container">
                            <div class="mailbox-email-screen pt-4">

                                <?php foreach($message_details_list as $item){ ?>
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-actions">
                                                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                                                <a href="javascript:void(0);" class="fas fa-reply"></a>
                                           <!--     <a href="#" class="fas fa-reply-all"></a>
                                                <a href="#" class="far fa-star"></a>-->
                                            </div>

                                            <p class="card-title"><?php echo $item['sender_name']; ?> <i class="fas fa-angle-right fa-fw"></i> <?php echo $item['receiver_name']; ?></p>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $item['message']; ?>
                                        </div>
                                        <div class="card-footer">
                                            <p class="m-0"><small><?php echo $item['created_at']; ?></small></p>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="compose pt-3" id="txtInput">

                                <div style="color:red;text-align: center;display: none;" id="messageErr"><?php echo $term['pleaseputmessage']; ?></div>

                                    <div class="col-lg-12">
                                        <div class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></div>
                                    </div>

                                <div class="text-right mt-3" style="margin-bottom: 1rem !important;">
                                    <a id="sendBtn" data-loading-overlay data-loading-overlay-options='{ "startShowing": false }' href="javascript: sendMsg();" class="btn btn-primary">
                                        <i class="fas fa-paper-plane mr-1"></i>
                                        <?php echo $term['send']; ?>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
		</div>
	</div>

	<!-- end: page -->
</section>

<script>
    $(".fas.fa-reply").on('click', function(){
        window.location.href="#txtInput";
    });

    function sendMsg(){
        var markupStr = $('.summernote').summernote('code');
        if(markupStr == "" || markupStr == "<p><br></p>"){
            $("#messageErr").css('display', 'block');
            return;
        }
        $("#messageErr").css('display', 'none');

       // $("#sendBtn").attr('data-loading-overlay-options','{ "startShowing": true }');


        $("#sendBtn").trigger('loading-overlay:show');


        $.ajax({
            url: '<?php echo base_url(); ?>admin/message/reply_message',
            type: 'POST',
            data: {
                'msg_id': $("#msg_id").val(),
                'content': markupStr
            },
            success: function (data, status, xhr) {
                $("#sendBtn").trigger('loading-overlay:hide');

                if(data == "success") {
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo $term['themessagesenttousersuccess']; ?>',
                        type: 'success'
                    });
                }
                else{
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
                setTimeout(function(){
                    window.location.href="<?php echo base_url(); ?>admin/message/details/0/" + $("#msg_id").val();
                }, 2500);
            },
            error: function(){
                $("#sendBtn").trigger('loading-overlay:hide');
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                    type: 'error'
                });

//                setTimeout(function(){
//                    window.location.href="<?php //echo base_url(); ?>//admin/message/details/0/" + $("#msg_id").val();
//                }, 2500);
            }
        });
    }

</script>