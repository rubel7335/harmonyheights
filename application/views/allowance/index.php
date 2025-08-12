 <?php 
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 
 ?> 


<div  id="dataContainer" class="row" style="min-height:500px;">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>

   
     <table class="table-striped table-bordered" id="allowance_list" style="width: 100%;font-family: monospace;" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Allowance Type</th>
                <th>Allowance Amount</th>
                <th>Gross / Percentage</th>
                <th>Active / Inactive</th>
                <td>Action</td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Allowance Type</th>
                <th>Allowance Amount</th>
                <th>Gross / Percentage</th>
                <th>Active / Inactive</th>
                <th>Action</th>
            </tr>
        </tfoot>

        
<?php foreach ($allowances as $allowance_item): ?>
        <tr>
            <td><?php echo $allowance_item['id']; ?></td>
            <td><?php echo $allowance_item['allowance_type']; ?></td>
            <td><?php echo number_format($allowance_item['allowance_amount']); ?></td>
            <td><?php echo $allowance_item['gross_or_percentage']; ?></td>  
            <td><?php if($allowance_item['active_inactive']){?><p  style="color: #009926;">Active</p><?php ;}else {?><p style="color: #E74C3C;">Inactive</p><?php }?></td> 
<?php 
$id = base64_encode($allowance_item['id']);
?>
            <td>       
                <a href="<?php echo site_url('allowance/view/'.$id); ?>" class="btn btn-primary a-btn-slide-text">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    <span><strong>View</strong></span>            
                </a>
                <a href="<?php echo site_url('allowance/edit/'.$id); ?>" class="btn btn-primary a-btn-slide-text">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <span><strong>Edit</strong></span>            
                </a>
                                            <!--
                <a href="<?php echo site_url('allowance/view/'.$id); ?>"><button>View</button></a> | 
                <a href="<?php echo site_url('allowance/edit/'.$id); ?>"><button>Edit</button></a>

                <?php if($usercat==1){?>| 
                <a href="<?php echo site_url('allowance/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                <?php }?>
                -->
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


