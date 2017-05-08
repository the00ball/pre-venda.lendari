<?php

// Actions List

define("ACT_SHOW_NEW_FORM", "new");
define("ACT_SHOW_UPD_FORM", "update");
define("ACT_UPDATE_RECORD", "update_record");
define("ACT_INSERT_RECORD", "insert_record");

// Pagseguro URL

define("PAGSEGURO_URL", "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=");

// Pagseguro Status

define("ST_PENDENTE",   0);
define("ST_AGUARDANDO", 1);
define("ST_EM_ANALISE", 2);
define("ST_PAGA",       3);
define("ST_DISPONIVEL", 4);
define("ST_EM_DISPUTA", 5);
define("ST_DEVOLVIDA",  6);
define("ST_CANCELADA",  7);

// Main flow

function main_associado($action) {

  switch ($action) {
    case ACT_SHOW_UPD_FORM:
      update_flow_associado();
      break;
    case ACT_INSERT_RECORD:
      add_associado();
      break;
    case ACT_UPDATE_RECORD:
      update_associado();
      break;
    default:
      default_flow_associado();
      break;
  }
}

function update_flow_associado() {

  global $wpdb;

  $current_user = wp_get_current_user();
  $associate = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM sa_usuarios WHERE `ID` = %d", $current_user->ID ) );

  if ($associate !== null) {
    show_form_associado(ACT_UPDATE_RECORD, $associate);
  } else {
    wp_redirect("associado");
    exit;
  }
}

function default_flow_associado() {
  global $wpdb;

  // Check if the current user is an associate

  $current_user = wp_get_current_user();
  $associate = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM sa_usuarios WHERE `ID` = %d", $current_user->ID ) );

  if ($associate !== null) {
    show_finance_list_associado($associate);
  } else {
    //$user_email = esc_html( $current_user->user_email );
    $user_email = "sanchotene@embaubapaisagismo.com.br"; // just for test purposes
    $associate = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM sa_usuarios WHERE `email` = %s", $user_email ) );

    if ($associate === null) {
      show_form_associado(ACT_INSERT_RECORD);
    } else {
      show_form_associado(ACT_UPDATE_RECORD, $associate);
    }
  }
}

// Show finance List

