<!-- application/views/supplier_info/index.php -->

<div id="bodyholder" class="row" style="min-height:500px;font-family: monospace; ">
    <div class="col-md-3"></div>
        <div class="col-md-6" id="bodyholder" style="padding:20px; background:  #FFFFFF;text-align: center;">
            <h2>List of Suppliers</h2>
                    <table class="table table-stripped table-borderred">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($suppliers as $supplier): ?>
                                <tr>
                                    <td><?= $supplier->id ?></td>
                                    <td><?= $supplier->name ?></td>
                                    <td><?= $supplier->address ?></td>
                                    <td><?= $supplier->contact_no ?></td>
                                    <td>
                                        <a href="<?= site_url('supplier_info/show/' . $supplier->id) ?>">View</a>
                                        <a href="<?= site_url('supplier_info/edit/' . $supplier->id) ?>">Edit</a>
                                        <a href="<?= site_url('supplier_info/delete/' . $supplier->id) ?>" onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
        </div>
    <div class="col-md-3"></div>
</div>
        
