
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

        <?php echo validation_errors(); ?> 
        <p ><?php echo @$error_photo;?></p>
        <p ><?php echo @$error_poa;?></p>         

  
<div class="col-md-12">
    <div class="col-md-6">
    <div class="row">    
    <div class="col-md-6" >
        <div class="form-group">
            <label for="sap_id">SAP ID</label>
            <input type="text"   maxlength="15" size="25" placeholder="Enter SAP" name="sap_id" id="sap_id" value="<?php echo isset($_POST['sap_id']) ? htmlspecialchars($_POST['sap_id'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>    
    <div class="col-md-6" >
        <div class="form-group">
            <label for="index_no">Index No</label>
            <input type="text" maxlength="15" size="25" placeholder="Enter Index No" name="index_no" id="index_no" value="<?php echo isset($_POST['index_no']) ? htmlspecialchars($_POST['index_no'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>    
    </div>
    <div class="row">  
    <div class="col-md-6" >
        <div class="form-group">
            <label for="sap_id">PPO No</label>
            <input type="text" placeholder="Enter PPO No" name="ppo_no" id="ppo_no"  value="<?php echo isset($_POST['ppo_no']) ? htmlspecialchars($_POST['ppo_no'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>    
    <div class="col-md-6" >
        <div class="form-group">
            <label for="file_no">File No</label>
            <input type="text" placeholder="Enter File No" name="file_no" id="file_no"  value="<?php echo isset($_POST['file_no']) ? htmlspecialchars($_POST['file_no'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>
    </div>
    <div class="row">    
    <div class="col-md-6" >
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" placeholder="Enter Full Name" name="full_name" id="full_name"  value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>    
    <div class="col-md-3" >
            <label for="gender">Gender</label>
            <select class="form-control" name="gender"  id="gender">    
                <option value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
            </select>
    </div> 
    <div class="col-md-3" >
            <label for="designation_id">Designation</label>
            <select class="form-control" name="designation_id" id="designation_id" >
             <?php 
                foreach($designations as $row){ 
                    if((isset($_POST['designation_id']) && $_POST['designation_id'] === $row['id'])){?>
                        <option value="<?php echo $row['id'];?>" selected="selected" > <?php echo $row['title'];?> </option> 
                   <?php     
                    }else{?>   
                              <option value="<?php echo $row['id'];?>"  > <?php echo $row['title'];?> </option> 
                <?php }}?>
            </select>
    </div> 
    </div>
        
  
    <div class="row">      
    <div class="col-md-6" >
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" placeholder="Enter Email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>       
        
    <div class="col-md-6" >
        <div class="form-group">
            <label for="cell_phone">Cell phone</label>
            <input type="text" placeholder="Enter ell phone number" name="cell_phone" id="cell_phone" value="<?php echo isset($_POST['cell_phone']) ? htmlspecialchars($_POST['cell_phone'], ENT_QUOTES) : ''; ?>">
        </div>
    </div> 
    </div>   

    <div class="row">       
    <div class="col-md-12" >
        <div class="form-group">
            <label for="present_address">Present address</label>
            <input type="text" placeholder="Enter Present Address" name="present_address" id="present_address" value="<?php echo isset($_POST['present_address']) ? htmlspecialchars($_POST['present_address'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>  
