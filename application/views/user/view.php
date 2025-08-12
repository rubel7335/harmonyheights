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
        <td><strong>Gender</strong></td>
        <td><strong>Email</strong></td>
        <td><strong>Cell phone</strong></td>
        <td><strong>Designation</strong></td>
        <td><strong>Office Address</strong></td>
        <td><strong>Office Phone</strong></td>
        <td><strong>User category</strong></td>        
         <td><strong>Branch</strong></td>
        <td><strong>Remarks</strong></td>
    </tr>
<tr>
            <td><?php echo $user_item['id']; ?></td>
            <td><?php echo $user_item['username']; ?></td>
            <td><?php echo $user_item['full_name']; ?></td>
            <td><?php echo $user_item['gender']; ?></td>
            <td><?php echo $user_item['email']; ?></td>
            <td><?php echo $user_item['cell_phone']; ?></td>            

                <?php foreach ($designations as $designation):
                if($designation['id']=== $user_item['designation_id']){?>
            <td><?php echo $designation['title'];?></td><?php }?>
                <?php endforeach;?>
            
            <td><?php echo $user_item['office_address']; ?></td>
            <td><?php echo $user_item['office_phone']; ?></td>
            
                <?php foreach ($categories as $category):
                if($category['id']=== $user_item['user_category_id']){?>
            <td><?php echo $category['category_name'];?></td><?php }?>
                <?php endforeach;?>
            
                <?php foreach ($branches as $branch):
                if($branch['id']=== $user_item['branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
                <?php endforeach;?>
            <td><?php echo $user_item['remarks']; ?></td>
</tr>

</table>
</div>
<div class="row col-md-1"></div>

</div>

 


