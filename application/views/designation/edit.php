<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
<?php $id= base64_encode($designation_item['id']);?> 
<?php echo form_open('designation/edit/'.$id); ?>
    <table>
        <tr>
            <td><label for="title">ID</label></td>
            <td><input type="input" disabled="true" name="id" size="50" value="<?php echo $designation_item['id'] ?>" /></td>
        </tr>

        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="input" name="title" size="50" value="<?php echo $designation_item['title'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">Alias</label></td>
            <td><input type="input" name="alias" size="50" value="<?php echo $designation_item['alias'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" value="<?php echo $designation_item['remarks'] ?>" /></td>
        </tr>
        
        <tr>
            <td><label for="title">Grade No</label></td>
            <td><select class="form-control" name="gradeID">
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
            <td><input type="submit" name="submit" value="Update" /></td>
        </tr>
    </table>
</form>
