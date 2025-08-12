<div id="dataContainer" class="row">
<div class="row col-md-1"></div>
<div class="row col-md-10">
<?php echo validation_errors(); ?>
    <h2><?php echo $title; ?></h2>
 
<?php echo form_open('category/create'); ?>    
    <table>

        <tr>
            <td><label for="title">Category Name</label></td>
            <td><input type="input" name="name" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">Remarks</label></td>
            <td><textarea name="remarks" rows="10" cols="40"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="ADD" /></td>
        </tr>
    </table>    
</form>
</div>
<div class="row col-md-1"></div>

</div>