<div id="dataContainer" class="row">
<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
<div class="col-md-1"></div>
<div class="col-md-10">
    <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:5px;margin-bottom:10px;margin-top:10px;"><?php echo $title;?> </br></p>
    
<?php if($nominees){?>
<table class="table table-striped table-bordered  compact hover" id="nominee_list" style="width: 100%" cellspacing="0">
        <thead>

    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>NID </strong></td>
        <td><strong>Pension %</strong></td> 
        <td><strong>Pension provider</strong></td>     
        <td><strong>Action</strong></td>
    </tr> 

        </thead>


<?php foreach ($nominees as $nominee_item): ?>
        <tr>
            <td><?php
            echo $nominee_item['id'];
            ?></td>
            <td>
            <?php 
            echo "<img width='70px' height='60px'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";
            echo "</br>".$nominee_item['full_name'];?>
            <td><?php echo $nominee_item['nid_no']; ?></td> 
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
                

             
            </td>
        </tr>
<?php endforeach; ?>
</table>
<?php }else{?>
<p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:5px;margin-bottom:10px;margin-top:10px;"> No record found</p>
<?php   }?>

</div>
<div class="col-md-1"></div>

</div>

 




