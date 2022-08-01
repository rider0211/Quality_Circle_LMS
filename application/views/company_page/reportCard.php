<style type="text/css">
	.wowbook-container-full{
		position:relative!important;
	}
	body, html, .wowbook-container{
		background: white!important;
	}
    .main.mce-item-table{
        border: 4px solid #8f6cfb;
    }
    .page-header{
        margin: 0px !important;
    }
    label.cours-0 {
        cursor: not-allowed;
    }
    .content-body{
        display: unset !important;
    }
</style>
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
    body{
        background-image: none !important;
        background-color: white;
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
<header class="page-header">
    <h2><?=$term["exammanagement"]?></h2>
    <h5 style="text-align: right; margin-right: 10px"><a href="javascript:pagePrint()" class="btn btn-primary ml-3"><i class="fas fa-print"></i> Print and Download</a></h5>
</header>

<main role="main" class="content-body">
<table align="center" width = "720">
<tr><td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>header.jpg" /></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3"><?php echo strtoupper($certificate['COMPANY NAME']);?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3">Hereby Certifies</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3">That</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;color:blue;" align="center" height="35" colspan="3"><?= strtoupper($certificate['PARTICIPANT NAME']);?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3">Has Successfully Completed</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3"><?php echo strtoupper($certificate['COURSE NAME']);?></td></tr>
<tr><td style="font-size:18px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3">Given on</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3"><?php echo strtoupper($certificate['CERTIFICATION DATE']);?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3">in</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35" colspan="3"><?php echo $certificate['LOCATION'];?><br><br></td></tr>
<tr>
<td width="33.3%">&nbsp;</td>
<td width="33.3%" style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="35">
<?php if($certificate['COURSE TYPE'] != 'Non-Certification' && $certificate['NUMBER'] != ""){ echo "CEU Number <br>" . strtoupper($certificate['NUMBER']);?><?php } ?> <br><br>
<?= $certificate['COURSE_NUMBER']?><br><br>
</td>
<td align="right" width="33.3%"><?php echo $certificate['SIGNATURE']; ?></td>
</tr>
<tr>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo $certificate['CERTIFICATE NUMBER'];?> <br />Certificate Number</td>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo date_format(date_create($certificate['CERTIFICATION DATE']),"M d, Y")?> <br />Certificate Date</td>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo($certificate['CATEGORY']);?></td>
</tr>
<tr>
<td colspan="3">
<?php if($certificate['COURSE TYPE'] == 'Non-Certification'){?>
<img src="<?php echo base_url().'assets/certificate/' ?>footer.jpg" />
<?php }else{ ?>
<img src="<?php echo base_url().'assets/certificate/' ?>footer-3.jpg" />
<?php } ?>
</td>
</tr>
</table>
</main>
<script>
    var baseurl = "<?php echo base_url(); ?>";
    $(function(){
        if(!$("html").hasClass("sidebar-left-collapsed"))
        {
            $("html").addClass("sidebar-left-collapsed");
            $("html").removeClass("sidebar-left-opened");
        }
    });

    /*function pagePrint() {
       
        var content = $('.content-body').html();
        // alert(content); 
        $('#content').val(content);
        $('#print_form').submit(); 

        $.ajax({
            url: "<?= base_url()?>admin/demand/print_exam_certificate",
            type: 'POST',
            data: { content: content },  
            success: function(data, status, xhr){
              new PNotify({
                  title: 'Success',
                  text: 'Certificate Print and Download',
                  type: 'success'
              });               
            },
            error: function(){ 
                new PNotify({
                    title: 'Error',
                    text: 'Failed!',
                    type: 'error'
                });
            }
        }); 
    }*/
	
    function pagePrint() {
        var newWin = window.open();
        newWin.focus();
        newWin.document.write($('.content-body').html());
        newWin.print();
        newWin.close();
        
    }

    $(document).ready(function() {
        $("*[contenteditable=true]").attr("contenteditable",false);
    });
</script>       

<script src="<?php echo base_url(); ?>assets/js/user.js"></script>