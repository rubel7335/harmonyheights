


<div class="row"  style="font-family: monospace; ">
  <div class="acme-news-ticker" >
      <div class="acme-news-ticker-label"><a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" style="color:#FFFFFF;padding-right:5px;"></span></a> News update</div>
      <div class="acme-news-ticker-box">
          <ul class="my-news-ticker">
            <?php foreach ($notices as $notice):  ?>
                <?php $id = base64_encode($notice['id']);?>
                  <li><a href="<?php echo site_url('login/noticeview/'.$id); ?>" target="_blank"><?php echo $notice['title'];?></a></li>
              <?php endforeach; ?>  
          </ul>
      </div>
      <div class="acme-news-ticker-controls acme-news-ticker-horizontal-controls">
          <button class="acme-news-ticker-arrow acme-news-ticker-prev"></button>
          <span class="acme-news-ticker-pause"></span>
          <button class="acme-news-ticker-arrow acme-news-ticker-next"></button>
      </div>
  </div> 
</div>
   
<div  id="dataContainer" class="row"  style="font-family: monospace; ">
<div class="col-md-12">
       <div class="col-md-8"  >
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                  <img src="<?php echo  base_url()."upload/slider/".$firstImage; ?>"  style="width:100%;max-height:400px;">
                </div>

              <?php foreach ($images as $image):  ?>
                    
                    <div class="item">
                      <img src="<?php echo  base_url()."upload/slider/".$image['image_title']; ?>" alt="Chicago" style="width:100%;height:400px;">
                    </div>
                  

              <?php endforeach; ?>        
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
            </a>
          </div>

          <div id="map-container">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12281.83505933869!2d90.44256893228825!3d23.76835988360582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7ba61ca58a5%3A0x5e9aab045a9917f2!2sHarmony%20Heights!5e0!3m2!1sen!2sbd!4v1695399103123!5m2!1sen!2sbd" width="100%" height="250" style="border:1;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
    </div>
      <div class="col-md-4">      
                <div >
                <p class="errorMessgae" style="text-align:center; font-size:16px;margin:10px;" ><?php echo $invaliduser;?></p>    
                    <ul class="list-group">
                      <li class="list-group-item paneTitle list-group-item-info glyphicon glyphicon-log-in"> Login</li>
                            
                                    
                               
                      <li class="list-group-item" >                    
                          <?php 
                          $attributes = array('id' => 'myform');
                          echo form_open('login/verifyuser',$attributes);
                          ?>
                          
                              <input type="text" class="form-control" placeholder="Enter Username" name="username" required value="<?php echo set_value('username'); ?>" >        
                          <?php echo form_error('username'); ?>
                          
                    
                          <input type="password" class="form-control" placeholder="Enter Password" name="password" required value="<?php echo set_value('password'); ?>" > 
                          <?php echo form_error('password'); ?>
                          
                          <p id="captImg">            
                              <?php echo $captchaImg; ?><img id="refreshcontainer" onClick="window.location.reload()"  src="<?php echo base_url().'assets/appimages/refresh.png'; ?>"/>
                          </p>

                    
                          <input type="text" placeholder="Enter captcha here" name="captchatext" required value=""/>
                          <?php echo form_error('captchatext'); ?>
                         
                          <button type="submit" style="width:100%" class="btn btn-info">Login</button>
                          
              
                      </li>         
                    </ul> 
               

                    <ul >
                        <li  class="list-group-item paneTitle list-group-item-info"><span class="glyphicon glyphicon-info-sign"> Instructions</span></li>          
                        <li class="list-group-item">
                                    <table class="table table-condensed " >
                                      <tr>
                                        <td ><span class="glyphicon glyphicon-check" > </span> Change your password upon first logon </td>
                                      </tr>
                                      <tr>
                                        <td ><span class="glyphicon glyphicon-check" > </span> ID will be locked after 3(Three) consecutive times invalid  logon  attempts </td>
                                      </tr>
                                      <tr>
                                        <td><span class="glyphicon glyphicon-check" > </span> Password will be expire after 30(Thirty) days from first successful login</td>
                                      </tr>
                                    </table> 
                                   
                        </li>                      
                    </ul> 


                  

                    <ul class="list-group">
                    <li class="list-group-item paneTitle list-group-item-info glyphicon glyphicon-map-marker"> Project address</li>    
                       
                      <li class="list-group-item" style="text-align:center">
                        <p>Jahurul Islam City (Aftabnagar)</p>
                        <p>Road # 11,12 Block #L  Sector # 3 Plot # 2,3,4,5,6,7,8</p>
                        <p>Eastern Housing, Dhaka</p>
                      </li> 
                    </ul> 



                </div>
      </div>
</div>
</div>

<script src="<?php echo asset_url().'/js/acmeticker.js'?>"></script>
<script>
    $('.my-news-ticker').AcmeTicker({
      controls: {
        prev: $('.acme-news-ticker-prev'),
        toggle: $('.acme-news-ticker-pause'),
        next: $('.acme-news-ticker-next'),
        type: 'horizontal'
      }
    });
</script>
