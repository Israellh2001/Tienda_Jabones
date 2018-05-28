<?php

if(!isset($_POST['producto'], $_POST['precio'], $_POST['envio'])) {
  exit("Hubo un error");
}


use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'config.php';

$producto = $_POST['producto'];
$precio = $_POST['precio'];
$envio = $_POST['envio'];
$precio = (int) $precio;
$subTotal = (int) $precio;
$total = $precio + $envio;

$compra = new Payer();
$compra->setPaymentMethod('paypal');

$articulo = new Item();
$articulo->setName($producto)
         ->setCurrency('MXN')
         ->setQuantity(1)
         ->setPrice($precio);

$listaArticulos = new ItemList();
$listaArticulos->setItems(array($articulo));

$detalles = new Details();
$detalles->setShipping($envio)
         ->setSubtotal($subTotal);

$cantidad = new Amount();
$cantidad->setCurrency('MXN')
         ->setDetails($detalles)
         ->setTotal($total);

$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago ')
            ->setInvoiceNumber(uniqid());

// Cambiar Urls
$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "?exito=true")
              ->setCancelUrl(URL_SITIO . "?exito=false");


$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));


try{
  $pago->create($apiContext);
} catch(Paypal\Exception\PayPalConnectionException $pce) {
  echo "<pre>";
  print_r(json_decode($pce->getData()));
  exit;
  echo "</pre>";
}

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");

?>
