<style>
.dropdown-menu {
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.3s;
}

.nav.navbar-nav li:hover .dropdown-menu {
    transform: scaleY(1);
}
</style>


<div id="dataContainer" class="row">
 <?php
 date_default_timezone_set("Asia/Dhaka");
 $this->load->library('session');
 $username = $this->session->userdata('username');
 $usercat = $this->session->userdata('usercat');
 $pages = $this->session->userdata('pages');
 $page_list=array();
    foreach($pages as $page)
    {
        $page_list[]= $page['url_action'];
    }
 // print_r($page_list);
 $userID = $this->session->userdata('userID');
 $peronal_id = $this->session->userdata('peronal_id');
 $peronal_id = base64_encode($peronal_id);
 $password_cng_flg = $this->session->userdata('password_cng_flag');
 $days_interval = $this->session->userdata('days_interval');
 $last_login_timestamp = $this->session->userdata('last_login_timestamp');


/*
if(isset($_SESSION['username'])){
     echo "Now".$timeNow = date('Y-m-d H:i:s');
     echo "Logged in at:".$last_login_timestamp;
}
else{
    echo "No user loggedIn";
} */
//echo "<br>Diff:".$diff =  $last_login_timestamp - time();
// echo "Now".time();


 ?>
        <ul  class="nav navbar-nav" >
                <li>
                        <?php if(!$username){?>
                        <li role="presentation"><a style="display:none;" role="menuitem" href="<?php echo site_url('login') ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <?php }?>
                        
                        <li class="dropdown "><a class="dropdown-toggle" id="dropAcc" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> <?php echo $username;?> <b class="caret"></b></a>
                            <ul data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" class="dropdown-menu" role="menu" aria-labelledby="dropAcc">
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('person/view/'.$peronal_id) ?>"><span class="glyphicon glyphicon-th-list"></span> My Account</a></li>
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('changepassword') ?>"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li>
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            </ul>
                        </li>
                </li>
                <?php if (in_array("user", $page_list))  {?>
                        <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> User Module <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">  
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('membership') ?>"><span class="glyphicon glyphicon-list"></span> Members</a></li>
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('membership/create') ?>"><span class="glyphicon glyphicon-list"></span> Add Member</a></li>
                                <!-- <li role="presentation"><a role="menuitem" href="<?php echo site_url('user') ?>"><span class="glyphicon glyphicon-list"></span> Lists</a></li> -->
                                <?php if (in_array("user/create", $page_list))  {?>   
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('user/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add a user</a></li>
                                <?php }?>                
                                <?php if (in_array("category", $page_list))  {?>   
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('category') ?>"><span class="glyphicon glyphicon-plus"></span> User category</a></li>
                                <?php }?>                 
                                <?php if (in_array("category/create", $page_list))  {?>   
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('category/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add a category</a></li>
                                <?php }?> 
                            </ul>
                        </li>        
                <?php }?>          
                <?php if (in_array("person", $page_list))  {?>
                        <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Personal info <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">
                            
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('person') ?>"><span class="glyphicon glyphicon-list"></span> Lists</a></li>
                                <?php if (in_array("person/create", $page_list))  {?>   
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('person/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add a person</a></li>
                                <?php }?> 
                            </ul>
                        </li>            
                <?php }?> 
                <?php if (in_array("equipment", $page_list))  {?> 
                            <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Purchase / Expenses<b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">      
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('expense/incomeexpense') ?>"><span class="glyphicon glyphicon-list"></span> Income Expense statememnt</a></li>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('expense/index') ?>"><span class="glyphicon glyphicon-list"></span> All expenses</a></li>
                                    <li     role="presentation"><a role="menuitem" href="<?php echo site_url('expense/approval') ?>"><span class="glyphicon glyphicon-plus"></span> Approve expense</a></li> 
                                            <li     role="presentation"><a role="menuitem" href="<?php echo site_url('expense/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add new expense</a></li>       
                                            <li     role="presentation"><a role="menuitem" href="<?php echo site_url('salaryexpense/index') ?>"><span class="glyphicon glyphicon-list"></span> All salary payments</a></li>
                                            <li     role="presentation"><a role="menuitem" href="<?php echo site_url('salaryexpense/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add salary payments</a></li>
                                    </ul>
                            </li>
                <?php }?> 
                <?php if (in_array("equipment", $page_list))  {?> 
                            <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Materials Purchase / Expenses<b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp"> 
                                            <li     role="presentation"><a role="menuitem" href="<?php echo site_url('equipment/index') ?>"><span class="glyphicon glyphicon-list"></span> All materials purchase</a></li>
                                            <li     role="presentation"><a role="menuitem" href="<?php echo site_url('equipment/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add  materials purchase</a></li>
                                            <li  role="presentation"><a role="menuitem" href="<?php echo site_url('equipment/currentstock') ?>"><span class="glyphicon glyphicon-list"></span> Current stock</a></li>
                                    </ul>
                            </li>
                <?php }?> 
                <?php if (in_array("fundtransfer", $page_list))  {?> 

                            <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Fund management<b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">   
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('FundTransfer/currentbalance') ?>"><span class="glyphicon glyphicon-list"></span> Cash in hand</a></li>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('FundTransfer/read') ?>"><span class="glyphicon glyphicon-list"></span> Cash withdraw report</a></li>
                                    <li role="presentation"><a role="menuitem" href="<?php echo site_url('FundTransfer/create') ?>"><span class="glyphicon glyphicon-list"></span> Cash withdraw from account</a></li>
                                </ul>
                            </li>
            
                <?php }?> 

                <?php if (in_array("stock", $page_list))  {?> 
                    <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Stock <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">             
                                <li  role="presentation"><a role="menuitem" href="<?php echo site_url('equipment/currentstock') ?>"><span class="glyphicon glyphicon-list"></span> Current stock</a></li>
                        </ul>
                    </li> 
                <?php }?> 
                <?php if (in_array("notice", $page_list))  {?> 
                    <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Notice <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">             
                                <li  role="presentation"><a role="menuitem" href="<?php echo site_url('notice') ?>"><span class="glyphicon glyphicon-list"></span> Notices</a></li>
                                <li  role="presentation"><a role="menuitem" href="<?php echo site_url('notice/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add new notice</a></li>
                         </ul>
                    </li> 
                <?php }?> 

                <?php if (in_array("payment", $page_list))  {?>        
                    <li class="dropdown "><a class="dropdown-toggle" id="dropEmp" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Shareholder payments <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropEmp">             
                            <li  role="presentation"><a role="menuitem" href="<?php echo site_url('payment/summary') ?>"><span class="glyphicon glyphicon-list"></span> Summary Report</a></li>
                            <li  role="presentation"><a role="menuitem" href="<?php echo site_url('payment/index') ?>"><span class="glyphicon glyphicon-list"></span> Lists</a></li>
                            <li  role="presentation"><a role="menuitem" href="<?php echo site_url('payment/approval') ?>"><span class="glyphicon glyphicon-list"></span> Approve</a></li>
                            
                        </ul>
                    </li>
                <?php }?>  
                <?php if (in_array("branch", $page_list))  {?>
                        <li class="dropdown "><a class="dropdown-toggle" id="dropBranch" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span> Branches <b class="caret"></b></a>      

                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropBranch">
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('branch') ?>"><span class="glyphicon glyphicon-list"></span> Lists</a></li>
                                <?php if (in_array("branch/create", $page_list))  {?>
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('branch/create') ?>"><span class="glyphicon glyphicon-plus"></span> Add a Branch</a></li>
                                <?php } ?>    
                            </ul>
                        </li>
                <?php } ?> 
                <?php if (in_array("page", $page_list))  {?>  
                        <li class="dropdown "><a class="dropdown-toggle" id="dropPage" role="button"  data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span> Page Access Control <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropPage">
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('page') ?>"><span class="glyphicon glyphicon-list"></span> Lists</a></li>
                                <?php if (in_array("page/create", $page_list))  {?>  
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('page/create') ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add a Page</a></li>
                                <?php } ?>  
                                <?php if (in_array("usercatpage", $page_list))  {?>  
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('usercatpage') ?>"><span class="glyphicon glyphicon-list"></span> Page permissions</a></li>
                                <?php } ?>  
                                <?php if (in_array("usercatpage/create", $page_list))  {?>  
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('usercatpage/create') ?>"><span class="glyphicon glyphicon-plus"></span> Set permission</a></li>
                                <?php } ?>  
                                <?php if (in_array("expensecatpage", $page_list))  {?>  
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('expensecatpage') ?>"><span class="glyphicon glyphicon-list"></span> Expense categories</a></li>
                                <?php } ?>  
                                <?php if (in_array("expensecatpage/create", $page_list))  {?>  
                                    <!-- <li role="presentation"><a role="menuitem" href="<?php echo site_url('expensecatpage/expensecatexchange') ?>"><span class="glyphicon glyphicon-plus"></span> Exchange</a></li> -->
                                <li role="presentation"><a role="menuitem" href="<?php echo site_url('expensecatpage/create') ?>"><span class="glyphicon glyphicon-plus"></span> Set expense subcategory under category</a></li>
                                <?php } ?>  

                            </ul>
                        </li>
                <?php } ?>   
        </ul>
</div>

