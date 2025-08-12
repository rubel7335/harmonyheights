
<style>
.my-avatar2 {
   // background-image: url('images/emu.jpg');
    background-image: url(<?php echo  base_url()."upload/appimg/"."1.jpg"; ?>); 
    background-size: cover;
    background-position: center ;
    height: 12vw;
    width: 12vw;
    padding: 3px;
    border-radius: 10%;
}
.my-avatar {
   // background-image: url('images/emu.jpg');
    background-image: url(<?php echo  base_url()."upload/appimg/"."1.jpg"; ?>); 
    background-size: cover;
    background-position: center ;
    height: 5vw;
    width: 5vw;
    padding: 2px;
    border-radius: 50%;
}
    
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


<?php $person_id=base64_encode($person_id);?>
<!-- <div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div> -->
<div id="dataContainer" class="row frmContainer" style="font-family: monospace;">
 
<div class="col-md-5"  style="padding:10px;">
    <p class="btn-default btn-info" onclick="toggle_emp_info()" style="padding:10px;text-align:center;">Personal information<span>    
                    <a href="<?php echo site_url('person/edit/'.$person_id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a></span>
    </p>  

<table id="employee_info_container" class="table-striped table-bordered">
    <tr>
        
    </tr>
    <tr>
        <td colspan="6" style="padding:10px; text-align:center"> <?php echo "<img  class='my-avatar2' src='". base_url()."upload/".$person_item['image_url']."'>";?></td>
    </tr>
    <tr><td colspan="6" style="text-align:center;"><?php echo $title."[ Personal id:".$person_item['id']." ]"; ?></td></tr>
       
    <tr>    
        <td><strong>Roles</strong></td>
        <td><?php 
        // $person_role_id=$person_item['person_role_id']; 
         foreach($person_roles as $row)
            {  
             //   echo  $row['role_id'];
                foreach($roles as $role){
                    if($role['id']==$row['role_id']){
                        echo $role['name']."</br>";
                    }
                }
            }
            
        ?></td>
    </tr>
                          
    <tr>    
        <td><strong>Flat no</strong></td>
        <td><?php echo $person_item['flat_no']; ?></td>
    </tr>
    <tr>    
        <td><strong>Father name</strong></td>
        <td><?php echo $person_item['father_name']; ?></td>
    </tr>
    <tr>     
        <td><strong>Mother name</strong></td>
        <td><?php echo $person_item['mother_name']; ?></td> 
    </tr>
    
    <tr>    
        <td><strong>Spouse name</strong></td>
        <td><?php echo $person_item['spouse_name']; ?></td> 
    </tr>
    <tr> 
        <td><strong>Birthdate</strong></td>
        <td>
        <?php
       
        $birth_date = $person_item['birth_date'];
       if ($birth_date){
           echo $birth_date = date('d-m-Y', strtotime($birth_date));
       }else{
          echo    $birth_date; 
       }?>
      
        </td> 

    </tr>
    <tr>    
        <td><strong>Gender</strong></td>
        <td><?php echo $person_item['gender']; ?></td> 
            </tr>
    <tr> 
        <td><strong>Blood group</strong></td>
        <td><?php echo $person_item['blood_group']; ?></td>

    </tr>
     <tr>    
        <td><strong>Present address</strong></td>
        <td><?php echo $person_item['present_address']; ?></td>    
            </tr>
    <tr> 
        <td><strong>Permanent address</strong></td>
        <td><?php echo $person_item['permanent_address']; ?></td>

    </tr>
    
     <tr>    
        <td><strong>Nationality</strong></td>
        <td><?php echo $person_item['nationality']; ?></td> 
            </tr>
    <tr> 
        <td><strong>NID no</strong></td>
        <td><?php echo $person_item['nid_no']; ?></td>
     </tr>
     
    <tr>    
        <td><strong>Birth reg. no</strong></td>
        <td><?php echo $person_item['birth_reg_no']; ?></td>   
            </tr>
    <tr> 
        <td><strong>Passport no</strong></td>
        <td><?php echo $person_item['passport_no']; ?></td>
     </tr>
     
     
    <tr>    
        <td><strong>Religion</strong></td>
        <td><?php echo $person_item['religion']; ?></td> 
            </tr>
    <tr> 
        <td><strong>Educational qualification</strong></td>
        <td><?php echo $person_item['educational_qualification']; ?></td>
     </tr>
     
    <tr>    
        <td><strong>Organization</strong></td>
        <td><?php echo $person_item['organization']; ?></td> 
            </tr>
    <tr> 
        <td><strong>Designation</strong></td>
        <td><?php echo $person_item['designation']; ?></td>
     </tr>
     
    <tr>    
        <td><strong>Office address</strong></td>
        <td><?php echo $person_item['office_address']; ?></td> 
            </tr>
    <tr> 
                <td><strong>Tin no</strong></td>
        <td><?php echo $person_item['tin_no']; ?></td>
     </tr>


    <tr>
        <td><strong>Contact no</strong></td>
        <td ><?php echo $person_item['contact_no']; ?></td>    
            </tr>
    <tr> 
        <td><strong>E-mail</strong></td>
        <td><?php echo $person_item['email']; ?></td>    
    </tr>
  </table>
</div>

