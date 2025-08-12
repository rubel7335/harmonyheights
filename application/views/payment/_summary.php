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

   
     <table class="table-striped table-bordered table-condensed" id="employee_list" style="width: 100%;font-family: monospace;" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>               
                <th>Amount</th>
            </tr>
        </thead>
      

        
<?php foreach ($payments as $payment_item): ?>
        <tr>
            <td><?php echo $payment_item['personal_id']; ?></td>
            <td>
                <?php
                         foreach ($person as $per):
                         if($payment_item['personal_id'] === $per['id']){  echo $per['fullname']; }
                            endforeach;
                ?>
            </td>
           
           
            
            <td><?php echo $payment_item['total_amount']; ?></td>
          
          
            
            
        </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row col-md-1"></div>

</div>

 


