
<div  id="dataContainer" class="row">
    

    
<?php echo form_open_multipart('payment/create/'.$encryptedID); ?>
<input  type="hidden"  name="personal_id" value="<?php echo $shareholder_id;?>"  >   
    <div class="col-md-3" style="padding:20px;"></div>
    <div class="col-md-6"  style="padding:20px;" id="dataContainer">
    <div   class="col-md-12" style="padding:20px;">  
        <div  class="frmContainer" style="text-align: center;">
        <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />    
        <p class="text-info text-center text-uppercase"> Payment entry form </p>
        </div>     
    </div>   
    <div id="errordisplayArea">
        <?php echo validation_errors(); ?>
        <p ><?php echo @$error_photo;?></p>
    </div>
   <div class="col-md-6">
        <div class="rowlabel">Installment</div>
        <div>
            <select class="form-control" name="installment_id"  id="installment_id">                
            <?php 
            foreach($installments as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option> 
            <?php            
            }
            ?>             
            </select>
            <script type="text/javascript">
                $("#installment_id").val("<?php echo $_POST['installment_id'];?>");
             </script>
        </div>
   </div>

        <div class="col-md-6">
        <div class="rowlabel"> Deposit slip no</div>
        <div><input type="text" placeholder="Enter deposit slip no" name="deposit_slip_no" value="<?php echo set_value('deposit_slip_no'); ?>"  required></div>
        </div>
        
    
        <div  class="col-md-6">
        <div class="rowlabel">Deposit date</div>
        <input type="text" id="deposit_date" name="deposit_date" value="<?php echo set_value('deposit_date'); ?>" required /></input>
        </div>
        <div class="col-md-6">
        <div class="rowlabel"> Amount</div>
        <div><input type="text" placeholder="Enter deposit amount" name="deposit_amount" value="<?php echo set_value('deposit_amount'); ?>"   required></div>
        </div>
    
        <div class="col-md-12">
        <div class="rowlabel">Deposit slip image</div>    
        <p> [Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB]</p>
        <input type="file" name="image_file" id="image_file" onchange="return checkPhotoFile(this)" />    
        <img id="image_display" src="" alt='your deposit slip' width="100%"  />
       
        
        </div>
        
        <div class="col-md-6">
        <div class="rowlabel"> Bank</div>
        <div>            
            <select class="form-control" name="bankname"  id="bankname">                
                <option value="BBCOOP">Bangladesh Bank Co-operative</option>
            </select>
        </div>
        </div>
        
        <div class="col-md-6">
            <div class="rowlabel"> Branch</div>
            <div>            
                <select class="form-control" name="branchname"  id="branchname">                
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chattogram">Chattogram</option>
                    <option value="Khulna">Khulna</option>
                    <option value="Sylhet">Sylhet</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rowlabel"> Payment mode</div>
            <div>            
                <select class="form-control" name="payment_type"  id="payment_type">                
                    <option value="Credit">Credit</option>
                    <option value="Debit">Debit</option>
                </select>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="rowlabel"> Remarks</div>
                <div><input type="text" placeholder="Enter remarks" name="remarks" value="<?php echo set_value('deposit_date'); ?>"  ></div>
            </div>
        
            

        
        <div  class="col-md-12">
            <button type="submit"  class="btn btn-lg" name="submit" >ADD</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        </div>
 
</form>
</div>
 <div class="col-md-3"  style="padding:20px;"></div>
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
               
                 $("#deposit_date").datepicker({ dateFormat: 'dd-mm-yy' }).datepicker("setDate", "+0");
                 });
</script>