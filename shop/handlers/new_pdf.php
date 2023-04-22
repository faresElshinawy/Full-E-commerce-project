<?php
require_once "../shop/handlers/order_func.php";
require_once "../shop/handlers/validation.php";
require_once "../shop/handlers/functions.php";
require_once __DIR__ . "/vendor/autoload.php";



use Dompdf\Dompdf;

$html = '<h1 style="color:green"> example </h1>';

$html .= "hello <em>world</em>";


$dompdf = new Dompdf;

$dompdf -> setPaper("A4");

$dompdf -> loadHtml("$html");

$dompdf -> render();

$dompdf -> addInfo('Title' , 'order items pdf');

$dompdf -> stream("order.pdf" , ['Attachment' => 0]);



