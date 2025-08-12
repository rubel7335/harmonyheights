<?php
?>

<div id="dataContainer" class="row col-md-12">
<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><?php echo $allowance_item['id']; ?></td>
    </tr>
    <tr>    
        <td><strong>Type</strong></td>
        <td><?php echo $allowance_item['allowance_type']; ?></td>
    </tr>
    <tr>
        <td><strong>Amount</strong></td>
        <td><?php echo number_format($allowance_item['allowance_amount']); ?></td>
    </tr>
    <tr>    
        <td><strong>gross or percentage</strong></td>
        <td><?php echo $allowance_item['gross_or_percentage']; ?></td>
    </tr>
    
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