</div>   

    <div class="row">   
    <div class="col-md-12" >
        <div class="form-group">
            <label for="permanent_address">Permanent address</label>
            <input type="text" placeholder="Enter Permanent Address" name="permanent_address" id="permanent_address" value="<?php echo isset($_POST['permanent_address']) ? htmlspecialchars($_POST['permanent_address'], ENT_QUOTES) : ''; ?>">
        </div>
    </div> 
    </div>
        
    <div class="row">    
        <div class="col-md-6" >
        <div class="form-group">
                <label for="nid_no">NID no</label>
                <input type="text" placeholder="Enter NID No" name="nid_no" id="nid_no" value="<?php echo isset($_POST['nid_no']) ? htmlspecialchars($_POST['nid_no'], ENT_QUOTES) : ''; ?>">
        </div>
        </div>  
        <div class="col-md-6" >
            <div class="form-group">
                <label for="dob_time">Date of birth</label>
                <input type="text"  name="dob_time" id="dob_time" value="<?php echo isset($_POST['dob_time']) ? htmlspecialchars($_POST['dob_time'], ENT_QUOTES) : ''; ?>">
            </div>
        </div> 
    </div>
        
    <div class="row">     
        <div class="col-md-6" >
            <div class="form-group">
                <label for="dod_time">Date of deceased</label>
                <input type="text"  name="dod_time" id="dod_time" value="<?php echo isset($_POST['dod_time']) ? htmlspecialchars($_POST['dod_time'], ENT_QUOTES) : ''; ?>">
            </div>
        </div>
    <div class="col-md-6">
          <label for="marital_status">Marital status</label>
        <div>
            <select class="form-control" name="marital_status"  id="marital_status">                
                <option value="Unmarried" <?php echo (isset($_POST['marital_status']) && $_POST['marital_status'] === 'Unmarried') ? 'selected' : ''; ?>>Unmarried</option>
                <option value="Married" <?php echo (isset($_POST['marital_status']) && $_POST['marital_status'] === 'Married') ? 'selected' : ''; ?>>Married</option>
                <option value="Widowed" <?php echo (isset($_POST['marital_status']) && $_POST['marital_status'] === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                <option value="Separated" <?php echo (isset($_POST['marital_status']) && $_POST['marital_status'] === 'Separated') ? 'selected' : ''; ?>>Separated</option>
                <option value="Divorced" <?php echo (isset($_POST['marital_status']) && $_POST['marital_status'] === 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
            </select>
        </div>
    </div>
</div>  
        
</div>

    
<div class="col-md-6" >
    <hr>
    <div class="row">
    <div class="col-md-8" >
    <div class="form-group">
            <label for="image_file">Photo </label>    
            <input type="file" name="image_file" id="image_file" onchange="return checkPhotoFile(this)"></input>
                
                <input style="display:none;" type="button" id="btn_upload_photo" name="btn_upload_photo" value="Upload File" onclick="return validate()" />
                
                <p> [ Allowed types:JPEG,JPG,GIF,PNG <br>Maximum file size can be:100KB ]</p>
    </div>
    
    </div>
    <div class="col-md-4" >
        <img id="display_photo" src="<?php echo base_url()."upload/demo.jpg"; ?>" alt='your photo' width="200"/>         
            <div id="uploaded_image">
                    <script type="text/javascript">
                        $("#uploaded_image").val("<?php echo @$_FILES['image_file']['name'];?>");
                    </script>
            </div>
    </div>
    </div>     
        
    
    <hr>
      
    <div class="row">    
        <div  class="col-md-6" >
    <div class="form-group">
    <label  for="poa_file">Proof of alive</label>
        <input type="file" name="poa_file" id="poa_file"  onchange="return checkPoaFile(this)"> </input>     
        <p> [ Allowed types:PDF,JPEG,JPG <br>Maximum file size can be:500KB ] </p>
    </div>
    </div>
        <div  class="col-md-3" >
            <img id="display_poa" src="<?php echo base_url()."upload/demo.jpg"; ?>" alt="your poa" width="200"/>
        </div>
        <div class="col-md-3" >
        <div class="form-group">
            <label for="proof_of_alive_validity">Proof of alive validity</label>
            <input type="text"  name="proof_of_alive_validity" id="proof_of_alive_validity" value="<?php echo isset($_POST['proof_of_alive_validity']) ? htmlspecialchars($_POST['proof_of_alive_validity'], ENT_QUOTES) : ''; ?>">
        </div>
        </div> 
    </div> 
    <hr>
    <div class="row"> 
       <div class="col-md-4" >
        <div class="form-group">
            <label for="dor_time">Date of retirement</label>
            <input type="text"  name="dor_time" id="dor_time" value="<?php echo isset($_POST['dor_time']) ? htmlspecialchars($_POST['dor_time'], ENT_QUOTES) : ''; ?>">
        </div>
    </div> 
        
    <div class="col-md-4">
        <div class="form-group">        
        <label for="retired_branch_id">Retired from</label>
            <select class="form-control" name="retired_branch_id" id="retired_branch_id" >
             <?php 
                foreach($branches as $row){ 
                    if((isset($_POST['retired_branch_id']) && $_POST['retired_branch_id'] === $row['id'])){?>
                        <option value="<?php echo $row['id'];?>" selected="selected" > <?php echo $row['branch_name'];?> </option> 
                   <?php     
                    }else{?>   
                              <option value="<?php echo $row['id'];?>"  > <?php echo $row['branch_name'];?> </option> 
                <?php }}?>
            </select>
        </div>
    </div> 
        
    <div class="col-md-4">
        <div class="form-group">
        <label for="pension_provider_branch_id">Pension provider</label>
            <select class="form-control" name="pension_provider_branch_id" id="pension_provider_branch_id" >
             <?php 
                foreach($branches as $row){ 
                    if((isset($_POST['pension_provider_branch_id']) && $_POST['pension_provider_branch_id'] === $row['id'])){?>
                        <option value="<?php echo $row['id'];?>" selected="selected" > <?php echo $row['branch_name'];?> </option> 
                   <?php     
                    }else{?>   
                              <option value="<?php echo $row['id'];?>"  > <?php echo $row['branch_name'];?> </option> 
                <?php }}?>
            </select>
        </div>
    </div>              
            
    </div>
    <div class="row">       
    <div  class="col-md-6">            
        <div class="form-group">
            <label for="last_basic_during_retirement">Last basic during retirement</label> 
            <input type="text" placeholder="Enter Last basic during retirement" name="last_basic_during_retirement" id="last_basic_during_retirement" value="<?php echo isset($_POST['last_basic_during_retirement']) ? htmlspecialchars($_POST['last_basic_during_retirement'], ENT_QUOTES) : ''; ?>">
       </div>
    </div>    
        
    <div  class="col-md-6">
        <div class="form-group">
        <label for="pension_amount_during_retirement">Pension amount during retirement</label>
        <input type="text" placeholder="Enter Pension amount during retirement" name="pension_amount_during_retirement" id="pension_amount_during_retirement" value="<?php echo isset($_POST['pension_amount_during_retirement']) ? htmlspecialchars($_POST['pension_amount_during_retirement'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>
    </div>
    <div class="row"> 
    <div class="col-md-12" >
        <div class="form-group">
        <label for="remarks">Remarks</label>
        <input type="text" placeholder="Enter Remarks" name="remarks" id="remarks" value="<?php echo isset($_POST['remarks']) ? htmlspecialchars($_POST['remarks'], ENT_QUOTES) : ''; ?>">
        </div>
    </div>
    </div>
</div>
<div class="row">     
    <div class="col-md-12" style="background: #F2F3FF;" >  
    <div class="col-md-2" ></div>
    <div class="col-md-4" style="text-align: center">
            <button type="submit" name="submit" value="ADD" class="btn btn-info">Add Employee</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
    </div>
    <div class="col-md-4" >         
        <a href="<?php echo site_url('employee') ?>"><button type="button" class="btn btn-danger">Cancel</button> </a>        
    </div>
    <div class="col-md-2" ></div>
</div>
</div>     
</form>
</div>
</div>


<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#display_photo').attr('src', e.target.result);//where to display
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_file").change(function(){ //event
        readURL(this);
    });
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#display_poa').attr('src', e.target.result);//where to display
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#poa_file").change(function(){ //event
        readURL2(this);
    });
    $(document).ready(function(){
                 $("#dob_time").datepicker({ dateFormat: 'dd-mm-yy' });
                 $("#dor_time").datepicker({ dateFormat: 'dd-mm-yy' });
                 $("#dod_time").datepicker({ dateFormat: 'dd-mm-yy' });
                 $("#proof_of_alive_validity").datepicker({ dateFormat: 'dd-mm-yy' }).datepicker("setDate", "+6m");
                 });
</script>