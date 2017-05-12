<?php /* Template Name: FinanceiroPage */

define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__.'/financeiro.php');

if ( !is_user_logged_in() ) {
  auth_redirect();
}

$action = empty( $_REQUEST['action'] ) ? '' : $_REQUEST['action'];

$current_user = wp_get_current_user();
if ( user_can( $current_user, 'administrator' ) ) {
  main_financeiro($action);
} else {
  show_restrict_area_financeiro();
}

?>
