<section role="main" class="content-body">
    <header class="page-header">
        <h2>Global Settings</h2>

        <div class="right-wrapper">

        </div>
    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
    
	<?php $this->load->view('instructor/settings/settings_sidebar');?>
	<div class="inner-body">	
        <div class="col-lg-12">		
            <form id="add-form" action="<?=base_url()?>instructor/settings/createmenu" method="POST" novalidate="novalidate" enctype="multipart/form-data">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title">Menu</h2>
                </header>
                <div class="card-body">					
                    <div class="form-group row">
                    	<label class="col-sm-4 control-label text-lg-right pt-2" for="inputDefault">Icon</label>  
                    	<div class="col-sm-4">                        	                      
                            <input type="text"  class="form-control" value="<?php echo $icon;?>"  name="icon"/>
                        </div>
                   </div>
                   <div class="form-group row">
                   		<label class="col-sm-4 control-label text-lg-right pt-2" for="inputDefault">Menu Name</label>
                        <div class="col-sm-4">            
                            <input type="text"  class="form-control" value="<?php echo $menuName;?>"  name="name"/>
                        </div>
                   </div>
                   <div class="form-group row">
                   		<label class="col-sm-4 control-label text-lg-right pt-2" for="inputDefault">Path</label>
                        <div class="col-sm-4">                      
                            <input type="text"  class="form-control" value="<?php echo $path;?>" id="" name="path"/>
                        </div>
                   </div>
                   <div class="form-group row">                        
                       <label class="col-sm-4 control-label text-lg-right pt-2" for="inputDefault">Level</label>                        
                       <div class="col-sm-4">       
                            <select class="form-control" name="level">
                            	<option value="">--Select--</option>
                            	<option value="SuperAdmin" <?php echo ($level == 'SuperAdmin') ? 'selected' : '';?>>SuperAdmin</option>
                            	<option value="Admin" <?php echo ($level == 'Admin') ? 'selected' : '';?>>Admin</option>
                            	<option value="FASI" <?php echo ($level == 'FASI') ? 'selected' : '';?>>FASI</option>
                            	<option value="Company" <?php echo ($level == 'Company') ? 'selected' : '';?>>Company</option>
                            	<option value="Employee" <?php echo ($level == 'Employee') ? 'selected' : '';?>>Employee</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    	<label class="col-sm-4 control-label text-lg-right pt-2" for="inputDefault">Code</label>
                    	<div class="col-sm-4"> 
                    		<input type="text"  class="form-control" value="<?php echo $code;?>" id="" name="code"/>
                    	</div>
                    </div>                                      
                </div>               
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary modal-add-confirm">Save</button>
                            <button type="reset" id="btn_reset" class="btn btn-default">Reset</button>
                            <input type="hidden" name="editid" value="<?php echo $editid;?>" />
                        </div>
                    </div>
                </footer>
            </section>
            </form>

        </div>
        </div>
    </div>

    <!-- end: page -->
</section>

