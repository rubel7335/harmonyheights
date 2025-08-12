<?php
?>

<div  class="row col-md-3"></div>
<div id="bodyholder" class="row col-md-6">
    <div class="col-md-1" style="background-color:#f1f1f1"></div>    
    <div class="col-md-10">
        <div class="row" >  
<?php echo validation_errors(); ?>

<?php echo form_open('register/process'); ?>
        <div  style="text-align: center;">
        <img class="imgcontainer " src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> User Creation Form </p>
      </div>     
      </div>
        
        <div class="row" >
        <div class="rowlabel">Username</div>
        <div><input type="text" placeholder="Enter username" name="username" autocomplete="off" required></div>
        </div>
        
        <div class="row" >
        <div class="rowlabel">Password</div>
        <div><input type="text" placeholder="Enter Password" name="password" autocomplete="off" required></div>
        </div>
        
        <div class="row" >
        <div class="rowlabel">Employee Name</div>
        <div><input type="text" placeholder="Enter Employee Name" name="fullname" autocomplete="off" required></div>
        </div>
      
        <div class="row" >
        <div class="col-md-2 rowlabel">Gender</div>
        <div class="col-md-3">
           <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
            Male
          </label>
        </div>  
        <div class="col-md-3">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
            Female
          </label>
        </div>
        </div>
        
        <div class="row" >
        <div class="rowlabel">E-mail</div>
        <div><input type="text" placeholder="Enter Email" name="email" autocomplete="off" required></div>
        </div>

        <div class="row" >
        <div class="rowlabel">Cell phone</div>
        <div><input type="text" placeholder="Enter Cell Phone no" name="cellphone" autocomplete="off" required></div>
        </div>
        
        <div class="row" >
        <div class=" col-md-2 rowlabel">Designation</div>
        <div>
            <select class="form-control">
            <?php 
            foreach($designations as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>

      
        <div class="row" >
        <div class="rowlabel">Office Address</div>
        <div><input type="text" placeholder="Enter Office Address" name="officeaddress" autocomplete="off" required></div>
        </div>    
        
        <div class="row" >
        <div class="rowlabel">Office Phone</div>
        <div><input type="text" placeholder="Enter Office Phone" name="officephone" autocomplete="off" required></div>
        </div>
        
        
        <div class="row" >
        <div class=" col-md-2 rowlabel">User Category</div>
        <div>
            <select class="form-control">
            <?php 
            foreach($usercategories as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option> 
            <?php            
            }
            ?>
            </select>    

        </div>
        </div>
        
        <div class="row" >
        <div class=" col-md-2 rowlabel">Bank Branch</div>
        <div>
            <select class="form-control">
            <?php 
            foreach($branches as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>        
        
        <div class="row" >
        <button type="submit" id="btnregistersubmit" onclick="myFunction()">Submit</button>
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