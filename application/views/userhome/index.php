 <?php 
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 
 //var_dump($pages);
 $userID = $this->session->userdata('userID');
 $password_cng_flg = $this->session->userdata('password_cng_flg');
 $days_interval = $this->session->userdata('days_interval'); 
 $password_creation_date = $this->session->userdata('password_creation_date');
 ?> 
<div  id="dataContainer" class="row" style="height:450px;">
      <div class="col-md-12">
              <div class="row" >
                  <div class="col-md-3" style="background:#ffedcc;">
                      <p class="text-info text-center text-uppercase"> Welcome! <?php echo $full_name;?> </p> 
                    <?php if($days_interval<=10){?> 
                      <p class="text-info"> <?php echo "Your password will expire in ".$days_interval." days";?> </p>  
                      <p class="text-info text-danger"> <?php echo "Please change your password";?> </p>  
                      <a  href="<?php echo site_url('changepassword') ?>">Change Password</a> 
                    <?php }?>        
                    <?php if(!$password_cng_flg){?>
                      <p class="text-info text-center text-uppercase"> <?php echo "Please change your password";?> </p>  
                      <a  href="<?php echo site_url('changepassword') ?>">Change Password</a> 
                    <?php }?>
                  </div>
                  <div class="col-md-9" ></div>          
              </div>
      </div>  
</div>
 



