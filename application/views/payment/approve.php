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

   
     <table class="table-striped table-bordered table-condensed" id="payment_all_list" style="width: 100%;font-family: monospace;" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Installment</th>
                <th>Amount</th>
                <!-- <th>Deposit info</th> -->
                <th>Bank-Branch</th>
                <th>Status</th>
                <th>Remarks</th>
                <td>Action</td>
            </tr>
        </thead>
      

        
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
            <td><?php 
             foreach ($installments as $ins):
                         if($payment_item['installment_id'] === $ins['id']){  echo $ins['name']; }
                            endforeach;
          //  echo $payment_item['installment_id']; 
            ?></td>
           
            
            <td><?php echo $payment_item['deposit_amount']; ?></td>
            <!-- <td>
            
                <span id="slipImage" ><?php echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/payment/".$payment_item['image_url']."'> ";?></span>
            <?php
                echo "</br> Slip no:".$payment_item['deposit_slip_no'];
                echo "</br> Date: ".$payment_item['deposit_date']; 
            ?>
            </td> -->
            <td><?php echo $payment_item['bankname'];  echo "</br>".$payment_item['branchname']; ?></td>

            <?php  if($payment_item['status']==='0'){?><td class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Pending</td><?php  } ?>          
            <?php  if($payment_item['status']==='2'){?><td class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span><strong> Approved</strong></span></td><?php  } ?>
            <td><?php echo $payment_item['remarks']; ?></td>
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
                    <span><strong>Details</strong></span>            
                </a>
                    <?php  if($payment_item['status']==='0'){?>
                        <a href="<?php echo site_url('payment/approve/'.$id); ?>" class="btn btn-success a-btn-slide-text">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <span><strong>Approve</strong></span>            
                        </a>
                    <?php }?>
            </td>
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


