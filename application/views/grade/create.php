<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('grade/create'); ?>    
    <table>
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="input" name="title" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" /></td>
        </tr>
        <tr>
            <label class="custom-control custom-radio">
                <input id="active" name="active_inactive" type="radio" value="1" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Active</span>
            </label>
            <label class="custom-control custom-radio">
              <input id="inactive" name="active_inactive" type="radio" value="0" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Inactive</span>
            </label>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="ADD" /></td>
        </tr>
    </table>    
</form>