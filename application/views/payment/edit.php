<div id="dataContainer" class="row col-md-12">


<div class="row col-md-1"></div>
<?php echo validation_errors(); ?> 
<?php $id = base64_encode($payment_item['id']);?>
<?php echo form_open_multipart('payment/edit/'.$id); ?>
<input  type="hidden"  name="personal_id" value="<?php echo $payment_item['personal_id'];?>"  >  
<div  class="row col-md-12">
    <div class="col-md-3" style="background-color:#f1f1f1"></div>    
    <div  class="col-md-6">
        <div id="bodyholder" class="row" style="background: #d3f3d3;">
    <div class="row" >  
        <div  style="text-align: center;">
        <img class="imgcontainer " src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> Edit a payment </p>
      </div>     
    </div>
            
        <?php 
            $installment_id=$payment_item['installment_id'];
            $deposit_slip_no=$payment_item['deposit_slip_no'];
           // $deposit_date=$payment_item['deposit_date'];
            $deposit_date = date('d-m-Y', strtotime($payment_item['deposit_date']));
            $deposit_amount=$payment_item['deposit_amount'];
            $image_url=$payment_item['image_url'];
            $bankname=$payment_item['bankname'];
            $branchname=$payment_item['branchname'];
            $payment_type=$payment_item['payment_type'];
            $remarks=$payment_item['remarks'];
        ?>    
   
        <div class="col-md-6">       
            <div class="rowlabel"> Installment</div>
            <select class="form-control" name="installment_id" id="installment_id" >                
            <?php 
                foreach($installments as $row)
                { ?>
                <option value="<?php echo $row['id'];?>" <?php if($installment_id===$row['id']){ echo 'selected="selected"'; } ?> ><?php echo $row['name'];?></option> 
                <?php            
                }
                ?> 
            </select>
        </div>
            

        
        
        <div class="col-md-6">  
            <div class="form-group">
                <div class="rowlabel"> Deposit slip no</div>
                <input type="text" placeholder="Enter deposit slip no" name="deposit_slip_no" autocomplete="off"  value="<?php echo $deposit_slip_no; ?>" required></input>
            </div>
        </div>
        
        <div class="col-md-6"> 
             <div class="form-group">
        <div class="rowlabel"> Deposit date</div>
        <input type="text" id="deposit_date" name="deposit_date"  value="<?php echo $deposit_date; ?>" required></input>
             </div>
        </div>
        
        
        <div class="col-md-6">
                <div class="form-group">      
                <div class="rowlabel"> Amount</div>
                <input type="text" placeholder="Enter deposit amount" name="deposit_amount" autocomplete="off"  value="<?php echo $deposit_amount; ?>" required></input>
                </div>
        </div>
        
        
        <div class="col-md-12">
            <div class="form-group"> 
            <div class="rowlabel">Photo</div>
                <input type="file" name="image_file" id="image_file" value="<?php echo $image_url;?>" />
                <img id='image_display' idth='200px' height='200px' src='<?php echo base_url()."upload/payment/".$image_url;?>' />
          
            </div> 
            
                <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
        </div>
            
        <div class="col-md-6">       
        <div class="rowlabel"> Bank name</div>
        <select class="form-control" name="bankname" id="bankname" >                
           <option  <?php if($bankname=="BBCOOP") echo 'selected="selected"'; ?> value="BBCOOP" >Bangladesh Bank Co-operative</option>
        </select>
        </div>
        

            
        <div class="col-md-6">       
            <div class="rowlabel"> Branch name</div>
            <select class="form-control" name="branchname" id="branchname" >                
                <option  <?php if($bankname == "Dhaka") echo 'selected="selected"'; ?>        value="Dhaka" >Dhaka</option>
                <option  <?php if($bankname == "Chattogram") echo 'selected="selected"'; ?>   value="Chattogram" >Chattogram</option>
                <option  <?php if($bankname == "Khulna") echo 'selected="selected"'; ?>       value="Khulna" >Khulna</option>
                <option  <?php if($bankname == "Sylhet") echo 'selected="selected"'; ?>       value="Sylhet" >Sylhet</option>
            </select>
        </div>


        <div class="col-md-6">       
            <div class="rowlabel"> Payment mode</div> 
            <select class="form-control" name="payment_type" id="payment_type" >                
                <option  <?php if($payment_type=="Credit") echo 'selected="selected"'; ?> value="Credit" >Credit</option>
                <option  <?php if($payment_type=="Debit") echo 'selected="selected"'; ?> value="Debit" >Debit</option>
            </select>
        </div>
        
           
        <div  class="col-md-12">
                <div class="form-group"> 
                <div class="rowlabel"> Remarks</div>
                <input type="text" placeholder="Enter remarks" name="remarks" autocomplete="off"  value="<?php echo $remarks; ?>" ></input>
        </div>
    </div>
        

      
        
      
        
        <div  class="col-md-12">
            <button type="submit" class="btn btn-lg" name="submit" >Update</button>
        </div>
        
    </form>
</div>
    <div class="col-md-3" style="background-color:#f1f1f1"></div>
    </div>
</div>
</form>

<div class="row col-md-1"></div>
</div>

<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#image_display').attr('src', e.target.result);//where to display
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_file").change(function(){ //event
        readURL(this);
    });

    $(document).ready(function(){               
                 $("#deposit_date").datepicker({ dateFormat: 'dd-mm-yy' });
                 });
</script>