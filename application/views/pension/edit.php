<div id="dataContainer" class="row">
<?php echo validation_errors(); ?>
<?php $id = base64_encode($pension_item['id']);?>
<?php echo form_open('pension/edit/'.$id); ?>

   
     
    
    
    

    <div class="col-md-3" style="padding:20px;">  </div> 
    <div class="col-md-6" id="dataContainer" style="padding:20px;">
    
    <div class="frmContainer" style="text-align: center;">
      <img class="imgcontainer " src="<?php echo base_url('assets/appimages/registration.png');?>" />
      <p class="text-info text-center text-uppercase"> Edit  pension basic </p>
    </div> 
        
  
   <input type="hidden" placeholder="Enter employee id" name="employee_id" autocomplete="off" value="<?php echo $pension_item['employee_id'] ?>"required>
   <input type="hidden" placeholder="Enter pension basic" name="pension_basic" autocomplete="off" value="<?php echo number_format($pension_item['pension_basic']); ?>" required>
  

    <div  class="col-md-6" >
    <div class="rowlabel">Last increment date</div>
    <div>
        <input type="text" id="last_increment_date" name="last_increment_date" size="30" required  value="<?php echo $pension_item['last_increment_date'] ?>">
    </div>
    </div>   


    <div  class="col-md-6">
    <div class="rowlabel">Next increment date</div>
    <div>
        <input type="text" id="next_increment_date" name="next_increment_date" size="30" required value="<?php echo $pension_item['next_increment_date'] ?>">
    </div>
    </div>

    <div  class="col-md-6">
    <div class="rowlabel">Fixation date</div>
    <div>
        <input type="text" id="fixation_date" name="fixation_date" size="30"  required value="<?php echo $pension_item['fixation_date'] ?>">
    </div>
    </div>

    <?php $period_for_payment=$pension_item['period_for_payment'];?>
    <?php $payment_method=$pension_item['payment_method'];?>
    <div  class="col-md-6">
        <div class="rowlabel">Payment method</div>
        <div>

        <select class="form-control" name="payment_method" id="payment_method" onchange='displayPaymentAccNo()'>                
           <option  <?php if($payment_method=="Cheque") echo 'selected="selected"'; ?> value="Cheque" >Cheque</option>
           <option  <?php if($payment_method=="EFTBBCOOP") echo 'selected="selected"'; ?> value="EFTBBCOOP" >EFT to Bangladesh Bank Co-operative</option>
           <option  <?php if($payment_method=="EFTBANKS") echo 'selected="selected"'; ?> value="EFTBANKS" >EFT to Commercial Bank</option>
           
        </select>
        </div> 
    </div>

    <div class="col-md-12" style="display: none;" id="acc_no">              
    <div class="rowlabel">Payment to account no</div>        
    <div><input type="text" placeholder="Enter payment to account_no" name="payment_to_account_no" autocomplete="off" value="<?php echo $pension_item['payment_to_account_no'] ?>"required></div>
    </div>
    <?php $payment_to_bank_id=$pension_item['payment_to_bank_id'];?>
    <div class="col-md-6">
    <div class="  rowlabel">Payment to Bank</div>
    <div>
        <select class="form-control" name="payment_to_bank_id">
        <?php 
        foreach($fis as $row)
        { ?>
           <option <?php if($payment_to_bank_id==$row['id']){echo 'selected="selected"';} ?>value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option> 
        <?php            
        }
        ?>
        </select>
    </div>
    </div>  
    <?php $payment_to_branch_id=$pension_item['payment_to_branch_id'];?>
    <div class="col-md-6">
    <div class="  rowlabel">Payment to Branch</div>
    <div>
        <select class="form-control" name="payment_to_branch_id">
        <?php 
        foreach($branches as $row)
        { ?>
           <option <?php if($payment_to_branch_id==$row['id']){echo 'selected="selected"';} ?> value="<?php echo $row['id'];?>"><?php echo $row['branch_name'];?></option> 
        <?php            
        }
        ?>
        </select>
    </div>
    </div> 
    <div class="col-md-12">              
    <div class="rowlabel">Remarks</div>        
    <div><input type="text" placeholder="Enter remarks" name="remarks" autocomplete="off" value="<?php echo $pension_item['remarks'] ?>"required></div>
    </div>


    <div class="col-md-12" style="background-color:#f1f1f1">
    <button type="submit" id="btnregistersubmit" name="submit" >Update</button>
    <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />

    </div>
    <div  class="col-md-12" style="background-color:#f1f1f1">         
    <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
    </div>

        
    </form>
</div>
    <div class="col-md-3" style="padding:20px;">  </div> 
</div>
    
   

