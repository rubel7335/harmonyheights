<div  id="dataContainer" class="row"  style="font-family: monospace;">
<div class="row col-md-1"></div>
<?php echo validation_errors(); ?> 
<?php $id = base64_encode($allowance_item['id']);?>
<?php echo form_open('allowance/edit/'.$id); ?>
<div  class="row col-md-12">
    <div class="col-md-3" style="background-color:#f1f1f1"></div>    
    <div  class="col-md-6">
        <div class="row" >  
        <div  style="text-align: center;">
        <img class="imgcontainer " src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> Edit an Employee </p>
      </div>     
      </div>
            
        <?php 
        $allowance_type=$allowance_item['allowance_type'];
        $gross_or_percentage=$allowance_item['gross_or_percentage'];
        $allowance_amount=$allowance_item['allowance_amount'];
        ?>    
       <div>
        <div class="rowlabel">Allowance Type</div>
        <div class="row col-md-3">
           <label class="form-check-label">
            <input class="form-check-input" type="radio" name="allowance_type" id="BasicPay" <?php echo ($allowance_type=='Basic Pay')?'checked':''; ?> value="Basic Pay" >
            Basic Pay
          </label>
        </div>  
        <div class="col-md-2">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="allowance_type" id="DearnessAllowance" <?php echo ($allowance_type=='Dearness Allowance')?'checked':''; ?> value="Dearness Allowance">
            Dearness 
          </label>
        </div> 

       
        <div class="col-md-2">
           <label class="form-check-label">
            <input class="form-check-input" type="radio" name="allowance_type" id="MedicalAllowance" <?php echo ($allowance_type=='Medical Allowance')?'checked':''; ?> value="Medical Allowance" >
            Medical 
          </label>
        </div>  
        <div class="col-md-2">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="allowance_type" id="FestivalAllowance" <?php echo ($allowance_type=='Festival Allowance')?'checked':''; ?> value="Festival Allowance">
            Festival 
          </label>
        </div>
        <div class="col-md-3">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="allowance_type" id="NababarshaVata" <?php echo ($allowance_type=='Nababarsha vata')?'checked':'' ;?> value="Nababarsha vata">
            Nababarsha Vata
          </label>
        </div>
    </div>
       <div >       
        <div class="rowlabel">Allowance Amount</div>
        <div><input type="text" placeholder="Enter Full Name" name="allowance_amount" autocomplete="off"  value="<?php echo number_format($allowance_amount); ?>" required></div>
        
        </div>
       <div>
        <div class="rowlabel">Gross or Percentage</div>
        <div class="row col-md-3">
           <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gross_or_percentage" id="gross" <?php echo ($gross_or_percentage=='gross')?'checked':'' ?> value="gross" >
            Gross
          </label>
        </div>  
        <div class="row col-md-3">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gross_or_percentage" id="percentage" <?php echo ($gross_or_percentage=='percentage')?'checked':'' ?> value="percentage">
            Percentage 
          </label>
        </div>
       </div>
        
        
      
        
        <div class="row" >
        <button type="submit" id="btnregistersubmit" name="submit" >Update</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        </div>
        <div  class="row" style="background-color:#f1f1f1">         
        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>
        
        
    </form>
</div>
    <div class="col-md-3" style="background-color:#f1f1f1"></div>
</div>
</form>

<div class="row col-md-1"></div>
</div>

