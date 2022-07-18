
<?php
	
	//PEGA AS VARIAVEIS VINDAS DO OUTRO ARQUIVO
	$cpf =  $_POST['cpf'];
	
	require_once "conexaoSQL/Conexao.php";

	date_default_timezone_set('America/Sao_Paulo');
	$hoje = date('Y.m.d'); //PEGA DATA ATUAL PARA PREENCHER AUTOMATICO NA BAIXA
	
	define('DB_HOST'            , "192.168.10.199");
    define('DB_USER'            , "antares");
    define('DB_PASSWORD'        , "inox@60xl");
    define('DB_NAME'            , "ATUAL");
    define('DB_DRIVER'          , "sqlsrv");	

	// ==================== ***************************************** ==================			
	// ==================== INSERT PARA INSERIR USUARIOS NO SISTEMA
	// ==================== ***************************************** ==================

	try {
		$Conexao    = Conexao::getConnection(); //conecta com o banco
		$query      = $Conexao->query("UPDATE A_USER_SYSTEM SET STATUS_USUARIO='1' WHERE USUARIO_CPF='{$cpf}'");
        $usuarios   = $query->fetchAll();		
	}
	catch (Exception $e){ } 
	echo "<script type='text/javascript'>alert('OK :: Usuário desativado com sucesso.'); window.location='consulta.php';</script>";			
?>

<!DOCTYPE html>
    <html>
    <head>
	<link rel="shortcut icon" type="imagex/png" href="logoOficialIco.ico">
    <title>EXCLUIR CADASTRO - BAIXA MOBILE [ATUEX]</title>
    </head>
    <body>
    </body>
    </html>