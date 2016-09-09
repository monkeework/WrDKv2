<?php
/**
 * footer_inc.php provides the right panel and footer for our site pages 
 *
 * Includes dynamic copyright data 
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see template.php
 * @see header_inc.php 
 * @todo none
 */
?>
	  <!-- footer include starts here -->
	  </td>
	  <!-- right panel starts here -->	
	  <!-- change right panel color here -->
      	<td width="175" valign="top">
		<? echo $config->sidebar2; ?>
        </td>
	</tr>
      <!-- change footer color here -->
	<tr>
		<td colspan="3">
		    <p align="center"><b>Footer Goes Here!</b></p>
			<p align="center">Always include some sort of copyright notice, for example:</p>
	        <p align="center"><em>&copy; My Company, 2007 - <?php echo date("Y");?></em></p>
		</td>
  </tr>
</table>
</body>
</html>