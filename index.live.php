<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Meherscape - A fresh new look on the way</title>
	<link rel="stylesheet" href="coming.css" type="text/css" />
	<link rel="stylesheet" href="script/fotorama.css" type="text/css" />
</head>
<body>
<div class="site-container">
	<div class="top-bar">
		<header>
			<div>
				<h1>A fresh new look is coming soon</h1>
				<div>
					<h2>Stay tuned!
						<a href="https://www.facebook.com/meherscape/"><img class="fb" src="fb.png" alt="Mehescape's facebook page"></a>
					</h2>
				</div>
				<div>
					<address>
						<div>
							<span><a href="mailto:mahedihasan@meherscape.com">mahedihasan@meherscape.com</a></span>
							<br />
							<span><a href="tel:+919429121000">+91&nbsp;9429121000</a></span>
						</div>
					</address>
				</div>
			</div>
		</header>
	</div>
	<main>
		<div id='maincontainer' class='projectcontainer'>
		</div>
		<div div style='clear: both'></div>
		<div>
			<video autoplay='true' src="meherscape.mp4" type="video/mp4">
				<h1>>Meherscape</h1>
			</video>
		</div>
	</main>
	<div>
		<footer>
			<div>
				<hr width="50%" style="border: dashed 1px #ddd" />
				<h2 style="display: block; width: 100%; padding: 2vh 0 2vh 0">CONTACT</h2>
				<input name="name" placeholder="Name">
				<input name="e-mail" pattern="" placeholder="Email">
				<input name="phone" pattern="" placeholder="Phone">
				<input name="address" pattern="" placeholder="Address">
				<input name="subject" pattern="" placeholder="Subject">
				<textarea name="message"></textarea>
				<button>Send</button>
			</div>
		</footer>
	</div>
</div>
<script type='text/javascript' src='script/jquery.min.js'></script>
<script type='text/javascript' src='script/d3.js'></script>
<script type='text/javascript'>

	var projectdata = <?php
    $val = json_encode($arrval, JSON_PRETTY_PRINT);
    echo $val;
    ?>
</script>
<script type='text/javascript' src='script/index.js'></script>
</body>