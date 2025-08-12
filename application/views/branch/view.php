<?php
?>

<div id="dataContainer" class="row col-md-12">
<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Address</strong></td>
        <td><strong>Fax</strong></td>
        <td><strong>Telephone</strong></td>
        <td><strong>Remarks</strong></td>
    </tr>
    <tr>
        <td><?php echo $branch_item['id']; ?></td>
        <td><?php echo $branch_item['branch_name']; ?></td>
        <td><?php echo $branch_item['branch_business_address']; ?></td>
        <td><?php echo $branch_item['fax_num']; ?></td>
        <td><?php echo $branch_item['tel_num']; ?></td>
        <td><?php echo $branch_item['remarks']; ?></td>
    </tr>

</table>
</div>
<div class="row col-md-1"></div>

</div>

 


