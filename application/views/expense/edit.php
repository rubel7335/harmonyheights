<div id="dataContainer" class="row"  style="font-family: monospace;">

    <?php echo validation_errors(); ?> 
    <?php  $id= base64_encode($expenses_item['id']);?>

    <div class="col-md-3"></div>
    <div class="col-md-6" id="bodyholder" style="padding:20px; background:  #F2F3FF;text-align: center;">
        <?php echo form_open_multipart('expense/edit/'.$id); ?>

            <?php 
                    $expense_subarea_id=$expenses_item['expense_subarea_id'];
                    $description=$expenses_item['description'];
                // $deposit_date=$payment_item['deposit_date'];
                    $payment_date = date('d-M-Y', strtotime($expenses_item['payment_date']));
                    $total_amount=$expenses_item['total_amount'];
                    $memo_image=$expenses_item['memo_image'];
                    $memo_no=$expenses_item['memo_no'];
                    $paid_by_person_id  =$expenses_item['paid_by_person_id'];
                    $status=$expenses_item['status'];
                    $remarks=$expenses_item['remarks'];
                ?> 

            <div class="row" >  
                    <div  style="text-align: center;">
                    <img class="imgcontainer " src="<?php echo base_url('assets/appimages/registration.png');?>" />
                    <p class="text-info text-center text-uppercase"> Edit expense </p>
                </div>     
            </div>

            <div class="col-md-6">       
                <div class="rowlabel"> Category</div>
                <select class="form-control" name="expense_subarea_id" id="expense_subarea_id" >                
                <?php 
                    foreach($expenses_types as $row)
                    { ?>
                    <option value="<?php echo $row['id'];?>" <?php if($expense_subarea_id===$row['id']){ echo 'selected="selected"'; } ?> ><?php echo $row['title'];?></option> 
                    <?php            
                    }
                    ?> 
                </select>
            </div>    
            <div class="col-md-6">  
                <div class="form-group">
                    <div class="rowlabel"> Description</div>
                    <input type="text" placeholder="Enter description" name="description" autocomplete="off"  value="<?php echo $description; ?>" required></input>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <div class="rowlabel"> Date of payment</div>
                    <input type="text" id="payment_date" name="payment_date"  value="<?php echo $payment_date; ?>" required></input>
                </div>
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <div class="rowlabel"> Total amount</div>
                    <input type="text" placeholder="Enter total amount" name="total_amount" autocomplete="off"  value="<?php echo $total_amount; ?>" required></input>
                </div>
            </div>
            <div class="col-md-6">  
                <div class="form-group">
                    <div class="rowlabel"> Memo no</div>
                    <input type="text" placeholder="Enter memo no" name="memo_no" autocomplete="off"  value="<?php echo $memo_no; ?>" required></input>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group"> 
                <div class="rowlabel">Memo</div>
                    <input type="file" name="memo_image" id="memo_image" value="<?php echo $memo_image;?>" />
                    <img id='image_display' idth='200px' height='200px' src='<?php echo base_url()."upload/expense/".$memo_image;?>' />
            
                </div> 
                
                    <p> Allowed type:JPEG,JPG,GIF,PNG Maximum file size can be:100KB</p>
            </div>
            <div class="col-md-6">       
                <div class="rowlabel"> Paid by</div>
                <select class="form-control" name="paid_by_person_id" id="paid_by_person_id" >                
                <?php 
                    foreach($management as $row)
                    { ?>
                    <option value="<?php echo $row['id'];?>" <?php if($paid_by_person_id===$row['id']){ echo 'selected="selected"'; } ?> ><?php echo $row['fullname'];?></option> 
                    <?php            
                    }
                    ?> 
                </select>
            </div>  
            <div  class="col-md-12">
                    <div class="form-group"> 
                        <div class="rowlabel"> Remarks</div>
                        <input type="text" placeholder="Enter remarks" name="remarks" autocomplete="off"  value="<?php echo $remarks; ?>" ></input>
                    </div>
            </div>     
           
            <div class="col-md-12" >            
            <div  style="text-align: center;width:100%">
                <button type="submit" class="btn btn-info" name="submit"  >Update Expense</button>       
            </div>
        </div> 
        </form>
    </div>     

    <div class="col-md-3"></div> 
</div>



