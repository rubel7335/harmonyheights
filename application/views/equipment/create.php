
<div  id="dataContainer" class="row" style="font-family: monospace;">

    <div > 
            <?php
                    $attributes = array(
                        'id' => 'EquipmentCreate', // Set the id attribute here
                    );
                    echo form_open_multipart('equipment/create', $attributes);
            ?>
            <?= form_hidden('exp_id', 'hidden_field_value'); ?>
            <div  class="col-md-3"> </div>

            <div class="col-md-6" style="background: #ebebeb; padding:10px;">  
                    <div class="btn btn-success col-md-6" style="width: 100%">Equipments / Materials purchase</div>
                    <div class="row">    
                        <div  class="col-md-6">
                            <div class="form-group"><?php $classID =1; ?>
                            <label for="expense_subarea_id">Category <a href="<?= site_url('expense_subarea/create/'.$classID) ?>">[ + ]</a></label>  
                                <select class="form-control" name="expense_subarea_id" id="expense_subarea_id">
                                    <?php foreach($expense_types as $row)
                                            {   ?>
                                                    <option value="<?php echo $row['id'];?>" <?php echo set_select('expense_subarea_id',  $row['id']); ?>> <?php echo $row['title'];?> </option> 
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div  class="col-md-6">
                            <div class="form-group">
                                <label for="supplier_id">Supplier / Vendor <a href="<?= site_url('supplier_info/create') ?>">[ + ]</a></label> 
                                    <select class="form-control" name="supplier_id" id="supplier_id">
                                            <?php 
                                                foreach($suppliers as $row)
                                                { ?>
                                                    <option value="<?php echo $row['id'];?>" <?php echo set_select('supplier_id',  $row['id']); ?>> <?php echo $row['name'];?> </option> 
                                                <?php            
                                                }
                                            ?>
                                    </select>
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div  class="col-md-6">
                            <div class="form-group">
                                <label for="purchase_date">Date of purchase</label>
                                <input type="text" id="purchase_date" name="purchase_date" id="purchase_date" required value="<?php echo isset($_POST['purchase_date']) ? htmlspecialchars($_POST['purchase_date'], ENT_QUOTES) : ''; ?>">
                            </div>
                        </div>
                
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_amount">Total amount</label>
                                    <input type="text"   placeholder="Enter total amount" name="total_amount" id="total_amount"  value="<?php echo isset($_POST['total_amount']) ? htmlspecialchars($_POST['total_amount'], ENT_QUOTES) : ''; ?>">
                                </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="memo_no">Memo no</label>
                                <input type="text"   placeholder="Enter memo" name="memo_no" id="memo_no"  autocomplete="off"  required value="<?php echo isset($_POST['memo_no']) ? htmlspecialchars($_POST['memo_no'], ENT_QUOTES) : ''; ?>">
                            </div>
                    </div>
                
                    <div class="col-md-6" >
                        <div class="form-group">
                        <label for="image_file">Memo </label>   
                            <input type="file" name="memo_image" id="memo_image" onchange="return checkPhotoFile(this)"  />            
                                <img id="display_memo" src="<?php echo base_url()."upload/demo.jpg"; ?>" alt='your photo' width="200"/> 
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-6">   
                        <div class="form-group">
                            <label for="purchase_type">Purchase type</label>            
                            <select class="form-control" name="purchase_type"  id="purchase_type">                
                                <option value="direct" <?php echo (isset($_POST['purchase_type']) && $_POST['purchase_type'] === 'direct') ? 'selected' : ''; ?>>Direct / Cash (No due)</option>
                                <option value="advance" <?php echo (isset($_POST['purchase_type']) && $_POST['purchase_type'] === 'advance') ? 'selected' : ''; ?>>Advance (Product due)</option>
                                <option value="credit" <?php echo (isset($_POST['purchase_type']) && $_POST['purchase_type'] === 'credit') ? 'selected' : ''; ?>>Credit (Payment due)</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-md-6">   
                        <div class="form-group">
                            <label for="paid_unpaid">Paid / Unpaid</label>            
                                <select class="form-control" name="paid_unpaid"  id="paid_unpaid">  
                                    <option value="1" <?php echo (isset($_POST['paid_unpaid']) && $_POST['paid_unpaid'] === '1') ? 'selected' : ''; ?>> Paid</option>
                                    <option value="0" <?php echo (isset($_POST['paid_unpaid']) && $_POST['paid_unpaid'] === '0') ? 'selected' : ''; ?>> Unpaid</option>
                                </select>
                        </div>
                    </div> 
            </div>

                <div class="row">        
                    <div  class="col-md-6">            
                        <div class="form-group">
                            <label for="purchase_by_person_id">Purchase by</label>
                            <select class="form-control" name="purchase_by_person_id" id="purchase_by_person_id" >
                                <?php 
                                    foreach($mgm_users_info as $row){ 
                                        echo $row['id'];
                                    // foreach ($person as $per): 
                                            if((isset($_POST['purchase_by_person_id']) && $_POST['purchase_by_person_id'] === $row['id'])){?>
                                            <option value="<?php echo $row['id'];?>" selected="selected" > <?php echo $row['fullname'];?> </option> 
                                            <?php     
                                            }else{?>   
                                                    <option value="<?php echo $row['id'];?>"  > <?php echo $row['fullname'];?> </option> 
                                            <?php }                                    
                                    }?>     
                            </select>
                        </div>
                    </div>  
                
                    <div class="col-md-6" >
                        <div class="form-group">   
                            <label for="remarks">Remarks</label> 
                            <input type="text" placeholder="Enter Remarks" name="remarks" id="remarks" value="<?php echo isset($_POST['remarks']) ? htmlspecialchars($_POST['remarks'], ENT_QUOTES) : ''; ?>">
                        </div>
                    </div>  
                </div>  
        
                <div class="col-md-12" >            
                    <div  style="text-align: center;width:100%">
                        <button type="submit" class="btn btn-info" name="submit"  >Add Expense</button>       
                    </div>
                </div>
              

            <div  class="col-md-3">
                <div class="row">    
                    <div id="errordisplayArea">
                            <?php echo validation_errors(); ?> 
                            <p ><?php echo @$error_photo;?></p>
                    </div>
                </div>    
            </div>    
            
        </div> 
        <?php if ($this->session->flashdata('confirmation')): ?>
                        <div class="confirm_msg"><?php echo $this->session->flashdata('confirmation'); ?></div>
                        <?php $this->session->unset_userdata('confirmation'); ?> <!-- Clear flash data after displaying -->
        <?php endif; ?>

        <div style="padding:10px;display:none;" >   
            <div  class="col-md-12">    
                <div class="row" >
                    <div  class="col-md-12" style="">
                        <?php if($eq_expenses){?>

                            <h2><?php echo $title; ?></h2>
                            <form action="php_checkbox.php" method="post">
                            <table class="table table-striped table-bordered  compact hover tbl" id="employee_list"  cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Purchase date</th>
                                        <th>Total amount</th>   
                                        <!-- <th>Memo </th> -->
                                        <th>Paid / Unpaid</th>
                                        <th>Purchase by</th>  
                                        <th>Purchase type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Purchase date</th>
                                        <th>Total amount</th>                
                                        <!-- <th>Memo </th> -->
                                        <th>Paid / Unpaid</th>
                                        <th>Purchase by</th>
                                        <th>Purchase type</th>                
                                        <th>Status</th>
                                        <th>Action</th>              
                                    </tr>
                                </tfoot>

                                
                                <?php $sl=1;foreach ($eq_expenses as $eq_expenses_item): ?>
                                        <tr>
                                            <td><?php echo $sl++;?></td>
                                            
                                        
                                                <?php 
                                                foreach ($expense_types as $exp_area):
                                                if($exp_area['id']=== $eq_expenses_item['expense_subarea_id']){?>
                                            <td><?php echo $exp_area['title'];?></td><?php }?>
                                                <?php endforeach;?>  
                                                
                                                
                                                <?php
                                                foreach ($suppliers as $supplier):
                                                if($supplier['id']=== $eq_expenses_item['supplier_id']){?>
                                            <td><?php echo $supplier['name'];?></td><?php }?>
                                                <?php endforeach;?>  

                                            <td><?php echo $purchase_date = date('d-m-Y', strtotime($eq_expenses_item['purchase_date']));?></td> 
                                            <td><?php echo $eq_expenses_item['total_amount']; ?></td>
                                            <!-- <td>
                                        
                                                <span class='img_memo'>  <?php echo " <img  width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/equipment/".$eq_expenses_item['memo_image']."'> ";?>
                                            </span> 
                                                <div class='memo_no'><?php echo "</br>".$eq_expenses_item['memo_no'];?></div>
                                            </td>             -->
                                            <td>
                                                <?php  
                                                    $paid_unpaid=$eq_expenses_item['paid_unpaid'];
                                                    if($paid_unpaid==='0'){echo "Unpaid";}
                                                    if($paid_unpaid==='1'){echo "Paid";}
                                                ?>
                                            </td>
                                            
                                                            <?php 
                                                            foreach ($person as $per):
                                                                    if($per['id']=== $eq_expenses_item['purchase_by_person_id']){?>
                                                                        <td><?php echo $per['fullname'];?></td><?php }
                                                                endforeach;?>  
                                            
                                            
                                            
                                            

                                            
                                            <td>
                                                <?php                              
                                                    $purchase_type=$eq_expenses_item['purchase_type'];
                                                        if($purchase_type==='direct'){echo "Direct / Cash";}
                                                        if($purchase_type==='advance'){echo "Advance";}
                                                        if($purchase_type==='credit'){echo "Credit";}
                                                    ?>
                                            </td>
                                        
                                            <td><?php  if($eq_expenses_item['status']){echo "Confirmed";};if(!($eq_expenses_item['status'])){echo "Pending";}; ?></td>
                                            <?php 
                                            
                                        // $eq_expenses_id= base64_encode($eq_expenses_item['expense_subarea_id']);
                                            $eq_expenses_id= base64_encode($eq_expenses_item['id']);
                                            
                                            
                                            
                                            ?>

                                            <td>
                                                    <a  href="<?php echo site_url('equipmentdetail/create/'.$eq_expenses_id); ?>" class="btn">
                                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                        <span>Add / view details</span>            
                                                    </a>
                                                <a style="display: none;" href="<?php echo site_url('equipmentdetail/get_detailexpense_id/'.$eq_expenses_id); ?>" class="btn">
                                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                                        <span>View details</span>            
                                                    </a>
                                            </td>   

                                        </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <?php }else{?>
                            <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
                        <?php   }?>
                    </div>
                </div>

    
            </div>
        </div>
</div>



<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
                    var reader = new FileReader();            
                    reader.onload = function (e) {
                        $('#display_memo').attr('src', e.target.result);//where to display
                    }
                    reader.readAsDataURL(input.files[0]);
                }
        }
        $("#memo_image").change(function(){ //event
            readURL(this);
        });

        $(document).ready(function(){               
                 $("#purchase_date").datepicker({ dateFormat: 'dd-mm-yy' }).datepicker("setDate", "+0");
            });

                 

    document.getElementById('EquipmentCreate').addEventListener('submit', function () {
        // Show the loading indicator when the form is submitted
            e.preventDefault();
            document.getElementById('btnExpenseCreateSubmit').textContent = 'Submitting...';
        });
</script>
