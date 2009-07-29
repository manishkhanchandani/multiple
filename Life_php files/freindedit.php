<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1 align="center">EDIT FRIEND LIST</h1>
<form id="form1" name="form1" method="post" action="">
<table width="60%" height="100%" align="center" cellspacing="10">
    <tr valign="baseline">
      <td width="21%" align="right" nowrap><span class="style3">Name:</span></td>
      <td width="79%"><input type="text" name="Name" value="" size="32"></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right"><span class="style3">Category:</span></td>
      <td><select name="Category" size="1">
        <option value="Close Freind" <?php if (!(strcmp("Close Freind", ""))) {echo "SELECTED";} ?>>Close Freind</option>
        <option value="Family Freind" <?php if (!(strcmp("Family Freind", ""))) {echo "SELECTED";} ?>>Family Freind</option>
        <option value="Others" <?php if (!(strcmp("Others", ""))) {echo "SELECTED";} ?>>Others</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style3">EmailId:</span></td>
      <td><input type="text" name="EmailId" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="UPDATE"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>
