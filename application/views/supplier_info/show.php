<!-- application/views/supplier_info/show.php -->
<div id="bodyholder" class="row" style="min-height:500px;font-family: monospace; ">
<div class="col-md-3"></div>
    <div class="col-md-3">
        <h2>Supplier Details</h2>
        <p><strong>ID:</strong> <?= $supplier->id ?></p>
        <p><strong>Name:</strong> <?= $supplier->name ?></p>
        <p><strong>Address:</strong> <?= $supplier->address ?></p>
        <p><strong>Contact No:</strong> <?= $supplier->contact_no ?></p>
        <a href="<?= site_url('supplier_info/edit/' . $supplier->id) ?>">Edit</a> |
        <a href="<?= site_url('supplier_info') ?>">Back to List</a>
    </div>
<div class="col-md-3"></div>
</div>



