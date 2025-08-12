
<?php echo validation_errors(); ?>
<?php $id = base64_encode($user_item['id']);?>
<?php echo form_open('user/edit/'.$id); ?>

<div  class="row col-md-3"></div>
<div id="bodyholder" class="row col-md-6">
    <div class="col-md-1" style="background-color:#f1f1f1"></div>    
    <div class="col-md-10">
        <div class="row" >  
        <div  style="text-align: center;">
        <img class="imgcontainer " src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> Edit a User </p>
      </div>     
      </div>
        
        <div class="row" >
        <div class="rowlabel">Username</div>
        <div><input type="text" placeholder="Enter username" name="username" value="<?php echo $user_item['username'] ?>" autocomplete="off" required></div>
        </div>

        
        <div class="row" >
        <div class="rowlabel">Employee Name</div>
        <div><input type="text" placeholder="Enter Employee Name" name="fullname" value="<?php echo $user_item['full_name']; ?>"  autocomplete="off" required></div>
        </div>
      <?php  $gender = $user_item['gender'];?>

       
        <div class="row" >
        <div class="col-md-2 rowlabel">Gender</div>
        <div class="col-md-3">
           <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="male" <?php echo ($gender=='male')?'checked':''; ?> value="male" >
            Male
          </label>
        </div>  
        <div class="col-md-3">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="female" <?php echo ($gender=='female')?'checked':''; ?> value="female">
            Female
          </label>
        </div>
        </div>
        
        <div class="row" >
        <div class="rowlabel">E-mail</div>
        <div><input type="text" placeholder="Enter Email" name="email"  value="<?php echo $user_item['email']; ?>" autocomplete="off" required></div>
        </div>

        <div class="row" >
        <div class="rowlabel">Cell phone</div>
        <div><input type="text" placeholder="Enter Cell Phone no" name="cellphone" value="<?php echo $user_item['cell_phone']; ?>" autocomplete="off" required></div>
        </div>
         <?php $designation = $user_item['designation_id'];?>
        <div class="row" >
        <div class=" col-md-2 rowlabel">Designation</div>
        <div>
            <select class="form-control" name="designation">
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

      
        <div class="row" >
        <div class="rowlabel">Office Address</div>
        <div><input type="text" placeholder="Enter Office Address" name="officeaddress" value="<?php echo $user_item['office_address']; ?>" autocomplete="off" required></div>
        </div>    
        
        <div class="row" >
        <div class="rowlabel">Office Phone</div>
        <div><input type="text" placeholder="Enter Office Phone" name="officephone" value="<?php echo $user_item['office_phone']; ?>" autocomplete="off" required></div>
        </div>
        
        <?php $user_category_id = $user_item['user_category_id'];?>
        <div class="row" >
        <div class="rowlabel">User Category</div>
        <div>
            <select class="form-control" name="category">
            <?php 
            foreach($usercategories as $row)
            { ?>
               <option <?php if($user_category_id==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option> 
            <?php            
            }
            ?>
            </select>    

        </div>
        </div>
        <?php $branch_id=$user_item['branch_id'];?>
        <div class="row" >
        <div class="rowlabel">Bank Branch</div>
        <div>
            <select class="form-control" name="branch">
            <?php 
            foreach($branches as $row)
            { ?>
               <option <?php if($branch_id==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>   
        
        <div class="row" >
        <div class="rowlabel">Remarks</div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" value="<?php echo $user_item['remarks']; ?>" autocomplete="off" required></div>
        </div>
        
        <div class="row" >
        <button type="submit" id="btnregistersubmit" name="submit" >Update</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        </div>
        <div  class="row" style="background-color:#f1f1f1">         
        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>
        
        
    </form>
</div>
    <div class="col-md-1" style="background-color:#f1f1f1"></div>
</div>
<div  class="row col-md-3"></div>  



</form>

