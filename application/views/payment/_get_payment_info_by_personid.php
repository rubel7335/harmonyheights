<div id="dataContainer" class="row" style="min-height:400px">

<div class="col-md-1"></div>
<div class="col-md-10">
    
     
    <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:5px;margin-top:10px;"> Payment information of</br>
    <?php 
        echo "<img width='70px' height='60px'  src='". base_url()."upload/".$person_image."'>";
        echo  "</br>".$person_name; 
    ?>
        </p>
        
<?php if($payments){?>   
     <table class="table-striped table-bordered" id="payment_all_list" style="width: 100%;font-family: monospace;" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>Installment</th>                
                <th>Deposit date</th>
                <th>Credit</th>
                <th>Debit</th>
                <!-- <th>Amount</th>
                <th>Cr. / Dr.</th> -->
                <th>Slip image</th>
                <th>Bank </br>Branch</th>
                <th>Status</th>
                <th>Remarks</th>
                <td>Action</td>
            </tr>
        </thead>

<?php $credits=0;$debits=0;?>
        
<?php foreach ($payments as $payment_item): ?>
        <tr>           
            <td><?php echo $payment_item['id']; ?></td>            
            <td>
                <?php 
          
                    $installment_id= $payment_item['installment_id'];
                    foreach ($installments as $installment):
                        if($installment_id === $installment['id']){
                            echo $installment['name'];}
                    endforeach;
                ?>
            </td>
            
            <td><?php echo $payment_item['deposit_date']; ?></td>
            <td><?php $debitCredit=$payment_item['payment_type'];if($debitCredit =='Credit'){echo $payment_item['deposit_amount'];$credits=$credits+$payment_item['deposit_amount']; }else {echo "";} ?> </td>
            <td><?php $debitCredit=$payment_item['payment_type'];if($debitCredit =='Debit'){echo $payment_item['deposit_amount']; $debits=$debits+$payment_item['deposit_amount'];}else {echo "";} ?> </td>
            <!-- <td><?php echo $payment_item['deposit_amount']; ?></td>
            <td><?php echo $payment_item['payment_type']; ?></td> -->
            <td><?php 
              echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/payment/".$payment_item['image_url']."'> ";
              echo $payment_item['deposit_slip_no'];
            
            ?>
            </td>
            <td><?php echo $payment_item['bankname']."</br>".$payment_item['branchname']; ?></td>
            <td>
                <?php 
                $status= $payment_item['status']; 
                    if($status ==='0'){echo "Submitted by user";}
                    if($status ==='1'){echo "Pending at maker";}
                    if($status ==='2'){echo "Pending at checker";}            
                    if($status ==='3'){echo "Rejected for ".$payment_item['reject_cause'];}
                ?>
            </td>
            <td><?php echo $payment_item['remarks']; ?></td>
            <?php 
                $id = base64_encode($payment_item['id']);
            ?>
            <td >       
                <a  href="<?php echo site_url('payment/view/'.$id); ?>" >
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    <span><strong>View</strong></span>            
                </a>
            <?php echo "</br>";?>    
                <a  href="<?php echo site_url('payment/edit/'.$id); ?>" >
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <span><strong>Edit</strong></span>            
                </a>                                   

            </td>
        </tr>
<?php endforeach; ?>

        <tfoot>
            <tr>
                <!-- <th></th>
                <th></th> -->
                <th  colspan="3" style="text-align:right;font-weight:bold;">Total</th>
                <th style="font-weight:bold;"><?php echo $credits;?></th>
                <th style="font-weight:bold;"><?php echo $debits;?></th>
                <!-- <th>Amount</th>
                <th>Cr. / Dr.</th> -->
                <th colspan="5"></th>
                <!-- <th></th>                
                <th></th>
                <th></th>
                <td></td> -->
            </tr>
            <tr>
                <!-- <th></th>
                <th></th> -->
                <th  colspan="3" style="text-align:right;font-weight:bold;">Total Amount taka</th>
                <th style="font-weight:bold;"><?php echo $credits-$debits;?></th>
                <!-- <th>Amount</th>
                <th>Cr. / Dr.</th> -->
                <th colspan="6"></th>
                <!-- <th></th>                
                <th></th>
                <th></th>
                <td></td> -->
            </tr>
        </tfoot>
</table>


</div>

  <?php }else{?>
     <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin-bottom:10px;"> No payment information added</p>
  <?php   }?>

</div>
<div class="col-md-1"></div>

</div>

 


