<div  id="dataContainer"  class="row">
 

<?php echo form_open_multipart('person/create'); ?>
    <div class="col-md-3" >   </div>
    <div class="col-md-6" style="padding:20px;" id="dataContainer">  
        <div class="col-md-12"  >
                <div class="frmContainer" >  
                <div  style="text-align: center;">
                <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
                <p class="text-info text-center text-uppercase"> Personal information entry form </p>
                </div>    
                </div>
        </div>
    <div id="errordisplayArea">
        <?php echo validation_errors(); ?>
        <p ><?php echo @$error_photo;?></p>
    </div>


        <div class="col-md-6">      
        <div class="rowlabel">Person category</div>
            <div>
            <select class="form-control" name="person_role_id">
            <?php 
            foreach($person_roles as $row)
            { ?>
               <option value="<?php echo $row['id'];?>" <?php echo set_select('person_role_id',  $row['id']); ?>> <?php echo $row['name'];?> </option> 
            <?php            
            }
            ?>
            </select>
          </div>
        </div>      
       
           
        <div class="col-md-6">
        <div class="form-group" > 
        <div class="rowlabel">Flat No</div>
        <input type="text" maxlength="15" size="25" placeholder="Enter Flat No" name="flat_no" autocomplete="off"   <?php echo form_input('flat_no', set_value('flat_no')); ?></input>
        </div>
       </div>
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Fullname</div>
        <input type="text" placeholder="Enter Full Name" name="fullname"  autocomplete="off" required <?php echo form_input('fullname', set_value('fullname')); ?>  </input>
        </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Father Name</div>
        <input type="text" placeholder="Enter Father Name" name="father_name"  autocomplete="off" required <?php echo form_input('father_name', set_value('father_name')); ?>  </input>
        </div>
       </div>
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Mother Name</div>
        <input type="text" placeholder="Enter Mother Name" name="mother_name"  autocomplete="off" required <?php echo form_input('mother_name', set_value('mother_name')); ?>  </input>
        </div>
       </div>
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Spouse Name</div>
        <input type="text" placeholder="Enter Spouse Name" name="spouse_name"  autocomplete="off"  <?php echo form_input('spouse_name', set_value('spouse_name')); ?>  </input>
        </div>
       </div>
        <div class="col-md-6">
            <div class="rowlabel">Gender</div>
            <div>
            <select class="form-control" name="gender"  id="gender">                
                <option value="Male"  > Male</option>
                <option value="Female" > Female</option>
            </select>
            <script type="text/javascript">
                $("#gender").val("<?php echo @$_POST['gender'];?>");
             </script>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rowlabel">Blood group</div>
            <div>
            <select class="form-control" name="blood_group"  id="gender">                
                <option value="A+" > A+</option>
                <option value="A-" > A-</option>
                <option value="B+" > B+</option>
                <option value="B-" > B-</option>
                <option value="O+" > O+</option>
                <option value="O-" > O-</option>
                <option value="AB+"> AB+</option>
                <option value="AB-" > AB-</option>
            </select>
            <script type="text/javascript">
                $("#blood_group").val("<?php echo @$_POST['blood_group'];?>");
             </script>
            </div>
        </div>
        <div  class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Date of birth</div>
      
            <input type="text" id="birth_date" name="birth_date" required <?php echo form_input('birth_date', set_value('birth_date')); ?></input>
        </div>
        </div>
       
        <div  class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Nationality</div>
       
            <input type="text" id="nationality" name="nationality" required <?php echo form_input('nationality', set_value('nationality')); ?></input>
        </div>
        </div>
       
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">NID no</div>
        <input type="text" placeholder="Enter NID No" name="nid_no" autocomplete="off"   <?php echo form_input('nid_no', set_value('nid_no')); ?> </input>
        </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Tin no</div>
        <input type="text" placeholder="Enter TIN No" name="tin_no" autocomplete="off"   <?php echo form_input('tin_no', set_value('tin_no')); ?> </input>
        </div>
       </div>
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Birth registration no</div>
        <input type="text" placeholder="Enter Birth registration no" name="birth_reg_no" autocomplete="off"   <?php echo form_input('birth_reg_no', set_value('birth_reg_no')); ?> </input>
        </div>
       </div>
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Passport no</div>
        <input type="text" placeholder="Enter passport no" name="passport_no" autocomplete="off"   <?php echo form_input('passport_no', set_value('passport_no')); ?> </input>
        </div>
       </div>
        
        <div class="col-md-6">  
        <div class="form-group" > 
        <div class="rowlabel">E-mail</div>
        <input type="text" placeholder="Enter Email" name="email" autocomplete="off"  <?php echo form_input('email', set_value('email')); ?></input>
        </div>        
        </div>
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Religion </div>
        <input type="text" placeholder="Enter religion " name="religion" autocomplete="off"   <?php echo form_input('religion', set_value('religion')); ?> </input>
        </div>
       </div>
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Educational qualification </div>
        <input type="text" placeholder="Enter educational_qualification " name="educational_qualification" autocomplete="off"   <?php echo form_input('educational_qualification', set_value('educational_qualification')); ?> </input>
        </div>
       </div>
       
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Organization </div>
        <input type="text" placeholder="Enter organization " name="organization" autocomplete="off"   <?php echo form_input('organization', set_value('organization')); ?> </input>
        </div>
       </div>
        <div class="col-md-6">
            <div class="form-group" > 
        <div class="rowlabel">Designation </div>
        <input type="text" placeholder="Enter designation " name="designation" autocomplete="off"   <?php echo form_input('designation', set_value('designation')); ?> </input>
        </div>
        </div>
       
        <div class="col-md-12">
            <div class="form-group" > 
        <div class="rowlabel">Office address </div>
        <input type="text" placeholder="Enter office address " name="office_address" autocomplete="off"   <?php echo form_input('office_address', set_value('office_address')); ?> </input>
        </div>
       </div>
       

       
        <div class="col-md-12">
            <div class="form-group" > 
        <div class="rowlabel">Present  Address </div>
        <input type="text" placeholder="Enter present address " name="present_address" autocomplete="off"   <?php echo form_input('present_address', set_value('present_address')); ?> </input>
        </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group" > 
        <div class="rowlabel">Permanent  Address </div>
        <input type="text" placeholder="Enter permanent address " name="permanent_address" autocomplete="off"   <?php echo form_input('permanent_address', set_value('permanent_address')); ?> </input>
        </div>
        </div>

       
