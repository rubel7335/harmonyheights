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
 $branch_name = $this->session->userdata('branch_name');
 print_r($this->session->userdata());    
 ?> 

<div  id="dataContainer" class="row"  style="min-height:500px;background-image: url('../assets/appimages/blueblack.jpg');opacity: .75;">
<?php if($username){?>
 
<div class="col-md-9">
</div>

<div class="col-md-3">
        <div class="row" >
        <div class="col-md-12">
        <p class="text-info text-center" style="background:#ffedcc;"> <?php echo $username." [ ".$branch_name." ] ";?> </p> 
        <?php if($days_interval>20){            
            $days_remain = 30-$days_interval;
            if($days_remain>1){?> 
                    <p style="color:red;"> <?php echo " ** Your password will expire in ".$days_remain." days";?> </p>            
                    <a href="<?php echo site_url('changepassword') ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span><strong>Please change your password</strong></span>            
                    </a>
                <?php }?>
               <?php if($days_remain == 1){?> 
                    <p style="color:red;"> <?php echo " ** Your password will expire tomorrow";?> </p>            
                    <a href="<?php echo site_url('changepassword') ?>" class="btn">
                      <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                      <span><strong>Please change your password</strong></span>            
                    </a>
                <?php }?>  
        <?php }?>        
        <?php if(!$password_cng_flg){?>
                    <a href="<?php echo site_url('changepassword') ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span><strong>Please change your password</strong></span>            
                    </a>
        <?php }?>
            </div>
            <div class="col-md-9" ></div>
        </div>
</div>
<?php 
    }
?>
</div>
 

