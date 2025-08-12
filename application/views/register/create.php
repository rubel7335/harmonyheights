<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('page/create'); ?>    
<table class="table-bordered table-condensed">
        
        <tr>
            <td><label for="title">Name</label></td>
            <td><input type="input" name="name" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">URL Controller</label></td>
            <td><input type="input" name="url_controller" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">URL Action</label></td>
            <td><input type="input" name="url_action" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" /></td>
        </tr>
        <tr>

        
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="ADD" /></td>
        </tr>
    </table>    
</form>