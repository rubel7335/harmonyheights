

   
<div  id="dataContainer" class="row">
        <?php echo validation_errors(); ?> 
        <p ><?php echo @$error_photo;?></p>
        <?php  $person_id= base64_encode($person_item['id']);?>
        <?php echo form_open_multipart('person/edit/'.$person_id); ?>
       
        <div class="col-md-12"> 
                <div style="text-align: center;border:none">
                    <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:300KB</p>
                    <input  type="file" name="image_file" id="image_file" value="<?php echo $person_item['image_url'];?>" />
                    <img class="imgcontainer" id='image_display' src='<?php echo base_url()."upload/".$person_item['image_url'];?>' />
                    <p class="text-info text-center text-uppercase"> Personal info edit</p>
                </div> 
        </div> 
      
        <div  class="col-md-6" style="padding:20px;" >
                    <div class="col-md-6" style="display: none;">
                    <div class="rowlabel">Person category</div>
                            <div>            
                                <?php           
                                // $person_role_id=$person_item['person_role_id']; 
                                    foreach($person_roles as $row)
                                        {  
                                        //   echo  $row['role_id'];
                                            foreach($roles as $role){
                                                if($role['id']==$row['role_id']){
                                                    echo $role['name']."</br>";
                                                }
                                            }
                                        }
                                ?>           
                            </div>
                    </div>
                
                <div class="col-md-6" style="display: none;">
                    <div class="rowlabel">Flat No</div>
                    <div><input type="text" placeholder="Enter flat no" name="flat_no" autocomplete="off" value="<?php echo $person_item['flat_no'] ?>" ></div>
                </div>
                
                <div class="col-md-6">
                    <div class="rowlabel">Fullname</div>
                    <div><input type="text" placeholder="Enter fullname " name="fullname" autocomplete="off" value="<?php echo $person_item['fullname'] ?>" required></div>
                </div>
                
                <div class="col-md-6">
                    <div class="rowlabel">Father name</div>
                    <div><input type="text" placeholder="Enter father name " name="father_name" autocomplete="off" value="<?php echo $person_item['father_name'] ?>" required></div>
                </div>
                
                
                <div class="col-md-6">
                    <div class="rowlabel">Mother name</div>
                    <div><input type="text" placeholder="Enter mothername " name="mother_name" autocomplete="off" value="<?php echo $person_item['mother_name'] ?>" required></div>
                </div>
                
                <div class="col-md-6">
                    <div class="rowlabel">Spouse name</div>
                    <div><input type="text" placeholder="Enter spousename " name="spouse_name" autocomplete="off" value="<?php echo $person_item['spouse_name'] ?>" required></div>
                </div>
                

                    <?php  $gender=$person_item['gender'];?>
                    <div class="col-md-6">
                        <div class="rowlabel">Gender </div>
                        <select class="form-control" name="gender">                
                        <option value="male" <?php if($gender=="male") echo 'selected="selected"'; ?>>Male</option>
                        <option value="female" <?php if($gender=="female") echo 'selected="selected"'; ?>>Female</option>
                        </select>
                    </div>
            
                
                    <?php $blood_group=$person_item['blood_group'];?>
                    <div class="col-md-6">
                        <div class="rowlabel">Blood group</div>
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
                
            
                    <?php $birth_date = $person_item['birth_date'];
                    if ($birth_date){
                                $birth_date = date('d-M-Y', strtotime($birth_date));
                        }
                    ?>

                <div class="col-md-6">
                    <div class="rowlabel">Birthdate</div>
                    <div><input type="text"  id="birth_date" name="birth_date" autocomplete="off" value="<?php echo $birth_date; ?>" required></div>
                </div>
                
                <div  class="col-md-6">              
                    <div class="rowlabel">E-mail</div>        
                    <div><input type="text" placeholder="Enter Email" name="email" autocomplete="off" value="<?php echo $person_item['email'] ?>"></div>
                </div>

                <div  class="col-md-6">              
                    <div class="rowlabel">Nationality</div>        
                    <div><input type="text" placeholder="Enter Nationality" name="nationality" autocomplete="off" value="<?php echo $person_item['nationality'] ?>"></div>
                </div>
                
                <div  class="col-md-6">              
                    <div class="rowlabel">NID </div>        
                    <div><input type="text" placeholder="Enter NID Number" name="nid_no" autocomplete="off" value="<?php echo $person_item['nid_no'] ?>"></div>
                </div>
                
                <div  class="col-md-6">              
                    <div class="rowlabel">Tin no </div>        
                    <div><input type="text" placeholder="Enter Tin Number" name="tin_no" autocomplete="off" value="<?php echo $person_item['tin_no'] ?>"></div>
                </div>
                
                
                <div  class="col-md-6">              
                    <div class="rowlabel">Birth reg no </div>        
                    <div><input type="text" placeholder="Enter birth reg no" name="birth_reg_no" autocomplete="off" value="<?php echo $person_item['birth_reg_no'] ?>"></div>
                </div>
                
                <div  class="col-md-6">              
                    <div class="rowlabel">Passport no</div>        
                    <div><input type="text" placeholder="Enter passport" name="passport_no" autocomplete="off" value="<?php echo $person_item['passport_no'] ?>"></div>
                </div>
                
                <div  class="col-md-6">              
                    <div class="rowlabel">Religion</div>        
                    <div><input type="text" placeholder="Enter religion" name="religion" autocomplete="off" value="<?php echo $person_item['religion'] ?>"></div>
                </div>
                
                <div  class="col-md-6">              
                    <div class="rowlabel">Educational qualification</div>        
                    <div><input type="text" placeholder="Enter educational qualification" name="educational_qualification" autocomplete="off" value="<?php echo $person_item['educational_qualification'] ?>"></div>
                </div>
        </div>
        <div  class="col-md-6 " style="padding:20px;">       
            <div  class="col-md-6">              
                <div class="rowlabel">Organization</div>        
                <div><input type="text" placeholder="Enter organization" name="organization" autocomplete="off" value="<?php echo $person_item['organization'] ?>"></div>
            </div>
            
            <div  class="col-md-6">              
                <div class="rowlabel">Designation</div>        
                <div><input type="text" placeholder="Enter designation" name="designation" autocomplete="off" value="<?php echo $person_item['designation'] ?>"></div>
            </div>
            
            <div  class="col-md-12">              
                <div class="rowlabel">Office address</div>        
                <div><input type="text" placeholder="Enter office address" name="office_address" autocomplete="off" value="<?php echo $person_item['office_address'] ?>"></div>
            </div>
            
            <div  class="col-md-12">              
                <div class="rowlabel">Present address</div>        
                <div><input type="text" placeholder="Enter present address" name="present_address" autocomplete="off" value="<?php echo $person_item['present_address'] ?>"></div>
            </div>
            <div  class="col-md-12">              
                <div class="rowlabel">Permanent address</div>        
                <div><input type="text" placeholder="Enter permanent address" name="permanent_address" autocomplete="off" value="<?php echo $person_item['permanent_address'] ?>"></div>
            </div>
            

            <div  class="col-md-12">
                <div class="rowlabel">Contact no</div>
                <div><input type="text" placeholder="Enter Contact no" name="contact_no" autocomplete="off" value="<?php echo $person_item['contact_no'] ?>"></div>
            </div>
            <div class="col-md-12" >  
                <div style="width:100%"> 
                    <button type="submit" id="btnregistersubmit" class="btn btn-info" name="submit" >Update</button> 
                </div>
            </div>         
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
