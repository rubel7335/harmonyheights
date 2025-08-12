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
        <td><?php  echo $dob_time = date('d-m-Y', strtotime($employee_item['dob_time'])); ?></td>
        <td><strong>Retirement date</strong></td>
        <td><?php echo $dor_time = date('d-m-Y', strtotime($employee_item['dor_time']));?></td>  
            
    </tr>
    <tr>    

    </tr>

    <tr>    
        
        <td><strong>Date of deceased</strong></td>
        <td><?php echo $dod_time = date('d-m-Y', strtotime($employee_item['dod_time'])); ?></td>
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

                        
    <button class="btn-info" id="poa_histor_show" onclick="plusClick()"> Proof of alive History </button>
                            
<div id="poa_history_container">      
    <table class="table table-striped table-bordered  compact hover" id="employee_poa_history" style="width: 100%" cellspacing="0">
        <thead>
            <tr>
                <th>Sl</th>
                <th>File</th>                
                <th>Updated By</th>
                <th>Updated on</th>
                <th>Validity date</th>
                <th>Download</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sl</th>
                <th>File</th>                
                <th>Updated By</th>
                <th>Updated on</th>
                <th>Validity date</th>
                <th>Download</th>
            </tr>
        </tfoot>

        
<?php foreach ($employee_poa_item as $emp_poa_item): ?>
        <tr>
            <td></td>
            <td><?php echo $emp_poa_item['poa_file']; ?></td>            
            <td><?php echo $emp_poa_item['ins_upd_user']; ?></td>
            <td><?php echo $emp_poa_item['ins_upd_time']; ?></td>
            <td><?php //echo $emp_poa_item['poa_validity_date'];
            echo $poa_validity_date = date('d-m-Y', strtotime($employee_item['poa_validity_date']));?></td>
            <td><a href="<?php echo base_url()."upload/proof_of_alive/".$emp_poa_item['poa_file']; ?>">Download</a></td>
        </tr>
<?php endforeach; ?>
</table>
</div>

                        





       
    <table>
    <tr>    
        <td colspan="4" style="background: #ccffcc; "><strong>Proof of alive</strong></td> 
       
    </tr>
    <tr>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='100%' height='100%'  src='". base_url()."upload/proof_of_alive/".$employee_item['proof_of_alive']."'>";?></td>
        
    </tr>
    <tr>    
        <td><strong>Valid upto</strong></td>
        <td><?php //echo ": ".$employee_item['proof_of_alive_validity']; 
        echo ": ".$proof_of_alive_validity = date('d-m-Y', strtotime($employee_item['proof_of_alive_validity']));?></td>
    </tr>

</table>

<?php echo form_open_multipart('employee/update_poa/'.$id); ?>
    <div style="background: #ccffcc;padding:5px; ">
        <div  >
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


 
<script>
    $(document).ready(function(){
                 $("#proof_of_alive_validity").datepicker({ dateFormat: 'dd-mm-yy' });
                 });
</script>

