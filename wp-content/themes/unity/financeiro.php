<?php

// Actions List

define("ACT_GEN_ANUIDADE", "gen");


// Main flow

function main_financeiro($action) {
  switch ($action) {
  /*  case ACT_SHOW_UPD_FORM:
      update_flow_associado();
      break;
    case ACT_INSERT_RECORD:
      add_associado();
      break;
    case ACT_UPDATE_RECORD:
      update_associado();
      break;*/
    default:
      default_flow_financeiro();
      break;
  }
}

function default_flow_financeiro() {

  global $wpdb;

  get_header();

  $status_filter    = $_POST["status"];
  $from_date_filter = empty( $_POST['from_date'] ) ? date('d/m/Y', strtotime('-1 year')) : $_POST['from_date'];
  $to_date_filter   = empty( $_POST['to_date'] ) ? date("d/m/Y") : $_POST['to_date'];

  $sql  = "SELECT date_format(str_to_date(p.`date`, '%Y-%m-%d'), '%d/%m/%Y') as date,";
  $sql .= "u.nome, p.notificationCode, p.item_description, p.type, ";
  $sql .= "format(p.item_amount, 2, 'pt_BR') as item_amount, p.status, ";
  $sql .= "coalesce(st.significado, 'Pendente') as significado, coalesce(st.detalhe, 'Aguardando pagamento') as detalhe ";
  $sql .= "FROM sa_pagseguro p ";
  $sql .= "LEFT JOIN sa_statusTransacoes st ON (p.status = st.cod) ";
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
        jQuery('#example').DataTable();
        jQuery('[data-toggle="tooltip"]').tooltip();
        jQuery("#from_date").datepicker({ dateFormat: 'dd/mm/yy' });
        jQuery("#to_date").datepicker({ dateFormat: 'dd/mm/yy' });
      });
    </script>
    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <h2>Financeiro</h2>
          </div>
          <div class="dropdown navbar-right">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Opções
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="financeiro?action=<?php echo ACT_GEN_ANUIDADE; ?>">Gerar Anuidades</a></li>
              <!--li role="separator" class="divider"></li-->
            </ul>
          </div>
        </div>
      </nav>

      <form class="form-horizontal" id="form-financeiro" name="form-financeiro" method="post">
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
            <button id="filtrar" name="filtrar" class="btn btn-default">Filtrar</button>
          </div>
        </fieldset>
      </form>

      <div class="panel panel-default">
        <div class="panel-heading"><h3>Anuidades</h3></div>
        <div class="panel-body">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Status</th>
                <th>Data</th>
                <th>Associado</th>
                <th>Descrição</th>
                <th>Valor (R$)</th>
                <th>...</th>
            </tr>
            </thead>
            <tbody>
            <?php
              if ($payments !== null) {
                foreach ($payments as $payment) {
                  echo "<tr>";
                  echo "<th class='col-md-1'><a href='#' data-toggle='tooltip' title='".esc_html( $payment->detalhe )."'>".esc_html( $payment->significado )."</a></th>";
                  echo "<th class='col-md-1'>".esc_html( $payment->date )."</th>";
                  echo "<th>".esc_html( ucwords( strtolower( $payment->nome ) ) )."</th>";
                  echo "<th>".esc_html( $payment->item_description )."</th>";
                  echo "<th class='col-md-2'><label class='float-right'>".esc_html( $payment->item_amount )."</label></th>";
                  echo "<th class='col-md-1'>";

                  switch ($payment->status) {
                    case ST_PENDENTE:
                    case ST_AGUARDANDO:
                    case ST_EM_ANALISE:
                      echo "<a class='float-right' href='".PAGSEGURO_URL.$payment->notificationCode."'><img src='".get_template_directory_uri()."/images/84x35-pagar.gif'/></a></th>";
                      break;
                    case ST_PAGA:
                    case ST_DISPONIVEL:
                      echo "<img src='".get_template_directory_uri()."/images/pag_status_ok.png'/></th>";
                      break;
                    case ST_EM_DISPUTA:
                    case ST_DEVOLVIDA:
                      echo "<img src='".get_template_directory_uri()."/images/pag_status_devolvida.png'/></th>";
                    case ST_CANCELADA:
                      echo "<img src='".get_template_directory_uri()."/images/pag_status_cancel.png'/></th>";
                      break;
                    default:
                      echo $payment->status;
                      break;
                  }
                  echo "</tr>";
                }
              }
            ?>
            </tbody>
          </table>
      </div></div></div>
  <?php
  get_footer();
}

function show_restrict_area_financeiro() {
  get_header();
?>
  <div class="container">
    <div class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Área restrita!</strong> Somente administradores do sistema possuem acesso.
    </div>
  </div>
<?php
  get_footer();
}

?>
