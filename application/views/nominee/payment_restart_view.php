<?php $id=base64_encode($nominee_id);?>
<div id="dataContainer" class="row frmContainer">
<div class="col-md-6" style="padding:10px;">

<p class="btn-info" onclick="toggle_nomin_info()"  style="padding:10px; text-align: center;">Nominee Information</p>  
<table  id="nominee_info_container" class="table-striped table-bordered">
    <tr>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";?></td>
    </tr>
    <tr style="display: none;">
        <td><strong>ID</strong></td>
        <td><?php echo $nominee_item['id']; ?></td> 
        <td><strong>Employee ID</strong></td>
        <td><?php echo $nominee_item['employee_id']; ?></td>
    </tr>
    
    <tr style="display: none;">
        
        <td><strong>Relation</strong></td>
        <td><?php echo $nominee_item['relation']; ?></td>
   
    </tr>
    
    <tr>
        <td><strong>Full Name</strong></td>
        <td colspan="4"><?php echo $nominee_item['full_name']; ?></td>
    </tr>
    <tr>    
        <td><strong>Gender</strong></td>
        <td><?php echo $nominee_item['gender']; ?></td>
        <td><strong>Marital status</strong></td>
        <td><?php echo $nominee_item['marital_status']; ?></td>  
    </tr>

    <tr>    

        <td><strong>Physical status</strong></td>
        <td><?php echo $nominee_item['physical_status']; ?></td>  
        <td><strong>Pension percentage</strong></td>
        <td><?php echo $nominee_item['pension_percentage']; ?></td>
    </tr>
    
    <tr>     
        <td><strong>E-mail</strong></td>
        <td><?php echo $nominee_item['email']; ?></td>
        <td><strong>NID no</strong></td>
        <td><?php echo $nominee_item['nid_no']; ?></td>
            </tr>

    <tr> 
        <td><strong>Cell phone</strong></td>
        <td colspan="4"><?php echo $nominee_item['cell_phone']; ?></td>  
    </tr>

    <tr>    
        <td><strong>Present Address</strong></td>
          <td><?php echo $nominee_item['present_address']; ?></td>   
        <td><strong>Permanent Address</strong></td>        
        <td><?php echo $nominee_item['permanent_address']; ?></td>
    </tr>

    <tr>    
        <td><strong>Pension provider</strong></td> 
            <?php foreach ($branches as $branch):
                if($branch['id']=== $nominee_item['pension_provider_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
            <?php endforeach;?>
    </tr>
    <tr>    
        <td><strong>Birth date</strong></td>                        
        <td><?php echo $nominee_item['dob_time']; ?></td>
        <td><strong>Date of deceased</strong></td>
        <td><?php echo $nominee_item['dod_time']; ?></td>
            
    </tr>

    <tr style="display: none;">    
       
        <td><strong>Proof of alive validity</strong></td>
        <td colspan="4"><?php echo $nominee_item['proof_of_alive_validity']; ?></td>
    </tr>
    <tr style="display: none;">
        <td><strong>Proof of alive</strong></td>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/proof_of_alive/".$nominee_item['proof_of_alive']."'>";?></td>
    </tr>
    <tr style="display: none;"> 
        <td><strong>Non Marriage Certificate validity</strong></td>
        <td colspan="4"><?php echo $nominee_item['non_marriage_cert_validity']; ?></td>
    </tr>
    <tr style="display: none;">
        <td><strong>Non Marriage Certificate</strong></td>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/non_marriage_certificate/".$nominee_item['non_marriage_cert']."'>";?></td>
    </tr>    
    <tr>    

    </tr>

    <tr>    
        <td><strong>Remarks</strong></td>
        <td colspan="4"><?php echo $nominee_item['remarks']; ?></td>
    </tr>
</table>
</div>
    
<div class="col-md-6 ">                   

                        
<button class="btn-info" > Update Payment Status </button>
<?php echo form_open_multipart('nominee/restart_payment_status/'.$id); ?>
    <div style="background: #ccffcc;padding:5px; ">

      
        <div  >
            <div class="rowlabel">Reason<span class="errMsg"><?php echo form_error('reason'); ?></span></div>
        <div><input type="text" placeholder="Enter Reason of stop payment" name="reason" autocomplete="off"  <?php echo form_input('reason', set_value('reason')); ?></div>
        </div>
        </div>
        <button type="submit" id="btnUpdateStopPaymentsubmit" name="submit" value="ADD" >Restart Payment</button> 
        </div>
</div>    
    
    
</div>