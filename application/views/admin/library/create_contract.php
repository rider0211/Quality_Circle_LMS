

<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/samples.css">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/neo.css">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/editor.css?t=HBDD">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/scayt.css">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/dialog.css">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/tableselection.css">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/wsc.css">
<link rel="stylesheet" href="<?=PUBLIC_URL ?>ck_editor/copyformatting.css">

<style type="text/css">
.cstlist {
  background-color:#26a69a;
  color: #fff;
}
</style>

<section role="main" class="content-body">
    <form action="" method="post" id="save_form" novalidate="novalidate" enctype="multipart/form-data">
    <header class="page-header">
        <div class="card-actions" style="margin-top: 5px !important; top:initial">
            <button type="button" class="btn btn-primary modal-with-form" onclick="export_btn()"><i class=" icon-floppy-disk position-left"></i> Save </button>
            <a href="<?php echo base_url(); ?>admin/library" class="btn btn-primary"><i class="icon-cancel-square2 position-left"></i> Cancel</a>
            <a class="modal-with-form create-manual" href="#modalFormCreateManual" hidden>
                <button type="button" class="mb-1 mt-0 mr-1 btn btn-default" id="btn-add"> <i class="fa fa-plus"></i> <?=$term["createmanual"]?></button>
            </a>

        </div>
    </header>
    <div class="row">
        <div class="col-md-12" style="background-color: white">
            <div class="panel-body" >
                    <h2>Edit Contract</h2>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
                    <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $parent_id?>">
                    <input type="text" id="title" name="title" class="form-control">
                    <textarea cols="180" id="content" name="content" data-plugin-summernote data-plugin-options='{ "height": 500, "codemirror": { "theme": "ambiance" } }' rows="90">
                        <?php echo $contract;?>
                    </textarea>

            </div>
        </div>
    </div>
    <div id="modalFormCreateManual" class="modal-block modal-block-primary mfp-hide">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title"><?=$term["createmanual"]?></h2>
                </header>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-lg-right pt-2"><?=$term["manualname"]?></label>
                        <div class="col-sm-9">
                            <input type="text" id="new_manual" name="new_manual" class="form-control">
                        </div>

                    </div>

                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" type="button" onclick="save_manual()"><?=$term["create"]?></button>
                            <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </form>
</section>
<script src="<?=PUBLIC_URL ?>ck_editor/ckeditor.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        $('[data-plugin-ios-switch]').each(function () {
            var $this = $(this);

            $this.themePluginIOS7Switch();
        });

        $('[data-plugin-datepicker]').each(function () {
            var $this = $(this);

            $this.themePluginDatePicker();
        });
        $('[data-plugin-masked-input]').each(function() {
            var $this = $( this );

            $this.themePluginMaskedInput();
        });

        $('[data-plugin-markdown-editor]').each(function() {
            var $this = $( this ),
                opts = {};

            var pluginOptions = $this.data('plugin-options');
            if (pluginOptions)
                opts = pluginOptions;

            $this.themePluginMarkdownEditor(opts);
        });


    });
//<![CDATA[
//CKEDITOR.config.height = 400;
//CKEDITOR.config.width = 'auto';
//CKEDITOR.replace( 'content',
//  {
//      fullPage : true,
//      // extraPlugins : 'docprops'
//  });

//]]>

$('.create-manual').magnificPopup({
    type: 'inline',
    preloader: false,
    modal: true,
    // When elemened is focused, some mobile browsers in some cases zoom in
    // It looks not nice, so we disable it:
    callbacks: {
        beforeOpen: function() {

        }
    }
});
var content_html = '';
function  export_btn() {
    content_html = $("#content").val();

    $('.create-manual').click();
}

function save_manual() {
    $('#title').val($('#new_manual').val());
    var formData = new FormData($('#save_form')[0]);

    $.ajax({
        url: '<?=base_url()?>/admin/library/saveNewContract',
        type: 'POST',
        data: formData,
        processData:false,
        contentType: false,
        success: function(data) {
            if (data.failed_count == 0) {
                window.location.href = data.url;
            }else{
                new PNotify({
                    title: 'Failed',
                    text: 'Can not Export.',
                    type: 'danger'
                });
            }
        },
        error: function() {
            new PNotify({
                title: 'Failed',
                text: 'Can not Export.',
                type: 'danger'
            });
        }
    });

}

$('.btn-close').click(function (e) {
    e.preventDefault();
    $.magnificPopup.close();
});

</script>
</body>

<!-- Mirrored from www.w3schools.com/bootstrap/tryit.asp?filename=trybs_table_hover&stacked=h By www.freedomhunt.tk, Thu, 02 Jun 2016 12:18:14 GMT -->
</html>
