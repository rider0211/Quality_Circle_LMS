<style>
    .page-type{
        font-size: 12px;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View Assessment</h2>

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
                    <h4 class="card-title">pass mark :  <?php echo $pass_mark?></h4>
                </div>

                <h2 class="card-title">Assessment</h2>
            </header>
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Delegate Name</th>
                        <?php foreach ($course_session as $session){?>
                            <th><?php echo $session->title?></th>
                        <?php }?>
                        <th>Average</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($course_pay_user as $pay_user => $row){?>
                        <tr>
                            <td><h4><?php echo $row['fullname']?></h4></td>
                            <?php for($i = 0; $i < count($course_session); $i++){?>
                                <td></td>
                            <?php }?>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr data-item-type="6" data-item-user-id="<?php echo$row['user_id']?>" data-item-id="<?php echo$row['object_id']?>">
                            <td class="page-type other">Quiz</td>
                            <?php
                            $row_sum = 0;
                            $row_num = 0;
                            foreach ($course_session as $session){

                                if(is_null($asses_data[$row['user_id']][$session->id][6])){
                                    $row_num++;
                                }
                                $row_sum = $row_sum + $asses_data[$row['user_id']][$session->id][6];
                            ?>
                                <td class="quiz-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php  echo is_null($asses_data[$row['user_id']][$session->id][6])? '':$asses_data[$row['user_id']][$session->id][6]?></td>
                            <?php }?>
                            <td class="other quiz-<?php echo $row['user_id']?>-avg"><?php echo round($row_sum/(count($course_session)-$row_num), 2);  ?></td>
                            <td class="actions">
                                <a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
                                <a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
                                <a href="#" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="hidden on-default remove-row"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr data-item-type="1" data-item-user-id="<?php echo$row['user_id']?>" data-item-id="<?php echo$row['object_id']?>">
                            <td class="other page-type">Exercise</td>
                            <?php
                            $row_sum = 0;
                            $row_num = 0;
                            foreach ($course_session as $session){

                                if(is_null($asses_data[$row['user_id']][$session->id][1])){
                                    $row_num++;
                                }
                                $row_sum = $row_sum + $asses_data[$row['user_id']][$session->id][1];
                                ?>
                                <td class="exercise-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php echo is_null($asses_data[$row['user_id']][$session->id][1])? '':$asses_data[$row['user_id']][$session->id][1]?></td>
                            <?php }?>
                            <td class="other exercise-<?php echo $row['user_id']?>-avg"><?php echo round($row_sum/(count($course_session)-$row_num), 2);  ?></td>
                            <td class="actions">
                                <a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
                                <a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
                                <a href="#" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="hidden on-default remove-row"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr data-item-type="2" data-item-user-id="<?php echo$row['user_id']?>" data-item-id="<?php echo$row['object_id']?>">
                            <td class="other page-type">Evening Work</td>
                            <?php
                            $row_sum = 0;
                            $row_num = 0;
                            foreach ($course_session as $session){

                                $r = $asses_data[$row['user_id']][$session->id][2];
                                if(is_null($asses_data[$row['user_id']][$session->id][2])){
                                    $row_num++;
                                }
                                $row_sum = $row_sum + $asses_data[$row['user_id']][$session->id][2];
                                ?>
                                <td class="evening-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php echo is_null($asses_data[$row['user_id']][$session->id][2])? '':$asses_data[$row['user_id']][$session->id][2]?></td>
                            <?php }?>
                            <td class="other evening-<?php echo $row['user_id']?>-avg"><?php echo round($row_sum/(count($course_session)-$row_num), 2);  ?></td>
                            <td class="actions">
                                <a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
                                <a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
                                <a href="#" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="hidden on-default remove-row"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr data-item-type="3" data-item-user-id="<?php echo$row['user_id']?>" data-item-id="<?php echo$row['object_id']?>">
                            <td class="other page-type">Precourse Work</td>
                            <?php
                            $row_sum = 0;
                            $row_num = 0;
                            foreach ($course_session as $session){

                                if(is_null($asses_data[$row['user_id']][$session->id][3])){
                                    $row_num++;
                                }
                                $row_sum = $row_sum + $asses_data[$row['user_id']][$session->id][3];
                                ?>
                                <td class="precourse-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php echo is_null($asses_data[$row['user_id']][$session->id][3])? '':$asses_data[$row['user_id']][$session->id][3]?></td>
                            <?php }?>
                            <td class="other precourse-<?php echo $row['user_id']?>-avg"><?php echo round($row_sum/(count($course_session)-$row_num), 2);  ?></td>
                            <td class="actions">
                                <a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
                                <a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
                                <a href="#" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="hidden on-default remove-row"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr data-item-type="4" data-item-user-id="<?php echo$row['user_id']?>" data-item-id="<?php echo$row['object_id']?>">
                            <td class="other page-type">Handout</td>
                            <?php
                            $row_sum = 0;
                            $row_num = 0;
                            foreach ($course_session as $session){

                                if(is_null($asses_data[$row['user_id']][$session->id][4])){
                                    $row_num++;
                                }
                                $row_sum = $row_sum + $asses_data[$row['user_id']][$session->id][4];
                                ?>
                                <td class="handout-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php echo is_null($asses_data[$row['user_id']][$session->id][4])? '':$asses_data[$row['user_id']][$session->id][4]?></td>
                            <?php }?>
                            <td class="other handout-<?php echo $row['user_id']?>-avg"><?php echo round($row_sum/(count($course_session)-$row_num), 2);  ?></td>
                            <td class="actions">
                                <a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
                                <a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
                                <a href="#" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="hidden on-default remove-row"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr data-item-type="5" data-item-user-id="<?php echo$row['user_id']?>" data-item-id="<?php echo$row['object_id']?>">
                            <td class="other page-type">Cause study</td>
                            <?php
                            $row_sum = 0;
                            $row_num = 0;
                            foreach ($course_session as $session){

                                if(is_null($asses_data[$row['user_id']][$session->id][5])){
                                    $row_num++;
                                }
                                $row_sum = $row_sum + $asses_data[$row['user_id']][$session->id][5];
                                ?>
                                <td class="cause-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php echo is_null($asses_data[$row['user_id']][$session->id][6])? '':$asses_data[$row['user_id']][$session->id][5]?></td>
                            <?php }?>
                            <td class="other cause-<?php echo $row['user_id']?>-avg"><?php echo round($row_sum/(count($course_session)-$row_num), 2);  ?></td>
                            <td class="actions">
                                <a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
                                <a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
                                <a href="#" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" class="hidden on-default remove-row"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="page-type">Total</td>

                            <?php
                            $is_all_null_num = 0;
                            $all_total = 0;
                            foreach ($course_session as $session){
                                $sum_mark_total = 0;
                                $is_null_num = 0;

                                for($i = 1; $i<7; $i++)
                                {
                                    $sum_mark_total = $sum_mark_total+$asses_data[$row['user_id']][$session->id][$i];
                                    if(is_null($asses_data[$row['user_id']][$session->id][$i]))
                                    {
                                        $is_null_num++;
                                    }
                                }
                                if($is_null_num!=6)
                                    $all_total = $all_total+round($sum_mark_total/(6-$is_null_num), 2);
                                else
                                    $is_all_null_num++;
                                ?>
                                <td class="total-<?php echo $row['user_id']?>-<?php echo $session->id?>"><?php echo $is_null_num!=6?round($sum_mark_total/(6-$is_null_num), 2):'';?></td>
                            <?php }?>
                            <td class="total-<?php echo $row['user_id']?>-all"><?php echo $is_all_null_num!=count($course_session)? round($all_total/(count($course_session)-$is_all_null_num), 2):'';?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <?php foreach ($course_session as $session){?>
                                <td></td>
                            <?php }?>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>

        </section>
    </div>
</div>

<!-- end: page -->
</section>
<div id="dialog" class="modal-block mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Are you sure?</h2>
        </header>
        <div class="card-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>Are you sure that you want to delete this row?</p>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="dialogConfirm" class="btn btn-primary">Confirm</button>
                    <button id="dialogCancel" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>

<script>

    (function($) {

        'use strict';

        var EditableTable = {
            options: {
                table: '#datatable-editable',
                dialog: {
                    wrapper: '#dialog',
                    cancelButton: '#dialogCancel',
                    confirmButton: '#dialogConfirm',
                }
            },

            initialize: function() {
                this
                    .setVars()
                    .build()
                    .events();
            },

            setVars: function() {
                this.$table				= $( this.options.table );

                this.dialog				= {};
                this.dialog.$wrapper	= $( this.options.dialog.wrapper );
                this.dialog.$cancel		= $( this.options.dialog.cancelButton );
                this.dialog.$confirm	= $( this.options.dialog.confirmButton );

                return this;
            },

            build: function() {
                this.datatable = this.$table.DataTable({
                    "ordering": false,
                    "pageLength": 100,
                    dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p'
                });

                window.dt = this.datatable;

                return this;
            },

            events: function() {
                var _self = this;

                this.$table
                    .on('click', 'a.save-row', function( e ) {
                        e.preventDefault();

                        _self.rowSave( $(this).closest( 'tr' ) );
                    })
                    .on('click', 'a.cancel-row', function( e ) {
                        e.preventDefault();

                        _self.rowCancel( $(this).closest( 'tr' ) );
                    })
                    .on('click', 'a.edit-row', function( e ) {
                        e.preventDefault();

                        _self.rowEdit( $(this).closest( 'tr' ) );
                    })
                    .on( 'click', 'a.remove-row', function( e ) {
                        e.preventDefault();

                        var $row = $(this).closest( 'tr' ),
                            itemId = $row.attr('data-item-id'),
                            itemType = $row.attr('data-item-type'),
                            user_id = $row.attr('data-item-user-id');

                        $.magnificPopup.open({
                            items: {
                                src: _self.options.dialog.wrapper,
                                type: 'inline'
                            },
                            preloader: false,
                            modal: true,
                            callbacks: {
                                change: function() {
                                    _self.dialog.$confirm.on( 'click', function( e ) {
                                        e.preventDefault();

                                        $.ajax({
                                            url: $('#base_url').val()+'admin/coursecreation/delete_assess',
                                            type: 'POST',
                                            data: {
                                                'id': itemId, 'type': itemType, 'user_id':user_id
                                            },
                                            success: function() {
                                                _self.rowRemove( $row );
                                            }
                                        });

                                        $.magnificPopup.close();
                                    });
                                },
                                close: function() {
                                    _self.dialog.$confirm.off( 'click' );
                                }
                            }
                        });
                    });

                this.dialog.$cancel.on( 'click', function( e ) {
                    e.preventDefault();
                    $.magnificPopup.close();
                });

                return this;
            },

            // ==========================================================================================
            // ROW FUNCTIONS
            // ==========================================================================================

            rowCancel: function( $row ) {
                var _self = this,
                    $actions,
                    i,
                    data;

                if ( $row.hasClass('adding') ) {
                    this.rowRemove( $row );
                } else {

                    data = this.datatable.row( $row.get(0) ).data();
                    this.datatable.row( $row.get(0) ).data( data );

                    $actions = $row.find('td.actions');
                    if ( $actions.get(0) ) {
                        this.rowSetActionsDefault( $row );
                    }

                    this.datatable.draw();
                }
            },

            rowEdit: function( $row ) {
                var _self = this,
                    data;

                data = this.datatable.row( $row.get(0) ).data();

                $row.children( 'td' ).each(function( i ) {

                    var $this = $( this );

                    if ( $this.hasClass('actions') ) {
                        _self.rowSetActionsEditing( $row );
                    } else {
                        if($this.hasClass('other')){
                            $this.html( '<input type="text" readonly class="form-control" value="' + data[i] + '"/>' );
                        }else{
                            $this.html( '<input type="text" class="form-control input-block" value="' + data[i] + '"/>' );
                        }
                    }
                });
            },

            rowSave: function( $row ) {
                var _self     = this,
                    $actions,
                    values    = [],
                    cell_values = [];

                if ( $row.hasClass( 'adding' ) ) {
                    this.$addButton.removeAttr( 'disabled' );
                    $row.removeClass( 'adding' );
                }

                values = $row.find('td').map(function() {
                    var $this = $(this);

                    if ( $this.hasClass('actions') ) {
                        _self.rowSetActionsDefault( $row );
                        return _self.datatable.cell( this ).data();
                    } else {
                        if( $this.find('input').hasClass('input-block'))
                            cell_values.push($this.find('input').val());
                        return $.trim( $this.find('input').val() );
                    }
                });

                var itemId = $row.attr('data-item-id'),
                    itemType = $row.attr('data-item-type'),
                    user_id = $row.attr('data-item-user-id');

                $.ajax({
                    url: $('#base_url').val()+'admin/coursecreation/save_assess',
                    type: 'POST',
                    data: {
                        'id': itemId, 'type': itemType, 'user_id':user_id, 'data_value':cell_values
                    },
                    success: function() {
                        window.location.reload();
                    },
                    error: function(){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'error'
                        });
                    }

                });



                $actions = $row.find('td.actions');
                if ( $actions.get(0) ) {
                    this.rowSetActionsDefault( $row );
                }

                this.datatable.draw();
            },

            rowRemove: function( $row ) {
                if ( $row.hasClass('adding') ) {
                    this.$addButton.removeAttr( 'disabled' );
                }

                this.datatable.row( $row.get(0) ).remove().draw();
            },

            rowSetActionsEditing: function( $row ) {
                $row.find( '.on-editing' ).removeClass( 'hidden' );
                $row.find( '.on-default' ).addClass( 'hidden' );
            },

            rowSetActionsDefault: function( $row ) {
                $row.find( '.on-editing' ).addClass( 'hidden' );
                $row.find( '.edit-row' ).removeClass( 'hidden' );
            }

        };

        $(function() {
            EditableTable.initialize();
        });

    }).apply(this, [jQuery]);


</script>
