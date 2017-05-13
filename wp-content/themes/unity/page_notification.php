<?php /* Template Name: PagseguroNotification */

header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__.'/financeiro.php');

pagseguro_notification_financeiro();

?>
