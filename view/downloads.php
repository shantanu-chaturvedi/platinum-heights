<?php include '../controller/functions.php';

if(isset($_GET['inventory'])){
	downloadInventory();
}

if(isset($_GET['dbinventoryfile'])){
	downloadOldInventoryFile($_GET['n']);
}

if(isset($_GET['sampleLocation'])){
	downloadLocationSampleFile();
}

if(isset($_GET['downloadQuestionaire'])){
	downloadQuestionaire($_GET['i']);
}

if(isset($_GET['final_form'])){
	downloadFinalForm($_GET['final_form']);
}

if(isset($_GET['projectReport'])){
	downloadprojectReport($_GET['projectId']);
}

if(isset($_GET['downloadVideo'])){
	downloadVideo($_GET['i']);
}

?>