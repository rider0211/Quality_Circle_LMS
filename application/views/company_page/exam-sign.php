<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Specific Page vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-multi-select/css/multi-select.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/basic.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/media/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris/morris.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.checkboxes.css"  />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/elusive-icons/css/elusive-icons.css">
    <!-- Theme CSS -->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/theme.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/style.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/styles.css">-->
    <?php if (empty($edit_course)):?>
<!--        <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css/components.css">-->
    <?php endif;?>
    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css_company/main-style.css">-->

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
    <script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>

    <title>Question</title>
</head>
    <style>
        .sidenav .closebtn {
            position: relative !important;
            float: right;
        }
        html .bg-light, html .background-color-light {
            background-color: #f8f9fa!important;
        }
        .card-title {
            text-transform: none;
            margin-bottom: 0.75rem;
        }
        .card-body{
            padding: 2.25rem;
        }
        .mt-5{
            border-color: #FAFAFA !important;
            border: 1px dotted !important;
            margin-top: 3rem !important;
        }
        .card-footer{
             padding-top:10px;
         }
        .card-footer div{
            padding-top:10px;
        }
        ol{
            padding-bottom: 10px;
        }
        .card2-title{
            padding-left: 20px;
            margin-top: 10px !important;
            margin-bottom: 10px !important;
            font-size: 1.6rem;
        }
        .card3-title{
            padding-left: 20px;
            margin-bottom: 0px !important;
            font-size: 1rem;
        }
    </style>

    <body id="iframe_body" style="height: auto;">
        <section role="main" class="content-body">
            <!-- start: page -->
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="card2-header">
                        <h2 class="card2-title">Exam : <?php echo $exam['title']; ?>(<?php echo $exam['title']; ?>)</h2>
                    </div>
                    <section id="exam_instruction" class="card">
                        <header class="card-header">
                            <h2 class="card3-title" style="text-transform: uppercase;">Are you sure you want to end the exam and submit?</h2>
                        </header>
                        <div class="card-body">
                            <div id="" class="row">
                                <div class="col-lg-12">
                                    <h6 style="color: red;">Please Sign below with your mouse or touchscreen to authorize this exam. By electronically signing this exam, you agree to the above terms. After the document has been signed, please click submit.</h6>
                                </div>
                            </div>
                            <div id="" class="row">
                                <div class="col-lg-12">
                                    <center>
                                        <fieldset style="width: 500px;">
                                            <div id="signaturePad" style="background-color:white; border: 1px solid #ccc; height: 250px; width: 500px;">
                                            </div>
                                            <div id="imgData"></div>
                                        </fieldset>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12">
                                <button type="button" id="clearSig" class="mb-1 mt-1 mr-1 btn btn-info">Clear the signature</button>
                                <button type="button" id="saveSig" class="mb-1 mt-1 mr-1 btn btn-info">Submit Exam</button>
                            </div>
                        </div>
                    </section>
                </div>
        </section>
    </body>

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>
    <script>
        var  base_url = "<?php echo base_url($company['company_url'])?>/demand/";
        var id = "<?=$exam_id?>";
        $('body').imagesLoaded().always(function () {
            change_parent_height();
        });

        function change_parent_height() {
            var height = $('#iframe_body').height() + 50;
            $(window.top.document.getElementById('course_container')).height(height);
        }

        $(document).ready(function () {
            /** Set Canvas Size **/
            var canvasWidth = 498;
            var canvasHeight = 248;

            /** IE SUPPORT **/
            var canvasDiv = document.getElementById('signaturePad');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', canvasWidth);
            canvas.setAttribute('height', canvasHeight);
            canvas.setAttribute('id', 'canvas');
            canvasDiv.appendChild(canvas);
            if (typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");

            var clickX = new Array();
            var clickY = new Array();
            var clickDrag = new Array();
            var paint;

            /** Redraw the Canvas **/
            function redraw() {
                canvas.width = canvas.width; // Clears the canvas

                context.strokeStyle = "#000000";

                context.lineWidth = 2;

                for (var i = 0; i < clickX.length; i++) {
                    context.beginPath();
                    if (clickDrag[i] && i) {
                        context.moveTo(clickX[i - 1], clickY[i - 1]);
                    } else {
                        context.moveTo(clickX[i] - 1, clickY[i]);
                    }
                    context.lineTo(clickX[i], clickY[i]);
                    context.closePath();
                    context.stroke();
                }
            }

            /** Save Canvas **/
            $("#saveSig").click(function saveSig() {
                swal({
                    title: "Are You Sure to Save Your Signature ?",
                    buttons: true
                })
                    .then((willDelete) => {
                        if (willDelete) {
                        var sigData = canvas.toDataURL("image/png");
                        var nicURI = base_url+"save_signature";
                        var A = new FormData();
                        A.append("id", id);
                        A.append("sign", sigData);
                        var C = new XMLHttpRequest();
                        C.open("POST", nicURI);
                        C.onload = function() {
                            var E;
                            E = C.responseText;
                            if (E.indexOf("SUCCESS") >= 0) {
                                location.href = base_url+"examResult/"+id;
                            }else{
                                $("#imgData").html('Sorry! Your signature was not saved');
                                return;
                            }
                        };
                        C.send(A);
                    } else {
                        return;
                    }
                });
            });

            $('#clearSig').click(
                function clearSig() {
                    clickX = new Array();
                    clickY = new Array();
                    clickDrag = new Array();
                    context.clearRect(0, 0, canvas.width, canvas.height);
                });

            /**Draw when moving over Canvas **/
            $('#signaturePad').mousemove(function (e) {
                this.style.cursor = 'pointer';
                if (paint) {
                    var left = $(this).offset().left;
                    var top = $(this).offset().top;

                    addClick(e.pageX - left, e.pageY - top, true);
                    redraw();
                }
            });

            /**Stop Drawing on Mouseup **/
            $('body').mouseup(function (e) {
                paint = false;
            });

            /** Starting a Click **/
            function addClick(x, y, dragging) {
                clickX.push(x);
                clickY.push(y);

                clickDrag.push(dragging);
            }

            $('#signaturePad').mousedown(function (e) {
                paint = true;

                var left = $(this).offset().left;
                var top = $(this).offset().top;

                addClick(e.pageX - left, e.pageY - top, false);
                redraw();
            });
        });
    </script>
    <script src="<?php echo base_url(); ?>assets/js/user.js"></script>
</html>