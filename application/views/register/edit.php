<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('page/edit/'.$page_item['id']); ?>
    <table>
        <tr>
            <td><label for="title">ID</label></td>
            <td><input type="input" disabled="true" name="id" size="50" value="<?php echo $page_item['id'] ?>" /></td>
        </tr>

        <tr>
            <td><label for="title">Name</label></td>
            <td><input type="input" name="name" size="50" value="<?php echo $page_item['name'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">URL Controller</label></td>
            <td><input type="input" name="url_controller" size="50" value="<?php echo $page_item['url_controller'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">URL Action</label></td>
            <td><input type="input" name="url_action" size="50" value="<?php echo $page_item['url_action'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" value="<?php echo $page_item['remarks'] ?>" /></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Update" /></td>
        </tr>
    </table>
</form>
