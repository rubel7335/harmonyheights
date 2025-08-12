<?php

function asset_url(){
    return base_url().'/assets';
}

function technical_loggedin(){
    return true;
}
function test_login() {
  $CI = & get_instance();  //get instance, access the CI superobject
  $isLoggedIn = $CI->session->userdata('username');
  echo $isLoggedIn;
  if( $isLoggedIn ) {
     return TRUE;
  }
  return FALSE;  
}

function convert_number($number) 
{ 
    $my_number = $number;

    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 
    $Kt = floor($number / 10000000); /* Koti */
    $number -= $Kt * 10000000;
    $Gn = floor($number / 100000);  /* lakh  */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Kt) 
    { 
        $res .= convert_number($Kt) . " Koti "; 
    } 
    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lakh"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 


} 
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function duedays($birtdate){
        //get age from conifugarions
        //calculate due days
                      //  echo "<br>nominee birthday".$birtdate;
                      //  echo "<br>Nominee will expire on".$expiration_date=date('Y-m-d', strtotime('+25 year', strtotime($birtdate)) );                
                      //  echo "<br>Last date of this month".$last_date_present_month=date("Y-m-t", strtotime(date("Y-m-d")));
                      $expiration_date=date('Y-m-d', strtotime('+25 year', strtotime($birtdate)) );                
                      $last_date_present_month=date("Y-m-t", strtotime(date("Y-m-d")));
                        //print_r($nominee);
                        if($expiration_date >= $last_date_present_month){ //Nominee's age is within 25 years
                           return true;
                        }
                        else {
                            echo "<br> Age of the nominee is expired";
                            return false;
                             
                        }
        
}

function calcertValidity($nominee_nmc_validity,$last_day_this_month){
                        if($nominee_nmc_validity >= $last_day_this_month){ //Nominee's certificate is within validity period
                           return true;
                        }
                        else {
                            echo "<br> Certificate validity has been expired";
                            return false;                             
                        }        
                    }
function husbandRetirement($empDateOfRetirement,$last_day_this_month){
        $lastDayObject = new DateTime($last_day_this_month); 
        $retirementDayObject = new DateTime($empDateOfRetirement); 
        $diff = $retirementDayObject->diff($lastDayObject);
        //echo $diff->y;
        return $diff->y;
        
}
function calculateage($birthday){       
        $dob = date("Y-m-d",strtotime($birthday));
        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();
        $diff = $dobObject->diff($nowObject);
        //echo $diff->y;
        return $diff->y;
}

function is_valid_nominee($nominee,$last_day_this_month){
    return 1;
                  $empID = $nominee['employee_id'];
                  $emp_dod_time = $nominee['dod_time'];     
                  $empDateOfRetirement = $nominee['dor_time'];
                  $employee_pension_basic = $nominee['pension_basic'];
                  $emp_relation_with_nominee = $nominee['relation'];
                  $physical_status = $nominee['physical_status'];
                  $nominee_dob_time = $nominee['dob_time'];            
                  $nom_marital_status = $nominee['marital_status'];            
                  $nomineeID = $nominee['id'];
                  $nominee_basic = $nominee['nominees_basic'];
                  $nominee_share  =   $nominee['pension_percentage'];
                  $nominee_nmc_validity = $nominee['non_marriage_cert_validity'];
                  /*
                  echo "<br>".$empID = $nominee['employee_id'];
                  echo "<br>".$emp_dod_time = $nominee['dod_time'];            
                  echo "<br>".$employee_pension_basic = $nominee['pension_basic'];
                  echo "<br>".$emp_relation_with_nominee = $nominee['relation'];
                  echo "<br>".$physical_status = $nominee['physical_status'];
                  echo "<br>".$nominee_dob_time = $nominee['dob_time'];            
                  echo "<br>".$nom_marital_status = $nominee['marital_status'];            
                  echo "<br>".$nomineeID = $nominee['id'];
                  echo "<br>".$nominee_basic = $nominee['nominees_basic'];
                  echo "<br>".$nominee_share  =   $nominee['pension_percentage'];*/
                  
                    //echo "emp:".$empID."empBasic:".$employee_pension_basic."nomineeID".$nomineeID."nomineeBasic".$nominee_basic."nomineePercentage".$nominee_share;
                    
//Son is Handicapped or (Fit and age below 25 years)
                    if(($emp_relation_with_nominee == 'son') 
                            && ((($physical_status == 'Fit') && (duedays($nominee_dob_time))) || ($physical_status == 'Handicapped'))){                
                        return true;   
                    }
                    
// Daughter is Handicapped or (Fit and Unmarried)
                    if(($emp_relation_with_nominee == 'daughter') 
                            && ((($physical_status == 'Fit') && (calcertValidity($nominee_nmc_validity,$last_day_this_month))) ||($physical_status == 'Handicapped'))){        
                        return true;
                    }    
                    
//Wife is unmarried if age<50 or age>50
                    if(($emp_relation_with_nominee == 'wife')&& (calculateage($nominee_dob_time)>50)){
                        return true;
                    }
                    
                    if(($emp_relation_with_nominee == 'wife')&& (calculateage($nominee_dob_time)<=50) && (calcertValidity($nominee_nmc_validity,$last_day_this_month))){
                        return true;
                    }
                    
 
//Husband not get married after his wife deceased and year of the employee retirement below 15 and 
                     
                    if(($emp_relation_with_nominee == 'husband') 
                            && (husbandRetirement($empDateOfRetirement,$last_day_this_month)<=15) && (calcertValidity($nominee_nmc_validity,$last_day_this_month))){
                        return true;
                    }
                    
    return false;
}

function convertNumberToWord($num = false)
{
    
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
        'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
    );
    $list2 = array('', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred');
    $list3 = array('', 'Thousand', 'Million', 'Billion', 'Trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}


  // Set timezone
 date_default_timezone_set("Asia/Dhaka");

  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
        break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {
          $interval .= "s";
        }
        // Add value and interval to times array
        $times[] = $value . " " . $interval;
        $count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
  }


