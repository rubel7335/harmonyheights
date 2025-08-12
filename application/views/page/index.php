<div  id="dataContainer" class="row">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>URL Controller</strong></td>
        <td><strong>URl Action</strong></td>
        <td><strong>Remarks</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($pages as $pages_item): ?>
        <tr>
            <td><?php echo $pages_item['id']; ?></td>
            <td><?php echo $pages_item['name']; ?></td>
            <td><?php echo $pages_item['url_controller']; ?></td>
            <td><?php echo $pages_item['url_action']; ?></td>
            <td><?php echo $pages_item['remarks']; ?></td>
            <?php $id = base64_encode($pages_item['id']);?>
            <td>
                <a href="<?php echo site_url('page/view/'.$id); ?>">View</a> | 
                <a href="<?php echo site_url('page/edit/'.$id); ?>">Edit</a> | 
                <a href="<?php echo site_url('page/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


