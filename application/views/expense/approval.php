<style>
        .tooltip-container {
                position: relative;
                display: inline-block;
            }

        .tooltip {
                visibility: hidden;
                position: absolute;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                color: #333;
                padding: 10px;
                z-index: 1;
                min-width: 150px;
                top: 100%;
                left: 0;
                opacity: 0;
                transition: opacity 0.3s;
            }

        .tooltip-link:hover + .tooltip {
                visibility: visible;
                opacity: 1;
            }

</style>

<?php $user = $this->session->userdata('userID'); ?>

<div  id="dataContainer" class="row"  style="font-family: monospace; ">
<?php if($all_expenses){?>
        <div class="col-md-12" style="padding:20px;">  
          
        
                <h2><?php echo $title; ?></h2><span><a class="btn btn-info" href="<?php echo site_url('expense/create') ?>"><span class="glyphicon glyphicon-plus" style="text-align:right"></span> Add new expense</a></span>
                <form action="php_checkbox.php" method="post">
                <table class="table table-striped table-bordered  compact hover tbl" id="employee_list"  cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Total amount</th> 
                            <th>Paid by</th>                
                            <th>Status</th>
                            <th>Action</th>               
                        </tr>
                    </thead>
                    
                    <?php $totalExp=0;?>            
                        <?php $sl=1;foreach ($all_expenses as $expenses_item): ?>

                            <?php  $maker_id = $expenses_item['maker_id'];?>
                                <tr>
                                    <td><?php echo $sl++;?></td>                        
                                    <?php   
                                    foreach ($expense_types as $exp_area):
                                        if($exp_area['id']=== $expenses_item['expense_subarea_id']){?>
                                        <td><?php echo $exp_area['title'];?></td><?php }?>
                                    <?php endforeach;?>                            
                                    <td><?php echo $expenses_item['description'];?></td>                            
                                    <td><?php echo $payment_date = date('d-m-Y', strtotime($expenses_item['payment_date']));?></td> 
                                    <td><?php echo $total_amount=$expenses_item['total_amount']; $totalExp = $totalExp+$total_amount; ?></td>
                                    <!-- <td>
                                        <?php 
                                            echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/expense/".$expenses_item['memo_image']."'> ";
                                            echo "</br>".$expenses_item['memo_no'];
                                        ?>
                                    </td>             -->
                                
                                
                                    <?php 
                                        foreach ($person as $per):
                                            if($per['id']=== $expenses_item['paid_by_person_id']){?>
                                            <td><?php echo $per['fullname'];?></td><?php }
                                        endforeach;?>  
                                    <?php $expenses_id= base64_encode($expenses_item['id']); ?>
                                    <?php  if($expenses_item['status']==='0'){?>

                                            <td>
                                            <span class="glyphicon glyphicon-hourglass" aria-hidden="false">Pending</span>
                                            </br>
                                                <a  href="<?php echo site_url('expense/approve/'.$expenses_id); ?>" class="btn btn-info" onclick="return confirmUser(<?php echo $maker_id; ?>, <?php echo $user; ?>)" >
                                                    <span class="glyphicon glyphicon-ok" aria-hidden="true">Approve</span>
                                                </a>
                                            </td>
                                    <?php }?>

                                    <!-- <?php  if($expenses_item['status']==='0'){?><td ><span class="glyphicon glyphicon-hourglass" aria-hidden="true">Pending</span> </td><?php  } ?>          
                                    <?php  if($expenses_item['status']==='1'){?><td ><span class="glyphicon glyphicon-check" aria-hidden="true"></span><span>Approved</span></td><?php  } ?>
                                 -->
                                    

                                    <td>
                                        <div class="tooltip-container">
                                            <a href="#" class="tooltip-link">Memo</a>
                                            <div class="tooltip">
                                                <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src="<?= base_url()."upload/expense/".$expenses_item['memo_image'] ?>">
                                                <br>
                                                <?= $expenses_item['memo_no'] ?>
                                            </div>
                                        </div>
                                    </br>

                                        <?= anchor('expense/view/' . $expenses_id, 'Details', 'class="view-link"') ?>    
                                        <?= anchor('expense/edit/' . $expenses_id, 'Edit', 'class="edit-link"') ?>
                                        
                                    </td>

                                </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr style="font-weight:bold;background:#FFFFFF;padding:3px">                    
                                <th colspan="4" style="text-align:right;">Total amount </th>
                                <th><?php echo $totalExp;?></th>                
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                </table>
            
               
        <div>
    <?php }else{?>
                <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
    <?php   }?>        

</div>


<script type="text/javascript">
        function confirmUser(makerId, userId) {            
            if (makerId === userId) {     
                    alert("Same user cannot be maker and checker");
                    return false;
            }else{
                if (confirm('Are you sure you want to approve ?')) {
                    // User confirmed, allow navigation to the link
                    return true;
                    } else {
                    // User canceled, prevent navigation                  
                            return false;
                    }
                }
            // User is not the maker, allow navigation to the link
            return true;
        }
</script>
