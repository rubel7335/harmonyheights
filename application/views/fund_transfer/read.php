
<!-- application/views/fund_transfer/read.php -->
<div  id="dataContainer" class="row"  style="font-family: monospace; ">
    <div class="row col-md-1"></div>
        <div class="row col-md-10">
        <table class="table-striped table-bordered" id="payment_all_list" style="width: 100%;font-family: monospace;" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Transfer date </th>
                    <th>Amount</th>
                    <th>Purpose</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <th>Transferred to</th>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            <?php $credits=0;$debits=0;?>   
                <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= $record->id ?></td>
                    <td><?= $record->payment_date ?></td>
                    <td><?= $record->amount ?></td>
                    <td><?= $record->purpose ?></td>
                    <td><?php $debitCredit=$record->payment_type;if($debitCredit =='Credit'){echo $record->amount;$credits=$credits+$record->amount; }else {echo "";} ?> </td>
                    <td><?php $debitCredit=$record->payment_type;if($debitCredit =='Debit'){echo $record->amount;$debits=$debits+$record->amount; }else {echo "";} ?> </td>
                    <td> 
                        <?php 
                           foreach($management as $row)
                           { 
                            if($record->reciever_id===$row['id']){ echo $row['fullname'];}                                     
                           }
                        ?> 
                     </td>
                    <td><?= anchor('fundtransfer/update/' . $record->id, 'Edit', 'class="edit-link"') ?></td>
                </tr>  
                <?php endforeach; ?>
                <tfoot>
                    <tr>
                        <!-- <th></th>
                        <th></th> -->
                        <th  colspan="4" style="text-align:right;font-weight:bold;">Total</th>
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
                        <th  colspan="4" style="text-align:right;font-weight:bold;">Total Amount taka</th>
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
            </tbody>   
            </table>  
        </div>
    <div class="row col-md-1"></div>
</div>
