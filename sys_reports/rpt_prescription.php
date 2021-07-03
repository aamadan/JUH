<!DOCTYPE html>
<html>
<head>
    <title>Prescription Print</title>
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <style>
        @font-face{
            font-family: roboto bold;
            src: url(../fonts/Roboto/Roboto-Bold.ttf);
        }
        @font-face{
            font-family: roboto medium;
            src: url(../fonts/Roboto/Roboto-Medium.ttf);
        }
        @font-face{
            font-family: roboto regular;
            src: url(../fonts/Roboto/Roboto-Regular.ttf);
        }
        @media print{
            @page{
                size:  A5 landscape;   /* auto is the initial value */
                margin: 10px;  /* this affects the margin in the printer settings */
                padding: 0px;

            }
            #print{
                display: none;
            }
            /*#prescription{
            	background-color: #FF0025;
            	padding: 10px;
            	font-size: 16px;
            	text-align: center;
            	text-transform: uppercase;
            	color: white;
            	font-family: Roboto-Bold;
            }*/
        }
        body{
            font-size: 12pt;
        }
        table{
            margin: 0;
            padding: 0;
                
        }
        #prescription{
            background-color: #FF0025;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
            color: white;
            font-family: roboto bold;
            letter-spacing: 2px;
        }
        #image_table{
        	border-collapse: collapse;
            color:black;
            padding-left: 10px;
            padding-right: 10px;
        }
        #patient_info_table{
            border-collapse: collapse;
            color:black;
            padding-left: 10px;
            padding-right: 10px;

        }
        #patient_info_row{

        }
        .patient_info{
            font-size: 10pt;
            padding:5px 10px;
            font-family: "roboto medium";
            background-color: #008DC4;
            color:white;

        }
        #items_table{
            border:1px solid black;
            border-collapse: collapse;
        }
        #payment_table{
            border:1px solid black;
            border-collapse: collapse;
        }
        .payment_td{
            border:1px solid black;
            padding: 5px;
            font-size: 12px;
            font-family: "roboto regular";
        }
        .items_table_td{
            border:1px solid black;
            padding: 5px;
            font-size: 12px;
            font-family: "roboto regular";
        }
        .header_info{
            padding: 2px;
            font-size: 8pt;
            font-family: "roboto regular";
            letter-spacing: 0.5px;  
        }
        .header_icon_holder{
            background-color: #276AB4;
            border-radius: 10%;
        }
        .header_icon{
            font-size: 14pt;
            color: white;
        }
        #print{
            background-color:#276AB4;
            color: white;
            width: 200px;
            height: 50px;
            border:1px solid white;
            margin-top: 10px;
        }
        #print:hover{
            background-color: white;
            color:#276AB4;
            border:1px solid #276AB4;
        }
        #footer_table{
            position: absolute;
        	top:475px;
        	display: block;
        	width: 100%;
        }
        .footer_text{
            font-size:12px;
        	font-family: "roboto medium";
        	letter-spacing: 1px;
        }
        #signature{
        	position: absolute;
        	top: 500px;
        	display: block;
        	width: 100%;
        	text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%;" id="image_table">
        <thead>
            <tr>
                <th align="left" width="60%"><img src="../app_images/header_logo.png" width="70%;"></th>
                <th align="right" width="60%"><img src="../app_images/header_numbers.png" width="70%;"></th>
            </tr>
            <tr>
            	<td id="prescription" colspan="2">Medical Prescription</td>
            </tr>
        </thead>
    </table>
    <?php
    date_default_timezone_set("Africa/Mogadishu");
    include '../lib/conn.php';
    if (isset($_GET["p_no"])) {
        $sql="SELECT pt.name,g.name 'gender',pt.age,p.prescription_serial FROM prescription p INNER JOIN patient pt ON p.patient_id=pt.id INNER JOIN gender g on pt.gender=g.id WHERE prescription_serial='$_GET[p_no]'";
    }
    else{
        $sql="SELECT pt.name,g.name 'gender',pt.age,p.prescription_serial FROM prescription p INNER JOIN patient pt ON p.patient_id=pt.id INNER JOIN gender g on pt.gender=g.id WHERE prescription_serial=(SELECT value-1 from setup WHERE name='prescription_serial')"; 
    }
	$res=$conn->query($sql);
    $row=$res->fetch_assoc();
    // print_r($row);
    ?>
    <table width="100%" id="patient_info_table" style="margin-top: 10px; table-layout: fixed;">
        <thead>
            <tr class="patient_info_row">
                <td width="5%" align="left" class="patient_info">P.No:</td>
                <td width="5%" align="left" class="patient_info"><?php echo $row["prescription_serial"]?></td>
                <td width="5%" align="left" class="patient_info">Name:</td>
                <td width="35%" align="left" class="patient_info"><?php echo $row["name"]?></td>
                <td width="7%" align="left" class="patient_info">Gender:</td>
                <td width="7%" align="left" class="patient_info"><?php echo $row["gender"]?></td>
                <td width="5%" align="left" class="patient_info">Age:</td>
                <td width="5%" align="left" class="patient_info"><?php echo $row["age"]?></td>
                
            </tr>
        </thead>
    </table>
    <?php $conn->close();?>
    <table width="100%" style="margin-top: 10px;" id="items_table">
        <thead>
            <tr class="items_table_row">
                <th class="items_table_td" align="center">S.No</th>
                <th class="items_table_td" align="left">Description</th>
                <th class="items_table_td" align="center">Qty</th>
                <th class="items_table_td" align="center">Frequency</th>
                <th class="items_table_td" align="center">Duration</th>
                <th class="items_table_td" align="center">Route/Instruction</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        		include '../lib/conn.php';
                if (isset($_GET["p_no"])) {
                   $sql="SELECT  pi.brand_name,c.name'country',d.name'category',p.quantity,p.frequency,p.duration,p.instruction FROM prescription p INNER JOIN product_info pi ON pi.id=p.drug_id INNER JOIN country c ON pi.country=c.id INNER JOIN drug_category d ON pi.category=d.id WHERE prescription_serial='$_GET[p_no]'"; 
                }
                else{
                    $sql="SELECT  pi.brand_name,c.name'country',d.name'category',p.quantity,p.frequency,p.duration,p.instruction FROM prescription p INNER JOIN product_info pi ON pi.id=p.drug_id INNER JOIN country c ON pi.country=c.id INNER JOIN drug_category d ON pi.category=d.id WHERE prescription_serial=(SELECT value-1 from setup WHERE name='prescription_serial')";
                }
        		
				$res=$conn->query($sql);
				$i=1;
        		while ($row=$res->fetch_assoc()) {
        	?>
	        	<tr class="items_table_row">
	                <th class="items_table_td" align="center"><?php echo $i;?></th>
	                <th class="items_table_td" align="left"><?php echo $row["brand_name"]." ".$row["country"]." ".$row["category"]?></th>
	                <th class="items_table_td" align="center"><?php echo $row["quantity"]?></th>
	                <th class="items_table_td" align="center"><?php echo $row["frequency"]?></th>
	                <th class="items_table_td" align="center"><?php echo $row["duration"]." Days"?></th>
	                <th class="items_table_td" align="center"><?php echo $row["instruction"]?></th>
	            </tr>
        	<?php
        		$i++;	
        		}
        		$conn->close();
        	?>
        </tbody>
    </table>
    <?php
    	include '../lib/conn.php';
        if (isset($_GET["p_no"])) {
            $sql="SELECT d.name from prescription p INNER JOIN doctor d on p.doctor_id=d.id WHERE prescription_serial='$_GET[p_no]'";
        }
        else{
            $sql="SELECT d.name from prescription p INNER JOIN doctor d on p.doctor_id=d.id WHERE prescription_serial=(SELECT value-1 from setup WHERE name='prescription_serial')";
        }
		$res=$conn->query($sql);
		$row=$res->fetch_assoc();
    ?>
    <table id="footer_table">
        <tr>
            <td class="footer_text">Dr <?php echo $row["name"]?>: </td>
            <td>______________________________________<br><spna class="footer_text"><?php echo date("d-F-Y")?></spna></td>
        </tr>
    </table>
    <p id="dr"></p>
    <p id="signature"></p>
    <button id="print">Print</button>
</body>
</html>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    window.print();
    $(document).ready(function(){
        $("#print").click(function(){
            window.print();
        });
    })    
</script>

<?php
function patient_info(){

}
?>