﻿    <?php

        if(isset($_POST['submit']))
        {

        $param=array("PublicationId" => $_POST['publication']);
      
         
        $client= new soapclient('http://etypeservices.com/Service_GetSubsciptionPlan.asmx?wsdl');
        
     $response=$client->GetSubsciptionPlan($param);
        $_SESSION['Publication_Id'] =$_POST['publication'];
  //    echo "<pre>";
      //   print_r($response);
       //  echo "</pre>";
      }
      ?>
       <form  name="planform" method="POST" action="http://www.stmarynow.com/node/19015" enctype="multipart/form-data">
<fieldset>
    <style>

.header1{width:100%;height:auto;margin-left: 15px;}
.headertop{width:100%;height:auto;}
.headerdown{width:100%;height:auto;}
.headerdl{width:50%;height:auto;float:left;margin-top: 20px;}
.headerdr{width:50%;height:auto;float:left;}

.content1{width:900px;margin-left: 0px !important;}
.left{width:100%;float:left;}
.right{width:50%;float:left;}
.footer1{width:100%; text-align:center;}
.container_12 .grid_8{width:100%;}
h3{font-size: 19px !important;}
</style>
              
<div class="header1">
<div class="headertop">
<h1 style="background: gray;margin-right: 33px;"> <center>CHOOSE THE SUBSCRIPTION THAT'S RIGHT FOR YOU</center></h1></div>
<div class="headerdown">
<div class="headerdl">
  <?php if($_POST['publication']==256) {?>
  <img src="http://www.stmarynow.com/sites/stmarynow.com/files/stmary.jpg" width="200" height="100%"></div>
<?php } else {?>

<img src="http://www.stmarynow.com/sites/stmarynow.com/files/morgancity.jpg" width="200" height="100%">
<?php } ?>
</div></div>

          
<br/>
            <p style="text-align: justify;margin-right: 41px;margin-top: 13px;">
              Select the Subscription Term that is right for you, then click Submit!. You will be taken to a form where you will be asked to submit your customer and billing info.
<br/>
<br/>
Whether you’re a current subscriber or a new subscriber, all subscription plans include digital e-Edition (delivered to your email inbox) and website access.<br/>
<br/>
<strong>Already a print subscriber? <a href="19018" style="color:red">Fill out this form</a> to activate your digital subscription. Once your print subscription is verified, your user account will be enabled.</strong>
             </p>
          
      <!--<input type="submit" name="alreadysub" value="Already Print Subscriber!" />-->
 
    
<div class="content1">
<div class="left">
<br /><br />
  <?php if($_POST['publication']==256) {?>

<strong><h3>St. Mary and Franklin Banner Tribune</h3></strong>
<?php } else {?>
<strong><h3>Morgan City Daily-Review</h3></strong>
<?php } ?>
<br/>
<?php
                $i=0;
               while($response->GetSubsciptionPlanResult->PlanDetails[$i]->ID > 0) 
                {?>
              <input type="radio" name="plandetail" value="<?php echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->ID ;?>" required>  <?php echo "&nbsp"; echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->Title; echo "&nbsp";echo "-";echo "&nbsp";  echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->Period; echo "&nbsp";echo "&nbsp"; echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->PeriodType; ?>, $<?php echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->Price ;?><br>
              <input type="hidden" name="Publication_Id" value="<?php echo $_SESSION['Publication_Id'];?>">

              <input type="hidden" name="planPeriod" value="<?php echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->Period;?>">
              <input type="hidden" name="planPeriodType" value="<?php echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->PeriodType;?>">
              <input type="hidden" name="planPrice" value="<?php echo $response->GetSubsciptionPlanResult->PlanDetails[$i]->Price;?>">
              <?php $i++; } ?>

<!--FULL ACCESS - CARRIER DELIVERY <br />
Morgan City Daily-Review<br />
Carrier delivery,</strong> 5 days a week<br />
Plus digital e-Edition and website access<br />
<br />
[  ] 3 Months - $26<br />
[  ] 6 Months - $48<br />
[  ] One Year - $92<br />
<br /><strong>
FULL ACCESS - MAIL DELIVERY<br />
Morgan City Daily-Review<br />
Mail delivery,</strong> 5 days a week<br />
Plus digital e-Edition and website access<br />
<br />
[  ] 3 Months - $50<br />
[  ] 6 Months - $80<br />
[  ] One Year - $150<br />
<br />
<br /><strong>
DIGITAL ONLY<br />
Morgan City Daily-Review & StMaryNow.com</strong><br />
Website access & e-Edition delivered directly to your email box<br />
<br />
[  ] 3 months - $25<br />
[  ] 6 months - $45<br />
[  ] One year - $75.<br />-->

</div>

  
</div>


         <!--   <div>
               <input type="radio" name="publication" value="255" required>Morgan City Daily-Review<br>
               <input type="radio" name="publication" value="256">St. Mary and Franklin Banner Tribune<br>
            </div>-->

            
 
 
            
 
        
 
            
 
 
            
                      
               </fieldset>
        <div style="text-align:center;margin-top:10px;"><!--<strong>CURRENT SUBSCRIBER?<br/>
Your subscription now include full access to our website and e-Edition.<br />
Clickhere to activate your digital access</strong>--><br/>
                
        <input type="submit" name="submit" value="Submit!" style="background-color: gainsboro;border-radius: 4px;width: 93px;height: 28px;border: 1px solid #CCC;text-decoration: none;color: #000;text-shadow: white 0 1px 1px;padding: 2px;">
                </div>
        </form>