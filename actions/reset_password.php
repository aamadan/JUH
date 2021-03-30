<?php
include '../lib/conn.php';
$sp=$_POST['sp'];
$password=$_POST['password'];
$id=$_POST['username'];
$sql="CALL ".$sp."('".$password."','".$id."');";
$res=$conn->query($sql);
if($res)
{
  $row=$res->fetch_array();
  $msg=explode("|", $row[0]);
  if ($msg[0] == "success") {
  ?>
    <script>
          $("#sys_form_change").each(function(){
        this.reset();
        $(".password_check").text(" ");
        $(".select2").val("");
        $(".select2").trigger("change");
      });
        </script>
  <?php
  }
?>
<div class="alert alert-<?php echo $msg[0];?> fade show alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-<?php if($msg[0] == "success"){ echo "check";} else{ echo "ban";}?>"></i> Message
    </h5>
        <?php echo $msg[1];?>
</div>
<?php
}
?>