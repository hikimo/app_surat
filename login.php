<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="assets/css/w3.css">
	<style type="text/css">
		.tengah {
			width: 500px;
			margin: 150px auto;
		}

		.w3-card-4
		{
			background: white;
		}
		body {
			background: #fcefce;
		}
	</style>
</head>
<body>
	<div class="tengah">
		<div class="w3-container">
			<div class="w3-card-4">
				<div class="w3-container w3-teal">
					<h2>Login Form</h2>
				</div>

				<div class="w3-container">
					<form method="POST" action="cek.php">
						<p>
							<label class="w3-label" for="username">Username</label>
							<input type="text" name="username" class="w3-input" id="username" required>
						</p>

						<p>
							<label class="w3-label" for="password">Password</label>
							<input type="password" name="password" class="w3-input" id="password" required>
						</p>

						<p>
							<button class="w3-btn w3-blue">Masuk</button>
						</p>
					</form>
				</div>
				
			</div>
			
		</div>
	</div>
	
</body>
</html>