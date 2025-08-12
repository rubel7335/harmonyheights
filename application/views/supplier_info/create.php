<!-- application/views/supplier_info/create.php -->
<div  id="dataContainer" class="row" style="font-family: monospace;">
<div  class="col-md-3"> </div>
    <div  class="col-md-6"> 
    <h2>Create New Supplier</h2>

    <?php echo form_open('supplier_info/store'); ?>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address">

    <label for="contact_no">Contact No:</label>
    <input type="text" name="contact_no" id="contact_no">


    <div class="col-md-12" >            
            <div  style="text-align: center;width:100%">
                <button type="submit" class="btn btn-info" name="submit"  >Create new supplier</button>       
            </div>
    </div>

   

    <?php echo form_close(); ?>

    <a href="<?= site_url('supplier_info') ?>">Back to List</a>
</div>
</div>