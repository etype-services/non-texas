<?php
global $user;
$username= $user ->name;
$param12=array('UserName'=>"$username");
 $client12= new soapclient('http://etypeservices.com/service_GetPublicationIDByUserName.asmx?WSDL');
    $response12=$client12->GetPublicationID($param12);
    
       
     if($response12->GetPublicationIDResult== -9)
    {
    
    }  
    else if($response12->GetPublicationIDResult== 320)
    {
			header ("location:http://etypeservices.com/ReadTheEdition.aspx?Username=$username&Pub=320&PType=CPS000320");
	}
	else if($response12->GetPublicationIDResult== 440)
	{
		header ("location:http://etypeservices.com/ReadTheEdition.aspx?Username=$username&Pub=440&PType=RAT000440");
	}
	else if($response12->GetPublicationIDResult== 1658)
	{
		header ("location:http://etypeservices.com/ReadTheEdition.aspx?Username=$username&Pub=1658&PType=CPN001658");
	}
?>
