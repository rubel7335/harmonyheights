
<div  id="dataContainer" class="row"  style="font-family: monospace; ">
     <?php $sl=1;?>
<div class="col-md-1"></div>       
                <div  class="col-md-10">
                    <table class="table table-striped table-bordered  compact hover tbl" id="employee_list"  cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Total amount</th>                
                                            <th>Memo </th>
                                            <th>Paid by</th>                
                                            <th>Status</th>
                                            <th>Action</th>               
                                        </tr>
                                    </thead>
                        

                                    <tr>
                                        <td><?php echo $sl++;?></td>
                                       <?php foreach ($expense_types as $exp_area): ?>
    <?php if (!empty($expenses_item['expense_subarea_id']) && $exp_area['id'] === $expenses_item['expense_subarea_id']): ?>
        <td><?php echo $exp_area['title']; ?></td>
    <?php endif; ?>
<?php endforeach; ?>

<?php if (empty($expenses_item['expense_subarea_id'])): ?>
    <td></td>
<?php endif; ?>
                        
                                        <td><?php echo $expenses_item['description'];?></td>                            
                                        <td><?php echo $payment_date = date('d-M-Y', strtotime($expenses_item['payment_date']));?></td> 
                                        <td><?php echo $total_amount=$expenses_item['total_amount']; ?></td>
                                        <td>
                                            <?php 
                                                echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/expense/".$expenses_item['memo_image']."'> ";
                                                echo "</br>".$expenses_item['memo_no'];
                                            ?>
                                        </td>            
                                    
                                    
                                        <?php 
                                            foreach ($person as $per):
                                                if($per['id']=== $expenses_item['paid_by_person_id']){?>
                                                <td><?php echo $per['fullname'];?></td><?php }
                                            endforeach;?>  
                                            
                                        <td><?php  if($expenses_item['status']){echo "Confirmed";};if(!($expenses_item['status'])){echo "Pending";}; ?></td>
                                        <?php $expenses_id= base64_encode($expenses_item['id']); ?>
                                        <td><?= anchor('expense/edit/' . $expenses_id, 'Edit', 'class="edit-link"') ?></td>
                                    </tr>
                    </table>
                </div>
<div class="col-md-1"></div>         
    
</div>