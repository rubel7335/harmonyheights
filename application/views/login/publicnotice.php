




<div class="row"  style="font-family: monospace; ">
  <div class="acme-news-ticker" >
      <div class="acme-news-ticker-label"> <a href="<?php echo site_url();?>"><span class="glyphicon glyphicon-home" style="color:#FFFFFF;padding-right:5px;"></span></a> News update</div>
      <div class="acme-news-ticker-box">
          <ul class="my-news-ticker">
            <?php foreach ($notices as $notice):  ?>
                <?php $id = base64_encode($notice['id']);?>
                  <li><a href="<?php echo site_url('login/noticeview/'.$id); ?>" ><?php echo $notice['title'];?></a></li>
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
   
<div  id="dataContainer" class="row"  style="font-family: monospace;margin-tp:100px; min-height:450px">
  <div class="col-md-12" style="margin-top:100px; ">
      <div class="col-md-3"></div>
      <div class="col-md-6"  >
              <div >
                  <ul >
                              <li  class="list-group-item paneTitle list-group-item-info"><span class="glyphicon glyphicon-info-sign"> Notice</span></li>          
                              <li class="list-group-item">
                                          <table class="table table-condensed " >
                                              <thead>
                                                  <tr>
                                                      <th>
                                                      <?= $notice_item['title']; ?>
                                                      </th>
                                                  </tr>
                                              </thead>
                                              <tr>
                                                  <td><?= $notice_item['details']; ?></td>
                                              </tr>
                                          </table> 
                                      
                              </li>                      
                  </ul>   
              </div>
      </div>
      <div class="col-md-3">  
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

    

