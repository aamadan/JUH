<?php
session_start();
?>
<input type="hidden" id="user-id" value="<?php echo $_POST['username']?>">
<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">User Permissions</h3>
	</div>
	<div class="card-body">
		<div class="row">
		<?php
		include '../lib/conn.php';
		$menusql="SELECT * FROM menu ORDER BY id";
		$menures=$conn->query($menusql);
		while ($menurow=$menures->fetch_assoc()) {
		?>
			<div class="col-md-4">
				<div class="form-group clearfix d-inline">
					<div class="icheck-primary">
						<input type="checkbox" id="<?php echo $menurow['id'] ?>" value="<?php echo $menurow['id'] ?>" name="menu" class="menu">
						<label for="<?php echo $menurow['id'] ?>"><?php echo $menurow['name']; ?></label>
						<?php
						$submenusql = "SELECT s.id,s.text,m.name,p.user FROM sidebar s INNER JOIN menu m ON m.id=s.menu_id LEFT JOIN permission p ON p.sidebar_id=s.id AND p.user='$_POST[username]' WHERE m.name='$menurow[name]'"; 
						$submenres= $conn->query($submenusql);
						while($submenrow = $submenres->fetch_assoc()){
						?>	
							<div class="col-12">
							<input type="checkbox" class="check" value="<?php echo $submenrow['id']?>" <?php echo $submenrow['user'] == null ? '' : 'checked';?>><?php echo "     ".$submenrow['text']?>
							</div>			
						<?php
						}
						?>
					</div>
				</div>
			</div>
		<?php
		}
		?>	
		</div>	
	</div>
</div>
