
<div  id="dataContainer" class="row">
    
<?php echo validation_errors(); ?> 
<?php echo form_open('pension/create'); ?>


    <input type="hidden"  name="employee_id"  autocomplete="off" value="<?php echo $employee_id;?>" required>
    <input type="hidden" placeholder="Enter pension basic" name="pension_basic" value="<?php echo $employee['pension_amount_during_retirement'];?>" autocomplete="off" required>
    <div class="col-md-3" style="padding:20px;">  </div>   
    <div class="col-md-6" style="padding:20px;" id="dataContainer" >
    <div class="frmContainer">
        <div class="row" >  
        <div  style="text-align: center;">   
        <?php   echo " <img width='120px' height='100px' style='border: #004ab3 solid thin; padding:8px;' src='". base_url()."upload/".$employee['image_url']."'> ";?>
            <p style="padding: 10px; color: royalblue;font-weight: bold; font-size: 16px;" ><?php echo $employee['full_name']."<br> (SAP :".$employee['sap_id'].",PPO :".$employee['ppo_no']." )";?></p>
        </div>     
        </div>   
    </div>
        <div  class="col-md-6">
        <div class="rowlabel">Last increment date</div>
        <div>
            <input type="text" name="last_increment_date" id="last_increment_date" required <?php echo form_input('last_increment_date', set_value('last_increment_date')); ?>
        </div>
        </div> 
    
        <div  class="col-md-6">
        <div class="rowlabel">Next increment date</div>
        <div>
            <input type="text" name="next_increment_date" id="next_increment_date" required <?php echo form_input('next_increment_date', set_value('next_increment_date')); ?> 
        </div>
        </div>
    
        <div  class="col-md-6">
        <div class="rowlabel">Fixation date</div>
        <div>
            <input type="text" id="fixation_date" name="fixation_date" size="30" required <?php echo form_input('fixation_date', set_value('fixation_date')); ?>
        </div>
        </div>




        <div class="col-md-6">
            <div class="rowlabel">Payment Method</div>
            <div>
                <select class="form-control" name="payment_method"  id="payment_method" onchange='displayPaymentAccNo()'>  
                <option value="Cheque"  > Cheque </option>
                <option value="EFTBBCOOP" > EFT to Bangladesh Bank Co-operative </option>
                <option value="EFTBANKS" > EFT to Commercial Bank </option>
            </select>
            <script type="text/javascript">
                $("#payment_method").val("<?php echo $_POST['payment_method'];?>");
             </script>
            </div>
        </div> 
        
        <div class="col-md-12" style="display: none;" id="acc_no">              
        <div class="rowlabel">Payment to account no</div>        
        <div><input type="text" placeholder="Enter payment to account_no" name="payment_to_account_no" autocomplete="off"  <?php echo form_input('payment_to_account_no', set_value('payment_to_account_no')); ?></div>
        </div>
        
        <div class="col-md-6">
        <div class="col-md-6 rowlabel">Payment to Bank</div>
        <div>
            <select class="form-control" name="payment_to_bank_id">
            <?php 
            foreach($fis as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"<?php echo set_select('payment_to_bank_id',  $row['id']); ?> ><?php echo $row['name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="col-md-6 rowlabel">Payment to Branch</div>
        <div>
            <select class="form-control" name="payment_to_branch_id">
            <?php 
            foreach($branches as $row)
            { ?>
               <option value="<?php echo $row['id'];?>" <?php echo set_select('payment_to_branch_id',  $row['id']); ?>><?php echo $row['branch_name'];?></option> 
            <?php            
            }
            ?>
            </select>
        </div>
    </div>

        <div class="col-md-12">              
        <div class="rowlabel">Remarks</div>        
        <div><input type="text" placeholder="Enter remarks" name="remarks" autocomplete="off" ></div>
        </div>
        <div  class="col-md-12" style="background-color:#f1f1f1" >
        <button type="submit" id="btnregistersubmit" name="submit" >ADD</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        </div>
        <div class="col-md-12" style="background-color:#f1f1f1">         
        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>
 
</form>
</div>
    <div class="col-md-3" style="padding:20px;">  </div>  
</div>

