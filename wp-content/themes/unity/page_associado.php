<?php /* Template Name: AssociadoPage */

if ( !is_user_logged_in() ) {
  auth_redirect();
}

define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__.'/associado.php');

$action = empty( $_REQUEST['action'] ) ? '' : $_REQUEST['action'];

main_associado($action);

?>
