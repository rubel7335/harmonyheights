<div  id="dataContainer" class="row"  style="font-family: monospace; ">
    <div id="errordisplayArea">
            <?php echo validation_errors(); ?> 
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6"> 
    <div class="col-md-12" style="padding:20px;">
                        <div class="frmContainer" >  
                            <div  style="text-align: center;">
                                <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
                                <p class="text-info text-center text-uppercase"> Fund transfer update </p>
                            </div>     
                        </div>
                </div>
      <form method="post" action="<?= site_url('FundTransfer/update/'.$record->id) ?>">
            <?php 
                  $payment_type=$record->payment_type;
                  $remarks=$record->remarks;
                  $payment_date=$record->payment_date;
                  $amount=$record->amount; $purpose=$record->purpose;$remarks=$record->remarks;
                  $reciever_id=$record->reciever_id;
            ?>
         <!-- <input type="text" name="amount" value="<?= $record->amount ?>" required> -->
         <div class="col-md-6"> 
                  <div class="form-group">
                     <div class="rowlabel"> Amount</div>
                     <input type="text" id="amount" name="amount"  value="<?php echo $amount; ?>" required></input>
                  </div>
            </div>

         <div class="col-md-6"> 
                  <div class="form-group">
                     <div class="rowlabel"> Deposit date</div>
                     <input type="text" id="payment_date" name="payment_date"  value="<?php echo $payment_date; ?>" required></input>
                  </div>
            </div>

            <div class="col-md-12"> 
                  <div class="form-group">
                     <div class="rowlabel"> Purpose</div>
                     <input type="text" id="purpose" name="purpose"  value="<?php echo $purpose; ?>" required></input>
                  </div>
            </div>


         <!-- <input type="text" name="payment_date" value="<?= $record->payment_date ?>" required> -->
         <!-- <input type="text" name="purpose" value="<?= $record->purpose ?>" required> -->
         <!-- <input type="text" name="reciever_id" value="<?= $record->reciever_id ?>" required> -->
         <div class="col-md-6">       
                  <div class="rowlabel"> Reciever name</div> 
                  <select class="form-control" name="reciever_id" id="reciever_id" >                
                        <?php 
                           foreach($management as $row)
                           { ?>
                              <option value="<?php echo $row['id'];?>" <?php if($reciever_id===$row['id']){ echo 'selected="selected"'; } ?> ><?php echo $row['fullname'];?></option> 
                           <?php            
                           }
                           ?> 
                  </select>
         </div>   


         <div class="col-md-6">       
                  <div class="rowlabel"> Payment type</div> 
                  <select class="form-control" name="payment_type" id="payment_type" >                
                     <option  <?php if($payment_type=="Credit") echo 'selected="selected"'; ?> value="Credit" >Credit</option>
                     <option  <?php if($payment_type=="Debit") echo 'selected="selected"'; ?> value="Debit" >Debit</option>
                  </select>
            </div>

         <!-- <input type="text" name="payment_type" value="<?= $record->payment_type ?>" required> -->
         <div class="col-md-12"> 
                  <div class="form-group">
                     <div class="rowlabel"> Remarks</div>
                     <input type="text" id="remarks" name="remarks"  value="<?php echo $remarks; ?>" required></input>
                  </div>
         </div>
         <!-- <input type="text" name="remarks" value="<?= $record->remarks ?>" required> -->
         <div  style="text-align:center"> 
            <button class="btn btn-info" type="submit">Update</button> 
         </div>   
      </form>
      </div> 
      <div class="col-md-3"></div>
</div>
