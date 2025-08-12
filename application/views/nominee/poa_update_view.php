<?php $nominee_id=base64_encode($nominee_id);?>
<div id="dataContainer" class="row frmContainer">
<div class="col-md-6" style="padding:10px;">

<p class="btn-info" onclick="toggle_nomin_info()"  style="padding:10px; text-align: center;">Nominee Information</p>  
<table  id="nominee_info_container" class="table-striped table-bordered">
    <tr>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";?></td>
    </tr>
    <tr>
        <td><strong>ID</strong></td>
        <td><?php echo $nominee_item['id']; ?></td> 
        <td><strong>Employee ID</strong></td>
        <td><?php echo $nominee_item['employee_id']; ?></td>
            </tr>
    
    <tr>
        
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

    <tr>    
       
        <td><strong>Proof of alive validity</strong></td>
        <td colspan="4"><?php echo $nominee_item['proof_of_alive_validity']; ?></td>
    </tr>
    <tr>
        <td><strong>Proof of alive</strong></td>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/proof_of_alive/".$nominee_item['proof_of_alive']."'>";?></td>
    </tr>
    <tr>    

    </tr>

    <tr>    
        <td><strong>Remarks</strong></td>
        <td colspan="4"><?php echo $nominee_item['remarks']; ?></td>
    </tr>
</table>
</div>
<div class="col-md-6"  style="padding:10px;display:none;">
        <p class="btn-info" onclick="toggle_nomin_pension_info()"  style="padding:10px;text-align:center;">Pension basic information

            </p>
        
    <table id="nominee_pension_info_container" class="table-striped table-bordered">

    <tr>    
        <td><strong>Pension Basic</strong></td>
        <td><?php echo number_format($pension_item['pension_basic']); ?></td>   
        <td><strong>Last increment date</strong></td>
        <td><?php echo $pension_item['last_increment_date']; ?></td> 
    </tr>
    <tr> 
        <td><strong>Next increment date</strong></td>
        <td><?php echo $pension_item['next_increment_date']; ?></td>   
        <td><strong>Fixation date</strong></td>
        <td><?php echo $pension_item['fixation_date']; ?></td>
    </tr>
  

    <tr>
        <td><strong>Payment method</strong></td>
        <td><?php echo $pension_item['payment_method']; ?></td>     
        <td><strong>Payment to account no</strong></td>
          <td><?php echo $pension_item['payment_to_account_no']; ?></td>
    </tr>
    <tr>    
        <td><strong>Payment to Bank</strong></td>
                <?php foreach ($fis as $bank):
                if($bank['id']=== $pension_item['payment_to_bank_id']){?>
        <td><?php echo $bank['name'];?></td><?php }?>
                <?php endforeach;?>   
        <td><strong>Payment to Branch</strong></td> 
            <?php foreach ($branches as $branch):
                if($branch['id']=== $pension_item['payment_to_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
            <?php endforeach;?>
    </tr>
    <tr>     
        <td><strong>Remarks</strong></td>
        <td colspan="4"><?php echo $pension_item['remarks']; ?></td>
    </tr>

</table>        
</div>
<div class="col-md-6"> 
<button class="btn-info" id="poa_histor_show" onclick="nomin_plusClick()"> Proof of alive History </button>
<div id="poa_history_container">      
    <table class="table table-striped table-bordered  compact hover" id="employee_poa_history" style="width: 100%" cellspacing="0">
        <thead>
            <tr>
                <th>Sl</th>      
                <th>Updated By</th>
                <th>Updated on</th>
                <th>Validity date</th>
                <th>Download</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sl</th>          
                <th>Updated By</th>
                <th>Updated on</th>
                <th>Validity date</th>
                <th>Download</th>
            </tr>
        </tfoot>

        
<?php foreach ($nominee_poa_item as $emp_poa_item): ?>
        <tr>
            <td></td>
          <?php //echo $emp_poa_item['poa_file']; ?>           
            <td><?php echo $emp_poa_item['ins_upd_user']; ?></td>
            <td><?php echo $emp_poa_item['ins_upd_time']; ?></td>
            <td><?php echo $emp_poa_item['poa_validity_date']; ?></td>
            <td><a href="<?php echo base_url()."upload/proof_of_alive/".$emp_poa_item['poa_file']; ?>">Download</a></td>
        </tr>
<?php endforeach; ?>
</table>
</div>
   
</div>    
<div class="col-md-6" >   
 <button class="btn-info" id="poa_histor_show" onclick="poa_nominee_update_toggle()"> Update Proof of alive</button>
 <div id="poa_nominee_update_container">
     <?php echo form_open_multipart('nominee/update_poa/'.$nominee_id); ?>
        <div>
        <div class="rowlabel">Proof of alive</div>
        <div>
                <input type="file" name="poa_file" id="poa_file" />        
                <div id="uploaded_proof_of_alive"></div>  
        </div>
        </div>
        
        <div  >
            <div class="rowlabel">Proof of alive validity <span class="errMsg"><?php echo form_error('proof_of_alive_validity'); ?></span></div>
        <div>
            <input type="text" id="proof_of_alive_validity" name="proof_of_alive_validity" required <?php echo form_input('proof_of_alive_validity', set_value('proof_of_alive_validity')); ?></p>
        </div>
        </div>
        <div  >
            <div class="rowlabel">Remarks<span class="errMsg"><?php echo form_error('remarks'); ?></span></div>
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off"  <?php echo form_input('remarks', set_value('remarks')); ?></div>
        </div>
        </div>
        <button type="submit" id="btnregistersubmit" name="submit" value="ADD" >Update</button>
</div>
</div>    
</div>

 


