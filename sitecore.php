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
