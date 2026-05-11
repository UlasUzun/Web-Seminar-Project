<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$find['file'].'.php')) { include("./logicals/{$find['file']}.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $pagetitle['title'] ?></title>
	<link rel="stylesheet" href="./assets/css/style.css" type="text/css">
</head>
<body>
	<header>
		<div class="header-content">
			<h1>Animal Kingdom</h1>
			<?php $user = getUserData(); if ($user): ?>
				<div class="user-info">
					Logged-in: <?php echo htmlspecialchars($user['family_name'] . ' ' . $user['surname'] . ' (' . $user['username'] . ')'); ?>
				</div>
			<?php endif; ?>
		</div>
		<nav>
			<ul class="horizontal-menu">
				<?php foreach ($pages as $url => $page) { ?>
					<?php if( (!isLoggedIn() && $page['menun'][0]) || (isLoggedIn() && $page['menun'][1]) ) { ?>
						<?php if($page['text'] !== '') { ?>
						<li<?= (($page == $find) ? ' class="active"' : '') ?>>
						<a href="<?= ($url == '/') ? '.' : '?'.$url ?>">
						<?= $page['text'] ?></a>
						</li>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</ul>
		</nav>
	</header>
    <main class="container">
        <?php include("./templates/pages/{$find['file']}.tpl.php"); ?>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Animal Kingdom. All rights reserved.</p>
    </footer>
</body>
</html>
