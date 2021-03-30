<!DOCTYPE html>
<html>
<head>
    <title>Invoice Print</title>
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <style>
        @media print{
            @page{
                size:  A5;   /* auto is the initial value */
                margin: 10px;  /* this affects the margin in the printer settings */
                padding: 0px;
            }
            #print{
                display: none;
            }
        }
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
        body{
            font-size: 12pt;
        }
        table{
            margin: 0;
            padding: 0;
                
        }
        #invoice_info_table{
            border: 1px solid black;
            border-collapse: collapse;
            color:black;
            padding-left: 10px;
            padding-right: 10px;

        }
        .invoice_info{
            font-size: 8pt;
            padding:5px 10px;
            font-family: "roboto medium";

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
            font-size: 10px;
            font-family: "roboto regular";
        }
        .items_table_td{
            border:1px solid black;
            padding: 5px;
            font-size: 10px;
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
    </style>
</head>
<body>
    <table width="100%;" id="image">
        <thead>
            <tr>
                <th align="left" width="100%" colspan="6"><img src="../app_images/banner.png" width="100%;"></th>
            </tr>
            <tr>
                <th width="10%" rowspan="2" class="header_icon_holder"><i class="fas fa-phone header_icon"></i></th>
                <th width="20%" align="left" class="header_info">+252618796358</th>
                <th width="10%" rowspan="2" class="header_icon_holder"><i class="fas fa-envelope header_icon"></i></th>
                <th width="25%" align="left" class="header_info">aamadan2@gmail.com</th>
                <th width="10%" rowspan="2" class="header_icon_holder"><i class="fas fa-map-marker-alt header_icon"></i></th>
                <th width="25%" align="left" class="header_info">Seybiyaano Hodan</th>
            </tr>
            <tr>
                <th width="20%" align="left" class="header_info">+252618796358</th>
                <th width="25%" align="left" class="header_info">aamadan2@gmail.com</th>
                <th width="25%" align="left" class="header_info">Mogadishu - Somalia</th>
            </tr>
        </thead>
    </table>
    <?php
    include '../lib/conn.php';
    $sql="CALL rp_invoice_print('$_GET[invoice_number]')";
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();
    // print_r($row);
    ?>
    <table width="100%" id="invoice_info_table" style="margin-top: 10px; table-layout: fixed;">
        <thead>
            <tr class="invoice_info_row">
                <td width="15%" align="left" class="invoice_info">INVOICE NO:</td>
                <td width="38%" align="left" class="invoice_info"><?php echo $row["invoice_no"]?></td>
                <td width="20%" align="left" class="invoice_info">SALES TYPE:</td>
                <td width="22%" align="left" class="invoice_info"><?php echo $row["sales_type"]?></td>
                
            </tr>
            <tr class="invoice_info_row">
                <td width="15%" align="left" class="invoice_info">Name:</td>
                <td width="38%" align="left" class="invoice_info"><?php echo $row["customer_name"]?></td>
                <td width="20%" align="left" class="invoice_info">Date:</td>
                <td width="22%" align="left" class="invoice_info"><?php echo $row["invoice_date"]?></td>
            </tr>
        </thead>
    </table>
    <?php $conn->close();?>
    <table width="100%" style="margin-top: 10px;" id="items_table">
        <thead>
            <tr class="items_table_row">
                <th class="items_table_td" align="center">S.No</th>
                <th class="items_table_td" align="left">Item Name</th>
                <th class="items_table_td" align="left">Unit</th>
                <th class="items_table_td" align="center">Qty</th>
                <th class="items_table_td" align="center">Price</th>
                <th class="items_table_td" align="center">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../lib/conn.php';
            $result=$conn->query($sql);
            $i=1;
            while ($items=$result->fetch_assoc()) {
            ?>
            <tr class="items_table_row">
                <td class="items_table_td" align="center"><?php echo $i?></td>
                <td class="items_table_td" align="left"><?php echo $items["brand_name"]." ".$items["category"]." ".$items["country"]?></td>
                <td class="items_table_td" align="left" style=" text-transform: uppercase;"><?php echo $items["sales_unit"]?></td>
                <td class="items_table_td" align="center"><?php echo $items["qty"]?></td>
                <td class="items_table_td" align="center"><?php echo $items["price"]?></td>
                <td class="items_table_td" align="center"><?php echo $items["amount"]?></td>
            </tr>
            <?php
                $i++;
            }
            $conn->close();
            include '../lib/conn.php';
            $sql="SELECT total,discount,paid,rest FROM sales_invoice_info WHERE invoice='$_GET[invoice_number]'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            ?>
            <tr>
                <td rowspan="2" colspan="2" align="center" style="padding: 5px;font-size: 10px;font-family: 'roboto regular';">Seller Signature<br><br>_______________________________________________________</td>
                <td class="items_table_td">Total</td>
                <td class="items_table_td" align="center"><?php echo "$".$row["total"]?></td>
                <td class="items_table_td">Discount</td>
                <td class="items_table_td" align="center"><?php echo "$".$row["discount"]?></td>
            </tr>
            <tr>
                <td class="items_table_td">Paid</td>
                <td class="items_table_td" align="center"><?php echo "$".$row["paid"]?></td>
                <td class="items_table_td">Rest</td>
                <td class="items_table_td" align="center"><?php echo "$".$row["rest"]?></td>
            </tr>
        </tbody>
    </table>
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