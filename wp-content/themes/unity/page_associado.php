<?php /* Template Name: AssociadoPage */

if ( !is_user_logged_in() ) {
   auth_redirect();
}

get_header();

$current_user = wp_get_current_user();

// Check if the current user is an associate

//var $user_email = esc_html( $current_user->user_email );
$user_email = " sanchotene@embaubapaisagismo.com.br"; // just for test purposes

$associate = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM sa_usuarios WHERE `email` = %s", $user_email ) );

?>

<div id="content">

<form class="form-horizontal" id="form-associado" name="form-associado">
<fieldset>

<!-- Form Name -->
<legend>Cadastro Associado</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-4">
  <input id="nome" name="nome" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->nome; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="profissao">Profissão</label>  
  <div class="col-md-4">
  <input id="profissao" name="profissao" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->profissao; ?>" />
    
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
  <label class="col-md-4 control-label" for="dtnascimento">Data de Nascimento</label>  
  <div class="col-md-2">
  <input id="dtnascimento" name="dtnascimento" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->nascimento;?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tel">Tel. Residencial</label>  
  <div class="col-md-2">
  <input id="tel" name="tel" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->foneRes; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cel">Celular</label>  
  <div class="col-md-2">
  <input id="cel" name="cel" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->foneCel; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cep">CEP</label>  
  <div class="col-md-2">
  <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->cep; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="logradouro">Logradouro</label>  
  <div class="col-md-5">
  <input id="logradouro" name="logradouro" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->logradouro; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="numero">Nº</label>  
  <div class="col-md-1">
  <input id="numero" name="numero" type="number" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->numero; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="bairro">Bairro</label>  
  <div class="col-md-4">
  <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->bairro; ?>" />
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cidade">Cidade</label>  
  <div class="col-md-4">
  <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $associate->cidade; ?>" />
    
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
       value="<?php 
	if ($associate !== null) 
	   echo $associate->pais;
 	else
   	   echo "Brasil"; 
  	
	?>" />
    
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
    <input id="doc_estudante" name="doc_estudante" type="search" placeholder="" class="form-control input-md" value="<?php echo $associate->doc_estudante; ?>" />
    
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
      <input type="checkbox" name="conf_estatuto" id="conf_estatuto">
      Eu li e estou de acordo com os termos do <a href="http://www.sbau.org.br/estatuto/">Estatuto</a>
    </label>
   </div>
  </div>
</div>

</fieldset>
</form>



</div>

<script>
  // Format fields

  jQuery("#dtnascimento").datepicker();
  jQuery("#tel").mask("(99) 9999-9999");
  jQuery("#cel").mask("(99) 9999-9999");
  jQuery("#cep").mask("99999-999");
	
  // Form button click

  jQuery("#confirmar").click(
	function(){
           var form = jQuery("#form-associado")[0];  
	   if (form.checkValidity()) {
              var checkboxEstatuto = jQuery("#conf_estatuto"); 
	      if (!checkboxEstatuto.prop("checked")) {
	         alert("Antes de prosseguir, você deve aceitar os termos do Estatuto.");
	      	 return false;
	      } else {
	         form.submit();
	      }
           } else {
	      alert("Este campo deve ser preenchido.");
           }
	}); 
</script>


<?php
get_footer();
?>

