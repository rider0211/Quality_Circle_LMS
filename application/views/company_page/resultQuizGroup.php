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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
<?php if (empty($edit_course)):?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
<?php endif;?>
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css_company/main-style.css">-->

<!-- Skin CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
<style>
    body{
        background-image: none !important;
        background-color: white;
    }
    .card.mt-3{
        border: 1px solid rgba(0,0,0,.125) !important;
    }
    .table-border-th{
        border-bottom: 1px solid #B7BCB7 !important;
    }
    .table-border-td{
        border-bottom: 1px solid #E9EBE9 !important;
        width:25% !important;
    }
    div>i{
        font-size: 0px;
    }
</style>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <div class="container">
                    <h5 style="line-height: 30px;">Your Quiz Result is below.</h5>
            </div>
        </div>
        <main role="main" class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-responsive-md table-borderless">
                            <tr>
                                <th class="table-border-th" colspan="4">Your Score</th>
                            </tr>
                            <tr>
                                <td class="table-border-td">Correct Answers</td>
                                <td class="table-border-td"><?=$correct_count?></td>
                                <td class="table-border-td">Incorrect Answers</td>
                                <td class="table-border-td"><?=$wrong_count?></td>
                            </tr>
                            <tr>
                                <td class="table-border-td">Result Mark</td>
                                <td class="table-border-td"><?php echo 100/($correct_count + $wrong_count) * $correct_count; ?></td>
                                <td class="table-border-td">Level Mark</td>
                                <td class="table-border-td"><?=$pass_mark?></td>
                            </tr>
                            <tr>
                                <td class="table-border-td">Pass Result</td>
                                <td class="table-border-td">
                                    <?php echo 100/($correct_count + $wrong_count) * $correct_count?>
                                </td>
                                <?php if(100/($correct_count + $wrong_count) * $correct_count < $pass_mark){?>
                                <td class="table-border-td">Maximum Attempt Num</td>
                                <td class="table-border-td"><?=$max_num?></td>
                                <?php }?>
                            </tr>
                        </table>
                    </div>
                </div>
        </main>
        <script>
            var  baseurl = "<?php echo base_url($company['company_url'])?>/demand/";
            var  base_url = "<?php echo base_url($company['company_url'])?>/demand/";
            //window.top.document.location.reload();
        </script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.js"></script>