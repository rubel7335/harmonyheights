<div id="dataContainer" class="row">

<div class="col-md-1"></div>
<div class="col-md-10" id="dataContainer">
    
<h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Employee id</strong></td>
        <td><strong>full_name</strong></td>
        <td><strong>relation</strong></td>
        <td><strong>pension_percentage</strong></td> 
        <td><strong>pension_provider_branch_id</strong></td>     
        <td><strong>Action</strong></td>
    </tr> 

<?php foreach ($nominees as $nominee_item): ?>
        <tr>
            <td><?php echo $nominee_item['id']; ?></td>
            <td><?php echo $nominee_item['employee_id']; ?></td>
            <td><?php echo $nominee_item['full_name']; ?></td>
            <td><?php echo $nominee_item['relation']; ?></td> 
            <td><?php echo $nominee_item['pension_percentage']; ?></td> 
                <?php foreach ($branches as $branch):
                if($branch['id']=== $nominee_item['pension_provider_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
                <?php endforeach;?> 
            <?php $id= base64_encode($nominee_item['id']);?>
            <td>
                <a href="<?php echo site_url('nominee/view/'.$id); ?>">View</a> | 
                <a href="<?php echo site_url('nominee/edit/'.$id); ?>">Edit</a> | 
                <a href="<?php echo site_url('nominee/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="col-md-1"></div>

</div>

 


