<div  id="dataContainer" class="row">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>

        <table class="table-striped table-bordered compact hover" id="user_list" style="width: 100%" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Email</th>                
                <th>Cell phone</th>
                <th>Designation</th>
                <th>Office Address</th>
                <th>Office Phone</th>
                <th>User category</th>                
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SL</th>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Email</th>                
                <th>Cell phone</th>
                <th>Designation</th>
                <th>Office Address</th>
                <th>Office Phone</th>
                <th>User category</th>                
                <th>Branch</th>
                
                <th>Action</th>
            </tr>
        </tfoot>
        
<?php foreach ($users as $users_item): ?>
        <tr>
            <?php 
                $password_cng_flg = $users_item['password_cng_flg'];
                $password_creation_time= $users_item['password_creation_time'];
                $login_attempts  = $users_item['login_attempts'];
                $last_login_time = $users_item['last_login_time'];  
                $lock_unlock    =$users_item['lock_unlock'];      //0=Lock, For invalid attempt
                $active_inactive =$users_item['active_inactive']; //0=Active            
            ?>
            <td><?php echo $users_item['id']; ?></td>
            <td><?php echo $users_item['username']; ?></td>
            <td><?php echo $users_item['full_name']; ?></td>
            <td><?php echo $users_item['gender']; ?></td>
            <td><?php echo $users_item['email']; ?></td>
            <td><?php echo $users_item['cell_phone']; ?></td>
            

                <?php foreach ($designations as $designation):
                if($designation['id']=== $users_item['designation_id']){?>
            <td><?php echo $designation['title'];?></td><?php }?>
                <?php endforeach;?>
            
            <td><?php echo $users_item['office_address']; ?></td>
            <td><?php echo $users_item['office_phone']; ?></td>
            
                <?php foreach ($categories as $category):
                if($category['id']=== $users_item['user_category_id']){?>
            <td><?php echo $category['category_name'];?></td><?php }?>
                <?php endforeach;?>
            
                <?php foreach ($branches as $branch):
                if($branch['id']=== $users_item['branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
                <?php endforeach;?>
            
            
            <?php $id = base64_encode($users_item['id']);?>
            <td>

                
               
       
                
                
    <a href="<?php echo site_url('user/view/'.$id); ?>" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>
    <a href="<?php echo site_url('user/edit/'.$id); ?>" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>Edit</strong></span>            
    </a>
    <a href="<?php echo site_url('user/reset/'.$id); ?>" onClick="return confirm('Are you sure you want to reset?')" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
        <span><strong>Reset</strong></span>            
    </a>                 
                
                
                
                <!--
                <a href="<?php echo site_url('user/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                -->
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


