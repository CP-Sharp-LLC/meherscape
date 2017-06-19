<?php
require_once __DIR__ . '\sitecore.php';
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Interactive Edge - d3 Demo</title>
</head>
<body>
<div class="site-container">
	<main>
		<div id='maincontainer' class='projectcontainer'>
		</div>

	</main>
</div>
<script type='text/javascript' src='script/jquery.min.js'></script>
<script type='text/javascript' src='script/d3.js'></script>
<script type='text/javascript'>

	var projectdata = <?php
    $val = json_encode($arrval, JSON_PRETTY_PRINT);
    echo $val;
    ?>;
</script>
<script type='text/javascript' src='script/index.js'></script>
</body>