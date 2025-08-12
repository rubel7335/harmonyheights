
<div  id="dataContainer" class="row">
    
<?php echo validation_errors(); ?> 
<?php echo form_open('allowance/create'); ?>


    <div class="col-md-3" style="padding:20px;"></div>
    <div class="col-md-6"  style="padding:20px;" id="dataContainer">
    <div   class="col-md-12" style="padding:20px;">  
        <div  class="frmContainer" style="text-align: center;">
        <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />    
        <p class="text-info text-center text-uppercase"> Allowance entry form </p>
        </div>     
    </div>   

   <div class="col-md-6">
        <div class="rowlabel">Allowance Type</div>
        <div>
            <select class="form-control" name="allowance_type"  id="allowance_type">                
                <option value="Basic Pay">Basic Pay</option>
                <option value="Dearness Allowance">Dearness Allowance</option>
                <option value="Medical Allowance">Medical Allowance</option>
                <option value="Festival Bonus">Festival Bonus</option>
                <option value="Nababarsha vata">Nababarsha vata</option>
                <option value="Bijoy Dibos vata">Bijoy Dibos vata</option>                
            </select>
            <script type="text/javascript">
                $("#allowance_type").val("<?php echo $_POST['allowance_type'];?>");
             </script>
        </div>
   </div>

       

  
        <div class="col-md-6">
        <div class="rowlabel">Allowance Amount</div>
        <div><input type="text" placeholder="Enter allowance amount" name="allowance_amount" autocomplete="off" required></div>
        </div>
        
        
      
        <div  class="col-md-12">
        <div class="rowlabel">Gross or Percentage</div>
        <div class="col-md-6">
           <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gross_or_percentage" id="male" value="gross" checked>
            Gross
          </label>
        </div>  
        <div class="col-md-6">  
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gross_or_percentage" id="female" value="percentage">
            Percentage
          </label>
        </div>
        </div>
        
        
        <div  class="col-md-12">
        <button type="submit" id="btnregistersubmit" name="submit" >ADD</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        
        <div  style="background-color:#f1f1f1">         
        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>
        </div>
 
</form>
</div>
 <div class="col-md-3"  style="padding:20px;"></div>
</div>
