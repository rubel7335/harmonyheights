
<div  id="dataContainer" class="row"  style="font-family: monospace;">    
    <div class="col-md-2"></div>
    <?php if (isset($expdetails) && !empty($expdetails)) {?>
    <div class="col-md-8" style="padding:5px;">
            <div class="col-md-12" style="padding:10px; background: #F2F3FF;">
                <?php
                    foreach ($suppliers as $supplier):
                    if($supplier['id']=== $eq_expenses_byid['supplier_id']){?>
                    <p style="text-align: center;font-weight: bold; font-size: 20px;"> <?php echo $supplier['name'];?></p><?php }
                    endforeach; ?>                    
                    <p style="text-align: center;"><?php echo "Purchase date:".$eq_expenses_byid['purchase_date']; ?> <?php echo "</br>Memo no:".$eq_expenses_byid['memo_no'];?></p>
            </div> 

        
                <table class="table table-striped table-bordered  compact"   cellspacing="0">
                    <thead>
                        <tr style="background: #EBE1F9;">
                            <th>Sl</th>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Unit price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>   
                            <th>Action</th>              
                        </tr>
                    </thead>
                    <?php $sl=1;$subtotal=0;foreach ($expdetails as $eq_expenses_item): ?>
                    <tr>
                        <td><?php echo $sl++;?></td>  
                        <td>
                            <?php 
                            //echo $eq_expenses_item['item'];                
                            foreach ($all_items as $item):
                                if($item['id']=== $eq_expenses_item['item'])
                                    { 
                                    echo $item['title'];
                                    }
                                endforeach;
                            ?> 
                        </td>            
                        <td><?php 
                        //echo $eq_expenses_item['unit_id'];
                            foreach ($units as $unit):
                                if($unit['id']=== $eq_expenses_item['unit_id'])
                                    { 
                                    echo $unit['alias'];
                                    }
                                endforeach;
                        ?></td>
                        <td><?php echo $eq_expenses_item['unit_price'];?></td>
                        <td><?php echo $eq_expenses_item['quantity'];?></td>
                        <td><?php echo $eq_expenses_item['subtotal'];$subtotal=$subtotal+$eq_expenses_item['subtotal'];?></td>
                        <td>  
                            <?php
                                $stock_flag = $eq_expenses_item['stock_flag'];
                            ?>  
                            <?php 
                            if($stock_flag>0){ ?> 
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong> Stock in</strong></span> 
                             <?php   
                             }else{?>
                                  <button type="button" style="text-align:center;" class="btn btn-info" id="btnStockIn"    onclick="alertRowId(<?php echo $eq_expenses_item['id']; ?>)" >Add to stock</button>   
                            <?php    }
                            ?>                 
                            
                        </td>
                        <?php endforeach;?>  
                    </tr>

                    <tr style="background: #EBE1F9;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight:bold;text-align: right">Grand total</td>
                        <td style="font-weight:bold"><?php echo $subtotal;?></td>
                    </tr>
                </table>
      </div>
        <div class="col-md-2"></div>      
        <?php }
        else{?>
            <div class="col-md-12">
                <?php
                    foreach ($suppliers as $supplier):
                    if($supplier['id']=== $eq_expenses_byid['supplier_id']){?>
                    <p style="text-align: center;font-weight: bold; font-size: 20px;"> <?php echo $supplier['name'];?></p><?php }
                    endforeach; ?>                    
                    <p style="text-align: center;"><?php echo "Purchase date:".$eq_expenses_byid['purchase_date']; ?> <?php echo "</br>Memo no:".$eq_expenses_byid['memo_no'];?></p>
            </div> 
            
     <p style="text-align:center;"> Details information not included</p>




    <?php   }?>

    <div class="row">
        <div id="errordisplayArea">
            <?php echo validation_errors(); ?>
        </div>
    </div>  

    
    <div class="col-md-12" style="padding:15px;">
        <div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>
    </div>

    <div class="col-md-2" ></div>
<div class="col-md-8" style="padding:15px; background:#FFEEFF">
  <?php echo form_open_multipart('equipmentdetail/create/'.base64_encode($parent_id)); ?>
            <input type="hidden"    name="parent_id" value="<?php echo $parent_id;?>"></input>
            <input type="hidden"    name="grand_parent_id" value="1"></input>
           
                <div class="btn btn-success col-md-12">Equipments / Materials purchase</div>
                            <div  class="row col-md-12">                                  
                                    <div  class="col-md-2">
                                            <div class="rowlabel">Select item</div>       
                                                <select class="form-control" name="item">
                                                    <?php 
                                                    foreach($items as $row)
                                                        { ?>
                                                            <option value="<?php echo $row['id'];?>" <?php echo set_select('item',  $row['id']); ?>> <?php echo $row['title'];?> </option> 
                                                        <?php            
                                                        }
                                                    ?>
                                                </select>
                                    </div>                             
                                    <div  class="col-md-2">
                                                <div class="rowlabel">Unit</div>        
                                                <select class="form-control" name="unit_id">
                                                        <?php 
                                                        foreach($units as $row)
                                                            { ?>
                                                                    <option value="<?php echo $row['id'];?>" <?php echo set_select('unit_id',  $row['id']); ?>> <?php echo $row['alias'];?> </option> 
                                                            <?php            
                                                            }
                                                        ?>
                                                </select>
                                    </div >                                
                                    <div  class="col-md-2">                           
                                        <div class="rowlabel">Quantity</div>    
                                            <input type="text" class="form-control" placeholder="Quantity" id="quantity" name="quantity" required <?php echo form_input('quantity', set_value('quantity')); ?></input>        
                                        </div>
                                    
                                
                                    <div  class="col-md-2">  
                                            <div class="rowlabel">Unit price</div>    
                                            <input type="text" class="form-control" placeholder="Unit price" id="unit_price" name="unit_price" required <?php echo form_input('unit_price', set_value('unit_price')); ?></input>        
                                    </div> 
                                    <div  class="col-md-2"> 
                                        <div class="rowlabel">Sub total </div>
                                        <input type="text"  class="form-control" placeholder="Enter total amount" name="subtotal" autocomplete="off"  required <?php echo form_input('subtotal', set_value('subtotal')); ?></input>
                                    </div>
                                    <div  class="col-md-2"> 
                                                <div class="rowlabel">Remarks</div>
                                                <input type="text" class="form-control" placeholder="Remarks" name="remarks" autocomplete="off"  <?php echo form_input('remarks', set_value('remarks')); ?></input>
                                </div>
                            </div>  
                            <div class="col-md-4" ></div>
                            <div  class="col-md-3" style="text-align:center;"> 
                                            <button type="submit" style="text-align:center;" class="form-control btn btn-success" id="btnregistersubmit" name="submit" value="Save" >Add</button> 
                            </div>          
                </div>    
                      
</div>
 </div>


 <script>

    function alertRowId(id){
      //  alert(id);
        var userConfirmed = window.confirm("Are you sure you want to proceed?");

        // Check if the user confirmed or canceled
        if (userConfirmed) {
           // alert("You confirmed the action.");
            $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('equipmentdetail/updateRecord') ;?>', // URL mapped to the updateRecord method
                    data: { id: id},
                    success: function (response) {
                        alert(response); // Display success/error message
                        location.reload();
                    },
                    error: function (error) {
                        alert('Error updating record');
                    }
                });
        } else {
            alert("You canceled the action.");
        }

    }

</script>



