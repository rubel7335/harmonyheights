<div id="dataContainer" class="row col-md-12">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table table-striped table-bordered  compact hover tbl" id="pac_list"  cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pages</th>
                <th>User category</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>


        
<?php foreach ($permissions as $permissions_item): ?>
        <tr>
            <td><?php echo $permissions_item['id']; ?></td>
            <?php foreach ($pages as $page):
                if($page['id']=== $permissions_item['page_id']){?>
            <td><?php echo $page['name'];?></td><?php }?>
                <?php endforeach;?>
            
            <?php foreach ($categories as $category):
                if($category['id']=== $permissions_item['user_category_id']){?>
            <td><?php echo $category['category_name'];?></td><?php }?>
                <?php endforeach;?>
            
     
            <td><?php echo !empty($permissions_item['remarks']) ? $permissions_item['remarks'] : ''; ?></td>

                          
            <td>
                <a href="<?php echo site_url('usercatpage/view/'.$permissions_item['id']); ?>">View</a> | 
                <a href="<?php echo site_url('usercatpage/edit/'.$permissions_item['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('usercatpage/delete/'.$permissions_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


