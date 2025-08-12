<div  id="dataContainer" class="row" style="font-family: monospace;">
    <!-- application/views/expense_subarea/create.php -->
    <div  class="col-md-4"> </div>

            <div class="col-md-4" style="background: #ebebeb; padding:10px;">  
                <h2>Create New Expense Subarea</h2>

                <?php echo form_open('expense_subarea/store/'.$classID); ?>
                <div >   
                    <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" id="title" required value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title'], ENT_QUOTES) : ''; ?>">
                    </div>
                </div>

                <div >   
                    <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" id="description" name="description" id="description" required value="<?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES) : ''; ?>">
                    </div>
                </div>

        <div>
            <div class="form-group">   
                <button type="submit" id="btnExpenseCreateSubmit" class="btn btn-info" name="submit" value="ADD" >Add</button>
            </div>
        </div>
               

                <?php echo form_close(); ?>

                <a href="<?= site_url('expense_subarea') ?>">Back to List</a>
            </div>    

</div>
