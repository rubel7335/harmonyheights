<!-- application/views/expense_subarea/index.php -->
<h2>Expense Subareas</h2>
<ul>
    <?php foreach ($expense_subareas as $expense_subarea): ?>
        <li><a href="<?= site_url('expense_subarea/show/' . $expense_subarea->id) ?>"><?= $expense_subarea->title ?></a></li>
    <?php endforeach; ?>
</ul>
<a href="<?= site_url('expense_subarea/create') ?>">Create New Expense Subarea</a>