<div  class="col-md-12">
    <div class="form-group" > 
        <div class="rowlabel">Contact no</div>
        <input type="text" placeholder="Enter Cell Phone no" name="contact_no" autocomplete="off"  <?php echo form_input('contact_no', set_value('contact_no')); ?></input>
        </div>
</div>    

   
       

    <div class="col-md-12" >
        <div class="form-group">
            <div class="rowlabel">Photo</div>    
            <input type="file" name="image_file" id="image_file" onchange="return checkPhotoFile(this)"  />
            <img id="display_image" src="<?php echo base_url()."upload/demo.jpg"; ?>" alt='your photo' width="200"/> 
            <div id="uploaded_image"></div>
        </div>
      
            <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:300KB</p>
    </div>
    <div class="col-md-12" >   
    <div  style="text-align: center">
        <button type="submit" class="btn btn-info" id="btnregistersubmit" name="submit" value="ADD" onclick="return checkAll()">Add person</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
    </div>
    </div>


</div>
</div>

<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#display_image').attr('src', e.target.result);//where to display
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_file").change(function(){ //event
        readURL(this);
    });

    $(document).ready(function(){
               
                 $("#birth_date").datepicker({ dateFormat: 'dd-mm-yy' }).datepicker("setDate", "+0");
                 });
</script>