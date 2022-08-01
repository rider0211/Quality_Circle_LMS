<div class="inner-menu-toggle">
    <a href="#" class="inner-menu-expand" data-open="inner-menu">
		<?=$term["showmenu"]?> <i class="fas fa-chevron-right"></i>
    </a>
</div>

<menu id="content-menu" class="inner-menu" role="menu">
	<div class="nano">
		<div class="nano-content">	
			<div class="inner-menu-toggle-inside">
				<a href="#" class="inner-menu-collapse">
					<i class="fas fa-chevron-up d-inline-block d-md-none"></i><i class="fas fa-chevron-left d-none d-md-inline-block"></i> <?=$term["hidemenu"]?>
				</a>
				<a href="#" class="inner-menu-expand" data-open="inner-menu">
					<?=$term["showmenu"]?> <i class="fas fa-chevron-down"></i>
				</a>
			</div>						
			<div class="inner-menu-content">
						
				<ul class="list-unstyled mt-3 pt-3">
					<li>
						<a href="<?php echo base_url('instructor/settings/general_view')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'general_view') ? 'active':'';?>"><i class="fa fa-info-circle"></i> <?=$term["generalsettings"]?></a>
					</li>
                    <?php if($role != 'Admin'){  ?>
                        <li>
                            <a href="<?php echo base_url('instructor/settings/emailsettings')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'emailsettings') ? 'active':'';?>"><i class="fa fa-envelope"></i> <?=$term["emailsettings"]?></a>
                        </li>
                    <?php } ?>
					<li>
						<a href="<?php echo base_url('instructor/settings/emailtemp')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'emailtemp') ? 'active':'';?>"><i class="fas fa-edit"></i> <?=$term["emailtemplate"]?></a>
					</li>
					<!-- <li>
						<a href="<?php echo base_url('instructor/settings/smstemp')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'smstemp') ? 'active':'';?>"><i class="fas fa-comments"></i> <?=$term["smstemplate"]?></a>
					</li> -->

                    <?php if($role != 'Admin'){  ?>

					<li>
						<a href="<?php echo base_url('instructor/settings/theme')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'theme') ? 'active':'';?>"><i class="fa fa-code"></i> <?=$term["themesettings"]?></a>
					</li>

                    <?php } ?>

					<li>
						<a href="<?php echo base_url('instructor/settings/certificate')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'certificate' || $this->uri->segment(3) == 'certificateview') ? 'active':'';?>"><i class="fas fa-certificate"></i> <?=$term["certtemplatesetting"]?></a>
					</li>
					<?php  if($role != 'Admin'):?><li>
						<a href="<?php echo base_url('instructor/settings/translations')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'translations' ) ? 'active':'';?>"><i class="fa fa-globe"></i> <?=$term["translation"]?></a>
					</li><?php endif; ?>

                    <?php if($role != 'Admin'){  ?>

<!--					<li>
						<a href="<?php /*echo base_url('admin/settings/menusettings')*/?>" class="menu-item <?php /*echo ($this->uri->segment(3) == 'menusettings' || $this->uri->segment(3) =='newmenu') ? 'active':'';*/?>"><i class="fa fa-list-alt"></i> Menu Settings</a>
					</li>-->
					<li>
						<a href="<?php echo base_url('instructor/settings/notificationsettings')?>" class="menu-item <?php echo ($this->uri->segment(3) == 'notificationsettings') ? 'active':'';?>"><i class="fas fa-bell"></i> <?=$term["notification"]?></a>
					</li>

                    <?php } ?>
				</ul>						
			</div>
		</div>
	</div>
</menu>