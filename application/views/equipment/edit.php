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
        <div><input type="text" placeholder="Enter SAP" name="sap_id" autocomplete="off" value="<?php echo $employee_item['sap_id'] ?>"required></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Index No</div>
        <div><input type="text" placeholder="Enter Index No" name="index_no" autocomplete="off" value="<?php echo $employee_item['index_no'] ?>" required></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">PPO No</div>
        <div><input type="text" placeholder="Enter PPO No" name="ppo_no" autocomplete="off" value="<?php echo $employee_item['ppo_no'] ?>" required></div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">File No</div>
        <div><input type="text" placeholder="Enter File No" name="file_no" autocomplete="off" value="<?php echo $employee_item['file_no'] ?>" required></div>
        </div>

        
        <?php  $gender=$employee_item['gender'];?>
        <div class="col-md-6">
        <div class="rowlabel">Gender
            <select class="form-control" name="gender">                
               <option value="male" <?php if($gender=="male") echo 'selected="selected"'; ?>>Male</option>
               <option value="female" <?php if($gender=="female") echo 'selected="selected"'; ?>>Female</option>
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
               <option <?php if($designation==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>        

        <div class="col-md-12">
        <div class="rowlabel">Full Name</div>
        <div><input type="text" placeholder="Enter Full Name" name="full_name" autocomplete="off" value="<?php echo $employee_item['full_name'] ?>" required></div>
        </div>
        <div  class="col-md-6">              
        <div class="rowlabel">NID no</div>        
        <div><input type="text" placeholder="Enter NID Number" name="nid_no" autocomplete="off" value="<?php echo $employee_item['nid_no'] ?>"></div>
        </div>
        
        <div  class="col-md-6">              
        <div class="rowlabel">E-mail</div>        
        <div><input type="text" placeholder="Enter Email" name="email" autocomplete="off" value="<?php echo $employee_item['email'] ?>"></div>
        </div>

        <div  class="col-md-12">
        <div class="rowlabel">Cell phone</div>
        <div><input type="text" placeholder="Enter Cell Phone no" name="cell_phone" autocomplete="off" value="<?php echo $employee_item['cell_phone'] ?>"></div>
        </div>

        
              
        <div  class="col-md-12">
        <div class="rowlabel">Present Address</div>
        <div><input type="text" placeholder="Enter Present Address" name="present_address" autocomplete="off" value="<?php echo $employee_item['present_address'] ?>"></div>
        </div>    
        
        <div  class="col-md-12">
        <div class="rowlabel">Permanent Address</div>
        <div><input type="text" placeholder="Enter Permanent Address" name="permanent_address" autocomplete="off" value="<?php echo $employee_item['permanent_address'] ?>"></div>
        </div> 

        <div  class="col-md-6">
        <div class="rowlabel">Date of birth</div>
        
        <div>
            <input type="text" id="dob_time" name="dob_time" value="<?php echo $employee_item['dob_time'] ?>" size="30"></p>
        </div>
        </div>
    
        <div  class="col-md-6">
        <div class="rowlabel">Date of retirement</div>
        <div>
            <input type="text" id="dor_time" name="dor_time" value="<?php echo $employee_item['dor_time'] ?>" size="30"></p>
        </div>
        </div>
    
        <div  class="col-md-6">
        <div class="rowlabel">Date of deceased</div>
        <div>
            <input type="text" id="dod_time" name="dod_time" value="<?php echo $employee_item['dod_time'] ?>" size="30"></p>
        </div>
        </div>
        
        <?php $marital_status=$employee_item['marital_status'];?>
        <div  class="col-md-6">
        <div class="rowlabel">Marital status</div>
        <select class="form-control" name="marital_status"  id="marital_status">                
                <option value="unmarried" <?php if($marital_status=="unmarried") echo 'selected="selected"'; ?>> Unmarried</option>
                <option value="married" <?php if($marital_status=="married") echo 'selected="selected"'; ?>> Married</option>
                <option value="widowed" <?php if($marital_status=="widowed") echo 'selected="selected"'; ?>> Widowed</option>
                <option value="separated" <?php if($marital_status=="separated") echo 'selected="selected"'; ?>> Separated</option>
                <option value="divorced" <?php if($marital_status=="divorced") echo 'selected="selected"'; ?>> Divorced</option>
                <option value="married" <?php if($marital_status=="married") echo 'selected="selected"'; ?>> Married</option>
        </select>
        
        </div>

                
</div>
<div  class="col-md-6 ">
        <div class="col-md-8">
        <div class="rowlabel">Photo</div>
            <input type="file" name="image_file" value="<?php echo $employee_item['image_url'];?>" />
        <p>
            <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/".$employee_item['image_url']."'>";?>
        </p>
        </div>
        <div class="col-md-4">
            <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
        </div>
                
        

        <div  class="col-md-8">
        <div class="rowlabel">Proof of alive</div>
        <div>
            <input type="file" name="poa_file" id="poa_file" value="<?php echo $employee_item['proof_of_alive'];?>"/>        
                <div id="uploaded_proof_of_alive"></div> 
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
            <input type="text" id="proof_of_alive_validity" name="proof_of_alive_validity"  value="<?php echo $employee_item['proof_of_alive_validity'];?>" size="30"></p>
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
               <option <?php if($retired_from==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
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
               <option <?php if($pension_from==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        <div  class="col-md-6">
        <div class="rowlabel">Last basic during retirement</div>        
        <div><input type="text" placeholder="Enter Last basic during retirement" name="last_basic_during_retirement" autocomplete="off" value="<?php echo number_format($employee_item['last_basic_during_retirement']); ?>"required></div>
        </div>
        
        <div  class="col-md-6">
        <div class="rowlabel">Pension amount during retirement</div>
        <div><input type="text" placeholder="Enter Pension amount during retirement" name="pension_amount_during_retirement" autocomplete="off" value="<?php echo number_format($employee_item['pension_amount_during_retirement']); ?>"required></div>
        </div>    
        <div  class="col-md-12">
        <div class="rowlabel">Remarks</div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off" value="<?php echo $employee_item['remarks'] ?>"></div>
        </div>
</div>
    <div class="col-md-12" >        
        <div class="row" >
         <div class="col-md-2" > </div>
         <div class="col-md-8" > 
        <button type="submit" id="btnregistersubmit" name="submit" >Update</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />        
        </div>
        </div>
        <div class="row" >
        <div class="col-md-2" > </div>
        <div class="col-md-8" > 
            <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>      
        </div>
        </div> 
        <div class="col-md-2" > </div>  

        
    </form>
</div>
  

</form>
</div>



