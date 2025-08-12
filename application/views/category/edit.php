<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
<?php $id= base64_encode($category_item['id']);?>
<?php echo form_open('category/edit/'.$id); ?>
    <table>
        <tr>
            <td><label for="title">Category Name</label></td>
            <td><input type="input" name="name" size="50" value="<?php echo $category_item['category_name'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="text">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" value="<?php echo $category_item['remarks'] ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Update" /></td>
        </tr>
    </table>
</form>
