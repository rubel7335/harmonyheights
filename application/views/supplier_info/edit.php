<!-- application/views/supplier_info/edit.php -->
<div id="bodyholder" class="row" style="min-height:500px;font-family: monospace; ">
    <div class="col-md-3"></div>
            <div class="col-md-3">
                <h2>Edit Supplier</h2>

                <?php echo form_open('supplier_info/update/' . $supplier->id); ?>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= $supplier->name ?>" required>

                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="<?= $supplier->address ?>">

                <label for="contact_no">Contact No:</label>
                <input type="text" name="contact_no" id="contact_no" value="<?= $supplier->contact_no ?>">

                <div class="col-md-12" >            
                        <div  style="text-align: center;width:100%">
                            <button type="submit" class="btn btn-info" name="submit"  >Update</button>       
                        </div>
                </div>

                <?php echo form_close(); ?>

                <a href="<?= site_url('supplier_info/show/' . $supplier->id) ?>">Back to Details</a> |
                <a href="<?= site_url('supplier_info') ?>">Back to List</a>
            </div>
    <div class="col-md-3"></div>
</div>
