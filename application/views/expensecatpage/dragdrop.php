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
                    $expenses_selected = $this->expense_model->get_all_expense_of_a_subarea($category['id']);
                    
                    foreach ($expenses_selected as $expense_item): ?>
                        <li class="draggable" data-expenseid="<?php echo $expense_item['id']; ?>">
                            <?php echo $expense_item['description']; ?>
                        </li>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Available Expenses for Drag-and-Drop -->
    <ul id="available-expenses" class="draggable-list">
        <?php foreach ($all_expenses as $expense): ?>
            <li class="draggable" data-expenseid="<?php echo $expense['id']; ?>">
                <?php echo $expense['description']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <button type="submit" id="btnregistersubmit" name="submit">Update</button>
</form>

<!-- JavaScript for Drag-and-Drop -->
<script>
    $(function () {
        $(".draggable").draggable({
            revert: "invalid",
            helper: "clone"
        });

        $("td").droppable({
            accept: ".draggable",
            drop: function (event, ui) {
                var expenseId = ui.helper.data("expenseid");
                var targetSubareaId = $(this).prev().find("input[name='expense_subarea_ids[]']").val();
                // Handle the drop action, e.g., update the model or hidden fields
                console.log("Dropped expense " + expenseId + " into subarea " + targetSubareaId);
            }
        });
    });
</script>
