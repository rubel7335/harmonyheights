<?php $emp_id=base64_encode($emp_id);?>
<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<div id="dataContainer" class="row frmContainer" style="font-family: monospace;padding: 15px;">
 
<div class="col-md-6"  >
    <table class="table-striped table-bordered">
    <tr >
        <td colspan="4"><div onclick="toggle_emp_info()" style="text-align:center; background: #ecf2f6;font-weight: bold;padding: 15px;">Employee Information</div>  </td>
    </tr>
    </table>
<table id="employee_info_container" class="table-striped table-bordered">

    <tr>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/".$employee_item['image_url']."'>";?></td>
    </tr>
    <tr><td colspan="4" style="text-align:center; font-weight: bold;"><?php echo $title; ?></td></tr>
    <tr>    
        <?php foreach ($designations as $designation):
                if($designation['id']=== $employee_item['designation_id']){?>
        <td colspan="4" style="text-align:center;"><?php echo "( ".$designation['title']." )";?></td><?php }?>
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
        <td colspan="4"><?php echo $employee_item['cell_phone']; ?></td>
        
    </tr>
    <tr> 
        <td><strong>NID no</strong></td>
        <td><?php echo $employee_item['nid_no']; ?></td>
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
        <td><?php
       // echo $dob_time = date('d-m-Y', strtotime($employee_item['dob_time']));
        //echo $employee_item['dob_time']; 
        if($employee_item['dob_time']!=NULL){ echo $dob_time = date('d-m-Y', strtotime($employee_item['dob_time']));}else{echo "";}
        ?>
        </td>    
        <td><strong>Retirement date</strong></td>
        <td><?php 
       // echo $dor_time = date('d-m-Y', strtotime($employee_item['dor_time']));
        if($employee_item['dor_time']!=NULL){ echo $dor_time = date('d-m-Y', strtotime($employee_item['dor_time']));}else{echo "";}
      //  echo $employee_item['dor_time']; 
        ?>
        </td>
            
    </tr>
    <tr>    
        <td><strong>Date of deceased</strong></td>
        <td><?php 
        
       if($employee_item['dod_time']!=NULL){ echo $dod_time = date('d-m-Y', strtotime($employee_item['dod_time']));}else{echo "";}
       // echo $employee_item['dod_time']; 
        ?>
        </td>
        <td><strong>Proof of alive validity</strong></td>
        <td><?php 
       // echo $proof_of_alive_validity = date('d-m-Y', strtotime($employee_item['proof_of_alive_validity']));
        if($employee_item['proof_of_alive_validity']!=NULL){ echo $proof_of_alive_validity = date('d-m-Y', strtotime($employee_item['proof_of_alive_validity']));}else{echo "";}
        //echo $employee_item['proof_of_alive_validity']; 
        ?>
        </td>
        
            
    </tr>
    <tr>    
            
    </tr>
    <tr>    
        <td><strong>Proof of alive</strong></td>
        
        <?php if($employee_item['proof_of_alive'] !== NULL){?>
        <td  style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/proof_of_alive/".$employee_item['proof_of_alive']."'>";?></td>
        <?php }?>
    </tr>
    <tr>    
        <td><strong>Last basic</strong></td>
        <td><?php echo round($employee_item['last_basic_during_retirement'],2); ?></td>  
        <td><strong>Pension amount</strong></td>
        <td><?php echo round($employee_item['pension_amount_during_retirement'],2); ?></td>
    </tr>

    <tr>    
        <td><strong>Remarks</strong></td>
        <td colspan="4"><?php echo $employee_item['remarks']; ?></td>
    </tr>
</table>
</div>
<div class="col-md-6" >

        <table class="table-striped table-bordered">
    <tr >
        <td colspan="4"><div onclick="toggle_emp_nominee_info()" style="text-align:center; background: #ecf2f6;font-weight: bold;padding: 15px;">List of nominees</div>  </td>
    </tr>
    </table>
<div id="emp_nominee_info_container">
                <span>
                    <a href="<?php echo site_url('nominee/create/'.$emp_id); ?>" >
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span><strong>Add</strong></span>            
                    </a>
                </span>
