<div  id="dataContainer" class="row"  style="font-family: monospace;">
    <div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<div class="col-md-3" style="padding:20px;">  </div>   



    
<?php  echo validation_errors(); ?> 
<?php  $id = base64_encode($salary_id);?>
<?php  echo form_open('salary/add_areear/'.$id); ?>


<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>

<div   class="col-md-6"  style="padding:20px;" id="dataContainer">
    <div class="row">
        <div class=" col-md-12 frmContainer" >  
            <div  style="text-align: center;">
                <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
                    <p class="text-info text-center text-uppercase"> Add Areear </p>
            </div>   
        </div>
          
        
        <?php foreach ($allowances as $allowance_item): ?>
        
        <div class="col-md-6">    
            <div class="rowlabel"><?php echo $allowance_item['allowance_type']; ?></div>
            <div>            
                <input type="text"     id="<?php echo $allowance_item['id'];?>"  name="allowanceAmount[]"></p>   
                <input type="hidden"   name="allowanceID[]" value="<?php echo  $allowance_item['id'];?>" ></p>    
            </div>
        </div>
            
        <div class="col-md-6">    
            <div class="rowlabel">Remarks</div>
            <div>            
                <input type="text" id="<?php echo $allowance_item['allowance_type']."_remarks";?>" name="remarks[]" ></p>            
            </div>
        </div>   
        <?php endforeach; ?>

  

        <div  class="rowlabel">
            <button type="submit" id="btnsalsubmit" name="submit" >ADD</button>
                <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />        
        </div>
        
        <div  style="background-color:#f1f1f1;text-align: center;">         
                <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>       
        </div>        
  </div>
<div class="col-md-3" style="padding:20px;">  </div>  
</form>
</div>
</div>



