<div id="dataContainer" class="row frmContainer" style="font-family: monospace;"> 
            <div class="col-md-6"  style="padding:10px;">
                <p class="btn-default btn-info" onclick="toggle_emp_info()" style="padding:10px;text-align:center;">Equipment / Materials Expense Information</p>  
                <table id="expense_info_container" class="table-striped table-bordered">
                    <tr>
                        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img width='200px' height='200px'  src='". base_url()."upload/equipment/".$eq_expenses['memo_image']."'>";?></td>
                    </tr>
                    <tr><td>Category</td><td colspan="4" style="text-align:center;">
                    <?php 
                        foreach ($all_expense_area as $exp_area):
                             if($exp_area['id']=== $eq_expenses['expense_subarea_id'])
                             {
                                echo $exp_area['title'];
                             }
                    ?>
                <?php endforeach;?> </td></tr>
                    <tr><td>Supplier</td><td colspan="4" style="text-align:center;"><?php echo $title; ?></td></tr>
                    <tr><td>Category</td><td colspan="4" style="text-align:center;"><?php echo $title; ?></td></tr>
                    <tr><td>Category</td><td colspan="4" style="text-align:center;"><?php echo $title; ?></td></tr>
                    <tr><td>Category</td><td colspan="4" style="text-align:center;"><?php echo $title; ?></td></tr>
                    <tr><td>Category</td><td colspan="4" style="text-align:center;"><?php echo $title; ?></td></tr>
                    
                </table>
            </div>
    </div>    
</div>

 


