    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <section class="loginAndSignSection">
        <?php echo form_open(base_url('login/verify_otp/'),['id'=>'otp_frm']);?>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-12 col-sm-3"></div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="loginWrap" style="border-top: 5px solid #0088cc;border-radius: 5px;">
                        <h3>One Time Password</h3>
                        <div class="errMsg"><div class="alert alert-info"><p class="m-0"><?php echo $userMsg; ?></p></div></div>
                        <div class="loginRow">
                            <input type="text" name="otp" id="otp" maxlength="5" placeholder="OTP" class="otpFeild">
                        </div>
                        <div class="loginRow">
                            <button type="submit" class="otplogin signin">Verify OTP</button>
                            <a href="<?php echo base_url('login/resend_otp/')?><?php echo $token; ?>" class="loginlink">Resend OTP</a>
                        </div>
                        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-3"></div>
            </div>
        </div>
        <?php echo form_close();?>
    </section>
    <script src="<?php echo base_url(); ?>assets/js_company/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js_company/filterable.pack.js"></script>
    <script src="<?php echo base_url(); ?>assets/js_company/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js_company/jquery.simplyscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/js_company/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js_company/owl.carousel.min.js"></script>
    <script>
        $('#otp_frm .otplogin').on('click', function(e){
            $('.otplogin').html('Processing...');
            e.preventDefault();
            var formdata 	= $('#otp_frm').serialize();
            var formAction 	= $('#otp_frm').attr('action');
            var msg 		= $('.errMsg');
            $.ajax({
                url : formAction,
                type : 'post',
                data : formdata,
                success : function(res){
                    if(res.type == 1){
                        if(res.msg)
                            msg.html('<div class="alert alert-success"><p class="m-0">'+res.msg+'</p></div>');
                        if(res.url)
                            location.reload();
                        if(res.redirect)
                            location.reload();
                    }else if(res.type == 0){                        
                        msg.html('<div class="alert alert-danger"><p class="m-0">'+res.msg+'</p></div>');                        
                        $('.otplogin').html('Verify OTP');
                    }else if(res.type == 2){
                        swal({
                            text: res.msg,
                            icon:"warning",
                        }).then((willDelete) => {
                            if (willDelete) {
                                location.href="<?php echo base_url('pricing')?>";
                            }
                        });
                        $(this).html('Verify OTP');
                    }
                }
            });            
        });
    </script>
</body>

</html>
