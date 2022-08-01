<section role="main" class="content-body">
	<header class="page-header">
		<h2>Favourite</h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
            <section class="content-with-menu mailbox">
                <div class="content-with-menu-container" data-mailbox="" data-mailbox-view="folder">
                    <div class="inner-menu-toggle">
                        <a href="#" class="inner-menu-expand" data-open="inner-menu">
                            Show Menu <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>

                    <menu id="content-menu" class="inner-menu" role="menu">
                        <div class="nano has-scrollbar hovered">
                            <div class="nano-content" tabindex="0" style="right: -17px;">

                                <div class="inner-menu-toggle-inside">
                                    <a href="#" class="inner-menu-collapse">
                                        <i class="fas fa-chevron-up d-inline-block d-md-none"></i><i class="fas fa-chevron-left d-none d-md-inline-block"></i> Hide Menu
                                    </a>

                                    <a href="#" class="inner-menu-expand" data-open="inner-menu">
                                        Show Menu <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>

                                <div class="inner-menu-content">
                                    <a href="<?php echo base_url('fasi/message/compose');?>" class="btn btn-block btn-primary btn-md pt-2 pb-2 text-3">
                                        <i class="fas fa-envelope mr-1"></i>
                                        Compose
                                    </a>

                                    <ul class="list-unstyled mt-3 pt-3">
                                        <li>
                                            <a href="<?php echo base_url('fasi/message');?>" class="menu-item">Inbox <span class="badge badge-primary font-weight-normal float-right">43</span></a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url('fasi/message/sent');?>" class="menu-item">Sent</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('fasi/message/favourite');?>" class="menu-item active">Favourites</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('fasi/message/trash');?>" class="menu-item">Trash</a>
                                        </li>
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

                                        Favourite
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

                                        <li class="unread">
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail1">
                                                        <label for="mail1"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">11:35 am</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <i class="mail-label" style="border-color: #EA4C89"></i>

                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail2">
                                                        <label for="mail2"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">Check it out.</span>
                                                    </p>
                                                    <i class="mail-attachment fas fa-paperclip"></i>
                                                    <p class="m-0 mail-date">3:35 pm</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="mailbox-email.html">
                                                <div class="col-sender">
                                                    <div class="checkbox-custom checkbox-text-primary ib">
                                                        <input type="checkbox" id="mail3">
                                                        <label for="mail3"></label>
                                                    </div>
                                                    <p class="m-0 ib">Okler Themes</p>
                                                </div>
                                                <div class="col-mail">
                                                    <p class="m-0 mail-content">
                                                        <span class="subject">Check out our new Porto Admin theme! &nbsp;–&nbsp;</span>
                                                        <span class="mail-partial">We are proud to announce that our new theme Porto Admin is ready, wants to know more about it?</span>
                                                    </p>
                                                    <p class="m-0 mail-date">Jul 03</p>
                                                </div>
                                            </a>
                                        </li>

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
