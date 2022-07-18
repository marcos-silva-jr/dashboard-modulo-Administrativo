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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		
		<link rel="shortcut icon" type="imagex/png" href="logoOficialIco.png">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Baixa Mobile &copy; Atuex Express</title>

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
		</script>
		</head>

<!---------------------------COMEÇANDO CORPO DA PÁGINA---------------------------->
<body>
	<div id="login-container" style="width: 90%; margin-top:2rem;">
    <a href="painel-Administrativo.php"><img src="inicial.png" title="Página Inicial" style="width: 360px; height: 160px; text-align: center;" /></a>
    <label for="logins" style="text-align: center; font-size: 2.2rem;">Cadastro de Usuário(a)</label>  
	    <form action="verificaCadastro.php" method="post">
        
		<!---------------------------CPF USUARIO---------------------------->
		
		<label for="usuario" style='font-size: 2.5rem;'>CPF Usuário</label>
        <input type="text" style='font-size: 2.5rem;' onKeyDown="limitText(this,11);" onKeyUp="limitText(this,11);" placeholder="Digite o CPF do usuário" required name="cpf" id="cpf" autocomplete="off"><br/>
		
		<!---------------------------NOME USUÁRIO---------------------------->
		
		<label for="usuario" style='font-size: 2.5rem;'>Nome Usuário</label>
        <input type="text" style='font-size: 2.5rem;' onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" placeholder="Digite o nome do usuário" required name="nome" id="nome" autocomplete="off"><br/>
		
		<!---------------------------SENHA USUÁRIO ( 5 digitos) ----------------->
		
		<label for="usuario" style='font-size: 2.5rem;'>Senha Usuário (5 números)</label>
        <input type="text" style='font-size: 2.5rem;' onKeyDown="limitText(this,5);" onKeyUp="limitText(this,5);" placeholder="Digite uma senha de 5 números" required name="senha" id="senha" autocomplete="off"><br/>
		
		<!---------------------------FILIAL SE FOR PARCEIRO ----------------->
		
		<label for="usuario" style='font-size: 2.5rem;'>Filial Parceiro</label>
        <input type="text" style='font-size: 2.5rem;' onKeyDown="limitText(this,5);" onKeyUp="limitText(this,5);" placeholder="Digite a Filial" required name="filial" id="filial" autocomplete="off"><br/>
		
		<!---------------------------TIPO USUÁRIO---------------------------->
		
		<center><label for="usuario" style='font-size: 1.8rem;'>Tipo de Usuário<br><li>0 - ADMIN</li> <li>1 - CHEFIA</li><li>2 - MOTORISTA</li><li>3 - PARCEIRO</li></label>
        <input type="text" style='font-size: 2.5rem;' onKeyDown="limitText(this,1);" onKeyUp="limitText(this,1);" placeholder="Digite o tipo de usuário" required name="tipo" id="tipo" autocomplete="off"><br/><br>
		</center>
		<!---------------------------BOTÃO CADASTRAR---------------------------->
		
        <input  type="submit" value="Cadastrar" style='font-size: 2.5rem; height:5rem;' id="entrar" name="entrar">
	</form>	
	<div id="rodape">
	<label style="background-color: #042f66;    text-align: center;    font-weight:normal;    width:100%;
    color:white;     position:fixed;     bottom:0px;    left:0px;     font-size: 1.1rem;    height: 2rem;">
	Atuex Express &copy; Todos os direitos reservados - <?php echo $hoje; ?></label>
	</div>
		</div>	
</body>
</html>