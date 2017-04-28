<?php /* Template Name: AssociadoPage */

if ( !is_user_logged_in() ) {
   auth_redirect();
}

define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__.'/associado.php');

get_header();

$action = empty( $_REQUEST['action'] ) ? '' : $_REQUEST['action'];

switch ($action) {
  case 'new':
    add_associado();
    break;
  case 'update':
    update_associado();
    break;
  default:
    main_flow_associado();
    break;
}

get_footer();
?>
