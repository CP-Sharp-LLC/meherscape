<<<<<<< refs/remotes/originmaster
<?php

class projectSet implements JsonSerializable
{
    private $projects = array();
	private $setname = '';

	public function name($aname)
	{
		$this->setname = $aname;
	}

    public function add($project)
    {
    	$newproj = new project();
    	$newproj->load($project);
        $this->projects[] = $newproj;
    }

    public function draw()
    {
        echo '<div class="projectset">';
        foreach ($this->projects as $project) {
            $project->draw();
        }
        echo '</div>';
    }

    public function jsonSerialize()
    {
        return ['name'=>$this->setname, 'projects'=>$this->projects ];
        // $temp[] = ['name'=>$this->setname, 'path'=>$tProj->path, 'images'=>$tProj->images ];
    }
}

class projectImage implements JsonSerializable
{
    private $myurl;
    private $myalt;

    public function load($imagepath)
    {
        $this->myalt = 'alt';
        $this->myurl = $_SERVER['CONTEXT_PREFIX']."$imagepath";
    }

    public function url()
    {
        return $this->myurl;
    }

    public function alt()
    {
        return $this->myalt;
    }


    public function jsonSerialize()
    {
        return ['url' => $this->myurl, 'alt' => $this->myalt];
    }
}

class project implements JsonSerializable
{

    private $path = '';
    private $images = array();

    public function load($path)
    {
    	$this->path = $path;
        $dir = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/projects/'.$path;
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file !== '..' && $file !== '.' &&
	                substr($file, strlen($file) - 4, 4) === '.jpg') {
                    $newImage = new projectImage();
                    $newImage->load('/projects/'.$path . '/'. $file);
                    $this->images[] = $newImage;
                }
            }
            closedir($dh);
        }
    }

    public function draw()
    {
    	if(count($this->images) === 0) {
            return;
        }
        echo '<div class="project">';
        echo '<h1>'.$this->path.'</h1>';
        echo '<div class="imagerow">';
        foreach ($this->images as $image) {
            echo '<img src="'.$image->url().'" alt="'.$image->alt().'" />';
        }
        echo '</div>';
        echo '</div>';
    }


    public function jsonSerialize()
    {
        return [ 'path' => $this->path, 'images' => $this->images];
    }
}



$set1 = new projectSet();
$set2 = new projectSet();
$set3 = new projectSet();
$set1->name("Design");
$set2->name("Build");
$set3->name("SomethingElse");
$arrval = array();
$arrval[] = $set1;
$arrval[] = $set2;
$arrval[] = $set3;
if ($dh = opendir($dir = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/projects/')) {
    while (($file = readdir($dh)) !== false) {
        if ($file !== '..' && $file !== '.'){
            $arrval[mt_rand(0,2)]->add($file);
        }
    }
    closedir($dh);
}
?>
<!DOCTYPE html>
<html>
=======
<<<<<<< HEAD
<!DOCTYPE HTML>
<html lang="en-US">
>>>>>>> HEAD~0
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
<script type='text/javascript' src='script/d3plus.js'></script>
<script type='text/javascript'>

	var projectdata = <?php
    $val = json_encode($arrval, JSON_PRETTY_PRINT);
    echo $val;
    ?>
</script>
<script type='text/javascript' src='script/index.js'></script>
</body>
<<<<<<< refs/remotes/originmaster
<!--<script type="text/javascript" src='wp-includes/js/jquery/jquery.js'></script>
<script type="text/javascript" src='coming.js'></script>-->
=======
<?php include 'scripts.php' ?>
=======
<?php

class projectSet implements JsonSerializable
{
    private $projects = array();
	private $setname = '';

	public function name($aname)
	{
		$this->setname = $aname;
	}

    public function add($project)
    {
    	$newproj = new project();
    	$newproj->load($project);
        $this->projects[] = $newproj;
    }

    public function draw()
    {
        echo '<div class="projectset">';
        foreach ($this->projects as $project) {
            $project->draw();
        }
        echo '</div>';
    }

    public function jsonSerialize()
    {
        return ['name'=>$this->setname, 'projects'=>$this->projects ];
        // $temp[] = ['name'=>$this->setname, 'path'=>$tProj->path, 'images'=>$tProj->images ];
    }
}

class projectImage implements JsonSerializable
{
    private $myurl;
    private $myalt;

    public function load($imagepath)
    {
        $this->myalt = 'alt';
        $this->myurl = $_SERVER['CONTEXT_PREFIX']."$imagepath";
    }

    public function url()
    {
        return $this->myurl;
    }

    public function alt()
    {
        return $this->myalt;
    }


    public function jsonSerialize()
    {
        return ['url' => $this->myurl, 'alt' => $this->myalt];
    }
}

class project implements JsonSerializable
{

    private $path = '';
    private $images = array();

    public function load($path)
    {
    	$this->path = $path;
        $dir = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/projects/'.$path;
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file !== '..' && $file !== '.' &&
	                substr($file, strlen($file) - 4, 4) === '.jpg') {
                    $newImage = new projectImage();
                    $newImage->load('/projects/'.$path . '/'. $file);
                    $this->images[] = $newImage;
                }
            }
            closedir($dh);
        }
    }

    public function draw()
    {
    	if(count($this->images) === 0) {
            return;
        }
        echo '<div class="project">';
        echo '<h1>'.$this->path.'</h1>';
        echo '<div class="imagerow">';
        foreach ($this->images as $image) {
            echo '<img src="'.$image->url().'" alt="'.$image->alt().'" />';
        }
        echo '</div>';
        echo '</div>';
    }


    public function jsonSerialize()
    {
        return [ 'path' => $this->path, 'images' => $this->images];
    }
}



$set1 = new projectSet();
$set2 = new projectSet();
$set3 = new projectSet();
$set1->name("Design");
$set2->name("Build");
$set3->name("SomethingElse");
$arrval = array();
$arrval[] = $set1;
$arrval[] = $set2;
$arrval[] = $set3;
if ($dh = opendir($dir = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/projects/')) {
    while (($file = readdir($dh)) !== false) {
        if ($file !== '..' && $file !== '.'){
            $arrval[mt_rand(0,2)]->add($file);
        }
    }
    closedir($dh);
}
?>
<!DOCTYPE html>
<html>
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
<script type='text/javascript' src='script/d3plus.js'></script>
<script type='text/javascript'>

	var projectdata = <?php
    $val = json_encode($arrval, JSON_PRETTY_PRINT);
    echo $val;
    ?>
</script>
<script type='text/javascript' src='script/index.js'></script>
</body>
<!--<script type="text/javascript" src='wp-includes/js/jquery/jquery.js'></script>
<script type="text/javascript" src='coming.js'></script>-->
>>>>>>> hi
>>>>>>> HEAD~0
</html>
