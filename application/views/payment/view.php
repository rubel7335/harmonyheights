<div id="dataContainer" class="row">
<div class="row col-md-3"></div>
<div class="row col-md-6">
     <h2><?php echo "Payment detail information"; ?></h2>
<table class="table-striped table-bordered">
        <tr>
            <td>Payment ID</td>
            <td><?php echo $payment_item['id']; ?></td>
        </tr>   
        <tr>           
                <td>Name</td>
                <td><?php 
                  foreach ($person as $per):
                         if($payment_item['personal_id'] === $per['id']){  echo $per['fullname']; }
                            endforeach;
                
                ?></td>
        </tr>
        <tr>
                <td>Installment</td>
                <td>
                    <?php 
                 $installment_id= $payment_item['installment_id'];
                    
                                   
            foreach ($installments as $installment):
                if($installment_id === $installment['id']){
                echo $installment['name'];}
                 endforeach;
                    
                    
                    ?>
                </td>
        </tr>
        <tr>        
            <td>Deposit info</td>
            <?php  $deposit_date = date('d-M-Y', strtotime($payment_item['deposit_date']));?>
             <td><?php 
            echo " <img width='400px' height='400px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/payment/".$payment_item['image_url']."'> ";
            echo "<br>Slip no:".$payment_item['deposit_slip_no']; 
            echo "<br>Deposit date:".$deposit_date;
                
                ?></td>
        </tr>
       
        <tr>                 
                <td>Amount</td>
                <td><?php echo $payment_item['deposit_amount']; ?></td>
        </tr>
        
        <tr>                 
                <td>Bank</td>                
                <td><?php echo $payment_item['bankname']; ?></td>
        </tr>
        <tr>                 
                <td>Branch</td>
                <td><?php echo $payment_item['branchname']; ?></td>
        </tr>
        <tr>                 
                <td>Initiated by</td>
                 <?php  $make_time = date('d-m-Y', strtotime($payment_item['make_time']));?>
                <td><?php if($payment_item['make_by']){echo $payment_item['make_by']." at ".$make_time;} ?></td>
        </tr>
        <tr> 
                <td>Approved by</td>
                <?php  $check_time = date('d-m-Y', strtotime($payment_item['check_time']));?>
                <td><?php if($payment_item['check_by']){echo $payment_item['check_by']." at ".$check_time;} ?></td>
        </tr>
        <tr>                 
                <td>Reject info</td>
                <?php  $reject_time = date('d-m-Y', strtotime($payment_item['reject_time']));?>
                <td><?php if($payment_item['reject_by']){echo $payment_item['reject_by']." at ".$reject_time."because ".$payment_item['reject_cause'];} ?></td>
        </tr>
        <tr>                 
                <td>Status</td>
                 <?php  if($payment_item['status']==='0'){?><td class="alert alert-warning"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> Pending</td><?php  } ?>          
                 <?php  if($payment_item['status']==='2'){?><td class="alert alert-success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span><span><strong> Approved</strong></span></td><?php  } ?>
        </tr>
        <tr>                 
                <td>Remarks</td>
                <td><?php echo $payment_item['remarks']; ?></td>
        </tr>      
                
    
    
</table>
</div>
<div class="row col-md-3"></div>

</div>

 


