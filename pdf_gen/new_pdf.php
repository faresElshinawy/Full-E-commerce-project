<?php
session_start();
require_once "../shop/core/validation.php";
require_once "../shop/core/functions.php";
require_once "../database/conn.php";
require_once "tcpdf-main/tcpdf.php";

// show order products with order id only function

function get_order_items_by_order_id_only($conn,$id){
    $sql = "SELECT products.pro_id , products.pro_name , products.price , order_items.order_item_id , orders.total_price , colors.color_name FROM pix.orders ,  pix.order_items , pix.products , pix.colors WHERE '$id' = orders.order_id AND '$id' = order_items.order_id AND order_items.product_id = products.pro_id AND colors.color_id = order_items.color_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

$id = sanitize_input($_GET['id']);

$data = get_order_items_by_order_id_only($conn,$id);


if(mysqli_num_rows($data) > 0){
    $data = mysqli_fetch_assoc($data);
    $pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
    $pdf -> SetCreator(PDF_CREATOR);
    $pdf -> SetTitle("Pix Market");
    $pdf -> SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
    $pdf -> SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $pdf -> SetFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
    $pdf -> SetDefaultMonospacedFont('helvetica');  
	$pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);  
	$pdf -> SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT );  
	$pdf -> setPrintHeader(false);  
	$pdf -> setPrintFooter(false);  
	$pdf -> SetAutoPageBreak(TRUE, 10);  
	$pdf -> SetFont('helvetica', '', 12);  
	$pdf -> AddPage(); 

    $content = '';
    $content .= ' <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <style type="text/css">
            body{
            font-size:12px;
            line-height:24px;
            font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            color:#000;
            }  
            
        </style>  
    </head>
    
    <body>   

    <h1 align="center">Pix Market</h1>

    


        <!-- DataTales Example -->
                <table  align="center"  cellpadding="6" class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead >
                        <tr style="font-weight:bold; font-size:13px ;">
                            <th>item id</th>
                            <th>name</th>
                            <th>color</th>
                            <th>price</th>
                        </tr>
                    </thead>
                        <tbody>';



		$data = get_order_items_by_order_id_only($conn,$id);


        while($row = mysqli_fetch_assoc($data)):
            $total = $row['total_price'];
            $content .=  '<tr style="color:gray">

                    <td>'.$row['order_item_id'].'</td>
                    <td>'.$row['pro_name'].'</td>
                    <td>'.$row['color_name'].'</td>
                    <td>$'.$row['price'].'</td>
                </tr>';
            endwhile;
            
            
            
            
            $content .= '
            <hr>
                    </tbody>
                </table>
                    <div>
                    <p align="right">total-price : <span style="color:red">$'. $total.'</span></p>
                    <hr>
                    </div>
    </body>
    
    </html>';

    $pdf -> writeHTML($content);

    $datetime=date('dmY_hms');
    $file_name = "Pix-Market".$datetime.".pdf";

	$pdf->Output($file_name, 'I');



}else{
    echo "<h1 align='center' style='color:red'>there is no order data</h1>";
}






