<?php
?>


<div id="dataContainer" class="row col-md-12">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Pages</strong></td>
        <td><strong>User category</strong></td>
        <td><strong>Remarks</strong></td>
    </tr>

        

        <tr>
            <td><?php echo $permission_item['id']; ?></td>
            <?php foreach ($pages as $page):
                if($page['id']=== $permission_item['page_id']){?>
            <td><?php echo $page['name'];?></td><?php }?>
                <?php endforeach;?>
            
            <?php foreach ($categories as $category):
                if($category['id']=== $permission_item['user_category_id']){?>
            <td><?php echo $category['category_name'];?></td><?php }?>
                <?php endforeach;?>
            
            <td><?php echo $permission_item['remarks']; ?></td>
            
            

        </tr>

</table>
</div>
<div class="row col-md-1"></div>

</div>

 




 


