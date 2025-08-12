<div  id="dataContainer" class="row" style="font-family: monospace; min-height: 450px; ">
    <?php echo form_open('employee/expired_emp_list'); ?>
    <?php echo validation_errors(); ?> 
    <div class="col-md-12" >
        
            <div class="col-md-3"></div>  
            <div class="col-md-6" >
                <div style="padding: 5px; background:  #F2F3FF">  
                <div class="row">
                    <div class="col-md-12" >
                        <ul class="list-group-item-info" style="text-align: center;padding: 10px;font-size: 16px; font-weight: bold;">Employee Proof of alive / Life certificate </ul>
                    </div> 
                </div> 
                <div class="row">     
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label for="date_from">Date from</label>
                                <input type="text"  name="date_from" id="date_from" value="<?php echo isset($_POST['date_from']) ? htmlspecialchars($_POST['date_from'], ENT_QUOTES) : ''; ?>" />
                            </div>
                        </div>

                        <div class="col-md-6" >
                            <div class="form-group">
                                <label for="date_to">Date to</label>
                                <input type="text"  name="date_to" id="date_to"  value="<?php echo isset($_POST['date_to']) ? htmlspecialchars($_POST['date_to'], ENT_QUOTES) : ''; ?>" />
                            </div>
                        </div>
                    </div> 
                <div class="row">
                        <div class="col-md-6" >
                            <button type="submit" name="submit" value="Search" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-6" >
                            <a href="<?php echo site_url('employee') ?>"><button type="button" class="btn btn-danger">Cancel</button> </a>
                        </div>
                </div>
                </div>
            </div>    
            <div class="col-md-3"></div> 
        
    </div>
</div>


<script>   
    $(document).ready(function(){ 
        $("#date_from").datepicker({ dateFormat: 'dd-mm-yy' }); $("#date_to").datepicker({ dateFormat: 'dd-mm-yy' });
    });
</script>