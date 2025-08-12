<div id="dataContainer" class="row col-md-12">
<div class="row col-md-1"></div>
<div class="row col-md-10">

<h2><?php echo $title; ?></h2> 
<?php echo validation_errors(); ?> 
<?php $id= base64_encode($branch_item['id'])?>
<?php echo form_open('branch/edit/'.$id); ?>
    <table>
        <tr>
            <td><label for="title">ID</label></td>
            <td><input type="input" name="id" size="50" value="<?php echo $branch_item['id'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">Name</label></td>
            <td><input type="input" name="name" size="50" value="<?php echo $branch_item['branch_name'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="text">Address</label></td>
            <td><textarea name="address" rows="5" cols="50"><?php echo $branch_item['branch_business_address'] ?></textarea></td>
        </tr>
        <tr>
            <td><label for="text">FI Name</label></td>
            <td>
            <select  name="fi">
            <?php 
            foreach($fis as $row)
            { ?>
               <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option> 
            <?php            
            }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td><label for="title">Fax</label></td>
            <td><input type="input" name="fax_num" size="50" value="<?php echo $branch_item['fax_num'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">Telephone</label></td>
            <td><input type="input" name="tel_num" size="50" value="<?php echo $branch_item['tel_num'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="title">Remarks</label></td>
            <td><input type="input" name="remarks" size="50" value="<?php echo $branch_item['remarks'] ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Update" /></td>
        </tr>
    </table>
</form>
</div>
</div>
