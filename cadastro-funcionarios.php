<?php

	/*
	DOCUMENTAÇÃO DE COMANDOS SQL PARA AUXILIAR NA MANUTENÇÃO DO BANCO DE DADOS
	# COMANDOS ELABORADOS POR: MARCOS SILVA
	-- DATA: 29.12.2021
	-- HORÁRIO: 09:14:00
	-- LOCAL: ATUEX EXPRESS
	-- SÃO PAULO, BRASIL.

	----------------------------------------------------------
	---------- LISTAR TODOS OS USUÁRIOS ----------------------
	----------------------------------------------------------

	-- SELECT * FROM A_USER_SYSTEM

	----------------------------------------------------------
	---------- ADICIONAR NOVA COLUNA NA TABELA ---------------
	----------------------------------------------------------

	-- ALTER TABLE A_USER_SYSTEM ADD STATUS_USUARIO VARCHAR(1)

	----------------------------------------------------------
	--------- ATUALIZAR CADASTRO DE USUÁRIO ------------------
	----------------------------------------------------------

	-- UPDATE A_USER_SYSTEM SET STATUS_USUARIO='0' WHERE USUARIO_CPF='05578963512'

	-------------------------------------------------------
	--------- INSERIR USUÁRIO NO SISTEMA ------------------
	-------------------------------------------------------

	------------ PADRÕES DEFINIDOS --------------------
	- CPF: APENAS OS 11 DIGITOS DO CPF SEM PONTO OU TRAÇO
	- NOME: APENAS O PRIMEIRO NOME EM LETRA MAISCULA
	- SENHA: SENHA PADRÃO SÃO OS 5 PRIMEIROS DIGITOS DO CPF
	- TIPO: TIPO DE USUÁRIO: PADRÃO: 0 ATIVO - 1 INATIVO
	- DATA: A DATA EM QUE FOI FEITO O CADASTRO (HOJE)

	--INSERT INTO A_USER_SYSTEM (USUARIO_CPF, NOME_USUARIO, SENHA_USUARIO, TIPO_USUARIO, DATA_CADASTRO) VALUES ('CPF_TODOS_NUMEROS_SEM_PONTO', 'NOME_APENAS_O_PRI', 'SENHAPADRAO_5_PRIMEIROS_DIGITOS_DO_CPF', '0_ATIVO_1_INATIVO', 'DATA_DE_HOJE');

	----------------------------------------------------------------
	-- SE HOUVER MAIS COMANDOS SERÃO LISTADOS AQUI POSTERIORMENTE --
	----------------------------------------------------------------

	*/
	require_once "conexaoSQL/Conexao.php";

	date_default_timezone_set('America/Sao_Paulo');
	$hoje = date('Y.m.d H:i:s'); //PEGA DATA ATUAL PARA PREENCHER AUTOMATICO NA BAIXA
	
	define('DB_HOST'            , "192.168.10.199");
    define('DB_USER'            , "antares");
    define('DB_PASSWORD'        , "inox@60xl");
    define('DB_NAME'            , "ATUAL");
    define('DB_DRIVER'          , "sqlsrv");
	
	session_start(); // --------------------- INICIA A SESSÃO DO USUARIO
	$operador = $_SESSION['login']; //------ CRIA VARIAVEL COM NOME DE USUARIO 
	
	if($operador==""){
		echo "<script type='text/javascript'>alert('ATENCAO :: TEMPO EXPIRADO, LOGAR NOVAMENTE'); window.location='index.php';</script>";
	}
	
	try {
		$Conexao    = Conexao::getConnection(); //SELECT PARA CONTAR QUANTOS USUÁRIOS TEM NO TOTAL
		
		$query2      = $Conexao->query("SELECT TIPO_USUARIO FROM A_USER_SYSTEM
										WHERE NOME_USUARIO = '{$operador}'");
		
		$usuarios2   = $query2->fetchAll();
	
			foreach($usuarios2 as $busca_usuario2) {							
				if($busca_usuario2['TIPO_USUARIO'] != 0){
					
					echo "<script type='text/javascript'>alert('ATENCAO :: ACESSO NÃO PERMITIDO'); window.location='index.php';</script>";
					
				} else { }
			} 
		}	catch (Exception $e){	}
		
	date_default_timezone_set('America/Sao_Paulo');
	$hoje = date('Y'); //PEGA DATA ATUAL PARA PREENCHER AUTOMATICO NA BAIXA
	
	/* CONFERENCIA DE DISPOSITIVO SE É MOBILE OU DESKTOP */

	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
	$windowsphone = strpos($_SERVER['HTTP_USER_AGENT'],"Windows Phone");

	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian || $windowsphone == true) {
	   $dispositivo = "mobile"; //SE FOR MOBILE REDIRECIONA PARA A OUTRA PAGIN
	   header('Location: mobile-cadastro.php');
	 }

	else { $dispositivo = "computador";} //SE NÃO MANTEM A VERSÃO DESKTOP :)		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		
		<link rel="shortcut icon" type="imagex/png" href="logoOficialIco.png">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Cadastro - Funcionários &copy; Atuex Express</title>

		<!--Carrega as bibliotecas JavaSript para as máscaras de CPF, Celular, etc. -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>

		<!--CHAMANDO O ARQUIVO CSS E JAVA SCRIPT-->
		<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
		<link rel="stylesheet" type="text/javascript" href="javascript/javascript.js" media="screen" />

		<script language="JavaScript">
			$(document).keydown(function(event){
   			 if(event.keyCode==123){
        		return false;
    		 }
   			 else if (event.ctrlKey && event.shiftKey && event.keyCode==73){        
             	return false;
    		 }
			 });

			$(document).on("contextmenu",function(e){        
   			e.preventDefault();
			});
    		function protegercodigo() {
    			if (event.button==2||event.button==3){
        		alert('ATENÇÃO::AÇÃO BLOQUEADA');}
    		}
    		document.onmousedown=protegercodigo
		</script>
		<script language="javascript" type="text/javascript"> 
			function limitText(limitField, limitNum) { //FUNÇÃO PARA TRAVAR OS 11 CARACTERES DO CPF E OS 44 DO CONHECIMENTO
				if (limitField.value.length > limitNum) {
					limitField.value = limitField.value.substring(0, limitNum);
				}
			}
			
			function mascaraMutuario(o, f) {
			  v_obj = o
			  v_fun = f
			  setTimeout('execmascara()', 1)
			}

			function execmascara() {
			  v_obj.value = v_fun(v_obj.value)
			}

			function cpfCnpj(v) {
			  //Remove tudo o que não é dígito
			  v = v.replace(/\D/g, '')

			  if (v.length <= 13) {
				//CPF

				//Coloca um ponto entre o terceiro e o quarto dígitos
				v = v.replace(/(\d{3})(\d)/, '$1.$2')

				//Coloca um ponto entre o terceiro e o quarto dígitos
				//de novo (para o segundo bloco de números)
				v = v.replace(/(\d{3})(\d)/, '$1.$2')

				//Coloca um hífen entre o terceiro e o quarto dígitos
				v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2')
			  } else {
				//CNPJ

				//Coloca ponto entre o segundo e o terceiro dígitos
				v = v.replace(/^(\d{2})(\d)/, '$1.$2')

				//Coloca ponto entre o quinto e o sexto dígitos
				v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')

				//Coloca uma barra entre o oitavo e o nono dígitos
				v = v.replace(/\.(\d{3})(\d)/, '.$1/$2')

				//Coloca um hífen depois do bloco de quatro dígitos
				v = v.replace(/(\d{4})(\d)/, '$1-$2')
			  }

			  return v
			}
		</script>
		</head>

