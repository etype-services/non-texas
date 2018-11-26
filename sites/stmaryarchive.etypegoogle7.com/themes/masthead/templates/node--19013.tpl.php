<?php 
if(isset($_POST['submit']))
{
	$publication=$_POST['publication'];
	if($publication==255)
	{
		header('location:http://www.etypeservices.com/Morgan%20City%20(LA)%20Daily%20ReviewID116/default.aspx?PubID=255');
	}
	if($publication==256)
	{
		header('location:http://www.etypeservices.com/Franklin%20(LA)%20Banner-TribuneID117/default.aspx?PubID=256');
	}
}
?>



<form name="form1" method="POST" action="http://www.stmarynow.com/node/19013" enctype="multipart/form-data">
      <fieldset>
               
                
            <div>
<h3 style="background:gray;line-height: 2.0em;font-size: 16px;"><center>Select Publication</center></h3>
<br>
<hr>
               <input type="radio" name="publication" value="255" required="">Morgan City Daily-Review<br>
         <input type="radio" name="publication" value="256">St. Mary and Franklin Banner Tribune<br>
            </div>

            
 
 <br>
            
 
        
 
            
 
 
            
            </fieldset>
                
        <input type="submit" name="submit" value="Submit!" style="background-color: gainsboro;border-radius: 4px;width: 93px;height: 28px;border: 1px solid #CCC;text-decoration: none;color: #000;text-shadow: white 0 1px 1px;padding: 2px;">
                      
        </form>