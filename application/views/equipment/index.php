

<div id="bodyholder" class="row" style="min-height:500px;">
<?php if ($this->session->flashdata('confirmation')): ?>
                        <div class="confirm_msg"><?php echo $this->session->flashdata('confirmation'); ?></div>
                        <?php $this->session->unset_userdata('confirmation'); ?> <!-- Clear flash data after displaying -->
        <?php endif; ?>
<?php if($eq_expenses){?>
<div  class="col-md-12">
    <h2><?php echo $title; ?></h2>
    <form action="php_checkbox.php" method="post">
    <table class="table table-striped table-bordered  compact hover tbl" id="employee_list"  cellspacing="0">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Purchase date</th>
                <th>Total amount</th>   
                <th>Memo </th>
                <th>Paid / Unpaid</th>
                <th>Paid by</th>    
                <th>Purchase type</th>              
                <th>Status</th>
                <th>Action</th>
                <!-- <th>Action<br><input type="checkbox" class="checkbox" onclick="toggle(this);" /> Check all?<br /></th> -->
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th>Sl</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Purchase date</th>
                <th>Total amount</th>                
                <th>Memo </th>
                <th>Paid / Unpaid</th>
                <th>Paid by</th>  
                <th>Purchase type</th>                
                <th>Status</th>
                <th>Action</th>
                <!-- <th>Action<br><input type="checkbox" class="checkbox"  onclick="toggle(this);" /> Check all?<br /></th> -->
            </tr>
        </tfoot>

        
<?php foreach ($eq_expenses as $eq_expenses_item): ?>
        <tr>
            
            
            <td>
                <?php echo $eq_expenses_item['expense_subarea_id'];
                 foreach ($all_expense_area as $exp_area):
                    if($exp_area['id']=== $eq_expenses_item['expense_subarea_id']){?>
                        <td><?php echo $exp_area['title'];?></td>
                    <?php }?>
                <?php endforeach;?>  
                
            
                <?php
                foreach ($suppliers as $supplier):
                    if($supplier['id']=== $eq_expenses_item['supplier_id']){?>
                        <td><?php echo $supplier['name'];?></td><?php }?>
                    <?php endforeach;?>  
                
           
            <!-- <td><?php echo $eq_expenses_item['supplier_id']; ?></td> -->
            <td><?php echo $purchase_date = date('d-m-Y', strtotime($eq_expenses_item['purchase_date']));?></td> 
            <td><?php echo $eq_expenses_item['total_amount']; ?></td>
            <td>
            <?php 
             echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/equipment/".$eq_expenses_item['memo_image']."'> ";
             
             echo "</br>".$eq_expenses_item['memo_no'];
            ?>
            </td>            
            <td><?php  
                    $paid_unpaid=$eq_expenses_item['paid_unpaid'];
                    if($paid_unpaid==='0'){echo "Unpaid";}
                    if($paid_unpaid==='1'){echo "Paid";}
                ?>
            </td>
            
            <!-- <td><?php echo $eq_expenses_item['paid_by_person_id']; ?></td> -->
            
            <?php 
                foreach ($person as $per):
                        if($per['id']=== $eq_expenses_item['purchase_by_person_id']){?>
                        <td><?php echo $per['fullname'];?></td><?php }
                endforeach;?>  
            <td>  
            <?php                              
                $purchase_type=$eq_expenses_item['purchase_type'];
                    if($purchase_type==='direct'){echo "Direct / Cash";}
                    if($purchase_type==='advance'){echo "Advance";}
                    if($purchase_type==='credit'){echo "Credit";}
                ?>
           </td>
           <td><?php  if($eq_expenses_item['status']){echo "Accepted by Checker";};if(!($eq_expenses_item['status'])){echo "Initiated by Maker";}; ?></td> 
            <?php 
                $eq_expenses_id= base64_encode($eq_expenses_item['id']);
            ?>
            <td>  
                    <a  href="<?php echo site_url('equipmentdetail/create/'.$eq_expenses_id); ?>" >
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>Add / view details</span>            
                     </a>
                     
                      
                    <a href="<?php echo site_url('equipment/view/'.$eq_expenses_id); ?>" >
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>

                      <a href="<?php echo site_url('equipment/edit/'.$eq_expenses_id); ?>">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>

            </td>
               

        </tr>
<?php endforeach; ?>
</table>
</div>
<div>
    

    <!-- <p class="frmContainer" style="margin:5px;float:right;">        
        <span ><input type="button" class="btn btn-info" id="accept_btn"  value="Accept"></span>            
        <span ><input type="button" class="btn btn-danger" id="reject_btn"  value="Reject"></span> 
    </p> -->
</div>
  <?php }else{?>
     <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
  <?php   }?>
</div>
 

