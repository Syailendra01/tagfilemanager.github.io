<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" type="image/png/jpg" href="<?= base_url()?>tamplate/picture/LogoTAG.png">
        <link rel="stylesheet" href="<?= base_url() ?>tamplate/assets/css/login.css">        
		<title>File sharing - Tunas Auto Graha</title>
	</head>
	<body>
		<div class="dashImage" id="dashImage">
			<img src="<?=base_url()?>/tamplate/picture/Folder.png" alt="" />
		</div>
		<div class="dashLogin" id="dashLogin">
			<div class="dashLogo">
				<img src="<?=base_url()?>/tamplate/picture/LogoTAG.png" alt="" />
				<p>Login to continue</p>
			</div>
			<?= $this->session->flashdata('login'); ?>
			<form method="post" action="<?= base_url('Login/validasiAccount') ?>" class="user">
				<div class="input-group">
					<input type="email" name="userEmail" id="userEmail" required />
					<label for="">Email</label>
				</div>
				<div class="input-group">
					<input
						type="password"
						name="userPassword"
						id="userPassword"
						required
					/>
					<label for="">Password</label>
				</div>
				<button>Login</button>
			</form>
		</div>
	</body>
</html>
