
<div  id="dataContainer" class="row"  style="font-family: monospace;">
 
 


<?php echo form_open_multipart('employee/create'); ?>
    
<div class="col-md-12" style="padding:20px;">
        <div class="frmContainer" >  
        <div  style="text-align: center;">
        <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> Employee entry form </p>
        </div>     
        </div>
</div>
    <div id="errordisplayArea">
        <?php echo validation_errors(); ?> 
        <p ><?php echo @$error_photo;?></p>
        <p ><?php echo @$error_poa;?></p>         
    </div>

    <div class="col-md-6" style="padding:20px;">
        <div class="col-md-6">      
        <div class="rowlabel">SAP ID</div>
        <div><input type="text"   maxlength="15" size="25" placeholder="Enter SAP" name="sap_id" autocomplete="off"  required <?php echo form_input('sap_id', set_value('sap_id')); ?></div>
        </div>      
       
            
        <div class="col-md-6">
        <div class="rowlabel">Index No</div>
        <div><input type="text" maxlength="15" size="25" placeholder="Enter Index No" name="index_no" autocomplete="off"  required <?php echo form_input('index_no', set_value('index_no')); ?></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">PPO No</div>
        <div><input type="text" placeholder="Enter PPO No" name="ppo_no" autocomplete="off"  required <?php echo form_input('ppo_no', set_value('ppo_no')); ?> </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">File No</div>
        <div><input type="text" placeholder="Enter File No" name="file_no" autocomplete="off"  required <?php echo form_input('file_no', set_value('file_no')); ?> </div>
        </div>
        
        <div class="col-md-12">
        <div class="rowlabel">Full Name</div>
        <div><input type="text" placeholder="Enter Full Name" name="full_name"  autocomplete="off" required <?php echo form_input('full_name', set_value('full_name')); ?>  </div>
        </div>
        
        <div class="col-md-6">
            <div class="rowlabel">Gender</div>
            <div>
            <select class="form-control" name="gender"  id="gender">                
                <option value="male"  > Male</option>
                <option value="female" > Female</option>
            </select>
            <script type="text/javascript">
                $("#gender").val("<?php echo @$_POST['gender'];?>");
             </script>
            </div>
        </div> 
        <div  class="col-md-6">
        <div class="col-md-2 rowlabel">Designation</div>
        <div>
            <select class="form-control" name="designation_id">
            <?php 
            foreach($designations as $row)
            { ?>
               <option value="<?php echo $row['id'];?>" <?php echo set_select('designation_id',  $row['id']); ?>> <?php echo $row['title'];?> </option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">NID no</div>
        <div><input type="text" placeholder="Enter NID No" name="nid_no" autocomplete="off"   <?php echo form_input('nid_no', set_value('nid_no')); ?> </div>
        </div>
        
        
        <div class="col-md-6">              
        <div class="rowlabel">E-mail</div>
        <div><input type="text" placeholder="Enter Email" name="email" autocomplete="off"  <?php echo form_input('email', set_value('email')); ?></div>
        </div>
        
        <div  class="col-md-12">
        <div class="rowlabel">Cell phone</div>
        <div><input type="text" placeholder="Enter Cell Phone no" name="cell_phone" autocomplete="off"  <?php echo form_input('cell_phone', set_value('cell_phone')); ?></div>
        </div>
      
        <div  class="col-md-12">
        <div class="rowlabel">Present Address</div>
        <div><input type="text" placeholder="Enter Present Address" name="present_address" autocomplete="off"  <?php echo form_input('present_address', set_value('present_address')); ?></div>
        </div>    
        
        <div  class="col-md-12">
        <div class="rowlabel">Permanent Address</div>
        <div><input type="text" placeholder="Enter Permanent Address" name="permanent_address" autocomplete="off"  <?php echo form_input('permanent_address', set_value('permanent_address')); ?></div>
        </div>
        <div  class="col-md-6">
        <div class="rowlabel">Date of birth</div>
        <div>
            <input type="text" id="dob_time" name="dob_time" required <?php echo form_input('dob_time', set_value('dob_time')); ?></p>
        </div>
        </div>

                
        <div  class="col-md-6">
        <div class="rowlabel">Date of retirement</div>
        <div>
            <input type="text" id="dor_time" name="dor_time" required <?php echo form_input('dor_time', set_value('dor_time')); ?></p>
        </div>
        </div>
    
        <div  class="col-md-6">
        <div class="rowlabel">Date of deceased</div>
        <div>
            <input type="text" id="dod_time" name="dod_time" <?php echo form_input('dod_time', set_value('dod_time')); ?></p>
        </div>
        </div>
        <div class="col-md-6">
            <div class="rowlabel">Marital status</div>
            <div>
            <select class="form-control" name="marital_status"  id="marital_status">                
                <option value="unmarried"> Unmarried</option>
                <option value="married"> Married</option>
                <option value="widowed" > Widowed</option>
                <option value="separated"> Separated</option>
                <option value="divorced"> Divorced</option>
                <option value="married"> Married</option>
            </select>
            <script type="text/javascript">
                $("#marital_status").val("<?php echo @$_POST['marital_status'];?>");
             </script>
            </div>
        </div>

    </div>
    <div class="col-md-6" style="padding:20px;">
        <div class="col-md-8">
        <div class="rowlabel">Photo</div>    
        <input type="file" name="image_file" id="image_file" onchange="return checkPhotoFile(this)"  />
        <input style="display:none;" type="button" id="btn_upload_photo" name="btn_upload_photo" value="Upload File" onclick="return validate()" />
        <div id="uploaded_image">
            <script type="text/javascript">
                $("#uploaded_image").val("<?php echo @$_FILES['image_file']['name'];?>");
             </script>
        </div>
        </div>
        <div class="col-md-4">
            <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
        </div>
                
        
    

      
        
        <div  class="col-md-8">
        <div class="rowlabel">Proof of alive</div>
        <div>
                <input type="file" name="poa_file" id="poa_file"  onchange="return checkPoaFile(this)" />        
                <div id="uploaded_proof_of_alive"></div>  
        </div>
        </div>
        <div class="col-md-4">
            <p> Allowed type:PDF,JPEG,JPG Maximum file size can be:500KB </p>
        </div>
        
        <div  class="col-md-12">
        <div class="rowlabel">Proof of alive validity</div>
        <div>
            <input type="text" id="proof_of_alive_validity" name="proof_of_alive_validity" required <?php echo form_input('proof_of_alive_validity', set_value('proof_of_alive_validity')); ?></p>
        </div>
        </div>     
<div class="col-md-6">
        <div class="rowlabel">Retired from</div>
        <div>
            <select class="form-control" name="retired_branch_id">
            <?php 
            foreach($branches as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"  <?php echo set_select('retired_branch_id',  $row['id']); ?>> <?php echo $row['branch_name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div> 
        <div class="col-md-6">
        <div class="  rowlabel">Pension provider</div>
        <div>
            <select class="form-control" name="pension_provider_branch_id">
            <?php 
            foreach($branches as $row)
            { ?>

               <option value="<?php echo $row['id']; ?>" <?php echo set_select('pension_provider_branch_id',  $row['id']); ?>> <?php echo $row['branch_name'];?></option>
                   
            <?php            
            }
            ?>
            </select>
        </div>
        </div>              
            

            
        <div  class="col-md-6">
        <div class="rowlabel">Last basic during retirement</div>        
        <div><input type="text" placeholder="Enter Last basic during retirement" name="last_basic_during_retirement" autocomplete="off" required <?php echo form_input('last_basic_during_retirement', set_value('last_basic_during_retirement')); ?></div>
        </div>
            
        
        <div  class="col-md-6">
        <div class="rowlabel">Pension amount during retirement</div>
        <div><input type="text" placeholder="Enter Pension amount during retirement" name="pension_amount_during_retirement" autocomplete="off" required <?php echo form_input('pension_amount_during_retirement', set_value('pension_amount_during_retirement')); ?></div>
        </div>
        
        <div class="col-md-6" >
        <div class="rowlabel">Remarks</div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off"  <?php echo form_input('remarks', set_value('remarks')); ?></div>
        </div>
        
    <div  style="text-align: center">
        <button type="submit" id="btnregistersubmit" name="submit" value="ADD" onclick="return checkAll()">Add Employee</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        </div>
        <div  style="background-color:#f1f1f1">         
        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>
</form>
</div>
</div>


