<style>
        .tooltip-container {
                position: relative;
                display: inline-block;
            }

        .tooltip {
                visibility: hidden;
                position: absolute;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                color: #333;
                padding: 10px;
                z-index: 1;
                min-width: 150px;
                top: 100%;
                left: 0;
                opacity: 0;
                transition: opacity 0.3s;
            }

        .tooltip-link:hover + .tooltip {
                visibility: visible;
                opacity: 1;
            }

</style>
 
 
 <?php 

 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $pages = $this->session->userdata('pages'); 
 ?> 


<div  id="dataContainer" class="row" style="min-height:500px;">
    <div class="row col-md-1"></div>
    <div class="row col-md-10">
        <h2><?php echo $title; ?></h2>    
        <table class="table-striped table-bordered" id="payment_all_list" style="width: 100%;font-family: monospace;" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name </th>
                    <th>Installment</th>
                    <th>Deposit Date</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <!-- <th>Deposit slip & no</th> -->
                    <th>Bank -Branch</th>
                    <th>Status</th>
                    <!--
                    <th>Initiated by</th>
                    <th>Approved by</th>
                    <th>Remarks</th>
                    -->
                    <td>Action</td>
                </tr>
            </thead>
        <?php $credits=0;$debits=0;?>        
        <?php foreach ($payments as $payment_item): ?>
                <tr>
                    <td><?php echo $payment_item['id']; ?></td>
                    <td>
                        <?php
                            foreach ($person as $per):
                                    if($payment_item['personal_id'] === $per['id']){  echo $per['fullname']; }
                            endforeach;
                        ?>
                    </td>
                    <td>
                        <?php 
                            foreach ($installments as $ins):
                                if($payment_item['installment_id'] === $ins['id']){  echo $ins['name']; }
                            endforeach;         
                        ?>
                    </td>
                    <td>
                        <?php echo $deposit_date = date('d-M-Y', strtotime($payment_item['deposit_date']));?>
                    </td>
                    <td><?php $debitCredit=$payment_item['payment_type'];if($debitCredit =='Credit'){echo $payment_item['deposit_amount'];$credits=$credits+$payment_item['deposit_amount']; }else {echo "";} ?> </td>
                    <td><?php $debitCredit=$payment_item['payment_type'];if($debitCredit =='Debit'){echo $payment_item['deposit_amount']; $debits=$debits+$payment_item['deposit_amount'];}else {echo "";} ?> </td>
                
                    
                    <!-- <td><?php echo $payment_item['deposit_amount']; ?></td>
                    <td><?php echo $payment_item['payment_type']; ?></td> -->
                    <!-- <td>
                        <?php
                            echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/payment/".$payment_item['image_url']."'> ";
                            echo "</br> Slip no:".$payment_item['deposit_slip_no'];                    
                        ?>
                    </td> -->
                    <td><?php echo $payment_item['bankname'];  echo "</br>".$payment_item['branchname']; ?></td>


                        <?php  if($payment_item['status']==='0'){?><td class="alert alert-warning"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> Pending</td><?php  } ?>          
                        <?php  if($payment_item['status']==='2'){?><td class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong> Approved</strong></span></td><?php  } ?>
                        <!--
                        <td><?php echo $payment_item['make_by']; ?></td>
                        <td><?php echo $payment_item['check_by']; ?></td>          
                        <td><?php echo $payment_item['remarks']; ?></td> 
                        -->
                    <?php 
                    $id = base64_encode($payment_item['id']);
                    ?>

                    
                    <td>   
                        <div class="tooltip-container">
                                            <a href="#" class="tooltip-link">Memo</a>
                                            <div class="tooltip">
                                                <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src="<?= base_url()."upload/payment/".$payment_item['image_url'] ?>">
                                                <br>
                                                <?= $payment_item['deposit_slip_no'] ?>
                                            </div>
                        </div> 
                        </br>   
                        <a href="<?php echo site_url('payment/view/'.$id); ?>" >
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            <span><strong>View</strong></span>            
                        </a>
                        </br>
                        <a href="<?php echo site_url('payment/edit/'.$id); ?>">
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
        </table>
    </div>

    
    <div class="row col-md-1"></div>
</div>

 


