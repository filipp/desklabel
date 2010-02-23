<?php
////
// desklabel/index.php
// @author Filipp Lepalaan <filipp@lepalaan.org>
// @created 29.08.2009
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$text = (!empty($_POST['t'])) ? $_POST['t'] : $hostname;

$r = (is_numeric($_POST['r'])) ? $_POST['r'] : round(rand(1,255));
$g = (is_numeric($_POST['g'])) ? $_POST['g'] : round(rand(1,255));
$b = (is_numeric($_POST['b'])) ? $_POST['b'] : round(rand(1,255));
  
if (!empty($_POST))
{
  $width = (is_numeric($_POST['w'])) ? $_POST['w'] : 1024;
  $height = (is_numeric($_POST['h'])) ? $_POST['h'] : 768;
  $im = imagecreatetruecolor($width, $height) or die('GD not work is!');
  
  $font_size = (is_numeric($_POST['font_size'])) ? $_POST['font_size'] : 52;
  
  $font = 'BEBAS';
  $bg_color = imagecolorallocate($im, $r, $g, $b);
  $text_color = imagecolorallocate($im, 255, 255, 255);
  
  imagefill($im, 0, 0, $bg_color);
  
  putenv("GDFONTPATH=" . realpath('.'));
  $y = ($height/2)-($font_size/2)+25;
  $x = $font_size*1.5;
  
  // "Drop shadow"
  $grey = imagecolorallocate($im, 28, 28, 28);
  imagettftext($im, $font_size, 0, $x+1, $y+1, $grey, $font, $text);
  imagettftext($im, $font_size, 0, $x, $y, $text_color, $font, $text);
  
  header("Content-type: image/png");
  imagepng($im);
  imagedestroy($im);
  exit();
  
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Desklabel</title>
	<style type="text/css" media="screen">
	  body {
	    padding: 40px; margin: 40px;
	    font: 1.2em "Georgia";
	    color: #888;
	  }
    input {
      font: 1.4em "Georgia", Verdana, sans-serif;
    }
	  input[type="text"] {
	    width: 70px;
	  }
    label {
      width: 100px;
      display: block;
    }
    form {
      width: 530px;
    }
	</style>
</head>

<body>

<form action="#" method="post" accept-charset="utf-8" target="_blank">
    
  <label>text</label>
  <input type="text" name="t" value="<?= $text; ?>" style="width:500px"/>
  <br/>
  <input type="text" name="w" id="w" title="Width"/>
  x
  <input type="text" name="h" id="h" title="Height"/>
  @
  <input type="text" name="font_size" value="52" id="font_size" title="Font Size"/>
  .
  <input type="text" name="r" value="<?= $r ?>" style="width:50px"/>R
  <input type="text" name="g" value="<?= $g ?>" style="width:50px"/>G
  <input type="text" name="b" value="<?= $b ?>" style="width:50px"/>B
  <p><input type="submit" value="Do it!" style="float:right"/></p>
  
</form>
<script type="text/javascript" charset="utf-8">
  document.getElementById('w').value = screen.width;
  document.getElementById('h').value = screen.height;
</script>
</body>
</html>
