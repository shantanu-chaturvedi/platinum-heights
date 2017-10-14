<?php include '../controller/functions.php';

$datas = memberSearchForMessage($_GET['role'],$_GET['location'],$_GET['name'],$_GET['firm_name']);

foreach($datas[0] as $adminName){?>
	<tr>
	  <td><input type="checkbox" class="recipientCheckbox" name="receiver" value=<?php echo "1-".$adminName['ID']?>></td>
	  <td><?php echo $adminName['name'];?></td>
	  <td><?php echo $adminName['location'];?></td>
	  <td>-</td>
	  <td><span class="label label-info">Manager</span></td>
	</tr>
<?php }?>

<?php foreach($datas[1] as $caName){?>
	<tr>
	  <td><input type="checkbox" class="recipientCheckbox" name="receiver" value=<?php echo "2-".$caName['ID']?>></td>
	  <td><?php echo $caName['name']?></td>
	  <td><?php echo $caName['location']?></td>
	  <td><?php echo $caName['firm_name']?></td>
	  <td><span class="label label-warning">Partner</span></td>
	</tr>
<?php }?>

<?php foreach($datas[2] as $clientName){?>
	<tr>
	  <td><input type="checkbox" class="recipientCheckbox" name="receiver" value=<?php echo "3-".$clientName['ID']?>></td>
	  <td><?php echo $clientName['contact_person']?></td>
	  <td><?php echo $clientName['location']?></td>
	  <td><?php echo $clientName['company_name']?></td>
	  <td><span class="label label-danger">Client</span></td>
	</tr>
<?php }?>

