
<?php echo validation_errors(); ?>
<?php $id = base64_encode($user_item['id']);?>
<?php echo form_open('membership/edit/'.$id); ?>

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
        
         <?php  $personal_id = $user_item['personal_id'];?>
        <div class="row" >
        <div class=" col-md-2 rowlabel">Shareholder id</div>
        <div>
            <select class="form-control" name="personal_id">
            <?php 
            foreach($persons as $row)
            { ?>
               <option <?php if($personal_id==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['fullname'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        <div class="row" >
        <div class="rowlabel">Username</div>
        <div><input type="text" placeholder="Enter username" name="username" value="<?php echo $user_item['username'] ?>" autocomplete="off" required></div>
        </div>

        
        <div class="row" >
        <div class="rowlabel"> Fullname</div>
        <div><input type="text" placeholder="Enter Employee Name" name="fullname"  value="<?php echo $user_item['fullname']; ?>"autocomplete="off" required></div>
        </div>
         <div class="row" >
        <div class="rowlabel">Flat no</div>
        <div><input type="text" placeholder="Enter flat_no" name="flat_no" value="<?php echo $user_item['flat_no']; ?>"  autocomplete="off" required></div>
         </div>
       
        
        <div class="row" >
        <div class="rowlabel">E-mail</div>
        <div><input type="text" placeholder="Enter Email" name="email"  value="<?php echo $user_item['email']; ?>" autocomplete="off" required></div>
        </div>

        <div class="row" >
        <div class="rowlabel">Contact no</div>
        <div><input type="text" placeholder="Enter Cell Phone no" name="contact_no" value="<?php echo $user_item['contact_no']; ?>" autocomplete="off" required></div>
        </div>


      

        
        <?php $user_category_id = $user_item['user_cat_id'];?>
        <div class="row" >
        <div class="rowlabel">User Category</div>
        <div>
            <select class="form-control" name="user_cat_id">
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

