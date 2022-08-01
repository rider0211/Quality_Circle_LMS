    <section class="loginAndSignSection">
        <?php echo form_open(base_url('loginuser'),['id'=>'login_frm']);?>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-12 col-sm-3"></div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="loginWrap">
                        <h3>Sign In</h3>
                        <div class="errMsg"></div>
                        <div class="loginRow">
                            <input type="text" name="email" placeholder="Email" class="loginFeild">
                        </div>
                        <div class="loginRow">
                            <input type="password" id="password" data-toggle="password" name="password" placeholder="Password" class="loginFeild">
                        </div>
                        <div class="loginRow">
                            <div id="recaptcha3"></div>
                            <div class="errormessage" style="color: red; margin: 5px 0 0 0px"></div> 
                        </div>
                        <div class="loginRow">
                            <button type="submit" class="signin">Sign In</button>
                            <a href="<?php echo base_url(); ?>login/signup" class="loginlink">New user? SignUp</a>
                        </div>
                        <div style="float: right; font-size: 14px; font-weight: 500;">
                            <a href="<?php echo base_url(); ?>forgotPassword" style="color: #03a9f4;">Forgot password?</a>
                        </div>
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
    <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
    <script>
        var recaptcha1;
        var recaptcha3;
        var myCallBack = function() {
            //Render the recaptcha1 on the element with ID "recaptcha1"
            recaptcha3 = grecaptcha.render('recaptcha3', {
            'sitekey' : '6LfFAvsgAAAAAAjak90G1MG8y0W6HwOcSOYNH5z1', //Replace this with your Site key
            'theme' : 'light'
            });
        };
        $('#login_frm .signin').on('click', function(e){
            e.preventDefault();
            if(grecaptcha.getResponse(recaptcha3) == "") { 
                $(".errormessage").text("Please Fill The Google Captcha");
                return false;
            } else {
                var formdata 	= $('#login_frm').serialize();
                var formAction 	= $('#login_frm').attr('action');
                var msg 		= $('.errMsg');
                $('.signin').html('Processing...');
                $.ajax({
                    url : formAction,
                    type : 'post',
                    data : formdata,
                    success : function(res) {
                        if(res.type == 1){
                            if(res.msg)
                                msg.html('<div class="alert alert-success"><p class="m-0">'+res.msg+'</p></div>');
                            if(res.url)
                                location.reload();
                            if(res.redirect)
                                location.reload();
                            }else if(res.type == 0){
                            msg.html('<div class="alert alert-danger"><p class="m-0">'+res.msg+'</p></div>');
                            $('.signin').html('Sign In');
                        }else if(res.type == 3){
                            location.href="<?php echo base_url('otp-login/')?>"+res.key;
                        }else if(res.type == 2){
                              swal({
                                  text: res.msg,
                                  icon:"warning",
                              }).then((willDelete) => {
                                if (willDelete) {
                                  location.href="<?php echo base_url('pricing')?>";
                                }
                            });
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
