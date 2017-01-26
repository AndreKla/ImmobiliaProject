<?php
    
    session_start();
    require_once("includes.php"); 
	Menu::createMenu("SBK");

?>
					
	<!-- page content -->
	<div class="right_col" role="main">
	
            <style>
                    
                th,td{
                    padding:10px;
                }
                
            </style>
            
                <table style="width:75%">
                    <tr>
                      <th>Aktiva</th>
                      <th>Schlussbilanzkonto</th>
                      <th>Passiva</th>
                    </tr>
                </table> 
                <table style="width:75%">
                    <tr>
                      <th>A. Anlagevermögen</th>
                      <th>A. Eigenkapital</th>
                    </tr>
                    <tr>
                      <td>Bebaute Grundstücke</td>
                      <td>C. Verbindlichkeiten</td>
                    </tr>
                    <tr>
                      <td>Baugrundstücke</td>
                      <td>2. Verbindlichkeiten gg. Kreditinstitute</td>
                    </tr>                   
                    <tr>
                      <td>Betr. & Geschäftsausstattung</td>
                    </tr>                    
                    <tr>
                      <td>Summe: </td>
                      <td>Summe: </td>
                    </tr>
                </table>

	</div>
	<!-- /page content -->
		
<?php 
	Menu::createFooter(); 
?>