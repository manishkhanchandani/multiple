<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
 <h1 align="center" class="style1">REMINDERS EDIT </h1>
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Account:</span></td>
      <td><select name="Account">
        <option value="BankAcoount" <?php if (!(strcmp("BankAcoount", ""))) {echo "SELECTED";} ?>>BankAcoount</option>
        <option value="Policy" <?php if (!(strcmp("Policy", ""))) {echo "SELECTED";} ?>>Policy</option>
        <option value="Will" <?php if (!(strcmp("Will", ""))) {echo "SELECTED";} ?>>Will</option>
        <option value="Credits" <?php if (!(strcmp("Credits", ""))) {echo "SELECTED";} ?>>Credits</option>
        <option value="Assets" <?php if (!(strcmp("Assets", ""))) {echo "SELECTED";} ?>>Assets</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">AccountNo:</span></td>
      <td><input type="text" name="AccountNo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><span class="style1">Description:</span></td>
      <td><textarea name="Description" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Contact:</span></td>
      <td><input type="text" name="Contact" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Place:</span></td>
      <td><input type="text" name="Place" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Upload:</span></td>
      <td><form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
        <input type="file" name="file" />
      </form>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Email To:</span></td>
      <td><form id="form2" name="form2" method="post" action="">
        <select name="select" multiple="multiple">
          <option value="FRIENDS NAME">FRIENDS NAME</option>
        </select>
      </form>
      </td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