<?php if($nominees){?>
<table class="table table-striped table-bordered  compact hover" id="nominee_list" style="width: 100%" cellspacing="0">
        <thead>

    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Relation </strong></td>
        <td><strong>Pension %</strong></td> 
        <td><strong>Pension provider</strong></td>     
        <td><strong>Action</strong></td>
    </tr> 

        </thead>


<?php foreach ($nominees as $nominee_item): ?>
        <tr>
            <td><?php echo $nominee_item['id']; ?></td>
            <td><?php echo "<img width='70px' height='60px'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";
            echo "</br>".$nominee_item['full_name']; ?>
            </td>
            <td><?php echo $nominee_item['relation']; ?></td> 
            <td><?php echo $nominee_item['pension_percentage']; ?></td> 
                <?php foreach ($branches as $branch):
                if($branch['id']=== $nominee_item['pension_provider_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
                <?php endforeach;?> 
            <?php $id= base64_encode($nominee_item['id']);?>
            <td>
                                
                    <a href="<?php echo site_url('nominee/view/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>
                    <a href="<?php echo site_url('nominee/edit/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>
                    <a href="<?php echo site_url('nominee/update_poa/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Update POA</span>            
                    </a>
                
                <?php if(!($nominee_item['stop_payment'])){?> 
                <a href="<?php echo site_url('nominee/stop_payment_status/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Stop Payment</span>            
                </a>
                <?php }?>
                <br>
                <?php if($nominee_item['stop_payment']){?>  
                <a href="<?php echo site_url('nominee/restart_payment_status/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Restart Payment</span>            
                </a>
                <?php }?>
             
            </td>
        </tr>
<?php endforeach; ?>
</table>
     <?php }else{?>
     <?php
     echo "Nominee information is not added";
     }?>
    </div>
</div>    
<div class="col-md-6" >            
    <table class="table-striped table-bordered">
    <tr >
        <td colspan="4"><div onclick="toggle_emp_pension_info()" style="text-align:center; background: #ecf2f6;font-weight: bold;padding: 15px;">Pension basic information</div>  </td>
    </tr>
    </table>
<div id="emp_pension_info_container">            
<table>
                    <tr>
                    <td>
                    <?php if(!($pension_item)){?>    
                        <a href="<?php echo site_url('pension/create/'.$emp_id); ?>" >
                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                            <span><strong>Add</strong></span>            
                        </a>
                    <?php }?>

                    <a href="<?php echo site_url('pension/edit/'.$emp_id); ?>" >
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>
                    </td>
                    </tr>
</table> 
<?php if($pension_item!=NULL){?>    
<table  class="table-striped table-bordered">

    <tr>    
        <td><strong>Pension Basic</strong></td>
        <td><?php echo round($pension_item['pension_basic'],2); ?></td>   
        <td><strong>Last increment date</strong></td>
        <td><?php 
        echo $last_increment_date = date('d-m-Y', strtotime($pension_item['last_increment_date']));
       // echo $pension_item['last_increment_date'];
        ?>
        </td> 
    </tr>
    <tr> 
        <td><strong>Next increment date</strong></td>
        <td><?php 
       // echo $pension_item['next_increment_date']; 
        echo $next_increment_date = date('d-m-Y', strtotime($pension_item['next_increment_date']));
        ?>
        </td>   
        <td><strong>Fixation date</strong></td>
        <td><?php 
       // echo $pension_item['fixation_date']; 
        echo $fixation_date = date('d-m-Y', strtotime($pension_item['fixation_date']));
        ?>
        </td>
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
        <td><strong>Pensioner category</strong></td>
          <?php echo $pension_item['pensioner_catid'];
          foreach ($pensioner_cat as $pensionercat):
                if($pensionercat['id']=== $pension_item['pensioner_catid']){?>
            <td><?php echo $pensionercat['title'];?></td><?php }?>
            <?php endforeach;?>
    </tr>
    <tr>     
        <td><strong>Remarks</strong></td>
        <td colspan="4"><?php echo $pension_item['remarks']; ?></td>
    </tr>

</table>
    <?php }?> 
  <?php if(!($pension_item)){?>    
        <table>
            <tr>     
                <td><strong><?php echo "Employee's pension basic information not added";?></strong></td>
            </tr>
        </table>    
  <?php }?>    
</div>
</div>        
<div class="col-md-6" > 
<table class="table-striped table-bordered">
<tr >
    <td colspan="4"><div onclick="plusClick()" style="text-align:center; background: #ecf2f6;font-weight: bold;padding: 15px;">Proof of alive History </div>  </td>
</tr>
</table>
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

        
<?php foreach ($employee_poa_item as $emp_poa_item): ?>
        <tr>
            <td></td>
            <?php //echo $emp_poa_item['poa_file']; ?>          
            <td><?php echo $emp_poa_item['ins_upd_user']; ?></td>
            <td><?php 
           // echo $emp_poa_item['ins_upd_time']; 
            echo $ins_upd_time = date('d-m-Y', strtotime($emp_poa_item['ins_upd_time']));
            ?>
            </td>
            <td><?php 
           // echo $emp_poa_item['poa_validity_date']; 
            echo $poa_validity_date = date('d-m-Y', strtotime($emp_poa_item['poa_validity_date']));
            ?>
            </td>
            <td><a href="<?php echo base_url()."upload/proof_of_alive/".$emp_poa_item['poa_file']; ?>">Download</a></td>
        </tr>
<?php endforeach; ?>
</table>
</div>
   
</div>
    
<div class="col-md-6" style="padding:10px; display:none;">   
 <button class="btn-info" id="poa_histor_show" onclick="poa_plusClick()"> Update Proof of alive</button>
 <div id="poa_update_container">
    <?php echo form_open_multipart('employee/update_poa/'.$emp_id); ?>
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
        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off" required <?php echo form_input('remarks', set_value('remarks')); ?></div>
        </div>
        </div>
        <button type="submit" id="btnregistersubmit" name="submit" value="ADD" >Update</button> 
        </div>

</div>
</div>    
</div>

 
<script>
    $(document).ready(function(){
                 $("#dob_time").datepicker({ dateFormat: 'dd-mm-yy' });
                 $("#dor_time").datepicker({ dateFormat: 'dd-mm-yy' });
                 $("#dod_time").datepicker({ dateFormat: 'dd-mm-yy' });
                 $("#proof_of_alive_validity").datepicker({ dateFormat: 'dd-mm-yy' });
                 });
</script>

