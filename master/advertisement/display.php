<?php require_once('../../Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsAdvertisement = "SELECT * FROM advertisements ORDER BY RAND() LIMIT 1";
$rsAdvertisement = mysql_query($query_rsAdvertisement, $conn) or die(mysql_error());
$row_rsAdvertisement = mysql_fetch_assoc($rsAdvertisement);
$totalRows_rsAdvertisement = mysql_num_rows($rsAdvertisement);
?>
<?php do { ?>
    <strong><?php echo $row_rsAdvertisement['title']; ?></strong>  <br />
  <?php echo $row_rsAdvertisement['description']; ?><br /><br />
  <?php } while ($row_rsAdvertisement = mysql_fetch_assoc($rsAdvertisement)); ?>
<?php
mysql_free_result($rsAdvertisement);
?>