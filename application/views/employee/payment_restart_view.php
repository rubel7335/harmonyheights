<?php  $id= base64_encode($employee_item['id']);?>

<div class="row" id="bodyholder" style="padding:10px;font-family: monospace; " >

<div class="col-md-6">
    <table class="table-striped table-bordered" >
    <tr><td colspan="4" style="text-align:center;font-weight: bold"><?php echo $title; ?></td></tr>
    <tr>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/".$employee_item['image_url']."'>";?></td>
    </tr>

    <tr>    
        <?php foreach ($designations as $designation):
                if($designation['id']=== $employee_item['designation_id']){?>
        <td colspan="4" style="text-align:center;"><?php echo $designation['title'];?></td><?php }?>
                <?php endforeach;?>
    </tr>
    <tr>    
        <td><strong>SAP ID</strong></td>
        <td><?php echo $employee_item['sap_id']; ?></td>
        <td><strong>Index</strong></td>
        <td><?php echo $employee_item['index_no']; ?></td>
    </tr>

    <tr>    
        <td><strong>PPO No</strong></td>
        <td><?php echo $employee_item['ppo_no']; ?></td>
        <td><strong>File No</strong></td>
        <td><?php echo $employee_item['file_no']; ?></td> 
    </tr>

    <tr>    
        <td><strong>Gender</strong></td>
        <td><?php echo $employee_item['gender']; ?></td> 
        <td><strong>Marital status</strong></td>
        <td><?php echo $employee_item['marital_status']; ?></td>

    </tr>
    <tr>
        <td><strong>Cell phone</strong></td>
        <td><?php echo $employee_item['cell_phone']; ?></td>  
        <td><strong>E-mail</strong></td>
        <td><?php echo $employee_item['email']; ?></td>
    </tr>
    <tr>  
        
        <td><strong>Present Address</strong></td>
        <td><?php echo $employee_item['present_address']; ?></td>
        <td><strong>Permanent Address</strong></td>        
        <td><?php echo $employee_item['permanent_address']; ?></td>   

    </tr>
    <tr>
        <td><strong>Retired from</strong></td>
        <?php foreach ($branches as $branch):
        if($branch['id']=== $employee_item['retired_branch_id']){?>
        <td><?php echo $branch['branch_name'];?></td><?php }?>
        <?php endforeach;?>
        <td><strong>Pension provider</strong></td> 
            <?php foreach ($branches as $branch):
                if($branch['id']=== $employee_item['pension_provider_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
            <?php endforeach;?>
            
    </tr>
    <tr>
        
 
        <td><strong>Birth date</strong></td>                        
        <td><?php echo $employee_item['dob_time']; ?></td>
        <td><strong>Retirement date</strong></td>
        <td><?php echo $employee_item['dor_time']; ?></td>  
            
    </tr>
    <tr>    

    </tr>

    <tr>    
        
        <td><strong>Date of deceased</strong></td>
        <td><?php echo $employee_item['dod_time']; ?></td>
        <td><strong>Last basic</strong></td>
        <td><?php echo round($employee_item['last_basic_during_retirement'],2); ?></td>
    </tr>
    <tr>    
        <td><strong>Pension amount</strong></td>
        <td><?php echo round($employee_item['pension_amount_during_retirement'],2); ?></td>   
        <td><strong>Remarks</strong></td>
        <td><?php echo $employee_item['remarks']; ?></td>
    </tr>
</table>
</div>
<div class="row col-md-6 inner_container">                   

                        
<button class="btn-info" id="poa_histor_show" onclick="plusClick()"> Update Payment Status </button>
<?php echo form_open_multipart('employee/restart_payment_status/'.$id); ?>
    <div style="background: #ccffcc;padding:5px; ">

        <div  >
            <div class="rowlabel">Reason<span class="errMsg"><?php echo form_error('reason'); ?></span></div>
        <div><input type="text" placeholder="Enter Reason of restart payment" name="reason" autocomplete="off"  <?php echo form_input('reason', set_value('reason')); ?></div>
        </div>
        </div>
        <button type="submit" id="btnUpdateRestartPaymentsubmit" name="submit" value="ADD" >Restart Payment</button> 
        </div>
</div>
</div>


 



