<div id="dataContainer" class="row"  style="font-family: monospace;">

<?php echo validation_errors(); ?> 
<?php  $id= base64_encode($employee_item['id']);?>
<?php echo form_open_multipart('employee/edit/'.$id); ?>
        <div  class="col-md-12" style="padding:20px;">
        <div class="row">  
            <div class="frmContainer" style="text-align: center;">
            <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
            <p class="text-info text-center text-uppercase"> Employee edit</p>
            </div>     
        </div> 
        </div>
    <div  class="col-md-6">
        <div class="col-md-6">
        <div class="rowlabel">SAP ID</div>
        <div><input type="text" placeholder="Enter SAP" name="sap_id" autocomplete="off" value="<?php echo isset($_POST['sap_id']) ? htmlspecialchars($_POST['sap_id'], ENT_QUOTES) : $employee_item['sap_id']?>"required></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Index No</div>
        <div><input type="text" placeholder="Enter Index No" name="index_no" autocomplete="off" value="<?php echo isset($_POST['index_no']) ? htmlspecialchars($_POST['index_no'], ENT_QUOTES) : $employee_item['index_no']?>" required></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">PPO No</div>
        <div><input type="text" placeholder="Enter PPO No" name="ppo_no" autocomplete="off" value="<?php echo isset($_POST['ppo_no']) ? htmlspecialchars($_POST['ppo_no'], ENT_QUOTES) : $employee_item['ppo_no']?>" required></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">File No</div>
        <div><input type="text" placeholder="Enter File No" name="file_no" autocomplete="off" value="<?php echo isset($_POST['file_no']) ? htmlspecialchars($_POST['file_no'], ENT_QUOTES) : $employee_item['file_no']?>" required></div>
        </div>

        
        <?php  $gender=$employee_item['gender'];?>
        <div class="col-md-6">
        <div class="rowlabel">Gender
            <select class="form-control" name="gender">    
                <option value="male" <?php if((isset($_POST['gender'])) && ($_POST['gender'] === 'male')){ echo 'selected="selected"';} if($gender=="male") echo 'selected="selected"'; ?>>Male</option> 
                <option value="female" <?php if((isset($_POST['gender'])) && ($_POST['gender'] === 'female')){ echo 'selected="selected"';} if($gender=="female") echo 'selected="selected"'; ?>>Female</option>    
            </select>
        </div>
        </div>
        <?php $designation=$employee_item['designation_id'];?>
        <div  class="col-md-6">
        <div class=" col-md-2 rowlabel">Designation</div>
        <div>
            <select class="form-control" name="designation_id">
            <?php 
            foreach($designations as $row)
            { ?>
               <option <?php if((isset($_POST['designation_id'])) && ($_POST['designation_id'] === $row['id'])){ echo 'selected="selected"';} if($designation==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>        

        <div class="col-md-12">
        <div class="rowlabel">Full Name</div>
        <div><input type="text" placeholder="Enter Full Name" name="full_name" autocomplete="off" value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name'], ENT_QUOTES) : $employee_item['full_name']?>" required></div>
        </div>
        <div  class="col-md-6">              
        <div class="rowlabel">NID no</div>        
        <div><input type="text" placeholder="Enter NID Number" name="nid_no" autocomplete="off" value="<?php echo isset($_POST['nid_no']) ? htmlspecialchars($_POST['nid_no'], ENT_QUOTES) : $employee_item['nid_no']?>"></div>
        </div>
        
        <div  class="col-md-6">              
        <div class="rowlabel">E-mail</div>        
        <div><input type="text" placeholder="Enter Email" name="email" autocomplete="off" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : $employee_item['email']?>"></div>
        </div>

        <div  class="col-md-12">
        <div class="rowlabel">Cell phone</div>
        <div><input type="text" placeholder="Enter Cell Phone no" name="cell_phone" autocomplete="off" value="<?php echo isset($_POST['cell_phone']) ? htmlspecialchars($_POST['cell_phone'], ENT_QUOTES) : $employee_item['cell_phone']?>"></div>
        </div>

        
              
        <div  class="col-md-12">
        <div class="rowlabel">Present Address</div>
        <div><input type="text" placeholder="Enter Present Address" name="present_address" autocomplete="off" value="<?php echo isset($_POST['present_address']) ? htmlspecialchars($_POST['present_address'], ENT_QUOTES) : $employee_item['present_address']?>"></div>
        </div>    
        
        <div  class="col-md-12">
        <div class="rowlabel">Permanent Address</div>
        <div><input type="text" placeholder="Enter Permanent Address" name="permanent_address" autocomplete="off" value="<?php echo isset($_POST['permanent_address']) ? htmlspecialchars($_POST['permanent_address'], ENT_QUOTES) : $employee_item['permanent_address']?>"></div>
        </div> 

        <div  class="col-md-6">
        <div class="rowlabel">Date of birth</div>
        
        <div>
         
            <input type="text" id="dob_time" name="dob_time" value="<?php 
            if(isset($_POST['dob_time'])){
                if(strlen($_POST['dob_time']<=1)){
                    echo ""; } 
                    else{echo htmlspecialchars($_POST['dob_time'], ENT_QUOTES);}
                }else
                    {
                    if(strlen($employee_item['dob_time'])<=1){echo "";}else{                    
                    echo $dob_time = date('d-m-Y', strtotime($employee_item['dob_time']));
                    }
                    }
                ?>">
            </p>
        </div>
        </div>

        <div  class="col-md-6">
        <div class="rowlabel">Date of retirement</div>
        <div>
      
            <input type="text" id="dor_time" name="dor_time" value="<?php 
            if(isset($_POST['dor_time'])){
                if(strlen($_POST['dor_time']<=1)){
                    echo ""; } 
                    else{echo htmlspecialchars($_POST['dor_time'], ENT_QUOTES);}
                }else
                    {
                    if(strlen($employee_item['dor_time'])<=1){echo "";}else{                    
                    echo $dob_time = date('d-m-Y', strtotime($employee_item['dor_time']));
                    }
                    }
                ?>" ></p>
        </div>
        </div>
    
        <div  class="col-md-6">
        <div class="rowlabel">Date of deceased</div>
        <div>
            <input type="text" id="dod_time" name="dod_time" value="<?php 
            if(isset($_POST['dod_time'])){
                if(strlen($_POST['dod_time']<=1)){
                    echo ""; } 
                    else{echo htmlspecialchars($_POST['dod_time'], ENT_QUOTES);}
                }else
                    {
                    if(strlen($employee_item['dod_time'])<=1){echo "";}else{                    
                    echo $dob_time = date('d-m-Y', strtotime($employee_item['dod_time']));
                    }
                    }
                ?>" ></p>
        </div>
        </div>
        
         
        <?php  $marital_status=$employee_item['marital_status'];?>
        <div class="col-md-6">
        <div class="rowlabel">Marital status
            <select class="form-control" name="marital_status">    
                   <option value="Unmarried" <?php if((isset($_POST['marital_status'])) && ($_POST['marital_status'] === 'Unmarried')){ echo 'selected="selected"';} if($marital_status=="Unmarried") echo 'selected="selected"'; ?>>Unmarried</option> 
                   <option value="Married" <?php if((isset($_POST['marital_status'])) && ($_POST['marital_status'] === 'Married')){ echo 'selected="selected"';} if($marital_status=="Married") echo 'selected="selected"'; ?>>Married</option> 
                   <option value="Divorced" <?php if((isset($_POST['marital_status'])) && ($_POST['marital_status'] === 'Divorced')){ echo 'selected="selected"';} if($marital_status=="Divorced") echo 'selected="selected"'; ?>>Divorced</option> 
                   <option value="Widowed" <?php if((isset($_POST['marital_status'])) && ($_POST['marital_status'] === 'Widowed')){ echo 'selected="selected"';} if($marital_status=="Widowed") echo 'selected="selected"'; ?>>Widowed</option> 
                   <option value="Separated" <?php if((isset($_POST['marital_status'])) && ($_POST['marital_status'] === 'Separated')){ echo 'selected="selected"';} if($marital_status=="Separated") echo 'selected="selected"'; ?>>Separated</option> 
            </select>
        </div>
        </div>

                
</div>
<div  class="col-md-6 ">
        <div class="col-md-8">
        <div class="rowlabel">Photo</div>
            <input type="file" name="image_file" id='image_file' value="<?php echo $employee_item['image_url'];?>" />
        <p>
            <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/".$employee_item['image_url']."'>";?>
        </p>
        </div>
        <div class="col-md-4">
            <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
        </div>
            
        <img id="display_photo" src="#" alt="your photo" width="200"/>
        

        <div  class="col-md-8">
        <div class="rowlabel">Proof of alive</div>
        <div>
            <input type="file" name="poa_file" id="poa_file" value="<?php echo $employee_item['proof_of_alive'];?>"/>        
                
                <img id="display_poa" src="#" alt="your POA" width="200"/>
       <p>
           <?php echo $employee_item['proof_of_alive'];?>
            <?php echo "<img width='200px' height='170px'  src='". base_url()."upload/proof_of_alive/".$employee_item['proof_of_alive']."'>";?>
        </p>
        </div>
        </div>
        <div class="col-md-4">
            <p> Allowed type:PDF,JPEG,JPG Maximum file size can be:500KB </p>
        </div>
        
        <div  class="col-md-12">
        <div class="rowlabel">Proof of alive validity</div>
        <div>
            <input type="text" id="proof_of_alive_validity" name="proof_of_alive_validity"  value="<?php 
            if(isset($_POST['proof_of_alive_validity'])){
                if(strlen($_POST['proof_of_alive_validity']<=1)){
                    echo ""; } 
                    else{echo htmlspecialchars($_POST['proof_of_alive_validity'], ENT_QUOTES);}
                }else
                    {
                    if(strlen($employee_item['proof_of_alive_validity'])<=1){echo "";}else{                    
                    echo $dob_time = date('d-m-Y', strtotime($employee_item['proof_of_alive_validity']));
                    }
                    }
                ?>" ></p>
        </div>
        </div>

<?php $retired_from=$employee_item['retired_branch_id'];?>
        <div class="col-md-6">
        <div class="rowlabel">Retired from</div>
        <div>
            <select class="form-control" name="retired_branch_id">
            <?php 
            foreach($branches as $row)
            { ?>
              <option <?php if((isset($_POST['retired_branch_id'])) && ($_POST['retired_branch_id'] === $row['id'])){ echo 'selected="selected"';} if($retired_from == $row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>   
        <?php $pension_from=$employee_item['pension_provider_branch_id'];?>
        <div class="col-md-6">
        <div class="rowlabel">Pension provider</div>
        <div>
            <select class="form-control" name="pension_provider_branch_id">
            <?php 
            foreach($branches as $row)
            { ?>
              <option <?php if((isset($_POST['pension_provider_branch_id'])) && ($_POST['pension_provider_branch_id'] === $row['id'])){ echo 'selected="selected"';} if($pension_from==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
            
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        <div  class="col-md-6">
        <div class="rowlabel">Last basic during retirement</div>        
        <div><input type="text" placeholder="Enter Last basic during retirement" name="last_basic_during_retirement" autocomplete="off" value="<?php echo isset($_POST['last_basic_during_retirement']) ? htmlspecialchars($_POST['last_basic_during_retirement'], ENT_QUOTES) : round($employee_item['last_basic_during_retirement'],2)?>"required></div>
        </div>
        
        <div  class="col-md-6">
        <div class="rowlabel">Pension amount during retirement</div>
        <div><input type="text" placeholder="Enter Pension amount during retirement" name="pension_amount_during_retirement" autocomplete="off" value="<?php echo isset($_POST['pension_amount_during_retirement']) ? htmlspecialchars($_POST['pension_amount_during_retirement'], ENT_QUOTES) : round($employee_item['pension_amount_during_retirement'],2)?>"required></div>
        </div>    
        <div  class="col-md-12">
        <div class="rowlabel">Remarks</div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off" value="<?php echo isset($_POST['remarks']) ? htmlspecialchars($_POST['remarks'], ENT_QUOTES) : $employee_item['remarks']?>"></div>
        </div>
</div>
    <hr>
<div class="col-md-12" style="text-align: center">        
        <div class="row" >
         <div class="col-md-4" > </div>
         <div class="col-md-4" > 
             <button type="submit" id="btnregistersubmit" name="submit" class="btn btn-info">Update</button>  
           
        </div>
        </div>
        <div class="row" >
        <div class="col-md-4" > </div>
        <div class="col-md-4" > 
            <a href="<?php echo site_url('employee') ?>"><button type="button" class="btn btn-danger">Cancel</button> </a>      
        </div>
        </div> 
        <div class="col-md-2" > </div>  
</div>
</form>
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
                 $("#proof_of_alive_validity").datepicker({ dateFormat: 'dd-mm-yy' });
                 });
</script>