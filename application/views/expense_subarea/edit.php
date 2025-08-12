<!-- application/views/expense_subarea/edit.php -->
<h2>Edit Expense Subarea</h2>

<?php echo form_open('expense_subarea/update/' . $expense_subarea->id); ?>

<label for="title">Title:</label>
<input type="text" name="title" id="title" value="<?= $expense_subarea->title ?>" required>

<label for="description">Description:</label>
<textarea name="description" id="description" rows="4"><?= $expense_subarea->description ?></textarea>

<input type="submit" value="Update">

<?php echo form_close(); ?>

<a href="<?= site_url('expense_subarea/show/' . $expense_subarea->id) ?>">Back to Details</a> |
<a href="<?= site_url('expense_subarea') ?>">Back to List</a>
