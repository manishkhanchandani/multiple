<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body>
<h1 align="center">EDIT WISH </h1>
<form id="form1" name="form1" method="post" action="">
<table width="60%" height="100%" align="center" cellspacing="10">
    <tr valign="CENTER">
      <td width="21%" align="right" nowrap>WISHES</td>
      <td align="left"><textarea name="Wishes" cols="50" rows="5"></textarea>      </td>
    </tr>
	 <tr valign="TOP">
     <td width="21%" align="right" nowrap>DONATION</td>
      <td align="LEFT"><select name="Donation">
        <option value="BodyParts" <?php if (!(strcmp("BodyParts", ""))) {echo "SELECTED";} ?>>BodyParts</option>
        <option value="Money" <?php if (!(strcmp("Money", ""))) {echo "SELECTED";} ?>>Money</option>
        <option value="Others" <?php if (!(strcmp("Others", ""))) {echo "SELECTED";} ?>>Others</option>
      </select>      </td>
    </tr>
    <tr valign="CENTER">
      <td nowrap align="right">DESCRIPTION</td>
      <td align="left">
        <textarea name="textarea" cols="50" rows="5"></textarea></td>
      </tr>
    <tr valign="baseline">
      <td nowrap align="right">Institution:</td>
      <td><input type="text" name="Institution" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">
	  Contact Person:</strong>	  </td>
      <td><input type="text" name="Contact" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="LEFT">
	  Email:</td>
      <td align="left"><select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
        <option>FRIENDS NAME</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
