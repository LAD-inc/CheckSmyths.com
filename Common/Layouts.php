
<?php
function displayHeader()
{
	echo'<title>CheckSmyths.com - An Smyths Stock Checker</title>';

	echo'<center>';//end is in footer.php
	echo '	<a href="http://www.checksmyths.com">
				<img src="images/Titlethin.png" alt="www.CheckSmyths.com" />
			</a>';
	echo "<br /><br />";
}

function displayFooter()
{
	//Footer
	echo "<br /><br />";
	echo '	<table cellspacing="15" id="footer">
				<tr>
					<td>
						<a href="index.php">Home</a>
					</td>
					<td>
						<a href="about.php">About</a>
					</td>
					<td>
						<a href="contact.php">Contact</a>
					</td>
				</tr>
			</table>
			
			<br />&copy;   checksmyths.com';  

	echo'</center>';//start is in header.php
}

?>