<?php

// Incluir
require 'paypal/autoload.php';

// Variable super global
define('URL_SITIO', 'http://sakuracompany.mipropia.com/ventas.php');

// Instalación del SDK en la pagina
$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
      'AXy2LDOz9Mz8TKFEPqTZE0vDoC8PdY4VPr4yTvaBV4qtzUTt3PsbwlfvSCzBXsFx2ueDOE7BrnfEHywE', // ClienteID
      'ED1WGm5Q3mlYUiY8gxXGQwA4MQT5Xfa3Mc8agbERxqbmNEpkHGpLhMd7DmLdKThR-UONYKJGlZv_Icby'// Sectret
    )
);
