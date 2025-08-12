<div id="dataContainer" class="row">
<?php echo validation_errors(); ?>
<?php $id= base64_encode($nominee_item['id']);?> 
<?php echo form_open_multipart('nominee/edit/'.$id); ?>


 <div class="col-md-3" >   </div>
  <div class="col-md-6" tyle="padding:20px;" id="dataContainer"> 
    <div   class="col-md-12" style="padding:20px;">   
        <div class="frmContainer"  style="text-align: center;">
        <input  type="file" name="image_file" id="image_file" value="<?php echo $nominee_item['image_url'];?>" />
        <img class="imgcontainer" id='image_display' src='<?php echo base_url()."upload/nominee/".$nominee_item['image_url'];?>' />
        <p class="text-info text-center text-uppercase"> Edit a family member </p>
      </div>     
    </div>
      
        <input type="hidden" name="personal_id"  value="<?php echo $nominee_item['personal_id'] ?>"required>
        

        
    
        <div class="col-md-12">
        <div class="rowlabel">Full Name</div>
        <div><input type="text" placeholder="Enter Full Name" name="fullname" autocomplete="off" value="<?php echo $nominee_item['fullname'] ?>" required></div>
        </div>
        
 <?php $relation=$nominee_item['relation'];?>
        <div  class="col-md-6">
            <div class="rowlabel">Relation with employee</div>
            <div>
            <select class="form-control" name="relation">                
               <option value="wife" <?php if($relation=="wife") echo 'selected="selected"'; ?>>Wife</option>
               <option value="son" <?php if($relation=="son") echo 'selected="selected"'; ?>>Son</option>
               <option value="daughter" <?php if($relation=="daughter") echo 'selected="selected"'; ?>>Daughter</option>
               <option value="husband" <?php if($relation=="husband") echo 'selected="selected"'; ?>>Husband</option>
            </select>
            </div> 
       </div> 

        <div class="col-md-6">              
        <div class="rowlabel">Share Percentage</div>        
        <div><input type="text" placeholder="Enter pension percentage" name="share_percentage" autocomplete="off" value="<?php echo $nominee_item['share_percentage'] ?>"required></div>
        </div>
        
        <?php $gender=$nominee_item['gender'];?>
        <div class="col-md-6">
            <div class="rowlabel">Gender</div>
            <div>
            <select class="form-control" name="gender">                
               <option <?php if($gender=="male") echo 'selected="selected"'; ?> value="male" >Male</option>
               <option <?php if($gender=="female") echo 'selected="selected"'; ?> value="female" >Female</option>
            </select>
            </div>
        </div>
        
        <?php $blood_group=$nominee_item['blood_group'];?>
        <div  class="col-md-6">
            <div class="rowlabel">Blood group</div>
            <div>
            <select class="form-control" name="blood_group">                
               <option value="A+" <?php if($blood_group=="A+") echo 'selected="selected"'; ?>>A+</option>
               <option value="A-" <?php if($blood_group=="A-") echo 'selected="selected"'; ?>>A-</option>
               <option value="B+" <?php if($blood_group=="B+") echo 'selected="selected"'; ?>>B+</option>
               <option value="B-" <?php if($blood_group=="B-") echo 'selected="selected"'; ?>>B-</option>
               <option value="O+" <?php if($blood_group=="O+") echo 'selected="selected"'; ?>>O+</option>
               <option value="O-" <?php if($blood_group=="O-") echo 'selected="selected"'; ?>>O-</option>
               <option value="B+" <?php if($blood_group=="AB+") echo 'selected="selected"'; ?>>AB+</option>
               <option value="AB-" <?php if($blood_group=="AB-") echo 'selected="selected"'; ?>>AB-</option>

            </select>
            </div>
        </div>   

        <?php $marital_status=$nominee_item['marital_status'];?>
        <div  class="col-md-6">
            <div class="rowlabel">Marital status</div>
            <div>
            <select class="form-control" name="marital_status">                
               <option value="Unmarried" <?php if($marital_status=="Unmarried") echo 'selected="selected"'; ?>>Unmarried</option>
               <option value="Married" <?php if($marital_status=="Married") echo 'selected="selected"'; ?>>Married</option>
               <option value="Widowed" <?php if($marital_status=="Widowed") echo 'selected="selected"'; ?>>Widowed</option>
               <option value="Separated" <?php if($marital_status=="Separated") echo 'selected="selected"'; ?>>Separated</option>
               <option value="Divorced" <?php if($marital_status=="Divorced") echo 'selected="selected"'; ?>>Divorced</option>
            </select>
            </div>
        </div>  
        <?php $birth_date = date('d-m-Y', strtotime($nominee_item['birth_date']));?>
        <div class="col-md-6" >
        <div class="rowlabel">Date of birth</div>
        <div>
            <input type="text" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>"size="30">
        </div>
        </div>      
       
        <div  class="col-md-12">
        <div class="rowlabel">Present Address</div>
        <div><input type="text" placeholder="Enter Present Address" name="present_address" autocomplete="off" value="<?php echo $nominee_item['present_address'] ?>"></div>
        </div>    
        
        <div  class="col-md-12">
        <div class="rowlabel">Permanent Address</div>
        <div><input type="text" placeholder="Enter Permanent Address" name="permanent_address" autocomplete="off" value="<?php echo $nominee_item['permanent_address'] ?>"></div>
        </div> 
        
        <div class="col-md-6">
        <div class="rowlabel">Nationality</div>
        <div><input type="text" placeholder="Enter Nationality" name="nationality" autocomplete="off"  value="<?php echo $nominee_item['nationality'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">NID no</div>
        <div><input type="text" placeholder="Enter NID No" name="nid_no" autocomplete="off"  value="<?php echo $nominee_item['nid_no'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Birth reg no</div>
        <div><input type="text" placeholder="Enter birth reg no" name="birth_reg_no" autocomplete="off"  value="<?php echo $nominee_item['birth_reg_no'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Passport no</div>
        <div><input type="text" placeholder="Enter passport no" name="passport_no" autocomplete="off"  value="<?php echo $nominee_item['passport_no'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Religion</div>
        <div><input type="text" placeholder="Enter religion" name="religion" autocomplete="off"  value="<?php echo $nominee_item['religion'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Educational qualification</div>
        <div><input type="text" placeholder="Enter educational qualification" name="educational_qualification" autocomplete="off"  value="<?php echo $nominee_item['educational_qualification'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">NID no</div>
        <div><input type="text" placeholder="Enter NID No" name="nid_no" autocomplete="off"  value="<?php echo $nominee_item['nid_no'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Organization</div>
        <div><input type="text" placeholder="Enter organization" name="organization" autocomplete="off"  value="<?php echo $nominee_item['organization'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Designation</div>
        <div><input type="text" placeholder="Enter designation" name="designation" autocomplete="off"  value="<?php echo $nominee_item['designation'] ?>" > </div>
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel">Office address</div>
        <div><input type="text" placeholder="Enter office address" name="office_address" autocomplete="off"  value="<?php echo $nominee_item['office_address'] ?>" > </div>
        </div>
        
        
        
        
        

        <div  class="col-md-6">
        <div class="rowlabel">Contact no</div>
        <div><input type="text" placeholder="Enter Contactno" name="contact_no" autocomplete="off" value="<?php echo $nominee_item['contact_no'] ?>"></div>
        </div>
        
        <div  class="col-md-6">              
        <div class="rowlabel">E-mail</div>        
        <div><input type="text" placeholder="Enter Email" name="email" autocomplete="off" value="<?php echo $nominee_item['email'] ?>"></div>
        </div>
     
    

      
        
    
       
   
    <div class="col-md-12" style="padding:20px;">    
  
 
      
        
        <div class="col-md-12" >
            <button type="submit" class="btn btn-lg" name="submit" >Update</button>        
        </div>

        
        
    </form>
</div>
    
</div>




<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#image_display').attr('src', e.target.result);//where to display
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_file").change(function(){ //event
        readURL(this);
    });

    $(document).ready(function(){               
                 $("#birth_date").datepicker({ dateFormat: 'dd-mm-yy' });
                 });
</script>
