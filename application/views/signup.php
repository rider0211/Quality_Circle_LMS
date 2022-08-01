<script src='https://www.google.com/recaptcha/api.js'></script> 
<style>
    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(2); /* IE */
        -moz-transform: scale(2); /* FF */
        -webkit-transform: scale(2); /* Safari and Chrome */
        -o-transform: scale(2); /* Opera */
        transform: scale(2);
        padding: 10px;
    }

    .help-tip{
        position: relative;
        /*top: 18px;
        right: 18px;*/
        text-align: center;
        background-color: #BCDBEA;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 14px;
        line-height: 26px;
        cursor: default;
    }

    .help-tip:before{
        content:'?';
        font-weight: bold;
        color:#fff;
    }

    .help-tip:hover p{
        display:block;
        transform-origin: 100% 0%;

        -webkit-animation: fadeIn 0.3s ease-in-out;
        animation: fadeIn 0.3s ease-in-out;

    }

    .help-tip p {
        display: none;
        text-align: left;
        background-color: #1E2021;
        padding: 15px;
        width: 300px;
        position: absolute;
        border-radius: 3px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
        right: -4px;
        color: #FFF;
        font-size: 12px;
        line-height: 25px;
        z-index: 99;
    }

    .help-tip p:before{ /* The pointer of the tooltip */
        position: absolute;
        content: '';
        width:0;
        height: 0;
        border:6px solid transparent;
        border-bottom-color:#1E2021;
        right:10px;
        top:-12px;
    }

    .help-tip p:after{ /* Prevents the tooltip from being hidden */
        width:100%;
        height:40px;
        content:'';
        position: absolute;
        top:-40px;
        left:0;
    }

    /* CSS animation */

    @-webkit-keyframes fadeIn {
        0% { 
            opacity:0; 
            transform: scale(0.6);
        }

        100% {
            opacity:100%;
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        0% { opacity:0; }
        100% { opacity:100%; }
    }

    .form-group.float-right {
        float: right;
        margin: -72px 10px 0px 0px;
        position: relative;
        top: 37px;
    }
</style>
    <?php echo form_open(base_url('signup'),['id'=>'signup_frm', 'name'=>'register_form']);?>
    <section class="loginAndSignSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-12 col-sm-3"></div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                        <h3>Sign Up</h3>
                    <div class="loginWrap">
                        <?php if($this->session->flashdata('success_msg')): ?>
                            <!-- <p><?php echo $this->session->flashdata('success_msg'); ?></p> -->

                            <div class="alert alert-success"><p class="m-0"><?php echo $this->session->flashdata('success_msg'); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="errMsg"></div>
                        <div class="loginRow">
                            <div class="login50 paddR5">
                                <input type="text" value="<?= set_value('firstname') ?>" name="firstname" placeholder="First Name" class="loginFeild">
                            </div>
                            <div class="login50 paddL5">
                                <input type="text" value="<?= set_value('lastname') ?>"  name="lastname" placeholder="Last Name" class="loginFeild">
                            </div>
                        </div>

                        <div class="loginRow">
                            <input type="text" value="<?= set_value('organization') ?>" name="organization" placeholder="Your Organazation Name" class="loginFeild">
                        </div>
                        <div class="loginRow">
                        	<select class="loginFeild" required name="country_code" id="country_code">
                            	<option value="">Select Country Code</option>
                                <?php if(isset($country_list) && !empty($country_list)){ 
									foreach($country_list as $cKey => $country){
								?>
								<option <?php if($country['phonecode'] == $this->session->userdata('country_code')){echo "selected";} ?> value="<?php echo $country['phonecode']; ?>"><?php echo $country['name'].' ('.$country['phonecode']; ?>)</option>
								<?php } } ?>
                            </select>
                        </div>
                        <div class="loginRow">
                            <input type="text" value="<?= set_value('phone') ?>" maxlength="11" name="phone" placeholder="Phone Number" class="loginFeild">
                        </div>
                        <div class="loginRow">
                            <input type="text" value="<?= set_value('email') ?>" name="email" placeholder="Email" class="loginFeild">
                        </div>
                        <div class="loginRow">
                            <input type="password" value="<?= set_value('password') ?>"  name="password" placeholder="Password" class="loginFeild">
                            <div class="form-group float-right">
                                <div class="help-tip">
                                    <p>Must include at least 8 chracters <br/>Must include at least 1 uppercase letter(A-Z) <br/>Must include at least 1 lowercase letter(a-z) <br/>Must include at least 1 numeric digit(0-9) <br/>Must include at least 1 special character(!@#$%^*)</p>
                                </div>
                            </div>
                        </div>
                        <div class="loginRow">
							<input type="password" value="<?= set_value('confirm_password') ?>" name="confirm_password" placeholder="Confirm Password" class="loginFeild">
						</div>

                        <div class="loginRow">
                            <select class="loginFeild" name="country" id="country" required="required">
                                <option value="">Select Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Åland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia, Plurinational State of</option>
                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvet Island</option>
                                <option value="BR">Brazil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="BN">Brunei Darussalam</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CM">Cameroon</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="CF">Central African Republic</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CX">Christmas Island</option>
                                <option value="CC">Cocos (Keeling) Islands</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CG">Congo</option>
                                <option value="CD">Congo, the Democratic Republic of the</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CI">Côte d'Ivoire</option>
                                <option value="HR">Croatia</option>
                                <option value="CU">Cuba</option>
                                <option value="CW">Curaçao</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands (Malvinas)</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="TF">French Southern Territories</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard Island and McDonald Islands</option>
                                <option value="VA">Holy See (Vatican City State)</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IR">Iran, Islamic Republic of</option>
                                <option value="IQ">Iraq</option>
                                <option value="IE">Ireland</option>
                                <option value="IM">Isle of Man</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KP">Korea, Democratic People's Republic of</option>
                                <option value="KR">Korea, Republic of</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Lao People's Democratic Republic</option>
                                <option value="LV">Latvia</option>
                                <option value="LB">Lebanon</option>
                                <option value="LS">Lesotho</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macao</option>
                                <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia, Federated States of</option>
                                <option value="MD">Moldova, Republic of</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="MM">Myanmar</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="MP">Northern Mariana Islands</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestinian Territory, Occupied</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Réunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russian Federation</option>
                                <option value="RW">Rwanda</option>
                                <option value="BL">Saint Barthélemy</option>
                                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                <option value="KN">Saint Kitts and Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="MF">Saint Martin (French part)</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
                                <option value="VC">Saint Vincent and the Grenadines</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">Sao Tome and Principe</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SX">Sint Maarten (Dutch part)</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="SO">Somalia</option>
                                <option value="ZA">South Africa</option>
                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                <option value="SS">South Sudan</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SD">Sudan</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="SY">Syrian Arab Republic</option>
                                <option value="TW">Taiwan, Province of China</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania, United Republic of</option>
                                <option value="TH">Thailand</option>
                                <option value="TL">Timor-Leste</option>
                                <option value="TG">Togo</option>
                                <option value="TK">Tokelau</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad and Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks and Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US">United States</option>
                                <option value="UM">United States Minor Outlying Islands</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela, Bolivarian Republic of</option>
                                <option value="VN">Viet Nam</option>
                                <option value="VG">Virgin Islands, British</option>
                                <option value="VI">Virgin Islands, U.S.</option>
                                <option value="WF">Wallis and Futuna</option>
                                <option value="EH">Western Sahara</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
                            </select>
                        </div>

                        <div class="loginRow">
							<label class="radioBox">Learner
							  <input type="radio" name="user_type" checked="checked" value="Learner" onclick="sel_company(0)">
							  <span class="checkmark"></span>
							</label>
							<label class="radioBox">Company Administrator
							  <input type="radio" name="user_type" value="Admin" onclick="sel_company(1)">
							  <span class="checkmark"></span>
							</label>
						</div>
                        <div class="loginRow company-row">
                            <label class="col-sm-4 control-label" style="padding: 6px"><?=$term["company"]?></label>
                            <div class="col-sm-6">
                                <select id="company_id" name="company_id" class="form-control mb3">
                                    <?php foreach($company_data as $item){ ?>
                                        <option value="<?php echo $item['id']; ?>"> <?php echo $item['name']; ?></option>
                                    <?php }  ?>
                                </select>
                            </div>
                        </div>

                        <div class="loginRow">
                            <div>
                                <input type="checkbox" required />
                                <span style="margin-left: 14px;">I agree to the website's <a style="color: red;text-decoration: underline !important;" href="javascript: window.open('<?php echo base_url('welcome/privacy');?>','_blank')">Privacy Policy</a>.</span>
                            </div>
                        </div>

                        <div class="loginRow">
                            <div class="g-recaptcha" data-sitekey="6LfFAvsgAAAAAAjak90G1MG8y0W6HwOcSOYNH5z1"></div> 
                            <div class="errormessage" style="color: red; margin: 5px 0 0 0px"></div> 
                        </div>
                        <div class="loginRow">
                            <!--<button type="submit" class="signin">Sign Up</button>-->
                            <a href="javascript:register()" class="signin">Sign Up</a>
                            <a href="<?php echo base_url(); ?>login" class="loginlink">Already Account. Sign In</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-3"></div>
            </div>
        </div>
    </section>
    <?php echo form_close();?>
<script>
    var msg = $('.errMsg');
    <?php foreach($errors as $error){
        echo "msg.html('<div class=\"alert alert-danger\"><p class=\"m-0\">".$error."</p></div>');";
        break;
    }?>
    function sel_company(is_company){
        if(is_company == 0)
            $('.company-row').show();
        else
            $('.company-row').hide();
    }
    function register(){
        // if(grecaptcha.getResponse() == "") {
        //     // console.log('recaptcha error');
        //     $(".errormessage").text("Please Fill The Google Captcha");
        // }
        // else{
            // console.log('All fine need to submit form now');
            $("#signup_frm").submit();
        // } 
    }
</script>
