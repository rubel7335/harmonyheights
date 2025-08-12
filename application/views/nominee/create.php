<div  id="dataContainer"  class="row">
<?php echo validation_errors(); ?> 
<?php echo form_open_multipart('nominee/create/'.$encryptedID); ?>
 
 
<input  type="hidden"  name="personal_id" value="<?php echo $shareholder_id;?>"  >  
 <div class="col-md-3" >   </div>
  <div class="col-md-6" tyle="padding:20px;" id="dataContainer">   
        <div class="col-md-12"  >
                <div class="frmContainer" >  
                    <div  style="text-align: center;">              
                            <p style=" color: #004ab3;font-weight: bold; font-size: 18px;" > <?php echo $title;?> </p> 
                            <?php   echo " <img width='200px' height='180px' style='border: #004ab3 solid thin;border-radius:70%; padding:8px;' src='". base_url()."upload/".$person['image_url']."'> ";?>
                            <p  ><?php echo $person['fullname'];?></p>
                    </div>    
                </div>
        </div>
        <div class="col-md-6">
                <div class="rowlabel">Full Name</div>    
                <input type="text" placeholder="Enter Full Name" name="fullname" autocomplete="off"  required <?php echo form_input('fullname', set_value('fullname')); ?>   </input>   
        </div>
        <div  class="col-md-6">
        <div class="rowlabel">Share percentage</div>
            <input type="text" id="share_percentage" name="share_percentage" required <?php echo form_input('share_percentage', set_value('share_percentage')); ?></input>
        </div>
        <div class="col-md-6" >
        <div class="rowlabel">Relation with employee </div>       
            <select class="form-control" name="relation"  id="relation">                
                <option value="wife">Wife</option>
                <option value="son">Son</option>
                <option value="daughter">Daughter</option>
                <option value="husband">Husband</option>
            </select>
            <script type="text/javascript">
                $("#relation").val("<?php echo $_POST['relation'];?>");
             </script>
     
       </div>

        <div class="col-md-6">
        <div class="rowlabel">Gender</div>
        
            <select name="gender" class="form-control" id="gender">                
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <script type="text/javascript">
                $("#gender").val("<?php echo $_POST['gender'];?>");
             </script>
        </div>
        <div class="col-md-6">
            <div class="rowlabel">Blood group</div>
           
            <select class="form-control" name="blood_group"  id="gender">                
                <option value="A+"  > A+</option>
                <option value="A-"  > A-</option>
                <option value="B+" > B+</option>
                <option value="B-"  > B-</option>
                <option value="O+"  > O+</option>
                <option value="O-" > O-</option>
                <option value="AB+"  > AB+</option>
                <option value="AB-" > AB-</option>
            </select>
            <script type="text/javascript">
                $("#blood_group").val("<?php echo @$_POST['blood_group'];?>");
             </script>
            </div>
        <div class="col-md-6">
        <div class="rowlabel">Marital status</div>
       
            <select class="form-control" name="marital_status"  id="marital_status">                
                <option value="unmarried">Unmarried</option>
                <option value="married">Married</option>
                <option value="widowed">Widowed</option>
                <option value="separated">Separated</option>
                <option value="divorced">Divorced</option>
            </select>
            <script type="text/javascript">
                $("#marital_status").val("<?php echo $_POST['marital_status'];?>");
             </script>
        </div>
        <div  class="col-md-6">
        <div class="rowlabel">Date of birth</div>
        
            <input type="text" id="birth_date" name="birth_date" required <?php echo form_input('birth_date', set_value('birth_date')); ?></input>
        </div>
        <div class="col-md-12">
        <div class="rowlabel">Present  Address </div>
        <input type="text" placeholder="Enter present address " name="present_address" autocomplete="off"   <?php echo form_input('present_address', set_value('present_address')); ?> </input>
        </div>
        <div class="col-md-12">
        <div class="rowlabel">Permanent  Address </div>
       <input type="text" placeholder="Enter permanent address " name="permanent_address" autocomplete="off"   <?php echo form_input('permanent_address', set_value('permanent_address')); ?> </input>
        </div>
        <div  class="col-md-6">
        <div class="rowlabel">Nationality</div>
       
            <input type="text" id="nationality" placeholder="Enter nationality" name="nationality" required <?php echo form_input('nationality', set_value('nationality')); ?></input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">NID no</div>
        <input type="text" placeholder="Enter NID No" name="nid_no" autocomplete="off"   <?php echo form_input('nid_no', set_value('nid_no')); ?> </input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">Birth registration no</div>
        <input type="text" placeholder="Enter Birth registration no" name="birth_reg_no" autocomplete="off"   <?php echo form_input('birth_reg_no', set_value('birth_reg_no')); ?> </input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">Passport no</div>
        <input type="text" placeholder="Enter passport no" name="passport_no" autocomplete="off"   <?php echo form_input('passport_no', set_value('passport_no')); ?> </input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">Religion </div>
        <input type="text" placeholder="Enter religion " name="religion" autocomplete="off"   <?php echo form_input('religion', set_value('religion')); ?> </input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">Educational qualification </div>
        <input type="text" placeholder="Enter educational_qualification " name="educational_qualification" autocomplete="off"   <?php echo form_input('educational_qualification', set_value('educational_qualification')); ?> </input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">Organization </div>
        <input type="text" placeholder="Enter organization " name="organization" autocomplete="off"   <?php echo form_input('organization', set_value('organization')); ?> </input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel">Designation </div>
       <input type="text" placeholder="Enter designation " name="designation" autocomplete="off"   <?php echo form_input('designation', set_value('designation')); ?> </input>
        </div>
        <div class="col-md-12">
        <div class="rowlabel">Office address </div>
        <input type="text" placeholder="Enter designation " name="office_address" autocomplete="off"   <?php echo form_input('office_address', set_value('office_address')); ?> </input>
        </div>
        <div class="col-md-12">  
      <div class="rowlabel">Contact no</div>
        <input type="text" placeholder="Enter Cell Phone no" name="contact_no" autocomplete="off"  <?php echo form_input('contact_no', set_value('contact_no')); ?></input>
       
      </div> 
        <div class="col-md-6">              
        <div class="rowlabel">E-mail</div>
        <input type="text" placeholder="Enter Email" name="email" autocomplete="off"  <?php echo form_input('email', set_value('email')); ?></input>
        </div>        
   
        <div class="col-md-12">
            <div class="form-group">
            <div class="rowlabel">Photo</div>    
            <input type="file" name="image_file" id="image_file" onchange="return checkPhotoFile(this)" />       
            <img id="display_image" src="<?php echo base_url()."upload/demo.jpg"; ?>" alt='your photo' width="200"/> 
            <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
            </div>
        </div>
        <div  class="col-md-12" style="background-color:#f1f1f1">
            <button type="submit" class="btn btn-lg" name="submit" >ADD</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        </div>
        </div>
<div class="col-md-3" >   </div>
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



