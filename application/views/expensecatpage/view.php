<?php
?>


<div id="dataContainer" class="row col-md-12">
    <div class="row col-md-1"></div>
        <div class="row col-md-10">
            <h2><?php echo "Expense description"; ?></h2>
                <table class="table-striped table-bordered">
                    <tr>
                        <td><strong>Sl</strong></td>
                        <td><strong>Expense description</strong></td>
                        <td><strong>Expense subarea title</strong></td>
                        <td><strong>Remarks</strong></td>
                    </tr>

                    <tr>
                        <td><?php echo $expense_expensecategory['id']; ?></td>
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
                                    <td><?php echo $expense_expensecategory['remarks']; ?></td>
                        
                    </tr>
                </table>
        </div>
    <div class="row col-md-1"></div>
</div>




 


