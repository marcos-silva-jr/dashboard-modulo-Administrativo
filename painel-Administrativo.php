<?php

	header("Refresh:120"); //REFRESH NA PÁGINA DE 2 E 2 MINUTOS
	
	require_once "conexaoSQL/Conexao.php";
	
	date_default_timezone_set('America/Sao_Paulo');
	
	$hojeSistema = date('Y.m.d');
	
	$datahoje = date('Y.m.d 00:00:00');
		
	$hoje = date('Y'); //PEGA DATA ATUAL PARA PREENCHER AUTOMATICO NA BAIXA
	
	  
	//date_default_timezone_set('America/Sao_Paulo');
	$hoje = date('Y'); //PEGA DATA ATUAL PARA PREENCHER AUTOMATICO NA BAIXA

	
	session_start(); // --------------------- INICIA A SESSÃO DO USUARIO
	$operador = $_SESSION['login']; //------ CRIA VARIAVEL COM NOME DE USUARIO 
	
	if($operador==""){
		echo "<script type='text/javascript'>alert('ATENCAO :: TEMPO EXPIRADO, LOGAR NOVAMENTE'); window.location='index.php';</script>";
	}
	
	try {
		$Conexao    = Conexao::getConnection(); //SELECT PARA CONTAR QUANTOS USUÁRIOS TEM NO TOTAL
		
		
		
		$usuarios2   = $query2->fetchAll();
	
			foreach($usuarios2 as $busca_usuario2) {							
				if($busca_usuario2['TIPO_USUARIO'] != 0){ //SE NÃO FOR ADMIN NÃO PODE ACESSAR A PÁGINA  # ====== PERMISSÕES ====== #
					
					echo "<script type='text/javascript'>alert('ATENCAO :: ACESSO NÃO PERMITIDO'); window.location='index.php';</script>";
					
				} else { }
			} 
		}	catch (Exception $e){	}
	
	$operador = substr($operador, 0, 18);
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		
		<link rel="shortcut icon" type="imagex/png" href="fav.png"> <!--ICONE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Painel &copy; Atuex Express</title>

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
		
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			
			/* =========================================== ********************************** ==============================
			=========================================== ********************************** ==============================
			============================================ MOSTRAR GRAFICO DE BAIXAS NA DIV ============================
			=========================================== ********************************** ==============================
			=========================================== ********************************======================================*/
			
			/// PEGAR A DATA ATUAL PARA MOSTRAR NA VARIAVEL
			
			var data = new Date();
			var dia = String(data. getDate()). padStart(2, '0');
			var mes = String(data. getMonth() + 1). padStart(2, '0');
			var ano = data. getFullYear();
			var dataAtual = dia + '/' + mes + '/' + ano;

			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
			  
				["Usuário", "N° Baixas", { role: "style" } ],
				<?php
				
				/* ================ ABRE O BANCO ========
				========================================*/						

				try {
					$Conexao    = Conexao::getConnection(); 
					
					//SELECT GERAL PARA PEGAR OS PARCEIROS E MOTORISTAS COM SEUS CONTADORES
					
					
																		
					$executa = $quer->fetchAll();
					$primeirocontador=1;
					
						foreach($executa as $buscar) {		
						
							$nomeUser = $buscar['OPERADOR'];	
							$contador_user = $buscar['CONTT'];							
				?>
				['<?php echo $nomeUser.'                              '; ?>', <?php echo $contador_user;
				$primeirocontador=$primeirocontador+1; ?>, "#154c79"],

				<?php	
					} }	catch (Exception $e){	}
				?>		
				
			  ]);

			  var view = new google.visualization.DataView(data);
			  view.setColumns([0, 1,
							   { calc: "stringify",
								 sourceColumn: 1,
								 type: "string",
								 role: "annotation" },
							   2]);

			  var options = {
				title: "ANÁLISE DE BAIXAS - APP BAIXA MOBILE "+dataAtual,
				width: 1100,
				height: 650,
				bar: {groupWidth: "95%"},
				legend: { position: "none" },
			  };
			  var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
			  chart.draw(view, options);
			}
			/* ========= DIV ACESSO RAPIDO  =========== */
			
			function mostraBaixaDiaria(){		
				//ALTERA A COR DOS FUNDOS
				let alterar = document.getElementById('consulta'); 
				alterar.style.background = '#dfdfdf'; 
								
				//ESCONDE AS OUTRAS DIVS				
				$('#login-container').hide(); 						
				
				//MOSTRA MINHA DIV				
				$('#div_baixasdodia').show(); 
			}
		  </script>		
		
		</head>

