
<div  class="row" id="dataContainer">
<div class="row col-md-3"></div>
<div class="row col-md-6" style="padding:10px;">
<?php echo validation_errors(); ?> 
<?php echo form_open('membership/create'); ?>
        <div class="row" >  
        <div  style="text-align: center;">
        <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> User Creation Form </p>
        </div>     
        </div>
    <div class="inner_container">
        <div  >
        <div class=" col-md-2 rowlabel">Shareholder id</div>
        <div>
            <select class="form-control" name="personal_id">
            <?php 
            foreach($persons as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['fullname'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
        <?php echo form_error('personal_id'); ?>
        </div>

        <div >
        <div class="rowlabel">Username</div>
        <div><input type="text" placeholder="Enter username" name="username" autocomplete="off" required></div>
        <?php echo form_error('username'); ?>
        </div>
        
        <div >
        <div class="rowlabel">Password</div>
        <div class="row">
            <div class="col-md-8">
            <input type="password" placeholder="Enter Password" name="password" id="paw" autocomplete="off" required>        
            </div>
        
        <div class="col-md-4">
        
          
				<div id="pswd_info">
					<h4>Password must be requirements</h4>
					<ul>
						<li id="letter" class="invalid">At least <strong>one letter</strong></li>
						<li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
						<li id="number" class="invalid">At least <strong>one number</strong></li>
						<li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
						<li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>
					</ul>
				</div>
            
        
        </div>
            </div>
        <?php echo form_error('password'); ?>

        </div>
        
        <div >
        <div class=" col-md-2 rowlabel">User Category</div>
        <div>
            <select class="form-control" name="user_cat_id">
            <?php 
            foreach($usercategories as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option> 
            <?php            
            }
            ?>
            </select>    

        </div>
        <?php echo form_error('user_cat_id'); ?>
        </div>
        
       
        
        <div  >
        <div class="rowlabel">Remarks</div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off" required></div>
        <?php echo form_error('remarks'); ?>
        </div>
        
        <div  >
        <button type="submit" id="btnregistersubmit" name="submit" >ADD</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        </div>

 
</form>
</div>
</div>
<div class="row col-md-3"></div>

</div>