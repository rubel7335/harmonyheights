<div  id="dataContainer" class="row"  style="font-family: monospace;">
<div class="col-md-1"></div>
<div class="col-md-10" style="padding:10px; border: #000 solid 1px;margin:20px;">

<p style="text-align: center;" >
<span class="text-uppercase" style="font-size:16px;">
<?php
if($salary_entry['nominee_full_name']){echo $salary_entry['nominee_full_name'];}else {echo $salary_entry['full_name'];}   
echo "</br>";
?>
</span>
    Pension of <?php 
    
    $month_id = $salary_entry['salary_month'];
                    if($month_id==1){$month = "January";}
                    if($month_id==2){$month = "February";}
                    if($month_id==3){$month = "March";}
                    if($month_id==4){$month = "April";}
                    if($month_id==5){$month = "May";}
                    if($month_id==6){$month = "June";}
                    if($month_id==7){$month = "July";}
                    if($month_id==8){$month = "August";}
                    if($month_id==9){$month = "September";}
                    if($month_id==10){$month = "October";}
                    if($month_id==11){$month = "November";}
                    if($month_id==12){$month = "December";}   
    echo $month.", ".$salary_entry['salary_year']."</br>";?>
    Type: <?php echo $salary_entry['salary_type'];?>
</p>
<table class="table-bordered"  style="width: 50%" cellspacing="0">
            <thead>
            <tr>
                <th style="background: #E0E2FF "colspan="2">Payment information</th>               
            </tr>
            
        </thead>
        <tr >
            <td>Payment method</td>
            <td><?php echo $payment_info['payment_method']; ?> </td>     
        </tr>
        <tr >
            <td>Account no</td>
            <td><?php echo $payment_info['payment_to_account_no']; ?> </td>     
        </tr>
        <tr >
            <td>Payment to Bank-Branch</td>
            <td><?php echo $payment_info['fi_name']."-".$payment_info['branch_name']; ?> </td>     
        </tr>
</table>
<?php echo "</br>";?>      
<table class="table-bordered" id="salary_sheet" style="width: 100%" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 50%;background: #E0E2FF "colspan="2">Pay & Allowances</th>
                <th style="width: 50%;background: #E0E2FF ">Deductions</th>
            </tr>
            
        </thead>
<?php $grand_total = 0;?>        
<?php foreach ($allowances as $allowance_item): ?>
        <tr >
            <td><?php echo $allowance_item['allowance_type'];if($allowance_item['pay_type']=='Areear'){echo "(Areear)";} ?></td>
            <td><?php echo number_format($allowance_item['allowance_amount']); ?> </td>     
        </tr>
        <?php $grand_total+=$allowance_item['allowance_amount'];?>
<?php endforeach; ?>
</table>
<?php echo "</br>";?>    
<table class="table-bordered" id="salary_sheet" style="width: 50%" cellspacing="0">
        <tr>
            <th><?php echo "Grand total" ?></th>
            <td><?php echo $grand_total; ?> </td>   
        </tr>
        <tr>
            <td><?php echo "Total deductions" ?></td>
            <td><?php echo $total_deduction=0.0; ?> </td>   
        </tr>
        <tr>
            <td><?php echo "Payment Amount" ?></td>
            <?php 
            $payment_amount=$grand_total-$total_deduction;
            $str_in_word=convertNumberToWord($payment_amount);?>
            <td><?php echo $payment_amount." (".$str_in_word.")"; ?> </td>   
        </tr>
</table>
<?php echo "</br>";?> 

    
</div>
<div class="row col-md-1"></div>

</div>

 


