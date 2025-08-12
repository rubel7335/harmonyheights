

<div class="row" id="dataContainer">
    <div class="row col-md-3"></div>
    <div class="row col-md-6" style="padding:10px;">
<!-- Assuming this is inside a form -->
<?php echo form_open('expensecatpage/update'); ?>
    <?php $selected_expenses = []; ?>
    <table class="table table-striped table-bordered compact hover tbl">
        <?php $sl = 1; ?>
        <?php foreach ($expense_categories as $category): ?>
            <tr>
                <td>
                    <?php echo $category['id'] . ") " . $category['title']; ?>
                    <!-- Add a hidden input field to store the expense_subarea_id -->
                    <input type="hidden" name="expense_subarea_ids[]" value="<?php echo $category['id']; ?>">
                </td>
                <td>
                    <?php
                    $expenses = $this->expense_model->get_all_expense_of_a_subarea($category['id']);
                    foreach ($expenses as $expense): ?>
                        <li>
                            <input type="checkbox" name="expense_ids[<?php echo $category['id']; ?>][]" value="<?php echo $expense['id']; ?>" checked>
                            <?php $selected_expenses[$category['id']][] = $expense['id']; ?>
                            <?php $expenseID = $expense['id']; ?>
                            <?php foreach ($all_expenses as $expense_item): ?>
                                <?php if ($expense_item['id'] === $expense['id']): ?>
                                    <?php echo $expense_item['description']; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </li>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit" id="btnregistersubmit" name="submit">Update</button>
</form>

            
        </form>
    </div>
    </div>
    <div class="row col-md-3"></div>
</div>