<?php
include("../lib/conn.php");
$sql="SELECT id,username FROM users WHERE usertype='$_GET[usertype]'";
echo $sql;
$res=$conn->query($sql);
while ($row=$res->fetch_assoc()) {
?>
	<option value="<?php echo $row['id']?>"><?php echo $row['username']?></option>
<?php
}
?>