<div class="col-md-7" style="padding:10px;">
    <p class="btn-info" onclick="toggle_emp_nominee_info()" style="padding:10px;text-align:center;">Family members
                <span>
                    <a href="<?php echo site_url('nominee/create/'.$person_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span><strong>Add</strong></span>            
                    </a>
                </span>
        </p>
<div id="emp_nominee_info_container">     
<?php if($nominees){?>
<table class="table table-striped table-bordered  compact hover" id="nominee_list" style="width: 100%" cellspacing="0">
        <thead>

    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Relation </strong></td>
        <td><strong>Share %</strong></td>   
        <td><strong>Action</strong></td>
    </tr> 

        </thead>


<?php foreach ($nominees as $nominee_item): ?>
        <tr>
            <td><?php echo $nominee_item['id']; ?></td>
            <td><?php echo "<img class='my-avatar'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";
            echo "</br>".$nominee_item['fullname']; ?>
            </td>
            <td><?php echo $nominee_item['relation']; ?></td> 
            <td><?php echo $nominee_item['share_percentage']; ?></td> 
            <?php $id= base64_encode($nominee_item['id']);?>
            <td>
                                
                    <a href="<?php echo site_url('nominee/view/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>
                    <a href="<?php echo site_url('nominee/edit/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>
         
            </td>
        </tr>
<?php endforeach; ?>
</table>
 <?php }else{?>
    <p class="btn btn-default" ><?php
     echo "Family information not found";
     }?>
    </p>
    </div>
</div>    
    
<div class="col-md-7" style="padding:10px;">
    <p class="btn-info" onclick="toggle_payment_info()" style="padding:10px;text-align:center;">Payment info
                <span>
                    <a href="<?php echo site_url('payment/create/'.$person_id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span><strong>Add payment</strong></span>            
                    </a>
                </span>
        </p>
<div id="payment_info_container">     
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
                <th>Cr./ Dr.</th> -->
                <!-- <th>Slip image</th> -->
                <th>Bank-Branch</th>
                <th>Status</th>
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
            
            <td>               
                        <?php                         
                        $deposit_date = $payment_item['deposit_date'];
                        if ($deposit_date){
                            echo $deposit_date = date('d-m-Y', strtotime($deposit_date));
                        }else{
                            echo    $deposit_date ; 
                        }?>            
            </td>

           
            <td><?php $debitCredit=$payment_item['payment_type'];if($debitCredit =='Credit'){echo $payment_item['deposit_amount'];$credits=$credits+$payment_item['deposit_amount']; }else {echo "";} ?> </td>
            <td><?php $debitCredit=$payment_item['payment_type'];if($debitCredit =='Debit'){echo $payment_item['deposit_amount']; $debits=$debits+$payment_item['deposit_amount'];}else {echo "";} ?> </td>
                
          
            <!-- <td>
                <?php 
                    echo " <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src='". base_url()."upload/payment/".$payment_item['image_url']."'> ";
                    echo $payment_item['deposit_slip_no'];            
                ?>
            </td> -->
            <td><?php echo $payment_item['bankname']."</br>".$payment_item['branchname']; ?></td>
           
           <?php $id = base64_encode($payment_item['id']);  ?>
           <?php  if($payment_item['status']==='0'){?>
                        <td class="alert alert-warning"><span class="glyphicon glyphicon-hourglass " ></span> Pending</td>
            <?php  } ?>          
            <?php  if($payment_item['status']==='2'){?>
                            <td >
                                <span class="glyphicon glyphicon-check"> </span>Approved                                
                                <span class="glyphicon glyphicon-download "></span><a  href="<?php echo site_url('payment/download/'.$id); ?>" target="_blank" > Download Receipt</a>  
                 
                                                      
                                
                            </td>
            <?php  } ?>
            <?php  if($payment_item['status']==='2'){?>
                       
                      
      <?php  } ?>
          
            
         
            <td>
            
            </br>
                <div class="tooltip-container">
                                            <a href="#" class="tooltip-link">Memo</a>
                                            <div class="tooltip">
                                                <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src="<?= base_url()."upload/payment/".$payment_item['image_url'] ?>">
                                                <br>
                                                <?= $payment_item['deposit_slip_no'] ?>
                                            </div>
                </div>
                       
                <a href="<?php echo site_url('payment/view/'.$id); ?>" >
                    <span><strong>Details</strong></span>            
                </a>
                </br>
                <?php  if($payment_item['status']!=='2'){?>
                <a href="<?php echo site_url('payment/edit/'.$id); ?>" >
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <span><strong>Edit</strong></span>            
                </a>                                   
                <?php  } ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <tfoot>
                    <tr>
                        <th  colspan="3" style="text-align:right;font-weight:bold;">Total</th>
                        <th style="font-weight:bold;"><?php echo $credits;?></th>
                        <th style="font-weight:bold;"><?php echo $debits;?></th>                      
                        <th colspan="5"></th>
                     
                    </tr>
                    <tr>
                        
                        <th  colspan="3" style="text-align:right;font-weight:bold;">Total Amount taka</th>
                        <th style="font-weight:bold;"><?php echo $credits-$debits;?></th>
                        <th colspan="6"></th>
                    </tr>
                </tfoot>

</table>
      <?php }else{?>
    <p class="btn btn-default" ><?php
     echo "Payment information not found";
     }?>
    </p>
 
    </div>
</div>        

        
  
</div>

 


