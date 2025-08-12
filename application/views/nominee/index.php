
<div  id="dataContainer" class="row" style="height: 350px;">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title;?></h2>
     
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Shareholder id</strong></td>
        <td><strong>Flat no</strong></td>
        <td><strong>Full name</strong></td>
        <td><strong>Relation</strong></td>
        <td><strong>Share %</strong></td>   
        <td><strong>Action</strong></td>
    </tr> 

<?php foreach ($nominees as $nominee_item): ?>
        <tr>
            <td><?php echo $nominee_item['id']; ?></td>
            <td><?php echo $nominee_item['personal_id']; ?></td>
            <td><?php echo $nominee_item['flat_no']; ?></td>
            <td><?php echo $nominee_item['fullname']; ?></td> 
            <td><?php echo $nominee_item['relation']; ?></td>
            <td><?php echo $nominee_item['share_percentage']; ?></td> 
            <?php $id = base64_encode($nominee_item['id']);?>
            <td>
                <a href="<?php echo site_url('nominee/view/'.$id); ?>">View</a> | 
                <a href="<?php echo site_url('nominee/edit/'.$id); ?>">Edit</a> | 
                <a style="display:none" href="<?php echo site_url('nominee/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


