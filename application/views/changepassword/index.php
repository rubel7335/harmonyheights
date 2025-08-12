 <?php 
 date_default_timezone_set("Asia/Dhaka");
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 
 $userID = $this->session->userdata('userID');
 $password_cng_flg = $this->session->userdata('password_cng_flg');
 $days_interval = $this->session->userdata('days_interval'); 
 ?>  
<div id="bodyholder" class="row">
<div class="col-md-4" style="padding-top:40px;">
<ul class="list-group">
  <li class="list-group-item paneTitle">Password criteria</li>
  <li class="list-group-item">Password  shall  be  combination  of  at  least  three  of  stated  criteria:uppercase, lowercase, special characters and numbers.</li>
  <li class="list-group-item">Minimum  password  length is 8 (Eight) characters</li>
  <li class="list-group-item">Same  passwords  to  be used again after 4(Four) times</li>
</ul> 
     
</div>  
    <div style="padding:10px;" class="col-md-4">
    <?php     
    if($days_interval>=30){?>
        <p class="errorMessgae">Your password has expired.Change your password to continue</p>
    <?php }?>
      <?php echo form_open('changepassword/updateuserpass',array('onsubmit' => 'return changepass_check()'));?>
     <div class="row">    
        <div class="row col-md-5"></div>
        <div class="row col-md-2" style="text-align: center;">
        <img class="imgcontainer " src="<?php echo base_url('assets/appimages/login.png');?>" />
      </div>
      <div class="row col-md-5"></div>
      </div>
        <div style="padding:10px;" class="inner_container">

        
       
        
        <label><b>New Password</b></label>
        <input type="password" placeholder="Enter New Password" name="new_password" value="<?php echo set_value('new_password'); ?>" > 
        <div class="errorMessgae"><?php echo form_error('new_password'); ?></div>
        
        <label><b>Retype new Password</b></label>
        <input type="password" placeholder="Retype Password" name="retype_password" value="<?php echo set_value('retype_password'); ?>" > 
        <div class="errorMessgae"><?php echo form_error('retype_password'); ?></div>
        
        <p id="captImg"><?php echo $captchaImg; ?><img id="refreshcontainer" onClick="window.location.reload()"  src="<?php echo base_url().'assets/appimages/refresh.png'; ?>"/></p>
        <div class="row">
        <a class="refreshCaptcha" >
            
        </a>  
        </div>
        
        <label><b>Enter captcha</b></label>
        <input type="text" name="captchatext" value=""/>
        <div class="errorMessgae"><?php echo form_error('captchatext'); ?></div>
        <div class="row" style="text-align: center;">
        <button style="text-align:center;" type="submit" class="btn btn-info">Change Password</button>
        </div>

    </div>​


    </form>
</div>
    <div class="col-md-4" style="padding:10px;">
   
    </div>
</div>