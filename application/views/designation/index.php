 <?php 
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 
 ?> 


<div  id="dataContainer" class="row">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Title</strong></td>
        <td><strong>Alias</strong></td>
        <td><strong>Grade</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($designations as $designations_item): ?>
        <tr>
            <td><?php echo $designations_item['id']; ?></td>
            <td><?php echo $designations_item['title']; ?></td>
            <td><?php echo $designations_item['alias']; ?></td>
            <td><?php echo $designations_item['grade_id']; ?></td>
            <?php $id= base64_encode($designations_item['id']);?> 
            <td>
                <a href="<?php echo site_url('designation/view/'.$id); ?>">View</a>
                <?php if($usercat==1){?>| 
                <a href="<?php echo site_url('designation/edit/'.$id); ?>">Edit</a> | 
                <a href="<?php echo site_url('designation/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                <?php }?>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


