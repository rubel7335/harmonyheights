
<div  id="dataContainer" class="row"  style="font-family: monospace; ">
 

    



<div id="errordisplayArea">
        <?php echo validation_errors(); ?> 
        <p ><?php echo @$error_photo;?></p>
</div>
<!-- <div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div> -->
    <div class="col-md-3"></div>
    <div class="col-md-6" id="bodyholder" style="padding:20px; background:  #FFFFFF;text-align: center;">
    <?php echo form_open_multipart('expense/create'); ?>   
        <div  class="col-md-6">
            <?php $classID=3;?>
        <div class="rowlabel">Category<a href="<?= site_url('expense_subarea/create/'.$classID) ?>">[ + ]</a></div>
            <div>
                <select class="form-control" name="expense_subarea_id">
                    <?php 
                    foreach($expenses_types as $row)
                        { ?>
                        <option value="<?php echo $row['id'];?>" <?php echo set_select('expense_subarea_id',  $row['id']); ?>> <?php echo $row['title'];?> </option> 
                        <?php            
                        }
                    ?>
                </select>
            </div>
        </div>

        

        <div  class="col-md-6">          
            <div class="form-group">       
                <div class="rowlabel">Description</div>
                <input type="text"   placeholder="Enter short description" name="description" autocomplete="off"   <?php echo form_input('description', set_value('description')); ?></input>
            </div>
        </div>

        <div  class="col-md-6">
            <div class="form-group" >
                <div class="rowlabel">Date of payment</div>        
                    <input type="text" id="payment_date" name="payment_date" required <?php echo form_input('payment_date', set_value('payment_date')); ?> </input>
                </div>
            </div>
        <div class="col-md-6">
           <div class="form-group">       
               <div class="rowlabel">Total amount</div>
               <input type="text"   placeholder="Enter total amount" name="total_amount" id="total_amount" autocomplete="off"  required <?php echo form_input('total_amount', set_value('total_amount')); ?></input>
           </div>
       </div>   
        <div class="col-md-6">
               <div class="form-group">       
               <div class="rowlabel">Memo no</div>
               <input type="text"   placeholder="Enter memo no" name="memo_no" autocomplete="off"  <?php echo form_input('memo_no', set_value('memo_no')); ?></input>

           </div>


       </div>
        <div class="col-md-12">
           <div class="form-group">       
               <div class="rowlabel">Memo </div>
               <input type="file" name="memo_image" id="memo_image" onchange="return checkPhotoFile(this)"  />
                <img id="display_image" src="<?php echo base_url()."upload/demo.jpg"; ?>" alt='your photo' width="200"/> 
                <div >
                   <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
               </div>
           </div>


       </div> 
        <div  class="col-md-6">
            <div class="form-group"> 
                <div class="rowlabel">Paid by</div>        
                <select class="form-control" name="paid_by_person_id" id="paid_by_person_id">
                    <option value="">Select Paid by</option>
                    <?php 
                    foreach($management as $row)
                    { ?>
                    <option value="<?php echo $row['id'];?>" <?php echo set_select('paid_by_person_id',  $row['id']); ?>  > <?php echo $row['fullname'];?> </option> 
                    <?php            
                    }
                    ?>
                </select>
            
            </div>
        </div>
        <div class="col-md-6" >
        <div class="form-group"> 
        <div class="rowlabel">Remarks</div>
        <input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off"  <?php echo form_input('remarks', set_value('remarks')); ?></input>
        </div>
        </div>
        
        <div class="col-md-12" >            
            <div  style="text-align: center;width:100%">
                <button type="submit" class="btn btn-info" name="submit" value="ADD" >Add Expense</button>       
            </div>
        </div>

        </div>
    </div>
    <div class="col-md-3"></div>
</form>
        
        
        

        </div>



<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#display_image').attr('src', e.target.result);//where to display
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#memo_image").change(function(){ //event
        readURL(this);
    });

    $(document).ready(function(){
               
                 $("#payment_date").datepicker({ dateFormat: 'dd-mm-yy' }).datepicker("setDate", "+0");
                 });
</script>

<script>
$(document).ready(function() {
    $('#paid_by_person_id').change(function() {
        var personId = $(this).val();
        var totalAmount = $('#total_amount').val();
        var baseURL= window.location.href; 
        //alert( '<?php echo site_url()."/FundTransfer/check_balance"; ?>');
      //  exit;
        if (personId !== '' && totalAmount !== '') {       
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()."/FundTransfer/check_balance"; ?>', // Update with your controller's URL
                data: { personId: personId },
                success: function(response) {
                   // alert(response);
                    var currentBalance = parseFloat(response);
                    if (currentBalance >= parseFloat(totalAmount)) {
                        // Allow the selection
                        // You can add additional logic here if needed
                    } else {
                        alert('Insufficient balance');
                        // You may also prevent selection or take other actions
                    }
                }
            });
        }
    });
});
</script>




