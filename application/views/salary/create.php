<div  id="dataContainer" class="row"  style="font-family: monospace;">
    <div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<div class="col-md-1" style="padding:20px;">  </div>   


    
<?php echo validation_errors(); ?> 
<?php echo form_open('salary/create'); ?>

<div class="col-md-6" style="padding:20px;" id="dataContainer">
    <div  >
        <div   class="row"  style="font-family: monospace;">
        <div class="frmContainer" >  
            <div  style="text-align: center;">
                <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
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
            <button type="submit" id="btnsalsubmit" name="submit" >Generate</button>
                <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />        
        </div>
        
        <div  style="background-color:#f1f1f1">         
                <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
        </div>        
  </div>
</div>
</form>
</div>


<div class="col-md-5">
    <div  id="dataContainer">
    <p style="background-color:#f1f1f1;text-align: center; padding:5px">
        Rollback to regenerate Pension for current month
    </p>
    
        <div  style="text-align: center">         
            <a href="<?php echo site_url('rollback/employee_salary') ?>"><button type="button" class="cancelbtn">Rollback</button> </a>  
        </div>
    </div>
</div>

</div>
