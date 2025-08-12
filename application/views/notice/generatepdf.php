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
#description{
  text-align: left;
  font-family:  monospace;
  font-size:  18px;
  color:  #002a80;
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
<body  style=" background-image: url(<?php echo $base64 ?>); color: #FFF; ">

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div >
        <table >
            <tr >
               <th colspan="4" id="title"><?php echo $title;?>  </th>
            </tr>
           <tr >
               <td colspan="4" id="description"><?php echo $notice_item['details'];?>  </td>
            </tr>
            
        </table>
        </div>


    </body>
