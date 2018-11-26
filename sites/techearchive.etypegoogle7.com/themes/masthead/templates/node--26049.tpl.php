<?php
if (isset($_POST['submit'])) {
  $email = $_SESSION['email'];
  $UserName = $_SESSION['username'];
  $Password = $_SESSION['password'];
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $address = $_SESSION['address'];
  $city = $_SESSION['city'];
  $state = $_SESSION['state'];
  $postal = $_SESSION['postalcode'];
  $phone = $_SESSION['phone'];
  $publicationid = $_SESSION['Publication_Id'];
  $planid = $_SESSION['planId'];
  $planTitle = $_SESSION['planTitle'];
  $amount = $_SESSION['planPrice'];
  $date = date("Y-m-d");
  $expdate = date('Y-m-d', strtotime("+" . $_SESSION['Period'] . " " . $_SESSION['PeriodType'] . ""));
  $param = array(
    'Email' => "$email",
    'UserName' => "$UserName",
    'Password' => "$Password",
    'FirstName' => "$firstname",
    'LastName' => "$lastname",
    'StreetAddress' => "$address",
    'City' => "$city",
    'State' => "$state",
    'PostalCode' => "$postal",
    'Phone' => "$phone",
    'ExpiryDate' => "$expdate",
    'PublicationID' => "$publicationid",
    'SubscriptionPlanID' => "$planid"
  );
  $client3 = new soapclient('http://etypeservices.com/Service_InsertDetailsinTempTable.asmx?WSDL');

  $response3 = $client3->Temp_SubscriberRegistration($param);

  //$payparam=array('PublicationID'=>"$publicationid",'UserName' =>"$UserName",'Amount'=>"$amount");
  // $clientpay=new soapclient('http://etypeservices.com/Service_SavePaymentin_TempTable.asmx?wsdl');

  // $responsepay=$clientpay->Temp_SubscriberPayment($payparam);

  $custom = $UserName;

  $sel = "select UserName from temp_user where UserName='" . $UserName . "'";
  $qu1 = db_query($sel);
  $userexit = "";
  foreach ($qu1 as $qu1) {
    $userexit = $qu1->UserName;

  }
  if ($userexit != '') {
    $up = "update temp_user set Email ='" . $email . "',UserName ='" . $UserName . "',Password ='" . $Password . "',FirstName ='" . $firstname . "',LastName='" . $lastname . "',StreetAddress='" . $address . "',City='" . $city . "',State='" . $state . "',PostalCode='" . $postal . "',Phone='" . $phone . "',ExpiryDate='" . $expdate . "',PublicationID='" . $publicationid . "',SubscriptionPlanID='" . $planid . "',custom='" . $custom . "',amount='" . $amount . "',planTitle='" . $planTitle . "',paymentnumber='" . $custom . "' where UserName='" . $UserName . "'";
    $qu = db_query($up);
  }
  else {
    $in = "insert into temp_user(Email,UserName,Password,FirstName,LastName,StreetAddress,City,State,PostalCode,Phone,ExpiryDate,PublicationID,SubscriptionPlanID,custom,amount,planTitle,paymentnumber) values ('" . $email . "','" . $UserName . "','" . $Password . "','" . $firstname . "','" . $lastname . "','" . $address . "','" . $city . "','" . $state . "','" . $postal . "','" . $phone . "','" . $expdate . "','" . $publicationid . "','" . $planid . "','" . $custom . "','" . $amount . "','" . $planTitle . "','" . $custom . "')";
    $qu = db_query($in);
  }

  drupal_goto('http://www.etypeservices.com/SubscriptionCheck.aspx?UserName=' . $UserName . '&PubID=' . $publicationid . '&PlanID=' . $planid . '');
  $publicationid = $_SESSION['Publication_Id'];
  $client1 = new soapclient('http://etypeservices.com/Service_GetPublisherPaypalEmailID.asmx?WSDL');
  $param1 = array('PublicationID' => "$publicationid");
  $response1 = $client1->GetPublisherPaypalEmailID($param1);
}
?>

<?php
//$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
$paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; //  Paypal API URL
$paypal_id = $response1->GetPublisherPaypalEmailIDResult; // Business email ID
//$paypal_id="pankaj.nettesting@gmail.com";
?>
<h3 style="Background:gray;line-height: 2.0em;font-size:16px">
  <center>CONFIRM PAYMENT</center>
</h3>
<div style="margin-left:30px">
  <p style="margin-top:10px">
    Your order is almost complete. Click Buy It Now to complete transaction.
  </p>
  <h4 style="Background:gray;line-height: 2.0em;font-size:14px">
    <center>Cart Content</center>
  </h4>
  <table style="width: 100%;">

    <tr>
      <td>Quantity
      </td>
      <td>Product
      </td>
      <td>Price
      </td>
    </tr>
    <tr>
      <td>1*
      </td>
      <td><?php echo $_SESSION['planTitle'];
        echo $_SESSION['Period'];
        echo $_SESSION['PeriodType']; ?>
      </td>
      <td>$<?php echo $_SESSION['planPrice'] ?>
      </td>
    </tr>
  </table>
  <h4>Welcome,<?php echo $_SESSION['firstname'];
    echo "&nbsp";
    echo $_SESSION['lastname']; ?></h4>

  <div class="product">

    <div class="name">
      Etype Payment
    </div>
    <div class="price">
      Price:$<?php echo $_SESSION['planPrice'] ?>
    </div>
    <div class="btn">
      <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name"
               value="<?php echo $_SESSION['planTitle'] ?>">
        <input type="hidden" name="item_number" value="1">
        <input type="hidden" name="credits" value="510">
        <input type="hidden" name="userid" value="1">
        <input type="hidden" name="amount"
               value="<?php echo $_SESSION['planPrice'] ?>">
        <input type="hidden" name="cpp_header_image" value="">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="first_name"
               value="<?php echo $_SESSION['firstname'] ?>">
        <input type="hidden" name="last_name"
               value="<?php echo $_SESSION['lastname'] ?>">
        <input type="hidden" name="address1"
               value="<?php echo $_SESSION['address'] ?>">
        <input type="hidden" name="address2"
               value="<?php echo $_SESSION['address'] ?>">
        <input type="hidden" name="city"
               value="<?php echo $_SESSION['city'] ?>">
        <input type="hidden" name="state"
               value="<?php echo $_SESSION['state'] ?>">
        <input type="hidden" name="zip"
               value="<?php echo $_SESSION['postalcode'] ?>">
        <input type="hidden" name="address_country" value="USA">
        <input type="hidden" name="custom" value="<?php echo $custom ?>">
        <input type="hidden" name="cancel_return"
               value="http://www.techetoday.com/node/26049">
        <input type="hidden" name="return"
               value="http://www.techetoday.com/node/26050">
        <input type="hidden" name="notify_url"
               value="http://www.techetoday.com/payment-status">
        <input type="image"
               src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif"
               border="0" name="submit"
               alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0"
             src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif"
             width="1" height="1">
      </form>
    </div>
  </div>
