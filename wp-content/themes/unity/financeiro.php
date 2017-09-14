<?php

define('__ROOT__', dirname(__FILE__));

require_once(__ROOT__.'/constants.php');
require_once(__ROOT__.'/utils.php');

// Main flow

function main_financeiro($action) {
    switch ($action) {
        case ACT_CANCELAR:
            cancelar_registro_financeiro();
            break;
        case ACT_BAIXAR:
            baixa_manual_financeiro();
            break;
        case ACT_GEN_ARQUIVO:
            generate_csv_plan_financeiro();
        default:
            default_flow_financeiro();
            break;
    }
}

function cancelar_registro_financeiro() {
    global $wpdb;

    $msg = "ok";
    $idPagamento = $_POST['idPagamento'];

    $sql = "SELECT status FROM sa_pagseguro WHERE idPagamento = $idPagamento";
    $status = $wpdb->get_var($sql);

    if ($status === null) {
        $msg = "Registro não encontrado";
        goto error;
    }

    if ($status != ST_PENDENTE && $status != ST_AGUARDANDO) {
        $msg = "O registro não pode ser cancelado";
        goto error;
    }

    $updated = $wpdb->update(
          "sa_pagseguro",
          array(
            "status"             => ST_CANCELADA,
            "cancellationSource" => "Manual",
          ),
          array("idPagamento" => $idPagamento)
        );

    if ($updated === false) {
        $msg = "Não foi possível realizar o cancelamento";
        goto error;
    }

    error:

    if (msg == "ok") {
        $status_img = get_image_status_associado($status);
    } else {
        $status_img = get_image_status_associado(ST_CANCELADA);
    }

    $response = array(
        "sender"     => $idPagamento,
        "msg"        => $msg,
        "status_img" => $status_img
    );

    echo json_encode($response);
}

function baixa_manual_financeiro() {
    global $wpdb;

    $msg = "ok";
    $idPagamento = $_POST['idPagamento'];

    $sql = "SELECT status, item_amount FROM sa_pagseguro WHERE idPagamento = $idPagamento";
    $payment = $wpdb->get_row($sql);

    if ($payment === null) {
        $msg = "Registro não encontrado";
        goto error;
    }

    if ($payment->status != ST_PENDENTE && $payment->status != ST_AGUARDANDO) {
        $msg = "O registro não pode ser baixado";
        goto error;
    }

    $dt_disp = date('Y-m-d H:i:s');

    $updated = $wpdb->update(
          "sa_pagseguro",
          array(
            "status"             => ST_DISPONIVEL,
            "paymentMethod_code" => 999, // Manual
            "paymentMethod_type" => 999, // Manual
            "escrowEndDate"      => $dt_disp,
            "netAmount"          => $payment->item_amount,
            "installmentCount"   => 1
          ),
          array("idPagamento" => $idPagamento)
        );

    if ($updated === false) {
        $msg = "Não foi possível realizar a baixa";
        goto error;
    }

    error:

    if (msg == "ok") {
        $status_img = get_image_status_associado($payment->status);
    } else {
        $status_img = get_image_status_associado(ST_DISPONIVEL);
    }

    $response = array(
        "sender"     => $idPagamento,
        "msg"        => $msg,
        "status_img" => $status_img,
        "dt_disp"    => date("d/m/Y")
    );

    echo json_encode($response);
}

