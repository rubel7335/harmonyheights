<style>
table{
   width: 100%;
}
th, td {
  padding: 3px;
  text-align: left;
  color: #002166;
  font-family:  monospace;
  font-size: 12px;
}
#title{
  letter-spacing: 3px;  
  font-weight: bold;
  text-align: center;
  font-family:  monospace;
  font-size:  24px;
  color: #003399;
  text-decoration: underline;      
}
#address{
  text-align: center;
  font-family:  monospace;
  font-size:  8px;
}
.italic{
  
}
.dashed{
     border-bottom: 1px dashed black;
     font-weight: bold;
     text-align: left;
}
</style>
        <?php
        
        
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

 

        $data = file_get_contents(base_url()."upload/appimg/"."frame3.jpg",false, stream_context_create($arrContextOptions));
        $type ='jpg';
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        ?>
<body  style="background-image: url(<?php echo $base64 ?>); color: #FFF; ">

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div >
        <table >
            <tr >
               <th colspan="4" id="title"><?php echo $title;?>  </th>
                
            </tr>
            <tr>
                <th colspan="4" id="address">
                <span>Jahurul Islam City (Aftabnagar)
                    <br>Plot#2,3,4,5,6,7,8
                    <br>Road#11,12 Block#L
                    <br>Eastern Housing, Dhaka
                </span>
                </th>
            </tr>
            <tr ><th colspan="4" style="text-align:center; font-size: small; " ><span style=" background: #ddd;padding: 5px;"><?php echo " Money Receipt ";?></span></th></tr>
            <tr >
                <td style="text-align:left;">Date:<?php echo date('d-m-Y');?></td>
                <td></td>
                <td></td>
                <td style="text-align:right;">Receipt no:<?php echo $payment_item['receipt_no'];?></td>
                
            </tr>
            <tr style="font-size:6px;">
                <td>
                </td>
            </tr>
            <tr>
                <td class="italic">Name of shareholder</td>
                <td class="dashed"><?php echo $payment_item['fullname'];?></td>
                <td class="italic">Amount (in word)</td>
                <td class="dashed"><?php echo $inWord = convert_number($payment_item['deposit_amount']);?></td>
            </tr>
            <tr >
                <td ><span class="italic">Name of Bank:</span> <span class="dashed"><?php echo $payment_item['bank'];?></span></td>
                <td ><span class="italic">Branch:</span><span class="dashed"><?php echo $payment_item['branch']?></span></td>
                <td > <span class="italic">Slip no:</span><span class="dashed"><?php echo $payment_item['deposit_slip_no']?></span></td>
                <td ><span class="italic">Date:</span><span class="dashed"><?php  echo    $deposit_date = date('d-m-Y', strtotime($payment_item['deposit_date']));?></span></td>
            </tr>
            <tr>
                <td ><span class="italic">Installment:</span> <span class="dashed"><?php echo $payment_item['installment_name'];?></span></td>
            </tr>
            <tr>
                <td  style="text-align:left;">Amount<span style="background: #FFF;padding: 5px;"><?php echo $payment_item['deposit_amount'];?></span></td>
                <td></td>
                <td></td>
                <td  style="text-align:right;">Approved by<span style="background: #FFF;padding: 5px;"><?php echo $payment_item['verified_by'];?></span></td>
               
            </tr>
            <tr ><td colspan="4" style="text-align:center;padding: 3px;font-size: small;padding-top: 20px;" >For more info please visit: https://www.harmonyheights.net/</td></tr>
          
        </table>
        </div>


    </body>
