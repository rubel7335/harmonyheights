
<style>
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
</style>

    <div id="bodyholder" class="row" style="min-height:500px;font-family: monospace; ">
    <!-- <div class="confirm_msg" ><?php echo $this->session->flashdata('confirmation'); ?></div> -->
        <?php if($person){?>
        <div  class="col-md-12">
            <h2><?php echo $title; ?></h2>
            <table class="table table-striped table-bordered  compact hover tbl" id="person_list"  cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl</th>    
                        <th>Photo</th>
                        <th>Fullname</th>
                        <th>Contact no</th>
                        <th>Email</th>
                        <th>Family info</th>
                        <th>Payment</th>   
                        <th>Action</th>
                    </tr>
                </thead>
            
                
                <tfoot>
                    <tr>
                        <th>Sl</th>   
                        <th>Photo</th>
                        <th>Fullname</th>
                        <th>Contact no</th>
                        <th>Email</th>
                        <th>Family info</th>
                        <th>Payment</th>    
                        <th>Action</th>
                    </tr>
                </tfoot>

                
                <?php foreach ($person as $person_item): ?>
                    <tr>
                        
                        <td><?php echo $person_item['id']; ?></td>
                    
                        <td style="text-align: center;" >
                    <?php echo " <img width='100px' height='80px' class='my-avatar' src='". base_url()."upload/".$person_item['image_url']."'> ";?>
                        <?php 
                    //  echo " <img width='100px' height='80px'  border-radius: 50%; src='". base_url()."upload/".$person_item['image_url']."'> ";
                        
                        /* $person_role_id=$person_item['person_role_id'];
                        foreach ($person_roles as $role):
                            if($role['id']=== $person_role_id){echo $role['name']; }
                        endforeach;*/
                        ?> 
                        
                        
                    
                        </td>
                        <td><?php echo $person_item['fullname']; ?></td>
                        <!--<td><?php echo $person_item['flat_no']; ?></td>
                        <td><?php echo $person_item['father_name']; ?></td>
                        <td><?php echo $person_item['mother_name']; ?></td>
                        <td><?php echo $person_item['spouse_name']; ?></td>
                        <td><?php echo $person_item['gender']; ?></td>
                        <td><?php echo $person_item['blood_group']; ?></td>
                        <td><?php echo $person_item['birth_date']; ?></td>
                        <td><?php echo $person_item['present_address']; ?></td>
                        <td><?php echo $person_item['permanent_address']; ?></td>
                        <td><?php echo $person_item['nationality']; ?></td>
                        <td><?php echo $person_item['nid_no']; ?></td>
                        <td><?php echo $person_item['birth_reg_no']; ?></td>
                        <td><?php echo $person_item['passport_no']; ?></td>
                        <td><?php echo $person_item['religion']; ?></td>
                        <td><?php echo $person_item['educational_qualification']; ?></td>
                        <td><?php echo $person_item['organization']; ?></td>
                        <td><?php echo $person_item['designation']; ?></td>
                        <td><?php echo $person_item['office_address']; ?></td>-->
                        <td><?php echo $person_item['contact_no']; ?></td>
                        <td><?php echo $person_item['email']; ?></td>

                        
                        <?php 
                        $person_id= base64_encode($person_item['id']);
                        ?>
                        <td>  
                                <a href="<?php echo site_url('nominee/create/'.$person_id); ?>" class="btn">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                    <span>Add</span>            
                                </a>
                            
                                <a href="<?php echo site_url('nominee/get_nominee_id/'.$person_id); ?>" class="btn">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    <span>View</span>            
                                </a>

                        </td>
                        <td>
                                <a href="<?php echo site_url('payment/create/'.$person_id); ?>" class="btn">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                    <span>Add</span>            
                                </a>
                                <a href="<?php echo site_url('payment/get_payment_info_by_personid/'.$person_id); ?>" class="btn">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    <span>View</span>            
                                </a>


                        </td>
                        
                        <td>      
                            
                            
                                <a href="<?php echo site_url('person/view/'.$person_id); ?>" class="btn">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    <span>View</span>            
                                </a>
                                <a href="<?php echo site_url('person/edit/'.$person_id); ?>" class="btn">
                                    <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    <span>Edit</span>            
                                </a>

                        

                        <!--
                            <?php if($usercat==1){?>| 
                            <a href="<?php echo site_url('person/delete/'.$person_id); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                            <?php }?>
                            -->
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
   
            <p class="frmContainer" style="margin:5px;float:right; display: none;">        
                    <span ><input type="button" class="btn btn-info" id="accept_btn"  value="Accept"></span>            
                    <span ><input type="button" class="btn btn-danger" id="reject_btn"  value="Reject"></span> 
            </p>
        </div>
    <?php }else{?>
        <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
    <?php   }?>
    </div>
 

