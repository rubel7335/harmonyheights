<!DOCTYPE html>
<html>
<head>
    <title>Certificate of Achievement</title>
    <style>
        body {
            font-family: Arial;           
            padding: .05in 0.03in .05in .03in;
        }
        .certificate {    
            padding-top:5px;
            font-size:14; 
            text-align: justify; 
            line-height: 2;
        }     

        .container {
        width: 100%;
        overflow: hidden; /* Clear the float */
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

    </style>

<?php   
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
                    ),
                );  
            $data = file_get_contents(base_url()."upload/appimg/"."sign.png",false, stream_context_create($arrContextOptions));
            $type ='jpg';
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);        
?>

</head>

    <?php foreach ($person  as $item) : ?>
        <body>
                <div>
                    <div style="text-align:left;font-family:Arial;font-size:12;float:left">Ref No:IBB/Exam/</div>
                    <div style="text-align:right;font-family:Arial;font-size:12;">Date: <?php echo date('d-m-Y') ;?> </div>
                </div> 
                
                <div style="padding-top:30px;">        
                    <p style="font-family:Arial;font-size:18;text-align:center;font-weight:bold"><?php echo "THE INSTITUTE OF BANKERS, BANGLADESH"."<br>"."DHAKA";?></p>
                    <p style="font-family:Arial;font-size:15;text-align:center;font-weight:bold"> <?php $part = $item['part']; if($part === 'JAIBB'){echo "JUNIOR ASSOCIATE OF THE INSTITUTE OF <BR> BANKERS, BANGLADESH (JAIBB)";}if($part === 'AIBB'){echo "ASSOCIATE OF THE INSTITUTE OF <BR> BANKERS, BANGLADESH (AIBB)";}?></p>
                    <p style="font-family:Arial;font-size:15;text-align:center;font-weight:bold"><?php echo "PROVISIONAL CERTIFICATE";?></p>
                                        
                </div>
                
                <p class="certificate">
                    This is to certify that <?php $gender = $item['gender']; if($gender === 'Male'){echo "Mr.";}if($gender === 'Female'){echo "Ms.";}?>
                    <span style="font-weight:bold;font-style: italic;"><?php echo $item['member_name'].", ";?></span>
                    <?php $gender = $item['gender']; if($gender === 'Male'){echo "S.O";}if($gender === 'Female'){echo "D.O.";}?>
                    <?php echo $item['father_name'];?> 
                    of <span style="font-weight:bold;"><?php echo $item['bank'];?></span>
                    has completed the 
                    <?php $part = $item['part']; if($part === 'JAIBB'){echo "Junior Associate of the Institute of Bankers, Bangladesh (JAIBB)";}if($part === 'AIBB'){echo "Associate of the Institute of Bankers, Bangladesh (AIBB)";}?>
                    Examination held in <span style="font-weight:bold;"><?php echo $item['exam'];?></span> 
                    under Roll No. <span style="font-weight:bold;"><?php echo $item['roll_no'];?></span>
                    and Enrollment No. <span style="font-weight:bold;"><?php echo $item['enrol_no'].".";?></span>
                </p>    
            
                <div style="padding-top:20px;">
                    <p style="padding-top:10px;text-align:right;font-family:Arial;font-size:12;">
                        <img width='70px' height='40px' src='<?php echo $base64;?>' />
                    </p>

                    <div>
                        <div style="text-align:left;font-family:Arial;font-size:12;float:left">Verifier:</div>
                        <div style="text-align:right;font-family:Arial;font-size:12;font-weight:bold;">Secretary General </div>
                    </div> 
            
                    <p style="padding-top:25px;font-family:Arial;font-size:10;text-align:center;">N. B. This Provisional Certificate is to be surrendered in exchange for the Diploma which will not be issued without this except in special circumstances.</p>
                </div>
            </body>
    <?php endforeach; ?>

</html>
