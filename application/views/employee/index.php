

<div id="bodyholder" class="row" style="min-height:500px;">
<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<?php if($employees){?>
<div  class="col-md-12">
    <h2><?php echo $title; ?></h2>
    <form action="php_checkbox.php" method="post">
    <table class="table table-striped table-bordered  compact hover tbl" id="employee_list"  cellspacing="0">
        <thead>
            <tr>
                <th>Sl</th>
                <th>SAP ID</th>
                <th>Index</th>
                <th>PPO No</th>
                <th>File No</th>                
                <th>Full Name</th>
                <th>Cell phone</th>
                <th>Designation</th> 
                <th>POA validity</th>  
                <th>Pension amount</th>
                <th>Nominees</th>
                <th>Pension Info</th>
                
                <th>Action<br><input type="checkbox" class="checkbox" onclick="toggle(this);" style="display: none;" /> </th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>Sl</th>
                <th>SAP ID</th>
                <th>Index</th>
                <th>PPO No</th>
                <th>File No</th>                
                <th>Full Name</th>
                <th>Cell phone</th>
                <th>Designation</th>
                <th>POA validity</th>
                <th>Pension amount</th>
                <th>Nominees</th>
                <th>Pension Info</th>               
                <th>Action<br><input type="checkbox" class="checkbox"  onclick="toggle(this);"  style="display: none;"/> </th>
            </tr>
        </tfoot>

        
<?php foreach ($employees as $employee_item): ?>
        <tr>
            
            <td></td>            
            <td>
            <?php 
            echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/".$employee_item['image_url']."'> ";
            echo "</br>".$employee_item['sap_id'];
            ?>
            </td>
            <td><?php echo $employee_item['index_no']; ?></td>
            <td><?php echo $employee_item['ppo_no']; ?></td>
            <td><?php echo $employee_item['file_no']; ?></td> 
            <td><?php echo $employee_item['full_name']; ?></td>
            <td><?php echo $employee_item['cell_phone']; ?></td>
                <?php foreach ($designations as $designation):
                if($designation['id']=== $employee_item['designation_id']){?>
            <td><?php echo $designation['title'];?></td><?php }?>
                <?php endforeach;?>  
            <td>
            <?php 
               // echo $proof_of_alive_validity = date('d-m-Y', strtotime($employee_item['proof_of_alive_validity']));
                if($employee_item['proof_of_alive_validity']!=NULL){ echo $proof_of_alive_validity = date('d-m-Y', strtotime($employee_item['proof_of_alive_validity']));}else{echo "";}
            ?>
            </td>
            <td><?php echo round($employee_item['pension_amount_during_retirement'],2); ?></td>
            
            <?php 
            $emp_id= base64_encode($employee_item['id']);
            
            
            ?>
            <td>  
                    <a href="<?php echo site_url('nominee/create/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span>Add</span>            
                    </a>
                
                    <a href="<?php echo site_url('nominee/get_nominee_id/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>

            </td>
            <td>
                    <a href="<?php echo site_url('pension/create/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span>Add</span>            
                    </a>
                    <a href="<?php echo site_url('pension/get_pension_basic_by_id/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>
                    <a href="<?php echo site_url('pension/edit/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>

            </td>
           <!-- <td><?php  if($employee_item['status']){echo "Accepted by Checker";};if(!($employee_item['status'])){echo "Initiated by Maker";}; ?></td>  --> 
            <td>      
                
                <p><input type="checkbox" class="chkEmpID" value="<?php echo $emp_id;?>" style="display: none;"></p>
                    <a href="<?php echo site_url('employee/view/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>
                    <a href="<?php echo site_url('employee/edit/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>
                    <a href="<?php echo site_url('employee/update_poa/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Update POA</span>            
                    </a>
                
                <?php if(!($employee_item['stop_payment'])){?> 
                <a href="<?php echo site_url('employee/stop_payment_status/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Stop Payment</span>            
                </a>
                <?php }?>
                <br>
                <?php if($employee_item['stop_payment']){?>  
                <a href="<?php echo site_url('employee/restart_payment_status/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Restart Payment</span>            
                </a>
                <?php }?>
                


                <!--
                <?php if($usercat==1){?>| 
                <a href="<?php echo site_url('employee/delete/'.$emp_id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                <?php }?>
                -->
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div>
    

<p class="frmContainer" style="margin:5px;float:right; display: none;">        
        <span ><input type="button" class="btn btn-info" id="accept_btn"  value="Accept"></span>            
        <span ><input type="button" class="btn btn-danger" id="reject_btn"  value="Reject"></span> 
</p>
</div>
  <?php }else{?>
     <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
  <?php   }?>
</div>
 

