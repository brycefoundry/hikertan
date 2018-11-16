<?php 

// set paths and starting file names
$path = dirname(__FILE__);
echo $path;
/*
$dataPath = $path . "/data";
$backupPath = $path . "/backup";
$filename = $dataPath . "/index.php";

// keep list of files restored for report
$msg = "";

// check if target file exists
if (!file_exists($filename)) {

	// mail to AWD staff with start message 
	mail("bill@austinwebanddesign.com","Backup bug strikes TWIA at " . date("l jS \of F Y h:i:s A"),"");
	
	// run the recursive copy 
	recurse_copy($backupPath,$dataPath);

	// mail to AWD staff with file list
	mail("bill@austinwebanddesign.com","Files restored at TWIA on " . date("l jS \of F Y h:i:s A"),$msg);
	
	}

// recurse through all subdirectories to get all paths and file names	
function recurse_copy($src,$dst) {
	GLOBAL $msg;
    $dir = opendir($src); 
	@mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
		if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
            else{ 
				copy($src . '/' . $file,$dst . '/' . $file); 
				$msg .= "restoring $dst/$file\n";
        		} 
			} 
		} 
    closedir($dir);
	} 	
*/
?>