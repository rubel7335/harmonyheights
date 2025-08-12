
<div  class="row" id="dataContainer">
        <div class="row col-md-3"></div>
        <div class="row col-md-6" style="padding:10px;" >
            <?php echo validation_errors(); ?> 
            <?php echo form_open('usercatpage/create'); ?>
                <div class="row" >  
                    <div  style="text-align: center;">  
                        <p class="text-info text-center text-uppercase"> Page permission </p>
                    </div>     
                </div>
            
                <div class="inner_container">
                    <div >
                        <div class=" col-md-2 rowlabel">User Category</div>
                            <div>
                                    <select class="form-control" name="category">
                                    <?php 
                                    foreach($usercategories as $row)
                                        { ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option> 
                                        <?php            
                                        }
                                    ?>
                                    </select>  
                            </div>
                        </div>
                    <div >

                    <div class=" col-md-2 rowlabel">Pages</div>
                        <div>
                            <select multiple class="form-control" name="pages[]">
                                <?php 
                                foreach($pages as $row)
                                    { ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option> 
                                    <?php            
                                    }
                                ?>
                            </select> 
                        </div>
                    </div>
                    

                    
                    <div  >
                        <div class="rowlabel">Remarks</div>
                        <div><input type="text" placeholder="Enter Remarks" name="remarks" autocomplete="off" required></div>
                    </div>
                    
                    <div  >
                        <button type="submit" id="btnregistersubmit" name="submit" >ADD</button>
                        <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
                    </div>

                    <div  style="background-color:#f1f1f1">         
                        <a href="<?php echo site_url('home') ?>"><button type="button" class="cancelbtn">Cancel</button> </a>        
                    </div>
            </form>
            </div>
        </div>
        <div class="row col-md-3"></div>
</div>