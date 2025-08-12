<?php
?>


<div class="row col-md-3"></div>
<div class="row col-md-6" style="padding:20px;" id="dataContainer">
    <div class="frmContainer">
        <div class="row" >  
        <div  style="text-align: center;">  
            <p>Pension basic information of</p>
        <?php   echo " <img width='120px' height='100px' style='border: #004ab3 solid thin; padding:8px;' src='". base_url()."upload/".$employee['image_url']."'> ";?>
            
            <p style="padding: 10px; color: royalblue;font-weight: bold; font-size: 16px;" ><?php echo $employee['full_name']."<br> (SAP :".$employee['sap_id'].",PPO :".$employee['ppo_no']." )";?></p>
        </div>     
        </div>   
    </div>

<table class="table-striped table-bordered">

    <tr>    
        <td><strong>Pension Basic</strong></td>
        <td><?php echo number_format($pension_item['pension_basic']); ?></td>
    </tr>
    <tr>    
        <td><strong>Last increment date</strong></td>
        <td><?php echo $pension_item['last_increment_date']; ?></td>
    </tr>
    <tr>    
        <td><strong>Next increment date</strong></td>
        <td><?php echo $pension_item['next_increment_date']; ?></td>
    </tr>
    <tr>    
        <td><strong>Fixation date</strong></td>
        <td><?php echo $pension_item['fixation_date']; ?></td>
    </tr>
  
    <tr>     
        <td><strong>Remarks</strong></td>
        <td><?php echo $pension_item['remarks']; ?></td>
    </tr>
    <tr>
        <td><strong>Payment method</strong></td>
        <td><?php echo $pension_item['payment_method']; ?></td>  
    </tr>

    <tr>    
        <td><strong>Payment to account no</strong></td>
          <td><?php echo $pension_item['payment_to_account_no']; ?></td>
    </tr>
    <tr>    
        <td><strong>Payment to Bank</strong></td>
                <?php foreach ($fis as $bank):
                if($bank['id']=== $pension_item['payment_to_bank_id']){?>
        <td><?php echo $bank['name'];?></td><?php }?>
                <?php endforeach;?> 
        
    </tr>

    <tr>    
        <td><strong>Payment to Branch</strong></td> 
            <?php foreach ($branches as $branch):
                if($branch['id']=== $pension_item['payment_to_branch_id']){?>
            <td><?php echo $branch['branch_name'];?></td><?php }?>
            <?php endforeach;?>
    </tr>
    

</table>

<div class="row col-md-3"></div>

</div>

 


