
<div  class="row" id="dataContainer">
                <div class="row" >  
                    <div  style="text-align: center;">  
                        <p class="text-info text-center text-uppercase"> Expense category assign </p>
                    </div>     
                </div>

        
        <div class="col-md-12" style="padding:10px;" >
    
            <?php echo form_open('expensecatpage/create'); ?>
                
            
      
                    <div class="col-md-2" >
                        <div class="rowlabel">Expense Category</div>
                            <div>
                                    <select class="form-control" name="category">
                                        <?php 
                                        foreach($expense_subarea as $row)
                                            { ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option> 
                                            <?php            
                                            }
                                        ?>
                                    </select>  
                            </div>
                        </div>
                    
                    <div class="col-md-6" >
                    <div class="rowlabel">Expenses</div>
                            <select multiple class="form-control" name="expenses[]" style="min-height:400px;">
                                <?php 
                                foreach($all_expenses as $row)
                                    { ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['id'].") ".$row['description'];?></option> 
                                    <?php            
                                    }
                                ?>
                            </select> 
                    </div>
                    

                    
                    
                    
                    <div  >
                        <button type="submit" id="btnregistersubmit" name="submit" >ADD</button>
                        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
                    </div>

                    
            </form>
            </div>
        </div>
       


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Attach change event to expense_subarea dropdown
        $('#expense_subarea').change(function () {
            // Get the selected expense_subarea value
            var selectedSubareaId = $(this).val();
            
            // Make an AJAX request to fetch corresponding expense IDs
            $.ajax({
                url: '/your_controller/get_expense_ids', // Replace with your actual URL
                type: 'POST',
                data: {subarea_id: selectedSubareaId},
                dataType: 'json',
                success: function (response) {
                    // Deselect all options in expenses dropdown
                    $('#expenses option').prop('selected', false);

                    // Select corresponding options in expenses dropdown based on fetched expense IDs
                    $.each(response.expense_ids, function (index, expenseId) {
                        $('#expenses option[value="' + expenseId + '"]').prop('selected', true);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error: ' + error);
                }
            });
        });
    });
</script>
