

<div  id="dataContainer" class="row"  style="font-family: monospace;min-height:450px; ">
<div class="col-md-2" ></div>
        <div class="col-md-8">  
            <h1>Edit Notice</h1>
            <form action="<?= site_url('notice/update/' . $notice['id']); ?>" method="post">
               

                <div class="col-md-6">
                    <div class="rowlabel">Title:</div>
                    <div><input type="text" placeholder="Enter title " name="title" autocomplete="off" value="<?php echo $notice['title'] ?>" required></div>
                </div>

                <div class="col-md-12">
                    <div class="rowlabel">Details:</div>
                    <div><input type="text" placeholder="Enter details " name="details" autocomplete="off" value="<?php echo $notice['details'] ?>" required></div>
                </div>
               

                <label>Status:</label>
                <select name="status">
                    <option value="1" <?php if ($notice['status'] == 1) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if ($notice['status'] == 0) echo 'selected'; ?>>Inactive</option>
                </select><br>

                <input type="submit" value="Update">
            </form>
    </div>
    <div class="col-md-2" ></div>
</div>    
