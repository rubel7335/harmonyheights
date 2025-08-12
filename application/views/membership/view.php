<?php
?>

<div id="dataContainer" class="row col-md-12">
<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Username</strong></td>
        <td><strong>Full Name</strong></td>
        <td><strong>Flat no</strong></td>
        <td><strong>Email</strong></td>
        <td><strong>Contact no</strong></td>
        <td><strong>User category</strong></td>   
        <td><strong>Remarks</strong></td>
    </tr>
<tr>
            <td><?php echo $user_item['id']; ?></td>
            <td><?php echo $user_item['username']; ?></td>
            <td><?php echo $user_item['fullname']; ?></td>
            <td><?php echo $user_item['flat_no']; ?></td>
            <td><?php echo $user_item['email']; ?></td>
            <td><?php echo $user_item['contact_no']; ?></td>            

     
                <?php foreach ($categories as $category):
                if($category['id']=== $user_item['user_cat_id']){?>
            <td><?php echo $category['category_name'];?></td><?php }?>
                <?php endforeach;?>
            
             
            <td><?php echo $user_item['remarks']; ?></td>
</tr>

</table>
</div>
<div class="row col-md-1"></div>

</div>

 


