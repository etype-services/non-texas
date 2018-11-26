<?php  

//read the post from PayPal system and add 'cmd' 
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) { 
    $value = urlencode(stripslashes($value)); 
     $req .= "&$key=$value"; 
  // echo $req;
} 

//post back to PayPal system to validate 
$header = "POST /cgi-bin/webscr HTTP/1.1\r\n"; 
$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
$header .= "Host: www.paypal.com\r\n"; 
$header .= "Connection: close\r\n"; 
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30); 
// 

   
//error connecting to paypal 
if (!$fp) { 
    // 
} 
     
//successful connection     
if ($fp) { 
    fputs ($fp, $header . $req); 
     
    while (!feof($fp)) { 
        $res = fgets ($fp, 1024); 
        $res = trim($res); //NEW & IMPORTANT 
           $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
      
    /* strcmp($res, "INVALID") */
   
        if (strcmp($res, "VERIFIED") == 0) { 
                   $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_type = $_POST['txn_type'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $payment_date=$_POST['payment_date'];
    $custom=$_POST['custom'];
	$temp=explode("-",$custom);
        $paynumber=current($temp);
        $username=end($temp);
    
    $sel="select * from temp_user where UserName='".$custom."'";
    $qu1=db_query($sel);
    foreach($qu1 as $qu1)
        {
        $UserName = $qu1->UserName;
        $Email=$qu1->Email;
        $FirstName=$qu1->FirstName;
        $LastName=$qu1->LastName;
        $StreetAddress=$qu1->StreetAddress;
        $City=$qu1->City;
        $State=$qu1->State;
        $PostalCode=$qu1->PostalCode;
        $Phone=$qu1->Phone;
        $amount=$qu1->amount;
        $planTitle=$qu1->planTitle;
        $PublicationID=$qu1->PublicationID;
        }

         if($PublicationID==255)
      {
      $headers .= 'From: The Daily Review ' . "\r\n";
      $subject="Urgent New subscriber Registration - The Daily Review";
      $publname="The Daily Review ";
      }
      else
      {
        $headers .= 'From: Franklin Banner-Tribune ' . "\r\n";
        $subject="New subscriber Registration - Franklin Banner-Tribune";
        $publname="Franklin Banner-Tribune";
      }
    $in="insert into orders(txn_id,txn_type,mc_gross,payer_email,status,receiver_email,received,custom,paymentnumber) values ('".$txn_id."','".$txn_type."','".$payment_amount."','".$payer_email."','".$payment_status."','".$receiver_email."','".$payment_date."','".$custom."','".$paynumber."')";
    
        
    $qu=db_query($in);
    
     if($payment_status== 'Completed'){

      $message="<head>
    <title></title>
</head>
<body>
    <table border=0 cellpadding=0 cellspacing=0>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;
                width: 170px;>
                Dear,
                
            </td>
        </tr>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                A new subscriber has just signed up for
                ".$publname.".
            </td>
        </tr>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Subscriber detail are as follows:
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Name:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$FirstName."
                ".$LastName."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                User name:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$UserName."
            </td>
        </tr>
        
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Phone:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                 ".$Phone."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Email:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                 ".$Email."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                City:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                 ".$City."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Address:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$StreetAddress."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                State:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                 ".$State."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Zip:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                 ".$PostalCode."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Subscription Plan:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$planTitle."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Amount Paid:
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                 ".$amount."
            </td>
        </tr>
        
        <tr>
            <td colspan=2>
                <br />
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <br />
            </td>
        </tr>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Thank You
                <br />
                Etype Services
            </td>
        </tr>
    </table>
</body>
</html>";
$torec="admin@etypeservices.com";
$tomy="pradeep@sublimeitsolutions.com";
$sentmail1=mail($tomy,$subject,$message,$headers);
$sentmail=mail($torec,$subject,$message,$headers);
$message1="<head>
    <title>Untitled Page</title>
</head>
<body>
    
    <title>Mail Page</title>
    <table border=0 cellpadding=0 cellspacing=0 width=100%>
        <tr>
            <td style=padding-top: 2px; font-family: Verdana; font-size: 8.5pt; padding-left: 0px;>
            
                                <br />
                                <br />
                Dear&nbsp;Subscriber,<br />
                <br />
                Welcome to
                ".$publname.". Thank you for your registration..
                <br />
                <br />
                You have entered the following details for registration:<br />
                <br />
            </td>
        </tr>
    </table>
    <table border=0 cellpadding=0 cellspacing=0>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;
                width: 170px;>
                User Name
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$UserName."
            </td>
        </tr>
        

         <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Subscription Plan
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
               ".$planTitle."
            </td>
        </tr>

         <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Amount Transferred
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
               ".$amount."
            </td>
        </tr>

        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Email
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$Email."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                First Name
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$FirstName."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Last Name
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$LastName."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Phone
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$Phone."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                City
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$City."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Address
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
               ".$StreetAddress."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                State
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$State."
            </td>
        </tr>
        <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Zip
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$PostalCode."
            </td>
        </tr>
   <tr>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Payment Status
            </td>
            <td style=font-family: Tahoma; font-size: 11px; text-align: left;>
                ".$payment_status."
            </td>
        </tr>
        
        <tr>
            <td colspan=2>
                <br />
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <br />
            </td>
        </tr>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                Thanks
            </td>
        </tr>
    </table>
</body>
</html>";
$topay=$Email;
//$topay="jit1987@gmail.com";
$sentmail1=mail($topay,$subject,$message1,$headers);


     }
     else{

       $message2="<title>Mail Page</title>
    <table border=0 cellpadding=0 cellspacing=0 width=100%>
        <tr>
            <td style=padding-top: 2px; font-family: Verdana; font-size: 8.5pt; padding-left: 0px;>
                
                <br />
                <br />
                Dear&nbsp; Subscriber,<br />
                <br />
                Welcome to
                ".$publname.". Thanks for your registration..
                <br />
                <br />
                We are sorry your payment not succeeded:<br />
                <br />
                 ".$payment_status."
                <br />
            </td>
        </tr>
    </table>
    <table border=0 cellpadding=0 cellspacing=0>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                <br />
                <br />
                <br />
                Thanks
            </td>
        </tr>
    </table>
</body>
</html>";
$myemail="pradeep@sublimeitsolutions.com";
$sentmailj=mail($myemail,$subject,$message2,$headers);
$adminemail="admin@etypeservices.com";
$sentmail2=mail($adminemail,$subject,$message2,$headers);
     }
   
        } 
     /* VERIFIED strcmp ($res, "INVALID") */
        if (strcmp ($res, "INVALID") == 0) { 
              $item_name = $_POST['item_name'];
              $username=$_SESSION['username'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_type = $_POST['txn_type'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $custom=$_POST['custom'];
    $payment_date=$_POST['payment_date'];
	$temp=explode("-",$custom);
        $paynumber=current($temp);
        $username=end($temp); 
    $sel="select * from temp_user where UserName='".$custom."'";
    $qu1=db_query($sel);
    foreach($qu1 as $qu1)
        {
        $UserName = $qu1->UserName;
        $Email=$qu1->Email;
        $FirstName=$qu1->FirstName;
        $LastName=$qu1->LastName;
        $StreetAddress=$qu1->StreetAddress;
        $City=$qu1->City;
        $State=$qu1->State;
        $PostalCode=$qu1->PostalCode;
        $Phone=$qu1->Phone;
        $amount=$qu1->amount;
        $planTitle=$qu1->planTitle;
        $PublicationID=$qu1->PublicationID;
        }

         if($PublicationID==255)
      {
      $headers .= 'From: The Daily Review ' . "\r\n";
      $subject="New subscriber Registration - The Daily Review";
      $publname="The Daily Review ";
      }
      else
      {
        $headers .= 'From: Franklin Banner-Tribune ' . "\r\n";
        $subject="New subscriber Registration - Franklin Banner-Tribune";
        $publname="Franklin Banner-Tribune";
      }
     
             $in="insert into orders(txn_id,txn_type,mc_gross,payer_email,status,receiver_email,received,custom,paymentnumber) values ('".$txn_id."','".$txn_type."','".$payment_amount."','".$payer_email."','".$payment_status."','".$receiver_email."','".$payment_date."','".$custom."','".$paynumber."')";
   $qu=db_query($in);

             $message2="<title>Mail Page</title>
    <table border=0 cellpadding=0 cellspacing=0 width=100%>
        <tr>
            <td style=padding-top: 2px; font-family: Verdana; font-size: 8.5pt; padding-left: 0px;>
                
                <br />
                <br />
                Dear&nbsp; Subscriber,<br />
                <br />
                Welcome to
                ".$publname.". Thanks for your registration..
                <br />
                <br />
                We are sorry your payment not succeeded:<br />
                <br />
                 ".$payment_status."
                <br />
            </td>
        </tr>
    </table>
    <table border=0 cellpadding=0 cellspacing=0>
        <tr>
            <td colspan=2 style=font-family: Tahoma; font-size: 11px; text-align: left; font-weight: normal;>
                <br />
                <br />
                <br />
                Thanks
            </td>
        </tr>
    </table>
</body>
</html>";

//$adminemail="admin@etypeservices.com";
//$sentmail2=mail($adminemail,$subject,$message2,$headers);
            echo "The response from IPN was: <b>" .$res ."</b>";
          
        } 
    } 

    fclose($fp); 
} 

?> 
