/* 
   Simple telnet interface
   @Author: Elimination
   2016
*/
<?PHP
	class telnet {

		// default values
		var $user = 'qwerty';
		var $pass = 'qwerty';
		var $host = '127.0.0.1';
		var $port = 3443;
		var $timeout = 30;

		function send_ra_command($command) {
			$fp = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);

			if($fp) {
			   fputs($fp, $this->user."\r");
			   fputs($fp, $this->pass."\r");
			   fputs($fp, $command."\r");
			   $output = '';
			   while (!feof($fp)) { 
    				  $output .= fgets($fp, 1024); 
			   } 
			   fclose($fp);
			   return $output;
			}
			else
				return "<font color=#6F5A0B>Warning:</font> No telnet connection to Server.<br>";
		}

		function Execute($command) {
		    return $this->send_ra_command($command);
		}
	}

	$telnet = new telnet;
	$telnet->host = '127.0.0.1'; // server ip
	$telnet->port = 3443; // telnet port
	$telnet->user = 'qwerty'; // user name
	$telnet->pass = 'qwerty'; // user password
	$telnet->timeout = 30; // sending timeout

	if (isset($_POST['cmd'])) {
		echo $telnet->Execute($_POST['cmd']);
	}
	else
		// default command
		echo $telnet->Execute('.server info');
?>

Telnet:<br>
<form enctype="multipart/form-data" action="tn.php" method="POST"><input name="cmd" type="Text"/><input type="submit" value="Execute"/></form>	