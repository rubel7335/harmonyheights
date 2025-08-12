 <?php 
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 
 ?> 

<div id="dataContainer" class="row">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Title</strong></td>
        <td><strong>Remarks</strong></td>
        <td><strong>Active / Inactive</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($grades as $grades_item): ?>
        <tr>
            <td><?php echo $grades_item['id']; ?></td>
            <td><?php echo $grades_item['title']; ?></td>
            <td><?php echo $grades_item['remarks']; ?></td>
            <td><?php echo $grades_item['active_inactive']; ?></td>
            <?php $id = base64_encode($grades_item['id']);?>
            <td>
                <a href="<?php echo site_url('grade/view/'.$id); ?>">View</a> | 
                <a href="<?php echo site_url('grade/edit/'.$id); ?>">Edit</a> | 
                <a href="<?php echo site_url('grade/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


