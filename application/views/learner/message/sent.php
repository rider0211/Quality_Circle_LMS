<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['sent']; ?></h2>

	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
            <section class="content-with-menu mailbox">
                <div class="content-with-menu-container" data-mailbox="" data-mailbox-view="folder">
                    <div class="inner-menu-toggle">
                        <a href="#" class="inner-menu-expand" data-open="inner-menu">
                            <?php echo $term['showmenu']; ?> <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>

                    <menu id="content-menu" class="inner-menu" role="menu">
                        <div class="nano has-scrollbar hovered">
                            <div class="nano-content" tabindex="0" style="right: -17px;">

                                <div class="inner-menu-toggle-inside">
                                    <a href="#" class="inner-menu-collapse">
                                        <i class="fas fa-chevron-up d-inline-block d-md-none"></i><i class="fas fa-chevron-left d-none d-md-inline-block"></i> <?php echo $term['hidemenu']; ?>
                                    </a>

                                    <a href="#" class="inner-menu-expand" data-open="inner-menu">
                                        <?php echo $term['showmenu']; ?> <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>

                                <div class="inner-menu-content">
                                    <a href="<?php echo base_url('learner/message/compose');?>" class="btn btn-block btn-primary btn-md pt-2 pb-2 text-3">
                                        <i class="fas fa-envelope mr-1"></i>
                                        Compose
                                    </a>

                                    <ul class="list-unstyled mt-3 pt-3">
                                        <li>
                                            <a href="<?php echo base_url('learner/message');?>" class="menu-item"> <i class="fa fa-inbox" style="margin-right: 9px;"></i><?php echo $term['inbox']; ?> <span class="badge badge-primary font-weight-normal float-right"><?php echo $new_ms_nums; ?></span></a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url('learner/message/sent');?>" class="menu-item active"><i class="fa fa-paper-plane" style="margin-right: 9px;"></i><?php echo $term['sent']; ?></a>
                                        </li>
<!--                                        <li>
                                            <a href="<?php /*echo base_url('company/message/favourite');*/?>" class="menu-item">Favourites</a>
                                        </li>
                                        <li>
                                            <a href="<?php /*echo base_url('company/message/trash');*/?>" class="menu-item">Trash</a>
                                        </li>-->
                                    </ul>

                                    <hr class="separator">

                                </div>
                            </div>
                            <div class="nano-pane" style="opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 82px; transform: translate(0px, 0px);"></div></div></div>
                    </menu>
                    <div class="inner-body mailbox-folder">
                        <!-- START: .mailbox-header -->
                        <header class="mailbox-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="mailbox-title font-weight-light m-0">
                                        <a id="mailboxToggleSidebar" class="sidebar-toggle-btn trigger-toggle-sidebar">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line line-angle1"></span>
                                            <span class="line line-angle2"></span>
                                        </a>

                                        <?php echo $term['sent']; ?>
                                    </h1>
                                </div>
                                <div class="col-md-6">
                                    <div class="search">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                                            <span class="input-group-append">
														<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
													</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <!-- END: .mailbox-header -->

                        <div id="mailbox-email-list" class="mailbox-email-list">
                            <div class="nano has-scrollbar">
                                <div class="nano-content" tabindex="0" style="right: -17px;">
                                    <ul id="" class="list-unstyled">

                                        <?php foreach($message_receive_list as $item){ ?>
                                            <li>
                                                <a href="<?php echo base_url('learner/message/details/0/'.$item['message_id']); ?>">
                                                    <div class="col-sender">
                                                        <p class="m-0 ib">To <?php echo $item['first_name'].' '.$item['last_name'] ; ?></p>
                                                    </div>
                                                    <div class="col-mail">
                                                        <div class="m-0 mail-content">
                                                            <?php echo $item['message']; ?>
                                                        </div>
                                                        <p class="m-0 mail-date"><?php echo $item['created_at']; ?></p>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="nano-pane" style="opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
                        </div>
                    </div>
                </div>
            </section>
		</div>
	</div>

	<!-- end: page -->
</section>
