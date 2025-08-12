<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('designation/create'); ?>    
<table class="table-bordered table-condensed">
        
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="input" name="title" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">Alias</label></td>
            <td><input type="input" name="alias" size="50" /></td>
        </tr>
        <tr>
            <td><label for="text">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" /></td>
        </tr>
        <tr>
        <td><label for="text">Grade </label></td>
            <td>
            <select class="form-control" name="gradeID">
            <?php 
            foreach($grades as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option> 
            <?php            
            }
            ?>
            </select> 
            </td>
        </tr>
        
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="ADD" /></td>
        </tr>
    </table>    
</form>