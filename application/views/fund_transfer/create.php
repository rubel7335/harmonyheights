<div  id="dataContainer" class="row"  style="font-family: monospace; ">
    <div id="errordisplayArea">
            <?php echo validation_errors(); ?> 
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
            <form method="post" action="<?= site_url('FundTransfer/create') ?>">
                <div class="col-md-12" style="padding:20px;">
                        <div class="frmContainer" >  
                            <div  style="text-align: center;">
                                <img class="imgcontainer" src="<?php echo base_url('assets/appimages/registration.png');?>" />
                                <p class="text-info text-center text-uppercase"> Fund transfer entry form </p>
                            </div>     
                        </div>
                </div>
                <div  class="col-md-6">          
                        <div class="form-group">       
                            <div class="rowlabel">Amount</div>
                            <input type="text"   placeholder="Enter amount in taka" name="amount" autocomplete="off"   <?php echo form_input('amount', set_value('amount')); ?></input>
                        </div>
                </div>
                <div  class="col-md-6">
                        <div class="form-group" >
                            <div class="rowlabel">Date of payment</div>        
                                <input type="text" id="payment_date" name="payment_date" required <?php echo form_input('payment_date', set_value('payment_date')); ?> </input>
                        </div>
                </div>   
                <div  class="col-md-12">          
                        <div class="form-group">       
                            <div class="rowlabel">Purpose</div>
                            <input type="text"   placeholder="Enter short description" name="purpose" autocomplete="off"   <?php echo form_input('purpose', set_value('purposes')); ?></input>
                        </div>
                </div>
                <div  class="col-md-6">
                        <div class="form-group"> 
                            <div class="rowlabel">Reciever name</div>        
                            <select class="form-control" name="reciever_id">
                                <?php 
                                foreach($management as $row)
                                { ?>
                                <option value="<?php echo $row['id'];?>" <?php echo set_select('reciever_id',  $row['id']); ?>> <?php echo $row['fullname'];?> </option> 
                                <?php            
                                }
                                ?>
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
                <div  class="col-md-12">          
                        <div class="form-group">       
                            <div class="rowlabel">Remarks</div>
                            <input type="text"   placeholder="Enter short remarks" name="remarks" autocomplete="off"   <?php echo form_input('remarks', set_value('remarks')); ?></input>
                        </div>
                </div>

                <div class="col-md-12" >            
                    <div  style="text-align: center;width:100%">
                        <button type="submit" class="btn btn-info" name="submit" value="Create" >Create</button>       
                    </div>
                </div>
              
            </form>
    </div>    
    <div class="col-md-3"></div>    

</div>