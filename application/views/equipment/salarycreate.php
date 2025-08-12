
<div  id="dataContainer" class="row"  style="font-family: monospace;">
 
 


<?php echo form_open_multipart('salaryexpense/create'); ?>
    
<div class="col-md-12" style="padding:20px;">
        <div class="frmContainer" >  
        <div  style="text-align: center;">
        <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
        <p class="text-info text-center text-uppercase"> Expense entry form </p>
        </div>     
        </div>
</div>
    <div id="errordisplayArea">
        <?php echo validation_errors(); ?> 
        <p ><?php echo @$error_photo;?></p>
    </div>

    <div class="col-md-12" style="padding:20px;">
        
        
        <div  class="col-md-6">
        <div class="col-md-2 rowlabel">Category</div>
        <div>
            <select class="form-control" name="expense_subarea_id">
            <?php 
            foreach($expense_types as $row)
            { ?>
               <option value="<?php echo $row['id'];?>" <?php echo set_select('expense_subarea_id',  $row['id']); ?>> <?php echo $row['title'];?> </option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        
        <div  class="col-md-6">
        <div class="col-md-4 rowlabel">Pay to</div>
        <div>
            <select class="form-control" name="person_id">
            <?php 
            foreach($paid_person as $row)
            { ?>
               <option value="<?php echo $row['id'];?>" <?php echo set_select('person_id',  $row['id']); ?>> <?php echo $row['fullname'];?> </option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        
        <div  class="col-md-6">
        <div class="rowlabel">Date of payment</div>
        <div>
            <input type="text" id="payment_date" name="payment_date" required <?php echo form_input('payment_date', set_value('payment_date')); ?></p>
        </div>
        </div>
        
 
       
        <div class="col-md-6">
        <div class="rowlabel">Total amount</div>
        <div><input type="text"   placeholder="Enter total amount" name="total_amount" autocomplete="off"  required <?php echo form_input('total_amount', set_value('total_amount')); ?></div>
        </div>
            
        <div class="col-md-6">
        <div class="rowlabel">Memo no</div>
        <div><input type="text"   placeholder="Enter memo" name="memo_no" autocomplete="off"  required <?php echo form_input('memo_no', set_value('memo_no')); ?></div>
        </div>
        
        <div class="col-md-6" style="padding:20px;">
        <div class="col-md-8">
        <div class="rowlabel">Memo</div>    
        <input type="file" name="memo_image" id="image_file" onchange="return checkPhotoFile(this)"  />
        <input style="display:none;" type="button" id="btn_upload_photo" name="btn_upload_photo" value="Upload File" onclick="return validate()" />
        <div id="uploaded_image">
            <script type="text/javascript">
                $("#uploaded_image").val("<?php echo @$_FILES['memo_image']['name'];?>");
             </script>
        </div>
        </div>
        <div class="col-md-4">
            <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
        </div>
                
       </div> 
        
        <div class="col-md-6">
            <div class="rowlabel">Paid / Unpaid</div>
            <div>
            <select class="form-control" name="paid_unpaid"  id="paid_unpaid">                
                <option value="1"  > Paid</option>
                <option value="0" > Unpaid</option>
            </select>
            <script type="text/javascript">
                $("#paid_unpaid").val("<?php echo @$_POST['paid_unpaid'];?>");
             </script>
            </div>
        </div> 
        
        <div  class="col-md-6">
        <div class="col-md-2 rowlabel">Paid by</div>
        <div>
            <select class="form-control" name="paid_by_person_id">
            <?php 
            foreach($mgm_users as $row)
            { ?>
               <option value="<?php echo $row['id'];?>" <?php echo set_select('paid_by_person_id',  $row['id']); ?>> <?php echo $row['fullname'];?> </option> 
            <?php            
            }
            ?>
            </select>
        </div>
        </div>
        

    </div>

    

      
        
        
        
        <div class="col-md-6" >
        <div class="rowlabel">Remarks</div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off"  <?php echo form_input('remarks', set_value('remarks')); ?></div>
        </div>
        
    <div  style="text-align: center">
        <button type="submit" id="btnregistersubmit" name="submit" value="ADD" >Add Salary Expense</button>
        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />        
        </div>

</form>
</div>
</div>