function show_finance_list_associado($associate) {

  global $wpdb;

  get_header();

  $sql  = "SELECT date_format(str_to_date(p.`date`, '%Y-%m-%d'), '%d/%m/%Y') as date,";
  $sql .= "p.notificationCode, p.item_description, p.type, ";
  $sql .= "format(p.item_amount, 2, 'pt_BR') as item_amount, p.status, ";
  $sql .= "coalesce(st.significado, 'Pendente') as significado, coalesce(st.detalhe, 'Aguardando pagamento') as detalhe ";
  $sql .= "FROM sa_pagseguro p LEFT JOIN sa_statusTransacoes st ON (p.status = st.cod) WHERE ";
  $sql .= "p.`idCliente` = ".esc_html( $associate->id_usuarios ). " AND ";
  $sql .= "str_to_date(p.`date`, '%Y-%m-%d') <> '0000-00-00' ";
  $sql .= "ORDER BY str_to_date(p.`date`, '%Y-%m-%d') DESC";

  $payments = $wpdb->get_results( $sql );
?>
  <script>
    jQuery(document).ready(function() {
      jQuery('#example').DataTable();
      jQuery('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <h2><?php echo esc_html($associate->nome); ?></h2>
        </div>
        <div class="dropdown navbar-right">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Opções
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="associado?action=<?php echo ACT_SHOW_UPD_FORM; ?>">Atualizar Cadastro</a></li>
            <!--li role="separator" class="divider"></li-->
          </ul>
        </div>
      </div>
    </nav>

  <div class="panel panel-default">
    <div class="panel-heading"><h3>Financeiro - Anuidades</h3></div>
    <div class="panel-body">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Status</th>
          <th>Data</th>
          <th>Descrição</th>
          <th>Valor (R$)</th>
          <th>...</th>
      </tr>
      </thead>
      <!--tfoot>
        <tr>
          <th>Data</th>
          <th>Descrição</th>
          <th>Valor</th>
          <th>Status</th>
        </tr>
      </tfoot-->
      <tbody>
      <?php
        if ($payments !== null) {
          foreach ($payments as $payment) {
            echo "<tr>";
            echo "<th class='col-md-1'><a href='#' data-toggle='tooltip' title='".esc_html( $payment->detalhe )."'>".esc_html( $payment->significado )."</a></th>";
            echo "<th class='col-md-1'>".esc_html( $payment->date )."</th>";
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

// Add a new associate to the database

function add_associado() {
  global $wpdb;

  $maskChars = array("(", ")", "-", " ");

  // Hidden fields

  $action = $_POST["action"];

  // Gen new ID

  $id_usuarios = $wpdb->get_var("SELECT max(id_usuarios) FROM sa_usuarios");
  $id_usuarios = ( $id_usuarios === null ) ? 0 : $id_usuarios;

  // Form fields

  $nome = sanitize_text_field($_POST["nome"]);
  $profissao = sanitize_text_field($_POST["profissao"]);
  $sexo = $_POST["sexo"];
  $nascimento = $_POST["nascimento"];
  $res = str_replace($maskChars, "", sanitize_text_field($_POST["res"]));
  $cel = str_replace($maskChars, "", sanitize_text_field($_POST["cel"]));
  $cep = str_replace($maskChars, "", sanitize_text_field($_POST["cep"]));
  $logradouro = sanitize_text_field($_POST["logradouro"]);
  $numero = sanitize_text_field($_POST["numero"]);
  $bairro = sanitize_text_field($_POST["bairro"]);
  $cidade = sanitize_text_field($_POST["cidade"]);
  $uf = $_POST["uf"];
  $pais = sanitize_text_field($_POST["pais"]);
  $estudante = $_POST["estudante"];
  $doc_estudante = sanitize_text_field($_POST["doc_estudante"]);
  $data_cadastro = date('Y-m-d H:i:s');

  $inserted = $wpdb->insert(
    "sa_usuarios",
    array(
      "id_usuarios" => ++$id_usuarios,
      "nome" => $nome,
      "profissao" => $profissao,
      "sexo" => $sexo,
      "nascimento" => $nascimento,
      "foneRes" => $res,
      "foneCel" => $cel,
      "cep" => $cep,
      "logradouro" => $logradouro,
      "numero" => $numero,
      "bairro" => $bairro,
      "cidade" => $cidade,
      "uf" => $uf,
      "pais" => $pais,
      "estudante" => ( $estudante == "on" ) ? "1" : "0",
      "doc_estudante" => $doc_estudante,
      "sn_atualizado_antigo" => "N",
      "tipo_usuario" => 1,
      "data_cadastro" => $data_cadastro,
      "foto_url" => get_avatar_url(get_current_user_id()),
      "ID" => get_current_user_id()
    )
  );

  if ($inserted === false) {

    $associate = new StdClass();

    $associate->nome = $nome;
    $associate->profissao = $profissao;
    $associate->sexo = $sexo;
    $associate->nascimento = $nascimento;
    $associate->foneRes = $res;
    $associate->foneCel = $cel;
    $associate->cep = $cep;
    $associate->logradouro = $logradouro;
    $associate->numero = $numero;
    $associate->bairro = $bairro;
    $associate->cidade =$cidade;
    $associate->uf = $uf;
    $associate->pais = $pais;
    $associate->estudante = $estudante == "on" ? "1" : "0";
    $associate->doc_estudante = $doc_estudante;

    show_form_associado($action, $associate, true);

  } else {
      wp_redirect("associado");
      exit;
  }
}

// Update the current associate

function update_associado() {
  global $wpdb;

  $maskChars = array("(", ")", "-", " ");

  // Hidden fields

  $action = $_POST["action"];
  $id_usuarios = $_POST["id_usuarios"];
  $sn_atualizado_antigo = $_POST["sn_atualizado_antigo"];
  $email = $_POST["email"];

  // Form fields

  $nome = sanitize_text_field($_POST["nome"]);
  $profissao = sanitize_text_field($_POST["profissao"]);
  $sexo = $_POST["sexo"];
  $nascimento = $_POST["nascimento"];
  $res = str_replace($maskChars, "", sanitize_text_field($_POST["res"]));
  $cel = str_replace($maskChars, "", sanitize_text_field($_POST["cel"]));
  $cep = str_replace($maskChars, "", sanitize_text_field($_POST["cep"]));
  $logradouro = sanitize_text_field($_POST["logradouro"]);
  $numero = sanitize_text_field($_POST["numero"]);
  $bairro = sanitize_text_field($_POST["bairro"]);
  $cidade = sanitize_text_field($_POST["cidade"]);
  $uf = $_POST["uf"];
  $pais = sanitize_text_field($_POST["pais"]);
  $estudante = $_POST["estudante"];
  $doc_estudante = sanitize_text_field($_POST["doc_estudante"]);

  $updated = $wpdb->update(
    "sa_usuarios",
    array(
      "nome" => $nome,
      "profissao" => $profissao,
      "sexo" => $sexo,
      "nascimento" => $nascimento,
      "foneRes" => $res,
      "foneCel" => $cel,
      "cep" => $cep,
      "logradouro" => $logradouro,
      "numero" => $numero,
      "bairro" => $bairro,
      "cidade" => $cidade,
      "uf" => $uf,
      "pais" => $pais,
      "estudante" => ( $estudante == "on" ) ? "1" : "0",
      "doc_estudante" => $doc_estudante,
      "sn_atualizado_antigo" => ( $sn_atualizado_antigo == "" ) ? "S" : $sn_atualizado_antigo,
      "foto_url" => get_avatar_url(get_current_user_id()),
      "ID" => get_current_user_id()
    ),
    array("id_usuarios" => $id_usuarios)
  );

  if ($updated === false) {

    $associate = new StdClass();

    $associate->id_usuarios = $id_usuarios;
    $associate->email = $email;
    $associate->nome = $nome;
    $associate->profissao = $profissao;
    $associate->sexo = $sexo;
    $associate->nascimento = $nascimento;
    $associate->foneRes = $res;
    $associate->foneCel = $cel;
    $associate->cep = $cep;
    $associate->logradouro = $logradouro;
    $associate->numero = $numero;
    $associate->bairro = $bairro;
    $associate->cidade =$cidade;
    $associate->uf = $uf;
    $associate->pais = $pais;
    $associate->estudante = $estudante == "on" ? "1" : "0";
    $associate->doc_estudante = $doc_estudante;
    $associate->sn_atualizado_antigo = $sn_atualizado_antigo;

    show_form_associado($action, $associate, true);

  } else {
    wp_redirect("associado");
    exit;
  }
}

function show_form_associado($action, $associate = null, $show_info_error = false) {
  get_header();
?>
  <div class="container">
  <form class="form-horizontal" id="form-associado" name="form-associado" method="post">
  <fieldset>

  <!-- Hidden fields -->

  <input type="hidden" name="action" value="<?php echo $action; ?>">
  <input type="hidden" name="id_usuarios" value="<?php echo $associate->id_usuarios; ?>">
  <input type="hidden" name="email" value="<?php echo $associate->email; ?>">
  <input type="hidden" name="sn_atualizado_antigo" value="<?php echo $associate->sn_atualizado_antigo; ?>">

  <!-- Form Name -->

  <?php
  if ($action === "new") {
  ?>
    <legend>Cadastro de Associado</legend>
  <?php
  } else {
  ?>
    <legend>Atualização de Dados do Associado</legend>
  <?php
    if ($associate->sn_atualizado_antigo == "") {
  ?>
      <div class="alert alert-info fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Aviso!</strong> Seu antigo cadastro foi encontrado através do seu e-mail(<strong><?php echo $associate->email; ?></strong>). Precisamos que você confirme as suas informações.
      </div>
  <?php
    }
  }
  if ($show_info_error === true) {
  ?>
    <div id="msgError" class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong>Erro!</strong> Ocorreu um erro desconhecido. Por favor, tente novamente. Caso o erro persista, entre em contato com o suporte.
    </div>
  <?php
  }
  ?>
  <!-- Required fiels alert -->
  <div id="msgError" class="alert alert-danger fade in" style="display:none;">
    <a href="#" class="close" onclick="jQuery('#msgError').hide()">&times;</a>
    <strong>Erro!</strong> Todos os campos obrigatórios devem ser preenchidos.
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="nome">Nome</label>
    <div class="col-md-4">
      <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->nome); ?>" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="profissao">Profissão</label>
    <div class="col-md-4">
      <input id="profissao" name="profissao" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->profissao); ?>" />
    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="sexo">Sexo</label>
    <div class="col-md-2">
      <select id="sexo" name="sexo" class="form-control">
        <option value="1" <?php if ($associate->sexo == "1") echo "selected"; ?>>Masculino</option>
        <option value="0" <?php if ($associate->sexo == "0") echo "selected"; ?>>Feminino</option>
      </select>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="nascimento">Data de Nascimento</label>
    <div class="col-md-2">
      <input id="nascimento" name="nascimento" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->nascimento);?>" />
    </div>
  </div>

  <div class="form-group">
    <!-- Text input-->
    <label class="col-md-4 control-label" for="res">Tel. Residencial</label>
    <div class="col-md-2">
      <input id="res" name="res" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->foneRes); ?>" />
    </div>
    <!-- Text input-->
    <label class="col-md-1 control-label" for="cel">Celular</label>
    <div class="col-md-2">
      <input id="cel" name="cel" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->foneCel); ?>" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="cep">CEP</label>
    <div class="col-md-2">
      <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->cep); ?>" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="logradouro">Logradouro</label>
    <div class="col-md-5">
      <input id="logradouro" name="logradouro" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->logradouro); ?>" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="numero">Nº</label>
    <div class="col-md-1">
      <input id="numero" name="numero" type="number" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->numero); ?>" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="bairro">Bairro</label>
    <div class="col-md-4">
      <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->bairro); ?>" />
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="cidade">Cidade</label>
    <div class="col-md-4">
      <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo esc_html($associate->cidade); ?>" />
    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="uf">UF</label>
    <div class="col-md-1">
      <select id="uf" name="uf" class="form-control">
        <option value="AC" <?php if ($associate->uf == "AC") echo "selected"; ?>>AC</option>
        <option value="AL" <?php if ($associate->uf == "AL") echo "selected"; ?>>AL</option>
        <option value="AM" <?php if ($associate->uf == "AM") echo "selected"; ?>>AM</option>
        <option value="AP" <?php if ($associate->uf == "AP") echo "selected"; ?>>AP</option>
        <option value="BA" <?php if ($associate->uf == "BA") echo "selected"; ?>>BA</option>
        <option value="CE" <?php if ($associate->uf == "CE") echo "selected"; ?>>CE</option>
        <option value="DF" <?php if ($associate->uf == "DF") echo "selected"; ?>>DF</option>
        <option value="ES" <?php if ($associate->uf == "ES") echo "selected"; ?>>ES</option>
        <option value="GO" <?php if ($associate->uf == "GO") echo "selected"; ?>>GO</option>
        <option value="MA" <?php if ($associate->uf == "MA") echo "selected"; ?>>MA</option>
        <option value="MG" <?php if ($associate->uf == "MG") echo "selected"; ?>>MG</option>
        <option value="MS" <?php if ($associate->uf == "MS") echo "selected"; ?>>MS</option>
        <option value="MT" <?php if ($associate->uf == "MT") echo "selected"; ?>>MT</option>
        <option value="PA" <?php if ($associate->uf == "PA") echo "selected"; ?>>PA</option>
        <option value="PB" <?php if ($associate->uf == "PB") echo "selected"; ?>>PB</option>
        <option value="PE" <?php if ($associate->uf == "PE") echo "selected"; ?>>PE</option>
        <option value="PI" <?php if ($associate->uf == "PI") echo "selected"; ?>>PI</option>
        <option value="PR" <?php if ($associate->uf == "PR") echo "selected"; ?>>PR</option>
        <option value="RJ" <?php if ($associate->uf == "RJ") echo "selected"; ?>>RJ</option>
        <option value="RN" <?php if ($associate->uf == "RN") echo "selected"; ?>>RN</option>
        <option value="RO" <?php if ($associate->uf == "RO") echo "selected"; ?>>RO</option>
        <option value="RR" <?php if ($associate->uf == "RR") echo "selected"; ?>>RR</option>
        <option value="RS" <?php if ($associate->uf == "RS") echo "selected"; ?>>RS</option>
        <option value="SC" <?php if ($associate->uf == "SC") echo "selected"; ?>>SC</option>
        <option value="SE" <?php if ($associate->uf == "SE") echo "selected"; ?>>SE</option>
        <option value="SP" <?php if ($associate->uf == "SP") echo "selected"; ?>>SP</option>
        <option value="TO" <?php if ($associate->uf == "TO") echo "selected"; ?>>TO</option>
      </select>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="pais">País</label>
    <div class="col-md-4">
      <input id="pais" name="pais" type="text" placeholder="" class="form-control input-md" required=""
        value="<?php if ($associate !== null) echo $associate->pais; else echo "Brasil";?>" />
    </div>
  </div>

  <!-- Multiple Checkboxes (inline) -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="estudante"></label>
    <div class="col-md-4">
      <label class="checkbox-inline" for="estudante-0">
        <input type="checkbox" name="estudante" id="estudante-0"<?php if ($associate->estudante == 1) echo "checked";  ?> >
        Estudante
      </label>
    </div>
  </div>

  <!-- Search input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="doc_estudante">Doc. Estudante</label>
    <div class="col-md-2">
      <input id="doc_estudante" name="doc_estudante" type="search" placeholder="" class="form-control input-md" value="<?php echo esc_html($associate->doc_estudante); ?>" />
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="confirmar"></label>
    <div class="col-md-4">
      <button id="confirmar" name="confirmar" class="btn btn-default">
      	<?php
          if ($associate !== null)
      	    echo "Atualizar Cadastro";
          else
            echo "Confirmar Cadastro";
      	?>
      </button>
    </div>
  </div>

  <!-- Multiple Checkboxes -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="conf_estatuto"></label>
    <div class="col-md-4">
    <div class="checkbox">
      <label for="conf_estatuto-0">
        <input type="checkbox" name="conf_estatuto" id="conf_estatuto" required="required">
        Eu li e estou de acordo com os termos do <a href="http://www.sbau.org.br/estatuto/">Estatuto</a>
      </label>
     </div>
    </div>
  </div>

  </fieldset>
  </form>
  </div>

  <script>
    jQuery(document).ready(function() {
      // Format fields

      jQuery("#nascimento").datepicker({ dateFormat: 'dd/mm/yy' });
      jQuery("#res").mask("(99) 9999-9999");
      jQuery("#cel").mask("(99) 9999-9999");
      jQuery("#cep").mask("99999-999");

      // Form button click

      jQuery("#confirmar").click(function(){
        var form = jQuery("#form-associado")[0];
    	  if (!form.checkValidity()) {
          jQuery("#msgError").show();
        }
    	});
    });
  </script>
<?php
  get_footer();
}
?>
