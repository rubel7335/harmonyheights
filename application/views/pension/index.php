<div id="dataContainer" class="row col-md-12">

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Employee id</strong></td>
        <td><strong>Nominee id</strong></td>
        <td><strong>Pension Basic</strong></td>
        <td><strong>Last increment date</strong></td>
        <td><strong>Next increment date</strong></td> 
        <td><strong>Fixation date</strong></td> 
        <td><strong>Remarks</strong></td>
        <td><strong>Payment method</strong></td> 
        <td><strong>Payment to account no</strong></td>        
        <td><strong>Payment to Bank</strong></td> 
        <td><strong>Payment to Branch</strong></td> 
        <td><strong>Action</strong></td>
    </tr> 
    
<?php foreach ($pensions as $pension_item): ?>
        <tr>
            <td><?php echo $pension_item['id']; ?></td>
            <td><?php echo $pension_item['employee_id']; ?></td>
            <td><?php echo $pension_item['nominee_id']; ?></td>
            <td><?php echo number_format($pension_item['pension_basic']); ?></td> 
            <td><?php echo $pension_item['last_increment_date']; ?></td> 
            <td><?php echo $pension_item['next_increment_date']; ?></td>
            <td><?php echo $pension_item['fixation_date']; ?></td>
            <td><?php echo $pension_item['remarks']; ?></td> 
            <td><?php echo $pension_item['payment_method']; ?></td>
            <td><?php echo $pension_item['payment_to_account_no']; ?></td>
                 <?php foreach ($fis as $bank):
                if($bank['id']=== $pension_item['payment_to_bank_id']){?>
            <td><?php echo $bank['name'];?></td><?php }?>
                <?php endforeach;?> 
            
                <?php foreach ($branches as $branch):
                if($branch['id']=== $pension_item['payment_to_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
                <?php endforeach;?> 
            <?php $id = base64_encode($pension_item['id']);?>
            <td>
                <a href="<?php echo site_url('pension/view/'.$id); ?>">View</a> | 
                <a href="<?php echo site_url('pension/edit/'.$id); ?>">Edit</a> | 
                <a href="<?php echo site_url('pension/delete/'.$id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


