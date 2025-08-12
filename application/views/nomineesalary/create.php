

<div  id="dataContainer" class="row">

    
<?php echo validation_errors(); ?> 
<?php echo form_open('nomineesalary/create'); ?>
<div class="row col-md-3"></div>         
<div class="col-md-6" style="padding:20px;" id="dataContainer" >
        <div class="frmContainer" >  
        <div  style="text-align: center;">
        <p class="text-info text-center text-uppercase"> Pension initialization </p>
        </div>     
        </div>


        <div>
            <div class="rowlabel">Pension Type</div>
            <div class="row col-md-6">
               <label class="form-check-label">
                <input class="form-check-input" type="radio" name="salary_type" id="Regular" value="Regular" checked>
                Regular
              </label>
            </div>  
            <div class="col-md-6">  
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="salary_type" id="Allowance" value="Allowance">
                Allowance 
              </label>
            </div> 
        </div>
        <div >
        <div class="rowlabel col-md-3">Month</div>
        <div>
            <select class="form-control " name="salary_month">                       
               <option value="1">January</option>
               <option value="2">February</option>
               <option value="3">March</option>
               <option value="4">April</option>
               <option value="5">May</option>
               <option value="6">June</option>
               <option value="7">July</option>
               <option value="8">August</option>
               <option value="9">September</option>
               <option value="10">October</option>
               <option value="11">November</option>
               <option value="12">December</option>
            </select>
        </div>
       <div class="rowlabel col-md-3">Year</div>
        <div>
             <select class="form-control " name="salary_year">  
                 <?php 
                 for($year=2017;$year<2099;$year++){?>                                 
                <option value="<?php echo $year?>"><?php echo $year;?></option>
                 <?php }?>
             </select>
         </div>
        </div>  
    
       
        <div class="rowlabel">Date of payment</div>
        <div>            
            <input type="text" id="date_of_payment" name="date_of_payment" required></p>            
        </div>

        
      

        
        <div  class="rowlabel">
        <button type="submit" id="btnsalsubmit" name="submit" >Initiate</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        
        </div>
        <div  style="background-color:#f1f1f1">         
        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>
 
</form>
</div>
<div class="row col-md-3"></div>

</div>