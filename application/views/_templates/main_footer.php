
<!--<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                Powered by Quality Circle.
            </div>
        </div>
    </div>
</footer>-->
  <?php $actual_link = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
    <link href="<?php echo base_url(); ?>assets/css_company/new-footer.css" rel="stylesheet">
    <footer class="footer-wrap">

         <div class="footer-top">

            <div class="container">

               <div class="row">

                  <div class="col-lg-3" data-aos="fade-up" data-aos-duration="3000">
                    <?php if($actual_link=='https://gosmartacademy.com/landing3') { ?>
                      <div class="footer-logo-heading"> <a href="index.html"><img src="<?php echo base_url(); ?>assets/landing/images/logo-new-template.png" alt="footer-logo"></a></div>
                    <?php } else { ?>
                      <div class="footer-logo-heading"> <a href="index.html"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="footer-logo"></a></div>
                     <?php } ?>
                     

                     <div class="address-footer">

                            <h6>GLOBAL NETWORK</h6>

                     </div>

                     <div class="footer-global">

                        <div class="address-footer">

                            <h1>United States</h1>

                            <ul class="list-unstyled fa-ul">

                                <li>

                                    <i class="fa-li fa fa-map-marker"></i>

                                    <span>1402 W. Marshall Ave.,</span>               

                                    <span>Longview,</span>                                    

                                    <span>Texas</span>

                                    <span>75604.</span>

                                </li>

                                <li>

                                    <i class="fa-li fa fa-map-marker"></i>

                                    <span>P.O. Box 10135</span> 

                                    <span>4501  McCann Rd.</span>

                                    <span>Longview, TX</span>

                                    <span>75605</span>

                                </li>

                                <li>

                                    <i class="fa-li fa fa-phone"></i> <img src="<?php echo base_url(); ?>assets/images/flag-us.png" alt="flag"> 1-(430)272-2107

                                </li>

                            </ul>

                        </div>

                        <div class="address-footer">

                            <h1>Jamaica</h1>

                            <ul class="list-unstyled fa-ul">

                                <li>

                                <i class="fa-li fa fa-map-marker"></i>

                                <span>The Trade Center Business Complex</span>

                                <span>30-32 Red Hills Road,</span>

                                <span>Suite # 3A</span>

                                <span>Kingston 10</span>

                                <span>Jamaica</span>

                                </li>

                                <li>

                                    <i class="fa-li fa fa-map-marker"></i>

                                <span>P.O. Box 190,</span>

                                <span>Kingston 5,</span>

                                <span>Jamaica W.I.</span>   

                                </li>

                                <li>
                                    <i class="fa-li fa fa-phone"></i>  <img src="<?php echo base_url(); ?>assets/images/flag-j.png" alt="flag">  1-(876)926-2003

                                </li>
                            </ul>

                        </div>

                        

                     </div>

                  </div>

                  <div class="col-lg-3  col-md-5" data-aos="fade-up" data-aos-duration="3000">

                     <h1 class="footer-sec-heading">SERVICES</h1>

                     <ul class="list-unstyled menu-service">

                        <li><a href="http://qualitycircleint.wiziqxt.com/"><span class="text-lowercase">e-</span>Learning</a></li>

                        <li><a href="https://qualitycircleint.com/services/consulting.html">Consulting</a></li>

                        <li><a href="https://qualitycircleint.com/smart-tools.html">Smart Tools</a> </li>

                        <li><a href="https://qualitycircleint.com/services/auditing.html">Auditing</a> </li>

                     </ul>

                     <div class="social-footer">

                        <ul class="list-inline">



                            <li>

                                <a href="https://www.facebook.com/Quality-Circle-International-Limited-LLC-1985141218415956/" target="_blank">

                                    <i class="fa fa-facebook" aria-hidden="true"></i>

                                </a>

                            </li>

                            <li>

                                <a href="#">

                                    <i class="fa fa-twitter" aria-hidden="true"></i>

                                </a>

                            </li>

                            <li>

                                <a href="#">

                                    <i class="fa fa-google-plus" aria-hidden="true"></i>

                                </a>

                            </li>

                            <li>
                                <a href="https://www.linkedin.com/company/quality-circle-international-limited-llc/" target="_blank">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                                </a>
                            </li>                        
                        </ul>

                     </div>

                  </div>

                  <div class="col-lg-6 col-md-7" data-aos="fade-up" data-aos-duration="3000">

                     <h1  class="footer-sec-heading">INDUSTRIES</h1>

                     <ul class="list-unstyled menu-industry">

                        <li><a href="#">Food and Beverages</a></li>

                        <li><a href="#">Packaging Manufacturing</a></li>

                        <li><a href="#">Rubber and Plastics Products</a></li>

                        <li><a href="#">Oil and Gas</a></li>

                        <li><a href="#">Mining and Quarrying</a></li>

                        <li><a href="#">Agriculture and Forestry</a></li>

                        <li><a href="#">Transport and Storage</a></li>

                        <li><a href="#">Education</a></li>

                        <li><a href="#">Public Administration</a></li>

                     </ul>

                  </div>

               </div>

            </div>

         </div>

         <div class="footer-bottom">

            <div class="container">

               <div class="row">

                  <div class="col">

                     <p class="mb-0 text-center"><span>Copyright@Quality Circle International Limited,</span> All Rights Reserved, 2018</p>

                  </div>

               </div>

            </div>

         </div>

    </footer>
<!--<div class="fix-div">
  <p class="fix-div-p">Have Training Question</p>
  <p class="fix-div-p1">Talk with our virtual Training Assistant</p>
</div>-->
    <button onclick="topFunction()" id="gotop" title="Go to top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </button>

<!-- <script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.com/b14234287/crm/site_button/loader_2_6k1v2f.js');
</script> -->

<script type="text/javascript">
(function(w, d, s, u) {
	w.Verloop = function(c) { w.Verloop._.push(c) }; w.Verloop._ = []; w.Verloop.url = u;
	var h = d.getElementsByTagName(s)[0], j = d.createElement(s); j.async = true;
	j.src = 'https://gosmartacademy9.verloop.io/livechat/script.min.js';
	h.parentNode.insertBefore(j, h);
})(window, document, 'script', 'https://gosmartacademy9.verloop.io/livechat');
</script>

<script>
      AOS.init({
      duration: 1200,
    })
    </script>
    <script>
      AOS.init({disable: 'mobile'});
    </script>
    <script>
function openModal() {
    $('body').addClass('main-go-body');
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    $('body').removeClass('main-go-body');
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</body>
</html>