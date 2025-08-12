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
<table class="table-striped table-bordered" id="bank_branch_list" style="width: 100%" cellspacing="0">
    
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Fax</th>
                <th>Telephone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Fax</th>
                <th>Telephone</th>
                <th>Action</th>
            </tr>
        </tfoot>

<?php foreach ($branches as $branches_item): ?>
        <tr>
            <td><?php echo $branches_item['id']; ?></td>
            <td><?php echo $branches_item['branch_name']; ?></td>
            <td><?php echo $branches_item['branch_business_address']; ?></td>
            <td><?php echo $branches_item['fax_num']; ?></td>
            <td><?php echo $branches_item['tel_num']; ?></td>
            <?php 
            $id = base64_encode($branches_item['id']);
            ?>
            <td>
                <a href="<?php echo site_url('branch/view/'.$id); ?>">View</a> 
               <?php if($usercat==1){?> | 
               <a href="<?php echo site_url('branch/edit/'.$id); ?>">Edit</a> | 
               <a href="<?php echo site_url('branch/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
               <?php }?>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