<!---------------------------COMEÇANDO CORPO DA PÁGINA---------------------------->
<body>
	
	
	<!-- =========================================== ********************************** ==============================
	=========================================== DIV FIXA PRINCIPAL LATERAL ESQUERDA ====================================
	=========================================== ********************************======================================-->
		
	<div id="cabecalho" style="background-color: white;    box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    
	color: white;  height:100%; top:0px; left:0px; 	margin: 0 auto;      overflow: auto;    position: fixed; width: 10rem; "> 
		<center>
		
		
		<!-- =========================================== ********************************** ==============================
		====================================================== FOTO DO USUÁRIO ============================================
		=========================================== ********************************======================================-->
		
		<br><br><br>
		<img  src="foto-user.png" style="width: 90px; height: 90px; " />
		
		<!-- =========================================== ********************************** ==============================
		====================================================== NOME DO PARCEIRO ============================================
		=========================================== ********************************======================================-->
		
		<label style="margin-top:-0.5rem; text-align: center;  color: white; font-size: 0.9rem;	 height: 2rem;   background-color: gray;
		border-radius:5px; box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);  width: 90%; display: flex;  align-items: center; z-index:1000;">
		<a href="painel-Administrativo.php" style="text-decoration: none; text-align:center; cursor:pointer;"><?php echo "<label style='text-align:center; color:white; font-size:0.9rem;'>".$operador."</label>"; ?></label></a>
		
		
		<!-- ======================= *********CADASTRO USUARIOS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>
					
					<td>
						<a href="cadastro.php" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">CADASTRO USUÁRIOS</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= *********CONSULTA USUARIOS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>
					
					<td>
						<a href="consulta.php" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">CONSULTA USUÁRIOS</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= *********CONSULTA BAIXAS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="consulta" onclick="mostraBaixaDiaria()" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>
					
					<td>
						<a href="#" style="text-decoration: none;" onclick="mostraBaixaDiaria()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">CONSULTA BAIXAS MOBILE</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= *********CONSULTA RAPIDA ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="consultatracking/" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">CONSULTA RÁPIDA WEB</label></a>
					</td>
				</tr>
			</table>
		</div>
	
		<!-- ======================= ********* CADASTRO FUNCIONARIOS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="cadastro-funcionarios.php" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">CADASTRO FUNC. (TERMO DE RESP.)</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* COMPROVANTES WEB ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="comprovantes-web.php" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">COMPROVANTES WEB</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		
		<!-- ======================= ********* CONSULTA FUNCIONARIOS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style="background-color:red; display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="#"  style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="color: white; cursor: pointer; font-weight:normal; font-size: 0.7rem;">CONSULTA FUNCIONARIOS</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* CONSULTA TERMOS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style="background-color:red; display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="#" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem; color: white;">CONSULTA TERMOS RESPONS.</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* ANALISE DE BAIXAS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" color: white;  display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);        z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="analise-motoristas.php" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem; color: black;">ANÁLISE DE BAIXAS MOBILE</label></a>
					</td>
				</tr>
			</table>
		</div>
		<!-- ======================= ********* BAIXA WEB MÓDULO PARCEIRO ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="enviarDados-ModuloParceiro.php" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">BAIXA WEB - MÓDULO PARCEIRO</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* BAIXA MOBILE - MÓDULO MOTORISTA ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="enviarDados-ModuloMotorista.php" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">BAIXA MOBILE - MÓDULO MOTORISTAS</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* DASHBOARD CLIENTES ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="dashboard-cliente.php" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">DASHBOARD - MÓDULO CLIENTES</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* DASHBOARD MÓDULO FUNCIONARIOS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="painel-Operacional.php" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">DASHBOARD - MÓDULO FUNCIONÁRIOS</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* DASHBOARD GERENCIAMENTO DE PARCEIROS ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: black;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="dashboard-gerenciamento-parceiros.php" target="_blank" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem;">DASHBOARD - MÓDULO GER. DE PARCEIROS</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- ======================= ********* DASHBOARD DIRETORIA ===================================
		========================= ********************************==========================-->
		
		<br>
		<div id="acesso_rapido" style=" display: flex;  align-items: center; width: 90%; height:2rem; font-size:1rem; border-radius:3px;  box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    background-color:red;     z-index:1000;"> 
			<table>
				<tr>					
					<td>
						<a href="#" style="text-decoration: none;" onclick="div_acesso_rapido()"><label style="cursor: pointer; font-weight:normal; font-size: 0.7rem; color: white;  ">DASHBOARD - MÓDULO DIRETORIA</label></a>
					</td>
				</tr>
			</table>
		</div>
		
		
		<br><br><br><br><br><br><br><br><br>
	

		<!-- =========================================== ********************************** ==============================
		====================================================== FECHA DIV DO MENU LATERAL ============================================
		=========================================== ********************************======================================-->
		
		</center>
		
			
		
	</div>
	
	<!-- =========================================== ********************************** ==============================
	===================================================== DIV CABECALHO ============================================
	=========================================== ********************************======================================-->
	
	<div id="cabecalho" style="z-index:1000;background-color: white;   display: flex;  align-items: center; box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);    color: white;  height:3.2rem; top:0px; left:0px; 
	margin: 0 auto;     position:fixed;      width: 100%; "> 
		 &nbsp; &nbsp; &nbsp; &nbsp; <a href="index.php" title="TELA PRINCIPAL"><img src="inicial.png" title="Página Inicial" style="width: 110px; height: 38px; text-align: center;" /></a>
			
			<label for="logins" style="text-align: center; margin-left:-7rem; font-size: 1.1rem; font-weight:normal; margin-top: -1.2rem;"><br>Dashboard</label>  
		
			<label class="botaoSair" style=" display: flex;  align-items: center; text-align: center; position:fixed; margin-top:-0.1rem;  right:7rem; width: 20rem;  color: white; font-size: 0.9rem;
			height: 1.7rem;   background-color: gray; border-radius:5px; text-align:center; z-index:1000;">&nbsp;MÓDULO ADMINISTRATIVO - Versão 1.3.22</label>
		
			<a href="index.php" title="Sair do sistema" style="text-decoration: none;">
				<label class="botaoSair" style=" display: flex;  align-items: center; text-align: center; position:fixed; margin-top:-0.9rem; right:5px; width: 6rem;  cursor:pointer; color: white; font-size: 1rem;
				height: 1.7rem;   background-color: #f24a4a; border-radius:5px; text-align:center; z-index:1000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sair</label>
			</a>
				
	</div>
	
	
	<div id="login-container" style=" margin-top:4rem; margin-left:11rem; margin-right:1rem; ">
		<!-- ==================== DIV DOS USUARIOS ==================================== -->
		
		<div style=" display: inline-block; width: 30rem; height: 16rem; background-color:#154c79; 
		margin-left: -3%; color:white; font-size:0.9rem; border-radius:10px;">
			<br> <br><br>
			<img src="foto-users.png" style=" width: 100px; height: 100px;" align="left"/>
	
			<?php

				/* ======================================= ABRE O BANCO PARA PODER EXIBIR AS INFORMAÇÕES (USUARIOS) ==========
				============================================================================================================*/						

				try {
					$Conexao    = Conexao::getConnection(); //SELECT PARA CONTAR QUANTOS USUÁRIOS TEM NO TOTAL
					
					
					
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Usuarios = $busca_usuario2['CONTT'];							
						} 
					
					
				
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Op = $busca_usuario2['CONTT'];							
						} 
					
					
				
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Motoristas = $busca_usuario2['CONTT'];							
						} 
					
					
				
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {
							$contador_Agregados = $busca_usuario2['CONTT'];							
						} 
						
								
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {
							$contador_Parceiros = $busca_usuario2['CONTT'];							
						} 
					
					
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Clientes = $busca_usuario2['CONTT'];							
						} 
						
					
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Vendedores = $busca_usuario2['CONTT'];							
						} 
					}	catch (Exception $e){	}
			?> 		
			
			
			<table>
				<tr>
					<td>
						<label style='color:white; font-weight:normal; font-size: 5.6rem; margin-top:-1rem;'> <?php echo $contador_Usuarios; ?>  </label>
					</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><div style="background-color: gold; width:0.2rem; height:6rem;"></div></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
					<br><label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.9rem;'><?php echo $contador_Op; ?>&nbsp;FUNCIONARIOS</label>
					<br><label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.9rem;'><?php echo $contador_Motoristas; ?>&nbsp;MOTORISTAS</label>
					<br><label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.9rem;'><?php echo $contador_Agregados; ?>&nbsp;AGREGADOS</label>
					<br><label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.9rem;'><?php echo $contador_Parceiros; ?>&nbsp;PARCEIROS </label>
					<br><label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.9rem;'><?php echo $contador_Clientes; ?>&nbsp;CLIENTES</label>
					<br><label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.9rem;'><?php echo $contador_Vendedores; ?>&nbsp;GER. PARCEIROS</label>
					</td>
				</tr>
				<tr>
					<td>
						<label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-1rem;'>&nbsp;&nbsp;&nbsp;USUÁRIOS</label>
					</td>
					
				</tr>
				
			</table>
			<br>
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO CADASTRO DE USUARIOS ===================================
			=========================================== ********************************======================================-->
			<div style=" margin-top: -2 rem; display: inline-block;text-align:center; width: 7rem; height: 3rem; background-color:#F7C504;  color:white; font-size:1.1rem; border-radius:10px;"><a href='cadastro.php' style='text-decoration:none; color:white; font-size:0.9rem; font-weight:bold;'><br>&bull; CADASTRO</a></div>
			&nbsp;&nbsp;
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO CONSULTA DE USUARIOS =========================
			=========================================== ********************************======================================-->
			
			<div style="display: inline-block;text-align:center; width: 7rem; height: 3rem; background-color:#F7C504;  color:white; font-size:1.1rem; border-radius:10px;"><a href='consulta.php' style='text-decoration:none; color:white; font-size:0.9rem; font-weight:bold;'><br>&bull; CONSULTA</a></div>
			&nbsp;&nbsp;
			
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO ALTERAÇÃO DE USUARIOS =========================
			=========================================== ********************************======================================-->
			
			<div style=" display: inline-block;text-align:center; width: 7rem; height: 3rem; background-color:#F7C504; color:white; font-size:1.1rem; border-radius:10px;"><a href='#' style='text-decoration:none; color:white; font-size:0.9rem; font-weight:bold;'><br>&bull; ALTERAÇÃO</a></div>
		</div> <!--FECHA DIV DOS USUARIOS -->
		&nbsp;&nbsp;&nbsp;&nbsp;
			
			
		
		<!-- ==================== DIV DAS BAIXAS ==================================== -->
		
		<div style="display: inline-block;   height: 16rem; background-color: #76b5c5;  width: 30rem;
		margin-right:1rem; color:white; font-size:0.9rem; border-radius:10px; text-align:center;">
			<br> <br><br>
			<center>
	
			<?php
				try {
					$Conexao    = Conexao::getConnection(); //SELECT PARA CONTAR QUANTOS USUÁRIOS TEM NO TOTAL
					
										
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Baixas = $busca_usuario2['CONTT'];							
						} 					
					
									
					$usuarios2   = $query2->fetchAll();
				
						foreach($usuarios2 as $busca_usuario2) {							
							$contador_Hoje = $busca_usuario2['CONTT'];							
						} 
					}	catch (Exception $e){	}
			?> 		
						
			<table>
				<tr>
					<td>
						<label style='color:white; font-weight:normal; font-size: 5.6rem; text-align:center;'> <?php echo $contador_Baixas; ?>  </label>
					</td>					
				
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;<img src="baixas-grafico.png" style=" width: 100px; height: 100px;"/>
					</td>					
				</tr>
				<tr>
					<td>
						<label style='color: white; font-size: 0.9rem; font-weight: normal; margin-top:-0.6rem; margin-right: 0rem;'>&nbsp;&nbsp;&nbsp;BAIXAS NO SISTEMA HOJE</label>
					</td>					
				</tr>				
			</table>
			</center>
			<!-- =========================================== ********************************** ==============================
			=========================================== DIV BOTÃO ACESSAR TODAS AS BAIXAS ===================================
			=========================================== ********************************======================================-->
			<div style=" margin-top:1.6rem; display: inline-block;text-align:center; width: 60%; height: 3rem; background-color:#F7C504; 
			color:white; font-size:1.4rem; border-radius:10px;" onclick="mostraBaixaDiaria()"><a href='#' style='text-decoration:none; color:white; font-size:0.9rem; font-weight:bold;'><br>&bull; <?php echo $contador_Hoje; ?> VISUALIZAR BAIXAS DE HOJE</a></div>
			&nbsp;&nbsp;
			
		</div> <!--FECHA DIV DAS BAIXAS -->
		
		
		<br><br>		
		
	<!-- ====================================== ********************************** ==========================
			=========================================== ---------------------------------- ===================
			======================================== ULTIMA DIV ===================== =====================
			=========================================== ---------------------------------- =====================
			=========================================== ******************************** =========================-->
				
	<div style="display: inline-block;  height: 19rem; background-color: #76b5c5;  width: 63rem;
		margin-right:2rem; color:white; font-size:0.9rem; border-radius:10px;">
		<br>
			<table>
				<tr>
					<td>
						<img src="estatistica.jpg" style=" width: 160px; height: 110px;"/>
					</td>
					
					<td>
						
						<div style=" margin-top:0.5rem;display: inline-block;text-align:left; height: 3.6rem; background-color:#1d7e96;   border-radius:10px; "><a href='/App/dashboard-cliente.php' style='text-decoration:none; color:white; font-size:1rem; font-weight:bold;'><br>&nbsp;&nbsp;&bull; DASHBOARD CLIENTE &nbsp;&nbsp;</a></div><br>
						
						<!-- =========================================== ********************************** ==============================
						=========================================== DIV BOTÃO PAINEL OPERACIONAL =========================
						=========================================== ********************************======================================-->
						
						<div style=" margin-top:0.5rem;display: inline-block;text-align:center; height: 3.6rem; background-color:#1d7e96;   border-radius:10px; "><a href='painel-Operacional.php' style='text-decoration:none; color:white; font-size:1rem; font-weight:bold;'><br>&nbsp;&nbsp;&bull; DASHBOARD FUNCIONARIOS &nbsp;&nbsp;</a></div><br>
						
						<!-- =========================================== ********************************** ==============================
						=========================================== DIV PAINEL LOGISTICO - CONTROLE DE ENTREGA =========================
						=========================================== ********************************======================================-->
						
						<div style=" margin-top:0.5rem;display: inline-block;text-align:center; height: 3.6rem; background-color:#1d7e96;  border-radius:10px; "><a href='painel-logistico.php' style='text-decoration:none; color:white; font-size:1rem; font-weight:bold;'><br>&nbsp;&nbsp;&bull; DASHBOARD DIRETORIA &nbsp;&nbsp;</a></div><br>
						
						<!-- =========================================== ********************************** ==============================
						=========================================== DIV PAINEL GERENCIAMENTO DE PARCEIROS - TAIS =========================
						=========================================== ********************************======================================-->
						
						<div style="margin-top:0.5rem; display: inline-block; text-align:center; height: 3.6rem; background-color:#1d7e96;  width:28rem;  border-radius:10px; "><a href='dashboard-gerenciamento-parceiros.php' style='text-decoration:none; color:white; font-size:1rem; font-weight:bold;'><br>&bull; DASHBOARD GERENCIAMENTO DE PARCEIROS &nbsp;&nbsp;</a></div>
					
					</td>
					
					
					<td>
						<img src="acesso_rapido_mobile.jpg" style=" width: 80px; height: 100px;"/>
					</td>
					
					<td>						
						<!-- =========================================== ********************************** ==============================
						=========================================== DIV BOTÃO BAIXA WEB (MÓDULO PARCEIRO) =========================
						=========================================== ********************************======================================-->

						<div style=" display: inline-block;height: 3.6rem; background-color:#0e90ad;  border-radius:10px; margin-left:-3rem;"><a href='enviarDados-ModuloParceiro.php' style='text-decoration:none; color:white; font-size:1rem; font-weight:bold;'><br>&nbsp;&nbsp;&bull; BAIXA WEB (MÓDULO PARCEIRO)&nbsp;&nbsp;</a></div>
						
						<!-- =========================================== ********************************** ==============================
						=========================================== DIV BOTÃO BAIXA MOBILE (MÓDULO MOTORISTA) =========================
						=========================================== ********************************======================================-->
						
						<div style=" margin-top:0.5rem; display: inline-block;  height: 3.6rem; background-color:#0e90ad; margin-left:-3rem;  border-radius:10px; "><a href='enviarDados-ModuloMotorista.php' style='text-decoration:none; color:white; font-size:1rem; font-weight:bold;'><br>&nbsp;&nbsp;&bull; BAIXA MOBILE (MÓDULO MOTORISTA)&nbsp;&nbsp;</a></div>
					</td>
				</tr>			
			</table>
	</div>
	
	
	
	
	
	</div>
	
	<!-- =========================================== ********************************** =========================
			=========================================== ********************************** ==============================
			=================================== DIV BAIXAS DO DIA ======================
			=========================================== ********************************** ==============================
			=========================================== ********************************===============================-->			
			
			<div id="div_baixasdodia" style="width: 97%; height: 90%; margin-top:4rem; margin-left:11rem; margin-right:1rem; color: black; text-align:center; display:none;"> 
			<?php		
			
			try {
				$Conexao    = Conexao::getConnection(); //CONECTANDO COM O BANCO
				
				// SELECT PARA PEGAR AS INFORMACOES NECESSARIAS PARA MOSTRAR NA TABELA				
				
						
				$usuarios   = $query->fetchAll();
				
				
				echo "<table style=' margin-left:0rem; background-color: #ffffff; width:85%; border-color:black; box-shadow: 0 2px 0 rgba(0, 0, 0, .3),  0 2px 3px rgba(0, 0, 0, 0.2);'>						
						<label style='font-size: 1.1rem; text-align:center; background-color: #09b09f; color: white; height: 4rem; width:85%;'><br>Baixas de hoje: ".date('d.m.Y')."</label>
						<tr style='font-size: 0.7rem; font-weight: bold; background-color: #09b09f;   height:2rem;'>
						<td style='color: white;  border-color:black; box-shadow: 0 2px 0 rgba(0, 0, 0, .3),  0 2px 3px rgba(0, 0, 0, 0.2);'>FILIAL</td>
						<td style='color: white;  border-color:black; box-shadow: 0 2px 0 rgba(0, 0, 0, .3),  0 2px 3px rgba(0, 0, 0, 0.2);'>CT-e</td>
						<td style='color: white;  border-color:black; box-shadow: 0 2px 0 rgba(0, 0, 0, .3),  0 2px 3px rgba(0, 0, 0, 0.2);'>ENTREGA</td>
						<td style='color: white;  border-color:black; box-shadow: 0 2px 0 rgba(0, 0, 0, .3),  0 2px 3px rgba(0, 0, 0, 0.2);'>HORARIO DE ENTREGA</td>
						<td style='color: white; border-color:black; box-shadow: 0 2px 0 rgba(0, 0, 0, .3),  0 2px 3px rgba(0, 0, 0, 0.2);'>USUÁRIO</td>						
						</tr>";
				
					foreach($usuarios as $busca_usuario) {						
					
							echo "<tr style='background-color: #f5f5f5;'>";
							echo "<td style='width: 5px;'><label style='font-size:0.7rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario['FILIAL']."</label></td>"; 
							echo "<td style='width: 5px;'><label style='font-size:0.7rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario['NR_DOC']."</label></td>";
							echo "<td style='width: 5px;'><label style='font-size:0.7rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario['DT_RECEBIMENTO']."</label></td>"; 
							echo "<td style='width: 5px;'><label style='font-size:0.7rem; color:black; font-weight:normal; text-align:center;'>".$busca_usuario['HORAA']."</label></td>"; 																				
							echo "<td style='width: 5px;'><label style='font-size:0.6rem; background-color: #42c3c9; color:white; font-weight:gold; text-align:center; height: 1.8rem;
							border-color: black; box-shadow: 0 2px 0 rgba(0, 0, .3, 0),  0 2px 3px rgba(0, 0, 0.2, 0); border-radius:4px;'> <br>".$busca_usuario['OPERADOR']."</label></td>"; 							
							echo "</tr>";					
						
					}
				} catch (Exception $e){	}	
				echo "</table>";
				
				?> 				 
				
			</div> <!-- FECHA A DIV  -->
	
	
	
	
	
	<br><br><br><br><br><br><br><br><br><br><br><br>
		<div id="rodape">
			<!-- =========================================== ********************************** ==============================
			=====================================================	DIV SIGA - NOS REDES SOCIAIS ============================================
			=========================================== ********************************======================================-->
			<label style="margin-top:-5.5rem; margin-left:0.5rem; text-align: center;  color: white; font-size: 0.9rem;	 height: 5rem;   background-color: #76b5c5; 
			border-radius:5px; box-shadow: 0 3px 0 rgba(0, 0, 0, .3),  0 2px 7px rgba(0, 0, 0, 0.2);  width: 8rem;  z-index:1000; ">
			<br>REDES SOCIAIS<label>
			
			<table style="margin-top:0rem; margin-left: 1rem;">
				<tr>
					<td>
						<a href="https://www.atuexpress.com.br/"><img src="site.jpg" title="Site - AtuexExpress" style="width: 30px; height: 30px; text-align: center;" /></a>
					</td>
					<td>
						<a href="https://www.facebook.com/Atuex-Express-100280239201599/"><img src="fb.png" title="Facebook - AtuexExpress" style="width: 40px; height: 40px; text-align: center;" /></a>
					</td>
					<td>
						<a href="https://www.linkedin.com/company/atuexpress/"><img src="linkedin.png" title="Linkedin - AtuexExpress" style="width: 30px; height: 30px; text-align: center;" /></a>
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
			</table>
			<label style="background-color: #042f66;    text-align: center;    font-weight:normal;    width:100%;
			color:white;     position:fixed;     bottom:0px;       font-size: 0.9rem;    height: 1.8rem;">
			<?php echo date('Y'); ?> &copy; Todos os direitos reservados - Desenvolvido por Atuex Express -  &nbsp;
			<a href="mailto: suporte@transatual.com.br" style="font-size: 0.9rem; color: white; font-weight:bold; text-decoration:none;">@suporte</a>
			</label>
		</div>	
		
</body>
</html>