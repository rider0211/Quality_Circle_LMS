<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["companymanagement"]?></h2>

        <div class="right-wrapper">

        </div>
    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <!-- Modal Form -->
                    </div>

                    <h2 class="card-title"><?=$term["subscriptionlist"]?></h2>
                </header>
                <div class="card-body">
                    <table class="table table-responsive-md table-hover mb-0" id="datatable" >
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>

<script>
    var $table = $('#datatable');
    jQuery(document).ready(function() {

        $table.dataTable({
            "ordering": true,
            "info": true,
            "searching": true,

            "ajax": {
                "type": "POST",
                "async": true,
                "url": $('#base_url').val()+"superadmin/account/subscription_list",
                "data": null,
                "dataSrc": "data",
                "dataType": "json",
                "cache":    false,
            },
            "columnDefs": [
            {
                "targets": [11],
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).html('<a href="<?= base_url()?>superadmin/account/subscription_edit/'+cellData+'"><i class="fas fa-pencil-alt"></i></a>');
                }
            }],
            "columns": [
                { "title": "No", "data": "id", "class": "text-center", "width":"*" },
                { "title": "<?=$term["period"]?>", "data": "term_type", "class": "text-center", "width":"*",
                    mRender: function (data, type, row) {
                        if(data == 0 && row.price_type == 1){
                            return '15 <?=$term["days"]?>';
                        }else if(data == 0 && row.price_type == 0){
                            return "<?=$term["monthly"]?>";
                        }else if(data == 1 && row.price_type == 0){
                            return "<?=$term["yearly"]?>";
                        }else if(data == 0 && row.price_type == 2){
                            return "---";
                        }
                    }
                 },
                { "title": "<?=$term["subscription"]?> <?=$term["name"]?>", "data": "name", "class": "text-center", "width":"*" },
                { "title": "<?=$term["price"]?>", "data": "price", "class": "text-center", "width":"*",
                    mRender: function (data, type, row) {
                        if(row.price_type == 1){
                            return "---";
                        }else{
                            return data;
                        }
                    }
                 },
                { "title": "<?=$term["user"]?> <?=$term["limit"]?>", "data": "user_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    }
                },
                { "title": "<?=$term["library"]?> <?=$term["limit"]?>", "data": "library_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    } },
                { "title": "<?=$term["ondemand"]?> <?=$term["limit"]?>", "data": "demand_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    } },                  
                { "title": "<?=$term["viltroom"]?> <?=$term["user"]?> <?=$term["limit"]?>", "data": "vilt_user_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    } },  
                { "title": "<?=$term["viltroom"]?> <?=$term["limit"]?>", "data": "vilt_room_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    } },  
                    { "title": "<?=$term["iltroom"]?> <?=$term["user"]?> <?=$term["limit"]?>", "data": "ilt_user_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    } },  
                { "title": "<?=$term["iltroom"]?> <?=$term["limit"]?>", "data": "ilt_room_limit", "class": "text-center", "width":"*", 
                    mRender: function (data, type, row) {
                        if(data == 0){
                            return "-";
                        }else{
                            return data;
                        }
                    } },                               
                { "title": "<?=$term["action"]?>", "data": "id", "class": "text-center", "width":80 }
            ],
            "lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
            "scrollX": true,
            "scrollCollapse": false,
            "jQueryUI": true,
            "paging": true,
            "pagingType": "full_numbers",
            "pageLength": 150, // default record count per page
            dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
            bProcessing: true,
        });
    });

</script>
