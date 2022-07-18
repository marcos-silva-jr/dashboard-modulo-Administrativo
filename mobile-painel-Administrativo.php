<?php
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
    <a href="index.php" title="TELA PRINCIPAL"><img src="inicial.png" title="Página Inicial" style="width: 360px; height: 160px; text-align: center;" /></a>
    <label for="logins" style="text-align: center; font-size: 2.5rem;"><br>Painel Administrativo</label>  
	<center>
	
	<table style="margin-left: 1rem; margin-top: 5rem;"><tr><td>
			
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO CADASTRO DE USUARIOS ===================================
			=========================================== ********************************======================================-->		

			<div style=" margin-top:0.5rem;display: inline-block;text-align:center; width: 95%; height: 9rem; background-color:#042f66; margin-left: 0.5rem; color:white; font-size:2.5rem; border-radius:10px;"><a href='cadastro.php' style='text-decoration:none; color:white; font-weight:bold;'><br>CADASTRO DE USUÁRIOS</a></div>
	
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO CONSULTA DE USUARIOS =========================
			=========================================== ********************************======================================-->
			
			<div style=" margin-top:0.5rem;display: inline-block;text-align:center; width: 95%; height: 9rem; background-color:#042f66;  margin-left: 0.5rem; color:white; font-size:2.5rem; border-radius:10px; "><a href='consulta.php' style='text-decoration:none; color:white; font-weight:bold;'><br>CONSULTA DE USUÁRIOS</a></div>
			
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO BAIXA WEB (MÓDULO PARCEIRO) =========================
			=========================================== ********************************======================================-->

			<div style="margin-top:0.5rem; display: inline-block;text-align:center; width: 95%; height: 7.4rem; background-color:#042f66;  margin-left: 0.5rem;  border-radius:10px; "><a href='enviarDados-ModuloParceiro.php' style='text-decoration:none; color:white; font-size:2rem; font-weight:bold;'><br>BAIXA WEB (MÓDULO PARCEIRO)</a></div>
			
			<!-- =========================================== ********************************** ==============================
			===========================================  DIV BOTÃO BAIXA MOBILE (MÓDULO MOTORISTA) =========================
			=========================================== ********************************======================================-->
			
			<div style=" margin-top:0.5rem;display: inline-block;text-align:center; width: 95%; height: 7.4rem; background-color:#042f66;  margin-left: 0.5rem;  border-radius:10px; "><a href='enviarDados-ModuloMotorista.php' style='text-decoration:none; color:white; font-size:2rem; font-weight:bold;'><br>BAIXA MOBILE (MÓDULO MOTORISTA)</a></div>
			
			<!-- =========================================== ********************************** ==============================
			===========================================  DIV BARRA AMARELA =========================
			=========================================== ********************************======================================-->
			
			<div style=" margin-top:0.7rem; width: 95%; height: 0.8rem; background-color:gold;  margin-left: 0.5rem;  border-radius:10px;"></div>
			
			<!-- =========================================== ********************************** ==============================
			===========================================  DIV BOTÃO VOLTAR =========================
			=========================================== ********************************======================================-->
					
			<div style=" margin-top:0.7rem;display: inline-block;text-align:center; width: 95%; height: 9rem; background-color:#042f66;  margin-left: 0.5rem;  border-radius:10px; "><a href='mobile-index.php' style='text-decoration:none; color:white; font-size:2.5rem; font-weight:bold;'><br>VOLTAR</a></div>
					
			<br><br><br>
		</td></tr> <!---FECHA LINHA E COLUNA DA TABELA DAS DIVS -->
	</table> <!---FECHA TABELA DAS DIVS -->
	  </center>
		<div id="rodape">
			<label style="background-color: #042f66;    text-align: center;    font-weight:normal;    width:100%;
				color:white;     position:fixed;     bottom:0px;    left:0px;     font-size: 1.1rem;    height: 2rem;">
				Atuex Express &copy; Todos os direitos reservados - <?php echo $hoje; ?></label>
		</div>
	</div>	
</body>
</html>