function generate_csv_plan_financeiro() {
    global $wpdb;

    $table = "sa_usuarios";

    $existing_columns = $wpdb->get_col("DESC {$table}", 0);
    $sql = implode( ', ', $existing_columns );

    $associates = $wpdb->get_results( "SELECT $sql FROM {$table}", ARRAY_A );

    if ($associates !== null) {
        $csv = "$sql\n";
        foreach($associates as $associate) {
            foreach($existing_columns as $column) {
                $csv .= '"'.$associate[$column].'",';
            }
            $csv .= "\n";
        }
    }
    $date = date('d_m_Y');

    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=sbau_lista_associados_$date.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo $csv;
    exit;
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

  $sql  = "SELECT p.idPagamento, date_format(str_to_date(p.`date`, '%Y-%m-%d'), '%d/%m/%Y') as date,";
  $sql .= "u.nome, p.code, p.item_description, p.type, ";
  $sql .= "format(p.item_amount, 2, 'pt_BR') as item_amount, p.status, ";
  $sql .= "coalesce(st.significado, 'Pendente') as significado, coalesce(st.detalhe, 'Aguardando pagamento') as detalhe, ";
  $sql .= "format(p.netAmount, 2, 'pt_BR') as netAmount, date_format(str_to_date(p.`escrowEndDate`, '%Y-%m-%d'), '%d/%m/%Y') as escrowEndDate, ";
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
        function cancelar(id) {
            if (confirm("Confirma o cancelamento?")) {
                jQuery("#wait_anim").show();
                jQuery.post(
                    "",
                    { action : "<?php echo ACT_CANCELAR; ?>", idPagamento: id },
                    function(data) {
                        jQuery("#wait_anim").hide();
                        var response = jQuery.parseJSON(data);
                        if (response.msg == "ok") {
                            var statusDiv = "#img_status_"+response.sender;
                            var statusDet = "#det_status_"+response.sender;
                            var actionDiv = "#action_"+response.sender;
                            var statusImg = "<img src='"+response.status_img+"'/>";
                            jQuery(statusDiv).html(statusImg);
                            jQuery(actionDiv).html("");
                            jQuery(statusDet).html("Cancelada");
                            //TODO: Precisa atualizar o tooltip também
                        } else {
                            alert(response.msg);
                        }
                    }
                );
            }
        }

        function baixar(id) {
            if (confirm("Confirma a baixa?")) {
                jQuery("#wait_anim").show();
                jQuery.post(
                    "",
                    { action : "<?php echo ACT_BAIXAR; ?>", idPagamento: id },
                    function(data) {
                        jQuery("#wait_anim").hide();
                        var response = jQuery.parseJSON(data);
                        if (response.msg == "ok") {
                            var statusDiv     = "#img_status_"+response.sender;
                            var statusDet     = "#det_status_"+response.sender;
                            var lb_amount     = "#lb_amount_"+response.sender;
                            var lb_net_amount = "#lb_net_amount_"+response.sender;
                            var lb_dt_disp    = "#lb_dt_disp_"+response.sender;
                            var lb_tipo_pgto  = "#lb_tipo_pgto_"+response.sender;
                            var lb_meio_pgto  = "#lb_meio_pgto_"+response.sender;
                            var lb_num_parc   = "#lb_num_parc_"+response.sender;
                            var actionDiv     = "#action_"+response.sender;
                            var statusImg     = "<img src='"+response.status_img+"'/>";
                            jQuery(statusDiv).html(statusImg);
                            jQuery(actionDiv).html("");
                            jQuery(lb_net_amount).html(jQuery(lb_amount).html());
                            jQuery(lb_dt_disp).html(response.dt_disp);
                            jQuery(lb_tipo_pgto).html("Baixa Manual");
                            jQuery(lb_meio_pgto).html("Baixa Manual");
                            jQuery(lb_num_parc).html("1");
                            jQuery(statusDet).html("Disponível");
                            //TODO: Precisa atualizar o tooltip também
                        } else {
                            alert(response.msg);
                        }
                    }
                );
            }
        }

        jQuery(document).ready(function() {
            jQuery('#payments').DataTable(
            {
                "ordering": false
            }
        );
        jQuery('[data-toggle="tooltip"]').tooltip();
        jQuery("#from_date").datepicker({ dateFormat: 'dd/mm/yy' });
        jQuery("#to_date").datepicker({ dateFormat: 'dd/mm/yy' });
        jQuery("#wait_anim").hide();
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
                <ul style="width:220px" class="dropdown-menu">
                <li><a target="_blank" href="financeiro?action=<?php echo ACT_GEN_ARQUIVO; ?>"><img src='<?php echo fmt_img_path("icon_file_excel"); ?>'/>&nbsp;Lista de Associados</a></li>
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
                <th>...</th>
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
                <th>Ações<img id="wait_anim" src="<?php echo fmt_img_path("wait.gif"); ?>"/></th>
            </tr>
            </thead>
            <tbody>
            <?php
              if ($payments !== null) {
                foreach ($payments as $payment) {
                  echo "<tr>";
                  echo "<th><div id='img_status_$payment->idPagamento' style='width:32px'><img src='".get_image_status_associado($payment->status)."'/></div></th>";
                  echo "<th><a id='det_status_$payment->idPagamento' href='#' data-toggle='tooltip' title='".esc_html( $payment->detalhe )."'>".esc_html( $payment->significado )."</a></th>";
                  echo "<th>".esc_html( $payment->date )."</th>";
                  echo "<th>".esc_html( ucwords( strtolower( $payment->nome ) ) )."</th>";
                  echo "<th>".esc_html( $payment->item_description )."</th>";
                  echo "<th><label id='lb_amount_$payment->idPagamento' class='float-right'>".esc_html( $payment->item_amount )."</label></th>";
                  echo "<th><label id='lb_net_amount_$payment->idPagamento' class='float-right'>".esc_html( $payment->netAmount )."</label></th>";
                  echo "<th><label id='lb_dt_disp_$payment->idPagamento' class='float-right'>";
                  if ($payment->escrowEndDate != '00/00/0000') {
                    echo esc_html( $payment->escrowEndDate );
                  }
                  echo "</label></th>";
                  echo "<th><label id='lb_tipo_pgto_$payment->idPagamento' class='float-left'>".esc_html( $payment->tipoPagto )."</label></th>";
                  echo "<th><label id='lb_meio_pgto_$payment->idPagamento' class='float-left'>".esc_html( $payment->meioPagto )."</label></th>";
                  echo "<th><label id='lb_num_parc_$payment->idPagamento' class='float-right'>".esc_html( $payment->installmentCount )."</label></th>";
                  echo "<th><div id='action_$payment->idPagamento' style='width:150px'>";
                  if ($payment->status == ST_PENDENTE || $payment->status == ST_AGUARDANDO) {
                    echo "<a id='act_cancelar' title='Cancelar registro' href='javascript:cancelar($payment->idPagamento)'><img src='".fmt_img_path("bt_cancelar.png")."'/></a>";
                    echo "<a id='act_baixar_pagto' title='Confirmar baixa manual' href='javascript:baixar($payment->idPagamento)'><img src='".fmt_img_path("bt_baixar_pagto.png")."'/></a>";
                    echo "<a href='".PAGSEGURO_PAYMENT.$payment->code."'><img src='".fmt_img_path("84x35-pagar.gif")."'/></a></th>";
                  }
                  echo "</div></th>";
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
