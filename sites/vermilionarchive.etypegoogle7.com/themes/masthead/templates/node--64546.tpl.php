<?php 
if(isset($_POST['submit']))
{
	$publication=$_POST['publication'];
	if($publication==315)
	{
		header('location:http://www.etypeservices.com/Abbeville%20MeridionalID130/default.aspx?PubID=315');
	}
	if($publication==1659)
	{
		header('location:http://www.etypeservices.com/Kaplan%20HeraldID411/default.aspx?PubID=1659');
	}
	if($publication==1660)
	{
		header('location:http://www.etypeservices.com/Gueydan%20JournalID412/default.aspx?PubID=1660');
	}
}
?>

<form name="form1" method="POST" action="http://www.vermiliontoday.com/subscriber" enctype="multipart/form-data">

      <fieldset>
               
                
            <div>
<h3 style="background:gray;line-height: 2.0em;font-size: 16px;"><center>Select Publication</center></h3>
<br/>
<hr>
                <input type="radio" name="publication" value="315" required>The Abbeville Meridional<br>
         <input type="radio" name="publication" value="1659">Kaplan Herald<br>
         <input type="radio" name="publication" value="1660">Gueydan Journal<br>
            </div>

 <br/>
            
    </fieldset>
                
        <input type="submit" name="submit" value="Submit!" style="background-color: gainsboro;border-radius: 4px;width: 93px;height: 28px;border: 1px solid #CCC;text-decoration: none;color: #000;text-shadow: white 0 1px 1px;padding: 2px;">
                      
        </form>
       