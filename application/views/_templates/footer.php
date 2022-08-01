    
            </div>

        </section>

<!--       <footer class="main-footer">-->
<!--            <div class="pull-right hidden-xs">-->
<!--              <b><a href="https://8solutions.de">8solutions.de</a> - Training and Certification System</b> Version 1.0-->
<!--            </div>-->
<!--            <strong>Copyright &copy; 2018 <a href="--><?php //echo base_url(); ?><!--">A.U.S. Umweltberatungs GmbH Martin Zeiml</a>.</strong> All rights reserved.-->
<!--        </footer>-->
            <script src="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/js/theme.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/theme.init.js" type="text/javascript"></script>
    <script>
        //theme = theme || {};

        theme.Skeleton.initialize();

        function readme( id ) {
            $.ajax({
                url: "<?php echo base_url();?>notification/update_read_notif",
                type: 'POST',
                data: {'notif_id':id}
            });
        }

        var notif = $('#notif_container');
        var notif_count = notif.find('#notif_count');
        var notif_ul = notif.find('#notif_ul');

        $(document).ready(function () {
            //window.setInterval(function () {
                //notificationStream();
                $.ajax({
                    url: "<?php echo base_url();?>notification",
                    dataType: 'json',       
                }).done(function (data) {
                    notif_ul.empty();
                    notif_count.text(data.length);
                    if (0 != data.length ) {
                        //append_li(data);
                        var new_nodes = '';
                        $.each(data, function(index, obj) {
                            new_nodes += '' +
                            '<li data-notif-id="' + obj.id + '" onclick="readme('+obj.id+')">' +
                                '<a >' +
                                    '<span class="title">'+ obj.notification_title +'</span>' +
                                    '<span class="message">'+ obj.notification_message + '</span>' +
                                '</a>' +
                            '</li>';
                        });

                        notif_ul.prepend(new_nodes);
                        //notif_count.text(data.length);
                    }                    
                });
            //}, 1000);
        });

    </script>

    <?php $this->load->view('common/update-password-popup'); ?>

    </body>
</html>