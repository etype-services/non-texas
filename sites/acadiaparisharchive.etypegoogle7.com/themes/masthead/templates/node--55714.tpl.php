<?php 
if(isset($_POST['submit']))
{
	$publication=$_POST['publication'];
	if($publication==320)
	{
		header('location:http://www.etypeservices.com/Crowley%20Post%20SignalID133/default.aspx?PubID=320');
	}
	if($publication==440)
	{
		header('location:http://www.etypeservices.com/Rayne%20Acadian%20TribuneID144/default.aspx?PubID=440');
	}
	if($publication==1658)
	{
		header('location:http://www.etypeservices.com/Church%20Point%20NewsID410/default.aspx?PubID=1658');
	}
}
?>

<form name="form1" method="POST" action="http://www.acadiaparishtoday.com/subscriber" enctype="multipart/form-data">

      <fieldset>
               
                
            <div>
<h3 style="background:gray;line-height: 2.0em;font-size: 16px;"><center>Select Publication</center></h3>
<br/>
<hr>
               <input type="radio" name="publication" value="320" required>The Crowley Post-Signal<br>
         <input type="radio" name="publication" value="440">Rayne Acadian Tribune<br>
         <input type="radio" name="publication" value="1658">Church Point News <br>
            </div>

            
 
 <br/>
            
 
        
 
            
 
 
            
            </fieldset>
                
        <input type="submit" name="submit" value="Submit!" style="background-color: gainsboro;border-radius: 4px;width: 93px;height: 28px;border: 1px solid #CCC;text-decoration: none;color: #000;text-shadow: white 0 1px 1px;padding: 2px;">
                      
        </form>