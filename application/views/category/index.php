 <?php 
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 
 ?> 

<div id="dataContainer" class="row" >
<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Category Name</strong></td>
        <td><strong>Remarks</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($categories as $category_item): ?>
        <tr>
            <td><?php echo $category_item['id']; ?></td>
            <td><?php echo $category_item['category_name']; ?></td>
            <td><?php echo $category_item['remarks']; ?></td>
            <?php $id= base64_encode($category_item['id']);?>
            <td>
                
                    <a href="<?php echo site_url('category/view/'.$id); ?>" class="btn btn-primary a-btn-slide-text">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span><strong>View</strong></span>            
                    </a>
                <?php if($usercat==1){?>
                    <a href="<?php echo site_url('category/edit/'.$id); ?>" class="btn btn-primary a-btn-slide-text">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span><strong>Edit</strong></span>            
                    </a>
                <?php }?>
                
                
                <!--
                <a href="<?php echo site_url('category/view/'.$id); ?>">View</a>
                <?php if($usercat==1){?>| 
                <a href="<?php echo site_url('category/edit/'.$id); ?>">Edit</a> 
                
                <a href="<?php echo site_url('category/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                
                <?php }?>
                -->
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


