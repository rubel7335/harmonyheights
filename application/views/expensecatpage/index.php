<div id="dataContainer" class="row">
      <div class="col-md-12" > 

<div class="row col-md-1"></div>
<div class="row col-md-10">
     <h2><?php echo $title; ?></h2>
<table class="table table-striped table-bordered  compact hover tbl" id="pac_list"  cellspacing="0">
        <thead>
            <tr>
                <th>Sl</th>                
                <th>Expense</th>
                <th>Expenses category (subarea)</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $sl=1;foreach ($expense_expensecategories as $expense_expensecategory): ?>
                                <tr>
                                    <td><?php echo $sl++;?></td>       
                                   
                                    <?php foreach ($all_expenses as $expense): ?>
                                        <?php if (!empty($expense['id']) && $expense_expensecategory['expense_id'] === $expense['id']): ?>
                                            <td><?php echo $expense['description']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if (empty($expense['id'])): ?>
                                        <td></td>
                                    <?php endif; ?>









                                    <?php foreach ($expense_subarea as $expense_subarea_item): ?>
                                        <?php if (!empty($expense_subarea_item['id']) && $expense_expensecategory['expense_subarea_id'] === $expense_subarea_item['id']): ?>
                                            <td><?php echo $expense_subarea_item['title']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if (empty($expense_subarea_item['id'])): ?>
                                        <td></td>
                                    <?php endif; ?>


                                      
                                       
                            

            
            <td>
                <a href="<?php echo site_url('expensecatpage/view/'.$expense_expensecategory['id']); ?>">View</a> | 
                <a href="<?php echo site_url('expensecatpage/edit/'.$expense_expensecategory['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('expensecatpage/delete/'.$expense_expensecategory['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>
</div>

 


