<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	</head>
	<body>
		<form method="GET" action="webservice_auth.php">
			<label>Login</label><input type="text" name="login"/>
			<label>Password </label> <input type="password" name="lama"/>
			<input id="send" type="submit" value="envoyer"/>
		</form>
		<script>
		$("#send").click(function(){
			alert('coucou');
		});
		</script>
	</body>
</html>