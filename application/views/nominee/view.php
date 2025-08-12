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
</style>


<?php $nominee_id=base64_encode($nominee_id);?>
<div id="dataContainer" class="row frmContainer">
    <div class="col-md-2" style="padding:10px;"></div>
<div class="col-md-8" style="padding:10px;">

 
<table  id="nominee_info_container" class="table-striped table-bordered table-condensed">
    <tr><td colspan="4"  class="btn-info" style="text-align:center;"><span  style="padding:10px; text-align: center;">Nominee / Dependant's Information</span></td></tr>
    <tr>
        <td colspan="4" style="padding:10px; text-align:center"> <?php echo "<img class='my-avatar2'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";?></td>
    </tr>
    <tr style="display: none;">
        <td><strong>ID</strong></td>
        <td><?php echo $nominee_item['id']; ?></td> 
        <td><strong>Shareholder ID</strong></td>
        <td><?php echo $nominee_item['personal_id']; ?></td>
    </tr>
    

    
    <tr>
        <td><strong>Full Name</strong></td>
        <td ><?php echo $nominee_item['fullname']; ?></td>
        <td><strong>Educational qualification</strong></td>
        <td colspan="4"><?php echo $nominee_item['educational_qualification']; ?></td>
    </tr>
    <tr>
        <td><strong>Relation</strong></td>
        <td><?php echo $nominee_item['relation']; ?></td>   
        <td><strong>Share percentage</strong></td>
        <td><?php echo $nominee_item['share_percentage']; ?></td>
    </tr>
    <tr>      
         <td><strong>Gender</strong></td>
        <td><?php echo $nominee_item['gender']; ?></td>
        <td><strong>Blood group</strong></td>        
        <td><?php echo $nominee_item['blood_group']; ?></td>
    </tr>
    <tr>      
        <td><strong>Marital status</strong></td>
        <td><?php echo $nominee_item['marital_status']; ?></td>  
        <td><strong>Birth date</strong></td>                        
        <td><?php echo    $birth_date = date('d-m-Y', strtotime($nominee_item['birth_date']));?></td>
    </tr>
    <tr>    
        <td><strong>Present Address</strong></td>
          <td><?php echo $nominee_item['present_address']; ?></td>   
        <td><strong>Permanent Address</strong></td>        
        <td><?php echo $nominee_item['permanent_address']; ?></td>
    </tr>
    <tr>
        <td><strong>NID no</strong></td>
        <td><?php echo $nominee_item['nid_no']; ?></td> 
        <td><strong>Birth registration no</strong></td>
        <td><?php echo $nominee_item['birth_reg_no']; ?></td>
    </tr>
    <tr>      
        <td><strong>Passport no</strong></td>
        <td><?php echo $nominee_item['passport_no']; ?></td>
          <td><strong>Religion</strong></td>
        <td><?php echo $nominee_item['religion']; ?></td>
    </tr>
    <tr>
        <td><strong>Organization</strong></td>
        <td><?php echo $nominee_item['organization']; ?></td>
        <td><strong>Designation</strong></td>
        <td><?php echo $nominee_item['designation']; ?></td>
    </tr>
    <tr> 
        <td><strong>Office_address</strong></td>
        <td ><?php echo $nominee_item['office_address']; ?></td>  
        <td><strong>Contact no</strong></td>
        <td ><?php echo $nominee_item['contact_no']; ?></td> 
    </tr>
    <tr>    
         <td><strong>E-mail</strong></td>
        <td><?php echo $nominee_item['email']; ?></td>
    </tr>






</table>
</div>
<div class="col-md-2" style="padding:10px;"></div>

</div>    
</div>

 


