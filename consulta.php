<?php
	require_once "conexaoSQL/Conexao.php";

	date_default_timezone_set('America/Sao_Paulo');
	$hoje = date('Y'); //PEGA DATA ATUAL PARA PREENCHER AUTOMATICO NA BAIXA
	
	define('DB_HOST'            , "192.168.10.199");
    define('DB_USER'            , "antares");
    define('DB_PASSWORD'        , "inox@60xl");
    define('DB_NAME'            , "ATUAL");
    define('DB_DRIVER'          , "sqlsrv");
	  
	session_start();
	$operador = $_SESSION['login']; //------CRIA VARIAVEL COM NOME DE USUARIO 
	
	if($operador==""){
		echo "<script type='text/javascript'>alert('Favor realizar login novamente'); window.location='index.php';</script>"; 
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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
		<title>Consulta de Usuários &copy; [Painel Administrativo] - Atuex Express </title>
		<link rel="shortcut icon" type="imagex/png" href="logoOficialIco.png">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
		<link rel="shortcut icon" type="imagex/png" href="logoOficialIco.ico"> <!--ICONE-->
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		
		<script type="text/javascript" src="javascript/jquery.maskedinput-1.1.4.pack.js"></script>
		<script type="text/javascript" src="javascript/jquery-1.2.6.pack.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>		
		
		<script language="javascript" type="text/javascript"> 
			function limitText(limitField, limitNum) { //FUNÇÃO PARA TRAVAR OS 11 CARACTERES DO CPF E OS 44 DO CONHECIMENTO
				if (limitField.value.length > limitNum) {
					limitField.value = limitField.value.substring(0, limitNum);
				}
			}
		</script>
	</head>
	<body>
		<!-- =========================================== ********************************** ==============================
		===================================================== DIV CABECALHO ============================================
		=========================================== ********************************======================================-->
	
		<div id="cabecalho" style="z-index:1000;background-color: white;   display: flex;  align-items: center; box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: white;  height:3.2rem; top:0px; left:0px; 
		margin: 0 auto;     position:fixed;      width: 100%; "> 
			 &nbsp; &nbsp;<a href="painel-Administrativo.php" title="Voltar"><img src="inicial.png" title="Página Inicial" style="width: 110px; height: 38px; text-align: center;" /></a>
				
				<label for="logins" style="text-align: center; margin-left:-7rem; font-size: 1.1rem; font-weight:normal; margin-top: -1.2rem;"><br>Consulta de Usuários</label>  
			
				<label class="botaoSair" style=" display: flex;  align-items: center; text-align: center; position:fixed; margin-top:-0.1rem;  right:7rem; width: 20rem;  color: white; font-size: 0.9rem;
				height: 1.7rem;   background-color: gray; border-radius:5px; text-align:center; z-index:1000;">&nbsp;MÓDULO ADMINISTRATIVO - Versão 1.3.22</label>
			
				<a href="index.php" title="Sair do sistema" style="text-decoration: none;">
					<label class="botaoSair" style=" display: flex;  align-items: center; text-align: center; position:fixed; margin-top:-0.9rem; right:5px; width: 6rem;  cursor:pointer; color: white; font-size: 1rem;
					height: 1.7rem;   background-color: #f24a4a; border-radius:5px; text-align:center; z-index:1000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sair</label>
				</a>
					
		</div>
			
			<div id="login-container" style="width: 90%; overflow-y: auto; margin-top:4rem;"><center>
				<?php

				/* ======================================= ABRE A TABELA PARA LISTAR OS USUÁRIOS DO SISTEMA ==================
				============================================================================================================*/						

				try {
				$Conexao    = Conexao::getConnection(); //SELECT PERSONALIZADO PARA LISTAR NA TELA OS USUÁRIOS
				
				$query2      = $Conexao->query("SELECT USUARIO_CPF, NOME_USUARIO, SENHA_USUARIO, 
				TIPO_USUARIO, CONVERT(VARCHAR,DATA_CADASTRO,103) AS DATA,FILIAL ,STATUS_USUARIO FROM A_USER_SYSTEM ORDER BY DATA_CADASTRO DESC");
				
				$usuarios2   = $query2->fetchAll();
				
				echo "<table class='linhasAlternadas' style='border-right-color: transparent;width:50rem;margin-top:1rem;'><tr>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>CPF/CNPJ</td>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>NOME</td>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>SENHA</td>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>TIPO</td>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>CADASTRO</td>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>FILIAL</td>
				<td style='border: 1px solid gray; text-align:center; font-weight:bold;'>STATUS</td></tr>";
					foreach($usuarios2 as $busca_usuario2) {
							
						echo "<tr class='even'><td>";
						
						echo "<label style='font-size:0.8rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario2['USUARIO_CPF']."</label></td>"; 
						echo "<td><label style='font-size:0.8rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario2['NOME_USUARIO']."</label></td>"; 
						echo "<td><label style='font-size:0.8rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario2['SENHA_USUARIO']."</label></td>"; 
						
						if($busca_usuario2['TIPO_USUARIO']=='0'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>ADMIN</label></td>";
						}
						else if($busca_usuario2['TIPO_USUARIO']=='1'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>FUNCIONARIOS</label></td>";
						}
						else if($busca_usuario2['TIPO_USUARIO']=='2'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>MOTORISTAS</label></td>";
						}
						else if($busca_usuario2['TIPO_USUARIO']=='3'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>AGREGADOS</label></td>";
						}
						else if($busca_usuario2['TIPO_USUARIO']=='4'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>PARCEIROS</label></td>";
						}	
						else if($busca_usuario2['TIPO_USUARIO']=='5'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>CLIENTES</label></td>";
						}	
						else if($busca_usuario2['TIPO_USUARIO']=='6'){
							echo "<td><label style='font-size:0.8rem; font-weight:normal; color: black; text-align:center;'>VENDEDORES</label></td>";
						}							
						echo "<td><label style='font-size:0.8rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario2['DATA']."</label></td>"; 
						echo "<td><label style='font-size:0.8rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario2['FILIAL']."</label></td>"; 
						
						if($busca_usuario2['STATUS_USUARIO']=='0'){
							echo "<td><label style='box-shadow: 0 2px 0 rgba(0, 0, .3, 0),  0 2px 3px rgba(0, 0, 0.2, 0); border-radius:3px; background-color: #066922; color:white; 
							font-weight:normal; text-align:center; height: 1.8rem; text-align:center; font-size:0.6rem;'><br>ATIVO</label></td>";
						}
						else{
							echo "<td><label style='background-color: red; color:white; font-weight:normal; text-align:center;height: 1.8rem; text-align:center; font-size:0.6rem; 
							box-shadow: 0 2px 0 rgba(0, 0, .3, 0),  0 2px 3px rgba(0, 0, 0.2, 0); border-radius: 3px;'><br>INATIVO</label></td>";
						}
					} 
				}	catch (Exception $e){	}
				
					
				echo "</table>"; //FECHA A TABELA
				?> 	
			
			<label style='font-size:0.7rem; font-weight:normal; color: black; text-align:center;'>*Os dados informados são atualizados em real-time do nosso Banco de Dados. </label> 					
			
			<!--------------------------- DESATIVAR USUÁRIO PELO CPF ---------------------------->
			
			<form action="desativarUsuario.php" method="post">
        
			<!--------------------------- CAMPO CPF ---------------------------->
				
				<label for="usuario" style='text-align: center; font-size: 1.1rem;'>Desativar Usuário (CPF/CNPJ)</label>
				<input type="text" style='text-align: center; font-size: 1.1rem;' onKeyDown="limitText(this,20);" onKeyUp="limitText(this,20);" placeholder="Digite o CPF para desativar o usuário" required name="cpf" id="cpf" autocomplete="off">
				
				<!---------------------------BOTÃO DE DESATIVAR ---------------------------->
		
				<input type="submit" value="Desativar" style='font-size: 1.5rem; height:3rem;' id="entrar" name="excluir">
			</form>
		</div></center>
		
		
		<!-- =========================================== ********************************** ===========================
		======================================================== DIV RODAPÉ ===========================================
		=========================================== ********************************======================================-->
		<div id="rodape">
				<label style="background-color: #042f66;    text-align: center;    font-weight:normal;    width:100%;
				color:white;     position:fixed;     bottom:0px;       font-size: 0.9rem;    height: 1.8rem;">
					<?php echo date('Y'); ?> &copy; Todos os direitos reservados - Desenvolvido por Atuex Express - 
					<a href="mailto: suporte@transatual.com.br" style="font-size: 0.9rem; color: white; font-weight:bold; text-decoration:none;">@suporte</a></label>
		</div>								
	</body>
</html>