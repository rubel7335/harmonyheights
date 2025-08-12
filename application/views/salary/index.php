 <?php 
 $this->load->library('session'); 
 $username = $this->session->userdata('username'); 
 $usercat = $this->session->userdata('usercat'); 
 $pages = $this->session->userdata('pages'); 

      /*  $current_year = date("Y"); 
        $current_month = ltrim(date("m"),'0');
        $month = date("M");*/
echo @$current_month;
?> 

<?php if(empty($current_month)){?>
<div  class="col-md-12" id="dataContainer">
<p style="background-color:#f1f1f1;text-align: center; padding:5px">
    Rollback to regenerate Pension for current month
</p>

<div  style="text-align: center">         
    <a href="<?php echo site_url('rollback/employee_salary') ?>"><button type="button" class="cancelbtn" onclick="return confirm('Are you sure to Rollback ?')" >Rollback</button> </a>
</div>
</div>
<?php }?>
<div  id="dataContainer" class="row"  style="font-family: monospace;">
<div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div>

<?php echo validation_errors(); ?> 
<?php echo form_open('salary/search'); ?>
  
    <div class="col-md-2">
        <div class="rowlabel">Month</div>
            <select class="form-control " name="salary_month" id="salary_month">                       
               <option value="1">January</option>
               <option value="2">February</option>
               <option value="3">March</option>
               <option value="4">April</option>
               <option value="5">May</option>
               <option value="6">June</option>
               <option value="7">July</option>
               <option value="8">August</option>
               <option value="9">September</option>
               <option value="10">October</option>
               <option value="11">November</option>
               <option value="12">December</option>
            </select>
             <script type="text/javascript">
                $("#salary_month").val("<?php echo $_POST['salary_month'];?>");
             </script>
    </div>
    <div class="col-md-2">
       <div class="rowlabel col-md-3">Year</div>
             <select class="form-control " name="salary_year">  
                 <?php 
                 for($year=2017;$year<2099;$year++){?>                                 
                <option value="<?php echo $year?>" <?php echo set_select('salary_year',  $year); ?> ><?php echo $year;?></option>
                 <?php }?>
             </select>
    </div>
    <div  class="col-md-2" >     
        <div  class="rowlabel">
            <button type="submit"  id="btnsalsubmit" name="submit">Search</button>
            <img hidden="true" class="imgcontainer" src="<?php echo base_url('assets/appimages/loading.gif');?>" />
        </div>
</div>  


<?php if(!empty($salary_entries)){?>

<div class="col-md-12">
    <div style="background: #F2F3FF;text-align:center;font-weight:bold; padding:5px; margin-left:350px;margin-right:350px;margin-bottom:10px;margin-top:10px;">
        <?php 
        echo $header1."</br>".$title."</br>".$header2;        
        ?>
    </div>
</div>     
<div class="col-md-12">  
     <table class="table-striped table-bordered display compact" id="salary_list" style="width: 100%;" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Month,year</th>
                <th>Payment method</th> 
                <th>Account no.</th>
                 <th>Bank</th> 
                <th>Branch</th>
                <th>Allowance</th>
                <th>Gross Amount</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SL</th>
                <th>Name <br> Cell No</th>
                <th>Month,year</th>
                <th>Payment method</th>
                <th>Account no.</th>
                <th>Bank</th> 
                <th>Branch</th>
                <th>Allowance</th>
                <th>Gross Amount</th>
                <th>Status</th>
                
            </tr>
        </tfoot>

        
<?php foreach ($salary_entries as $salary_item): ?>
        <tr>
            
            <td></td>
            <td><?php 
            if($salary_item['Nominee_Name']){
                echo $salary_item['Nominee_Name']."<br/>"."[".ucfirst($salary_item['relation'])." of ".$salary_item['full_name']."]";
            }else  echo $salary_item['full_name']; 
            ?><br><span class="text-muted" style="font-size:10px;"><?php echo "Contact No: ".$salary_item['cell_phone'];?></span>
            <br><span  style="font-size:12px;"><?php echo "SAP: ".$salary_item['sap_id'];?></span>
            </td>
         
            <td>    
                   <?php 
                    $month_id = $salary_item['salary_month'];
                    ?><?php // echo ", ".$salary_item['salary_year']; 
                    echo date('M', mktime(0, 0, 0, $month_id, 10)).", ".$salary_item['salary_year']; 
                    ?>
            </td>
            
            
            <td><?php echo $salary_item['payment_method']; ?></td>
            <td><?php echo $salary_item['payment_to_account_no']; ?></td>
            <td><?php echo $salary_item['fi_name'];?></td>
            <td><?php echo $salary_item['branch_name']; ?></td>
            <td nowrap><?php echo $salary_item['Allowances']; ?></td>   
            <td><?php echo number_format($salary_item['gross_amount']); ?></td> 
            <?php 
                $id = base64_encode($salary_item['salary_id']);
                $emp_id= base64_encode($salary_item['employee_id']);
                $nom_id= base64_encode($salary_item['nominee_id']);
            ?>
            <td>
                <p class="btn-default">
                    <?php  if($salary_item['status']){echo "<span>Accepted";};if(!($salary_item['status'])){echo "Initiated";}; ?>
                </p>
                <p>
                    <a href="<?php echo site_url('salary/view/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span>Details</span>            
                    </a>
                </p>
            </td>            
            <td>
                    <a href="<?php echo site_url('salary/add_areear/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        <span>Add Arrear</span>            
                    </a>
            </td>

        </tr>
<?php endforeach; ?>
</table>
</div>
<?php
            }
?>
<?php if(empty($salary_entries)){?> 
    
<div class="col-md-12" style="height:400px;">
        <div class="negatedMessageBox">
        <?php 
        echo $title." is not generated";
        ?>
    </div>
</div> 
    
<?php
            }
?>    
</div>



 



