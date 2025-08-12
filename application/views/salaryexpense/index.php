
<div  id="dataContainer" class="row"  style="font-family: monospace; ">
<?php echo form_open_multipart('salaryexpense/create'); ?>    
<div class="col-md-12" style="padding:20px;">  
<div id="bodyholder" class="row" style="background:  #EBE1F9;">
<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<?php if($all_salaryexpenses){?>
    <div  class="col-md-12">
        <h2><?php echo $title; ?></h2>
        <form action="php_checkbox.php" method="post">
        <table class="table table-striped table-bordered  compact hover tbl" id="employee_list"  cellspacing="0">
            <thead>
                <tr>
                <th>Sl</th>
                    <th>Category</th>
                    <th>Pay to</th>
                    <th>Date</th>
                    <th>Total amount</th>                
                    <th>Memo </th>
                    <th>Paid by</th>                
                    <th>Status</th>               
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Sl</th>                
                    <th>Category</th>
                    <th>Pay to</th>
                    <th>Date</th>
                    <th>Total amount</th>                
                    <th>Memo </th>
                    <th>Paid by</th>                
                    <th>Status</th>
                    
                </tr>
            </tfoot>

            
                <?php $sl=1;foreach ($all_salaryexpenses as $expenses_item): ?>
                        <tr>
                            <td><?php echo $sl++;?></td>
                            
                        
                            <?php                 
                                foreach ($expense_types as $exp_area):
                                if($exp_area['id']=== $expenses_item['expense_subarea_id']){?>
                            <td><?php echo $exp_area['title'];?></td><?php }?>
                                <?php endforeach;?>  
                                
                                
                                
                            <?php                 
                            foreach ($person as $per):
                                if($per['id']=== $expenses_item['person_id']){?>
                            <td><?php echo $per['fullname'];?></td><?php }?>
                                <?php endforeach;?>  
                            
                        
                            
                            <td><?php echo $payment_date = date('d-m-Y', strtotime($expenses_item['payment_date']));?></td> 
                            <td><?php echo $expenses_item['total_amount']; ?></td>
                            <td>
                            <?php 
                            echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/salaryexpense/".$expenses_item['memo_image']."'> ";
                            
                            echo "</br>".$expenses_item['memo_no'];
                            ?>
                            </td>            
                        
                        
                                <?php 
                                            foreach ($person as $per):
                                if($per['id']=== $expenses_item['paid_by_person_id']){?>
                            <td><?php echo $per['fullname'];?></td><?php }
                                            endforeach;?>  
                            
                            

                        
                            <td><?php  if($expenses_item['status']){echo "Confirmed";};if(!($expenses_item['status'])){echo "Pending";}; ?></td>
                            <?php 
                            $expenses_id= base64_encode($expenses_item['id']);           
                            ?>

                            

                        </tr>
                <?php endforeach; ?>
        </table>
    </div>
<div>

</div>
  <?php }else{?>
     <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
  <?php   }?>
</div>