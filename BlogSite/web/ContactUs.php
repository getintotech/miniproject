<?php
include("header.php"); 
?>
<html>
    <title>Contact Us</title>
    <h1>Contact Us</h1>
    <h3>Please fill in the form below to send us an email.</h3>
<form name="contactform" method="post" action="mail.php"> 
<table width="450px">
<tr>
 <td valign="top">
  <label for="first_name">First Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top"">
  <label for="last_name">Last Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Email Address *</label>
 </td>
 <td valign="top">
  <input  type="text" name="email" maxlength="80" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Telephone Number</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="30" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="message" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
     <input type="submit" value="Submit">
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
     <input type="reset" value="Clear">
 </td>
</tr>
</table>
</form>
</html>
<?php include("Footer.php"); ?>

