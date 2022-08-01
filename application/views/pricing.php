<style>
   .matrix {
   padding: 95px 0 40px;
   overflow: hidden;
   float: none;
   }
   .matrix h2 {
   font-family: 'Helvetica Neue',Arial,Helvetica,sans-serif;
   font-size: 36px;
   text-align: center;
   margin-bottom: 20px;
   }
   .matrix table.feature_comparison_chart {
   margin: 0 auto;
   border-collapse: separate;
   border-spacing: initial;
   }
   .matrix table.feature_comparison_chart thead tr.tier_header th {
   border-top-left-radius: .5rem;
   border-top-right-radius: .5rem;
   border-top-width: 1px;
   font-size: 1.25rem;
   padding-bottom: .625rem;
   }
   .matrix table.feature_comparison_chart tbody tr td svg {
   width: 2rem;
   height: 1.75rem;
   }
   .matrix.left table.feature_comparison_chart thead tr.tier_header th.tier_left, .matrix.left table.feature_comparison_chart thead tr.tier_targets td.tier_left {
   background-color: #00ADEF;
   color: #FFF;
   }
   .matrix table.feature_comparison_chart thead tr.tier_pricing td {
   line-height: 1.625rem;
   }.matrix table.feature_comparison_chart .tier_left {
   background: -webkit-linear-gradient(left,transparent 0,transparent 93%,rgba(0,0,0,.07) 100%);
   background: linear-gradient(to right,transparent 0,transparent 93%,rgba(0,0,0,.07) 100%);
   }
   .matrix table.feature_comparison_chart thead td, .matrix table.feature_comparison_chart thead th {
   width: 16.25rem;
   padding: 1.25rem;
   vertical-align: top;
   }
   .matrix table.feature_comparison_chart td, .matrix table.feature_comparison_chart th {
   border: 1px solid #D0D8DB;
   border-top-width: 0;
   border-bottom-width: 0;
   padding: .9375rem 1.5625rem;
   text-align: center;
   color: #456;
   }
   .matrix table.feature_comparison_chart tbody tr:nth-child(odd) {
   background-color: #EEF1F2;
   }
   .matrix table.feature_comparison_chart tbody tr th .info aside {
   color: #FFF;
   font-size: .75rem;
   line-height: 1.125rem;
   background: rgba(0,0,0,.7);
   padding: .625rem;
   border-radius: .375rem;
   display: none;
   position: absolute;
   width: 16.25rem;
   top: -.9375rem;
   left: 1.875rem;
   }
   .matrix table.feature_comparison_chart tbody tr th .info {
   font-weight: 400;
   position: relative;
   float: right;
   width: 1.125rem;
   height: 1.125rem;
   }
   .matrix table.feature_comparison_chart tbody tr:first-child th {
   border-top-left-radius: .5rem;
   }
   .matrix table.feature_comparison_chart tbody tr:first-child th {
   border-top-width: 1px;
   }
   .matrix table.feature_comparison_chart tbody tr th {
   font-weight: 700;
   border-right-width: 0;
   text-align: left;
   }
   .matrix table.feature_comparison_chart tfoot td:first-child:empty, .matrix table.feature_comparison_chart tfoot th:first-child:empty, .matrix table.feature_comparison_chart thead td:first-child:empty, .matrix table.feature_comparison_chart thead th:first-child:empty {
   visibility: hidden;
   }
   .matrix table.feature_comparison_chart td, .matrix table.feature_comparison_chart th {
   border: 1px solid #D0D8DB;
   border-top-width: 0;
   border-bottom-width: 0;
   padding: .9375rem 1.5625rem;
   text-align: center;
   color: #456;
   }
   .matrix table.feature_comparison_chart tbody tr th {
   font-size: .875rem;
   line-height: 1.375;
   }
   .matrix table.feature_comparison_chart tbody tr:last-child th {
   border-bottom-left-radius: .5rem;
   }
   .matrix table.feature_comparison_chart tbody tr:last-child th {
   border-bottom-width: 1px;
   }
   .matrix.left table.feature_comparison_chart .tier_left {
   background: 0 0;
   }
   .matrix table.feature_comparison_chart .tier_left {
   background: -webkit-linear-gradient(left,transparent 0,transparent 93%,rgba(0,0,0,.07) 100%);
   background: linear-gradient(to right,transparent 0,transparent 93%,rgba(0,0,0,.07) 100%);
   }
   .matrix table.feature_comparison_chart tfoot tr td {
   border-bottom-left-radius: .5rem;
   border-bottom-right-radius: .5rem;
   border-bottom-width: 1px;
   padding: 1.25rem;
   }
   .matrix table.feature_comparison_chart td, .matrix table.feature_comparison_chart th {
   border: 1px solid #D0D8DB;
   border-top-width: 0;
   border-bottom-width: 0;
   padding: .9375rem 1.5625rem;
   text-align: center;
   color: #456;
   }
   .matrix.left table.feature_comparison_chart thead tr.tier_header th.tier_left{
   background-color: #00ADEF;
   color: #FFF;
   }
   .matrix table.feature_comparison_chart thead td .iris_btn {
    margin: .3125rem 0 .625rem;
}
.matrix table.feature_comparison_chart td .iris_btn {
    font-weight: 400;
    min-width: 1.25rem;
}
.iris_btn--secondary {
    color: #1A2E3B;
    border-color: #EEF1F2;
    background-color: #EEF1F2;
    letter-spacing: .25px;
}
.iris_btn {
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    position: relative;
    width: auto;
    min-width: 5.25rem;
    margin: 0;
    padding: 0 1rem;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: .875rem;
    font-weight: 700;
    line-height: 2.7142857143;
    border-width: 1px;
    border-style: solid;
    border-radius: .1875rem;
    -webkit-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out;
    text-align: center;
    vertical-align: middle;
    letter-spacing: .5px;
    appearance: none;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-font-smoothing: initial;
}
.iris_btn--lg {
    min-width: 7rem;
    min-height: 2.375rem;
    min-height: 3rem;
    padding: 0 1.5rem;
    font-size: 1rem;
    line-height: 2.875;
}
.nav-tabs {
    border: none;
    margin-top: 80px;
    margin-bottom: 0px;
}
</style>
<?php
$userID = $this->session->userdata('userId');
?>
<section class="innerHeader pricingHero">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-sm-12">
            <div class="captionSliderHero">
               <h2>CREATE YOUR OWN ACADEMY AND START SELLING INTERACTIVE COURSES ONLINE</h2>
               <p>Virtual Instructor  Led Training  (VILT), Live  and On-Demand Webinars  along with  Branded Customized  on-line single  user  and on-site presenter led solutions. 
               </p>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="pricingSection">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-sm-12">
            <ul class="nav nav-tabs pricingTabs">
               <li class="active"><a data-toggle="tab" href="#Monthly">Monthly</a></li>
               <li><a data-toggle="tab" href="#Yearly">Yearly</a></li>
            </ul>
            <div class="tab-content">
               <div id="Monthly" class="tab-pane fade in active matrix">
                  <div class="width_wrapper">
                     <table summary="Compare our membership plans" class="feature_comparison_chart matrix_desktop">
                        <!-- HEADER -->
                        <thead>
                           <tr class="tier_header">
                              <th></th>
                              <th class="tier_left" scope="col">
                                 <span class="mobile_hide"><?php echo $plans_trial->name?> </span>                    
                              </th>
                              <?php foreach($plans_month as $key=>$val):?>
                              <th class="tier_center" scope="col">
                                 <span class="mobile_hide"><?php echo $val->name?> </span>                    
                              </th>
                              <?php endforeach;?>
                              <th class="tier_right" scope="col">
                                 <span class="mobile_hide"><?php echo $plans_unlimit->name?> </span>                    
                              </th>
                           </tr>
                           <tr class="tier_targets mobile_hide">
                              <td></td>
                              <td class="tier_left">
                                 For free                    
                              </td>
                              <td class="tier_center">
                                 For personal                    
                              </td>
                              <td class="tier_center">
                                 For teams and businesses                    
                              </td>
                              <td class="tier_center">
                                 For Company                    
                              </td>
                              <td class="tier_center">
                                 Call for Pricing                    
                              </td>
                           </tr>
                           <tr class="tier_pricing">
                              <td></td>
                              <td class="tier_left">
                                 <span class="tier_trial mobile_hide">
                                 15days for free                            </span>
                              </td>
                              <?php foreach($plans_month as $key=>$val):?>
                              <td class="tier_center">
                                 <strong>$<?php echo $val->price?></strong>/month billed                             
                                 <span class="tier_trial mobile_hide">
                                                       </span>
                              </td>
                              <?php endforeach;?>
                              <td class="tier_right">
                                 <strong>Not Determine</strong>                           
                                 <span class="tier_trial mobile_hide">
                                 </span>
                              </td>
                           </tr>
                           <tr class="mobile_hide">
                              <td></td>
                              <td class="tier_left">
                                <?php if($this->session->userdata('is_trialed') != 1):?>
                                <a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(1, 'trail')">Buy Now</a>
                               <?php endif;?> 
                              </td>
                              <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(2, 'monthly')">Buy Now</a></td>
                          <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(3, 'monthly')">Buy Now</a></td>
                          <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(4, 'monthly')">Buy Now</a></td>
                              <td class="tier_right">

                              </td>
                           </tr>
                        </thead>
                        <!-- FEATURES -->
                        <tbody>
                          <?php foreach($limit_types as $key=>$val):?>
                          <tr>
                              <th scope="row">
                                 <?php echo $val?>
                              </th>
                              <td class="tier_left">
                                 <?php 
                                 if($plans_trial->$key == 0){
                                    echo '<svg role="img" viewBox="0 0 24 6" xmlns="http://www.w3.org/2000/svg">
                                          <title>Not included</title>
                                          <rect fill="#506370" width="24" height="6" rx="2" fill-rule="evenodd" fill-opacity=".2"></rect>
                                          </svg>';
                                  }else{
                                    echo $plans_trial->$key;
                                   if($key === 'user_limit' || $key === 'vilt_user_limit'){
                                      print ' users';
                                    }else if($key === 'vilt_room_limit'){
                                      print ' rooms';
                                    }else{
                                      print ' items';
                                    }
                                  }
                                 ?> 
                               </td>

                              <?php foreach($plans_month as $key1 =>$val1):?>
                              <td class="tier_center">
                                 <?php 
                                 if($val1->$key == 0){
                                    echo '<svg role="img" viewBox="0 0 24 6" xmlns="http://www.w3.org/2000/svg">
                                          <title>Not included</title>
                                          <rect fill="#506370" width="24" height="6" rx="2" fill-rule="evenodd" fill-opacity=".2"></rect>
                                          </svg>';
                                  }else{
                                    echo $val1->$key;
                                   if($key === 'user_limit' || $key === 'vilt_user_limit'){
                                      print ' users';
                                    }else if($key === 'vilt_room_limit'){
                                      print ' rooms';
                                    }else{
                                      print ' items';
                                    }
                                  }
                                 ?> 
                              </td>
                              <?php endforeach;?>
                              <td class="tier_right">
                                 <svg role="img" viewBox="0 0 24 17" xmlns="http://www.w3.org/2000/svg">
                                    <title>Included</title>
                                    <path d="M22.11.4c-.608-.577-1.65-.522-2.332.122L9.082 10.658 4.126 5.962c-.608-.575-1.594-.575-2.202 0L.456 7.354c-.608.575-.608 1.51 0 2.086l7.524 7.128c.608.576 1.594.577 2.202 0L23.45 4c.68-.644.737-1.634.13-2.21L22.11.4z" fill="#1AB7EB" fill-rule="evenodd"></path>
                                 </svg>                                          
                              </td>
                           </tr>
                          <?php endforeach; ?>
                          <?php if( $this->session->userdata("userId")){ ?>
                          <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div id="Yearly" class="tab-pane fade matrix">
                   <div class="width_wrapper">
                     <table summary="Compare our membership plans" class="feature_comparison_chart matrix_desktop">
                        <!-- HEADER -->
                        <thead>
                           <tr class="tier_header">
                              <th></th>
                              <th class="tier_left" scope="col">
                                 <span class="mobile_hide"><?php echo $plans_trial->name?> </span>                    
                              </th>
                              <?php foreach($plans_year as $key=>$val):?>
                              <th class="tier_center" scope="col">
                                 <span class="mobile_hide"><?php echo $val->name?> </span>                    
                              </th>
                              <?php endforeach;?>
                              <th class="tier_right" scope="col">
                                 <span class="mobile_hide"><?php echo $plans_unlimit->name?> </span>                    
                              </th>
                           </tr>
                           <tr class="tier_targets mobile_hide">
                              <td></td>
                              <td class="tier_left">
                                 For free                    
                              </td>
                              <td class="tier_center">
                                 For personal                    
                              </td>
                              <td class="tier_center">
                                 For teams and businesses                    
                              </td>
                              <td class="tier_center">
                                 For Company                    
                              </td>
                              <td class="tier_center">
                                 Call for Pricing                    
                              </td>
                           </tr>
                           <tr class="tier_pricing">
                              <td></td>
                              <td class="tier_left">
                                 <span class="tier_trial mobile_hide">
                                 15days for free                            </span>
                              </td>
                              <?php foreach($plans_year as $key=>$val):?>
                              <td class="tier_center">
                                 <strong>$<?php echo $val->price?></strong>/year billed                             
                                 <span class="tier_trial mobile_hide">
                                                       </span>
                              </td>
                              <?php endforeach;?>
                              <td class="tier_right">
                                 <strong>Not Determine</strong>                           
                                 <span class="tier_trial mobile_hide">
                                 </span>
                              </td>
                           </tr>
                           <tr class="mobile_hide">
                              <td></td>
                              <td class="tier_left">
                                <?php if($this->session->userdata('is_trialed') != 1):?>
                                 <a class="iris_btn iris_btn--primary iris_btn--lg" data-fatal-attraction="container:product_comparison_chart|component:marketing_upgrade|keyword:pro" href="javascript:set_plan('<?php echo base_url('index.php/pricing/add_purchase/'.$plans_trial->id)?>')">
                                 Get Started                        </a>
                               <?php endif;?>
                              </td>
                              <?php foreach($plans_year as $key=>$val):?>
                              <td class="tier_center">
                                 <a class="iris_btn iris_btn--secondary iris_btn--lg" data-fatal-attraction="container:product_comparison_chart|component:marketing_upgrade|keyword:pro" href="javascript:set_plan('<?php echo base_url('index.php/pricing/add_purchase/'.$val->id)?>')">
                                 Get Started                        </a>
                              </td>
                              <?php endforeach;?>
                              <td class="tier_right">

                              </td>
                           </tr>
                        </thead>
                        <!-- FEATURES -->
                        <tbody>
                          <?php foreach($limit_types as $key=>$val):?>
                          <tr>
                              <th scope="row">
                                 <?php echo $val?>
                              </th>
                              <td class="tier_left">
                                 <?php 
                                 if($plans_trial->$key == 0){
                                    echo '<svg role="img" viewBox="0 0 24 6" xmlns="http://www.w3.org/2000/svg">
                                          <title>Not included</title>
                                          <rect fill="#506370" width="24" height="6" rx="2" fill-rule="evenodd" fill-opacity=".2"></rect>
                                          </svg>';
                                  }else{
                                    echo $plans_trial->$key;
                                   if($key === 'user_limit' || $key === 'vilt_user_limit'){
                                      print ' users';
                                    }else if($key === 'vilt_room_limit'){
                                      print ' rooms';
                                    }else{
                                      print ' items';
                                    }
                                  }
                                 ?> 
                               </td>
                              <?php foreach($plans_year as $key1 =>$val1):?>
                              <td class="tier_center">
                                 <?php 
                                 if($val1->$key == 0){
                                    echo '<svg role="img" viewBox="0 0 24 6" xmlns="http://www.w3.org/2000/svg">
                                          <title>Not included</title>
                                          <rect fill="#506370" width="24" height="6" rx="2" fill-rule="evenodd" fill-opacity=".2"></rect>
                                          </svg>';
                                  }else{
                                    echo $val1->$key;
                                   if($key === 'user_limit' || $key === 'vilt_user_limit'){
                                      print ' users';
                                    }else if($key === 'vilt_room_limit'){
                                      print ' rooms';
                                    }else{
                                      print ' items';
                                    }
                                  }
                                 ?> 
                              </td>
                              <?php endforeach;?>
                              <td class="tier_right">
                                 <svg role="img" viewBox="0 0 24 17" xmlns="http://www.w3.org/2000/svg">
                                    <title>Included</title>
                                    <path d="M22.11.4c-.608-.577-1.65-.522-2.332.122L9.082 10.658 4.126 5.962c-.608-.575-1.594-.575-2.202 0L.456 7.354c-.608.575-.608 1.51 0 2.086l7.524 7.128c.608.576 1.594.577 2.202 0L23.45 4c.68-.644.737-1.634.13-2.21L22.11.4z" fill="#1AB7EB" fill-rule="evenodd"></path>
                                 </svg>                                          
                              </td>
                           </tr>
                          <?php endforeach;?>
                          <?php if( $this->session->userdata("userId")){ ?>
                          <tr> <td class="tier_left"></td>
                          <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(5, 'trail')">Buy Now</a></td>
                          <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(6, 'yearly')">Buy Now</a></td>
                          <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(7, 'yearly')">Buy Now</a></td>
                          <td class="tier_left"><a class="iris_btn iris_btn--secondary iris_btn--lg" href="javascript:purchase(8, 'yearly')">Buy Now</a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
  var is_login =  "<?php echo $this->session->userdata('isLoggedIn')?>";

  function set_plan(url){
    if(is_login == null || is_login == undefined || is_login === ""){
      location.href = "<?php echo base_url().'login'?>";
    }else{
      var user_type = "<?php echo $this->session->userdata('user_type');?>";
      if(user_type === "Admin"){
        $.ajax({
            url: url,
            type: 'POST',
            processData:false,
            contentType: false,
            success: function (data, status, xhr) {
              if(data.success){
                swal({
                    text: "Successfully planed",
                    icon:"success",
                }).then((willDelete) => {
                  if (willDelete) {
                    location.href="<?php echo base_url('admin')?>";
                  }
                });
              }else{
                swal({
                  text: "Error",
                  icon:"warning",
                });z
              }
            },
            error: function(){
             swal({
                  text: "Error",
                  icon:"warning",
              })
            }
          });
      }else{
        location.href = "<?php echo base_url().'login'?>";
      }
    }

  }
  function purchase(id, type){

   var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
	if(isLogin){
		var user__id = "<?php echo $userID; ?>";
		window.location = '<?= base_url()."pricing/payment/" ?>' +id + "/plan";
	
	}else{
		location.href = "<?php echo base_url().'login'?>";
	}

}
</script>