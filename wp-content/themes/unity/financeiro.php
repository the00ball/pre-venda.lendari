<?php

define('__ROOT__', dirname(__FILE__));

require_once(__ROOT__.'/constants.php');
require_once(__ROOT__.'/utils.php');

// Main flow

function main_financeiro($action) {
  switch ($action) {
    default:
      default_flow_financeiro();
      break;
  }
}

function generate_pagseguro_checkout_financeiro() {
  global $wpdb;

  

}

// Pagseguro Notification

function pagseguro_notification_financeiro() {

  $reponseCode = 500;

  global $wpdb;

  // Reading POST params

  $notificationCode = $_POST['notificationCode'];
  $notificationType = $_POST['notificationType'];

  if ($notificationType == "transaction") {

    $url = PAGSEGURO_NOTIFICATION."/$notificationCode?email=".PAGSEGURO_EMAIL."&token=".PAGSEGURO_TOKEN;

    $options = array(
          CURLOPT_URL            => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CONNECTTIMEOUT => 20,
    );

    $curl = curl_init();
    curl_setopt_array($curl, $options);
    $output = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpcode == "200") {

      $notification = simplexml_load_string($output);

      if ($notification !== false) {

        $updated = $wpdb->update(
          "sa_pagseguro",
          array(
            "notificationCode"   => $notificationCode,
            "type"               => $notification->type,
            "status"             => $notification->status,
            "cancellationSource" => $notification->cancellationSource,
            "lastEventDate"      => $notification->lastEventDate,
            "paymentMethod_type" => $notification->paymentMethod->type,
            "paymentMethod_code" => $notification->paymentMethod->code,
            "grossAmount"        => $notification->grossAmount,
            "discountAmount"     => $notification->discountAmount,
            "feeAmount"          => $notification->creditorFees->intermediationFeeAmount,
            "netAmount"          => $notification->netAmount,
            "escrowEndDate"      => $notification->escrowEndDate,
            "extraAmount"        => $notification->extraamount,
            "installmentCount"   => $notification->installmentCount,
            "itemCount"          => $notification->itemCount,
            "shipping_cost"      => $notification->shipping->cost
          ),
          array("reference" => $notification->reference)
        );

        if ($updated !== false) {
          $reponseCode = 200;
        }
      }
    }
  }

  http_response_code($reponseCode);
  exit;
}

