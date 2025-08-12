<!-- application/views/expense_subarea/show.php -->
<h2>Expense Subarea Details</h2>

<h3>Title: <?= $expense_subarea->title ?></h3>
<p>Description: <?= $expense_subarea->description ?></p>

<a href="<?= site_url('expense_subarea/edit/' . $expense_subarea->id) ?>">Edit</a> |
<a href="<?= site_url('expense_subarea') ?>">Back to List</a>
