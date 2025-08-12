
<div  id="dataContainer" class="row"  style="font-family: monospace;min-height:450px;">    

    <div class="col-md-2"></div>
    <?php if (isset($expdetails) && !empty($expdetails)) {?>
    <div class="col-md-8" style="padding:5px;">

    <h2><?php echo "Current stock report"; ?></h2>
        
                <table class="table table-striped table-bordered  compact"   cellspacing="0">
                    <thead>
                        <tr style="background: #EBE1F9;">
                            <th>Sl</th>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Quantity</th>        
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
                        
                        <td><?php echo $eq_expenses_item['Quantity'];?></td>
                        <!-- <td>  
                            <?php
                            $stock_flag = $eq_expenses_item['stock_flag'];                           
                            if($stock_flag>0){ ?> 
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong> Stock in</strong></span> 
                             <?php   
                             }else{?>
                                  <button type="button" style="text-align:center;" class="btn btn-info" id="btnStockIn"    onclick="alertRowId(<?php echo $eq_expenses_item['id']; ?>)" >Add to stock</button>   
                            <?php    }
                            ?>                 
                            
                        </td> -->
                        <?php endforeach;?>  
                    </tr>

                    <!-- <tr style="background: #EBE1F9;">
                        <td></td>
                        <td></td>
                        <td style="font-weight:bold;text-align: right">Grand total</td>
                        <td style="font-weight:bold"><?php echo $subtotal;?></td>
                    </tr> -->
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




    <div class="col-md-2" ></div>

 </div>