function default_flow_financeiro() {

  global $wpdb;

  get_header();

  $status_filter    = $_POST["status"];
  $from_date_filter = empty( $_POST['from_date'] ) ? date('d/m/Y', strtotime('-1 year')) : $_POST['from_date'];
  $to_date_filter   = empty( $_POST['to_date'] ) ? date("d/m/Y") : $_POST['to_date'];

  $sql  = "SELECT date_format(str_to_date(p.`date`, '%Y-%m-%d'), '%d/%m/%Y') as date,";
  $sql .= "u.nome, p.code, p.item_description, p.type, ";
  $sql .= "format(p.item_amount, 2, 'pt_BR') as item_amount, p.status, ";
  $sql .= "coalesce(st.significado, 'Pendente') as significado, coalesce(st.detalhe, 'Aguardando pagamento') as detalhe, ";
  $sql .= "p.netAmount, date_format(str_to_date(p.`escrowEndDate`, '%Y-%m-%d'), '%d/%m/%Y') as escrowEndDate, ";
  $sql .= "tp.significado as tipoPagto, p.installmentCount, mp.significado as meioPagto ";
  $sql .= "FROM sa_pagseguro p ";
  $sql .= "LEFT JOIN sa_statusTransacoes st ON (p.status = st.cod) ";
  $sql .= "LEFT JOIN sa_tipoPagamento tp ON (p.paymentMethod_type = tp.cod) ";
  $sql .= "LEFT JOIN sa_meioPagamento mp ON (p.paymentMethod_code = mp.cod) ";
  $sql .= "INNER JOIN sa_usuarios u ON (p.idCliente = u.id_usuarios) ";
  $sql .= "WHERE ";
  $sql .= "str_to_date(p.`date`, '%Y-%m-%d') between str_to_date('$from_date_filter', '%d/%m/%Y') and str_to_date('$to_date_filter', '%d/%m/%Y') ";
  $sql .= "AND str_to_date(p.`date`, '%Y-%m-%d') <> '0000-00-00' ";

  if ($status_filter != 0) {
    $sql .= "AND p.status = $status_filter ";
  }

  $sql .= "ORDER BY str_to_date(p.`date`, '%Y-%m-%d') DESC";

  $payments = $wpdb->get_results( $sql );

  $sql = "SELECT cod, significado FROM sa_statusTransacoes WHERE cod < 10";

  $status_list = $wpdb->get_results( $sql );

  ?>
    <script>
      jQuery(document).ready(function() {
        jQuery('#payments').DataTable(
          {
            "ordering": false
          }
        );
        jQuery('[data-toggle="tooltip"]').tooltip();
        jQuery("#from_date").datepicker({ dateFormat: 'dd/mm/yy' });
        jQuery("#to_date").datepicker({ dateFormat: 'dd/mm/yy' });
      });
    </script>
    <div id="content">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Financeiro</a>
          </div>

          <form class="navbar-form navbar-left" id="form-financeiro" name="form-financeiro" method="post">
            <fieldset>
              <div class="form-group">

                <!-- Text input-->
                <label class="col-md-1 control-label" for="from_date">De</label>
                <div class="col-md-2">
                  <input id="from_date" name="from_date" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $from_date_filter; ?>" />
                </div>

                <!-- Text input-->
                <label class="col-md-1 control-label" for="to_date">até</label>
                <div class="col-md-2">
                  <input id="to_date" name="to_date" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $to_date_filter; ?>" />
                </div>

                <label class="col-md-1 control-label" for="status">Status</label>
                <div class="col-md-3">
                  <select id="status" name="status" class="form-control">
                    <option value="0">Todos</option>
                    <?php
                    foreach ( $status_list as $status ) {
                      $selected = $status_filter == $status->cod ? "selected" : "";
                    ?>
                      <option value="<?php echo $status->cod;?>" <?php echo $selected; ?>><?php echo $status->significado; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <button id="filtrar" name="filtrar" class="btn btn-primary">Filtrar</button>
              </div>
            </fieldset>
          </form>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="financeiro?action=<?php echo ACT_GEN_ANUIDADE; ?>">Gerar Anuidades</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="panel panel-primary">
        <div class="panel-heading"><h2>Anuidades</h2></div>
        <div class="panel-body">
          <table id="payments" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Status</th>
                <th>Data</th>
                <th>Associado</th>
                <th>Descrição</th>
                <th>Valor Bruto(R$)</th>
                <th>Valor Líquido(R$)</th>
                <th>Data Disponível</th>
                <th>Forma de Pagto</th>
                <th>Meio de Pagto</th>
                <th>Parcelas</th>
                <th>...</th>
            </tr>
            </thead>
            <tbody>
            <?php
              if ($payments !== null) {
                foreach ($payments as $payment) {
                  echo "<tr>";
                  echo "<th><a href='#' data-toggle='tooltip' title='".esc_html( $payment->detalhe )."'>".esc_html( $payment->significado )."</a></th>";
                  echo "<th>".esc_html( $payment->date )."</th>";
                  echo "<th>".esc_html( ucwords( strtolower( $payment->nome ) ) )."</th>";
                  echo "<th>".esc_html( $payment->item_description )."</th>";
                  echo "<th><label class='float-right'>".esc_html( $payment->item_amount )."</label></th>";
                  echo "<th><label class='float-right'>".esc_html( $payment->netAmount )."</label></th>";
                  echo "<th><label class='float-right'>";
                  if ($payment->escrowEndDate != '00/00/0000') {
                    echo esc_html( $payment->escrowEndDate );
                  }
                  echo "</label></th>";
                  echo "<th><label class='float-left'>".esc_html( $payment->tipoPagto )."</label></th>";
                  echo "<th><label class='float-left'>".esc_html( $payment->meioPagto )."</label></th>";
                  echo "<th><label class='float-right'>".esc_html( $payment->installmentCount )."</label></th>";
                  echo "<th>";
                  $imageStatus = get_image_status_associado($payment->status);
                  if ($payment->status == ST_PENDENTE || $payment->status == ST_AGUARDANDO) {
                      echo "<a href='".PAGSEGURO_PAYMENT.$payment->code."'><img src='$imageStatus'/></a></th>";
                  } else {
                      echo "<img src='$imageStatus'/></th>";
                  }
                  echo "</tr>";
                }
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php
  get_footer();
}

function show_restrict_area_financeiro() {
  get_header();
?>
  <div id="content">
    <div class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Área restrita!</strong> Somente administradores do sistema possuem acesso.
    </div>
  </div>
<?php
  get_footer();
}

?>
