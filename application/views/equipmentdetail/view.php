<?php $emp_id=base64_encode($emp_id);?>
<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<div id="dataContainer" class="row frmContainer" style="font-family: monospace;">
 


<div class="col-md-6" style="padding:10px;">
    <p class="btn-info" onclick="toggle_emp_nominee_info()" style="padding:10px;text-align:center;">List of detail expense
                <span>
                    <a href="<?php echo site_url('nominee/create/'.$emp_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span><strong>Add</strong></span>            
                    </a>
                </span>
        </p>
<div id="emp_nominee_info_container">     
<?php if($expdetails){?>
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


<?php foreach ($expdetails as $expdetail_item): ?>
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
     echo "Detail expense information is not added";
     }?>
    </div>
</div>    

        

   
</div>

 