<!---------------------------COMEÇANDO CORPO DA PÁGINA---------------------------->
<body>

	<!-- =========================================== ********************************** ==============================
		===================================================== DIV CABECALHO ============================================
		=========================================== ********************************======================================-->
	
	<div id="cabecalho" style="z-index:1000;background-color: white;   display: flex;  align-items: center; box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: white;  height:3.2rem; top:0px; left:0px; 
	margin: 0 auto;     position:fixed;      width: 100%; "> 
		 &nbsp; <a href="painel-Administrativo.php" title="Voltar ao Painel"><img src="inicial.png" title="Página Inicial" style="width: 110px; height: 38px; text-align: center;" /></a>
			
			<label for="logins" style="text-align: center; margin-left:-7rem; font-size: 1.1rem; font-weight:normal; margin-top: -1.2rem;"><br>Cadastro de Funcionários</label>  
		
			<label class="botaoSair" style=" display: flex;  align-items: center; text-align: center; position:fixed; margin-top:-0.1rem;  right:7rem; width: 20rem;  color: white; font-size: 0.9rem;
			height: 1.7rem;   background-color: gray; border-radius:5px; text-align:center; z-index:1000;">&nbsp;MÓDULO ADMINISTRATIVO - Versão 1.3.22</label>
		
			<a href="index.php" title="Sair do sistema" style="text-decoration: none;">
				<label class="botaoSair" style=" display: flex;  align-items: center; text-align: center; position:fixed; margin-top:-0.9rem; right:5px; width: 6rem;  cursor:pointer; color: white; font-size: 1rem;
				height: 1.7rem;   background-color: #f24a4a; border-radius:5px; text-align:center; z-index:1000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sair</label>
			</a>				
	</div>
	
	<div id="login-container" style="width: 50%; margin-top:5rem;">    
    
	    <form action="verificaCadastro-funcionarios.php" method="post">
        
			<!---------------------------CPF FUNCIONÁRIO(A)---------------------------->
			
			<label for="usuario" style='margin-top:-0.8rem; font-size: 1.4rem;'>CPF - Funcionário(a)</label>
			<input type="text" style='font-size: 1.4rem;' onKeyDown="limitText(this,14);" onKeyUp="limitText(this,14); mascaraMutuario(this,cpfCnpj)" placeholder="Digite o CPF do funcionário(a)" required name="cpf" id="cpf" autocomplete="off">
			
			<!---------------------------NOME FUNCIONÁRIO(A)---------------------------->
			
			<label for="usuario" style='font-size: 1.4rem;'>Nome Completo - Funcionário(a) </label>
			<input type="text" style='font-size: 1.4rem;' onKeyDown="limitText(this,30);" onKeyUp="limitText(this,30);" placeholder="Digite o nome completo do(a) funcionário(a)" required name="nome" id="nome" autocomplete="off">
			
			<!---------------------------CARGO DO (A) FUNCIONARIO (A) ----------------->
			
			<label for="usuario" style='font-size: 1.4rem;'>Cargo</label>
			<input type="text" style='font-size: 1.4rem;' onKeyDown="limitText(this,25);" onKeyUp="limitText(this,25);" placeholder="Digite o cargo" required name="cargo" id="cargo" autocomplete="off">
			
			
			<!---------------------------FILIAL FUNCIONÁRIO(A) ----------------->
			
			<label for="usuario" style='font-size: 1.4rem;'>Filial - Funcionário(a)</label>
			<input type="text" style='font-size: 1.4rem;' onKeyDown="limitText(this,3);" onKeyUp="limitText(this,3);" placeholder="Digite a Filial do(a) funcionário(a)" required name="filial" id="filial" autocomplete="off">
			
			<!---------------------------BOTÃO CADASTRAR---------------------------->
			
			<input  type="submit" value="Cadastrar" style='font-size: 1.5rem; height:3rem;' id="entrar" name="entrar">
		</form>	
		<!-- =========================================== ********************************** ===========================
		======================================================== DIV RODAPÉ ===========================================
		=========================================== ********************************======================================-->
		<div id="rodape">
			<label style="background-color: #042f66;    text-align: center;    font-weight:normal;    width:100%;
			color:white;     position:fixed;     bottom:0px;       font-size: 0.9rem;    height: 1.8rem;">
			<?php echo date('Y'); ?> &copy; Todos os direitos reservados - Desenvolvido por Atuex Express - 
			<a href="mailto: suporte@transatual.com.br" style="font-size: 0.9rem; color: white; font-weight:bold; text-decoration:none;">@suporte</a></label>
		</div>
		
	</div>	
</body>
</html>