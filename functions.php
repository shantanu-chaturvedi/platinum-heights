<?php if(session_status() == PHP_SESSION_NONE) {
	session_start();
}


include 'model/classLib.php';
// require_once "../assets/lib/phpexcel-master/Classes/PHPExcel.php";
require_once 'assets/lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
/*common functions*/

function siteUrl(){
	return "http://stepoutsolutions.org/projects/PlatinumHeights/";
}

/*Add Member*/
if(isset($_GET['addMember'])){
	$dob=date_format(date_create($_POST['dob']),"d-M-y");
	$dobFor=date_format(date_create($_POST['dob']),"d");
	$doa=date_format(date_create($_POST['doa']),"d-M-y");
	$doaFor=date_format(date_create($_POST['doa']),"d");
	$colname = "name,society,flat_no,dob,dobFor,doa,doaFor,blood_group,telephone_no,emergency_no,email_address,role,created";
	$values = '"'.$_POST['name'].'","'.$_POST['society'].'","'.$_POST['flat_number'].'","'.$dob.'","'.$dobFor.'","'.$doa.'","'.$doaFor.'","'.$_POST['blood_group'].'","'.$_POST['telephone_number'].'","'.$_POST['emergency_number'].'","'.$_POST['email'].'","'.$_POST['role'].'","'.date('d-M-y').'"';
	myFunctions::insertToDb('tbl_members',$colname,$values);
}

if(isset($_GET['editMember'])){
	$dob=date_format(date_create($_POST['dob']),"d-M-y");
	$dobFor=date_format(date_create($_POST['dob']),"d");
	$doa=date_format(date_create($_POST['doa']),"d-M-y");
	$doaFor=date_format(date_create($_POST['doa']),"d");
	$values = "name = '".$_POST['name']."',society = '".$_POST['society']."',flat_no = '".$_POST['flat_number']."',dob = '".$dob."',dobFor = '".$dobFor."',doa = '".$doa."',doaFor = '".$doaFor."',blood_group = '".$_POST['blood_group']."',telephone_no = '".$_POST['telephone_number']."',emergency_no = '".$_POST['emergency_number']."',email_address = '".$_POST['email']."',role = '".$_POST['role']."',updated = '".date('d-M-y')."'";
	myFunctions::updateDataById('tbl_members',$values, $_POST['member_id']);
}

if(isset($_GET['deleteMember'])){
	$values = "status = '1'";
	myFunctions::updateDataById('tbl_members',$values, $_POST['memberId']);
}

function getMemberDetailById($id){
	$where = " where status = 0 and id = ".$id;
	$data = myFunctions::getData('tbl_members',$where);
	return $data[0];
}


/*Sign In*/



/*login*/
if(isset($_POST['signin'])){
	if(($_POST['username'] == 'admin') && ($_POST['password'] == 'pass3word#')){
		$_SESSION['logged_in'] = 1;
		header("Location: members.php");
	}
	// $logindatas = signin::login($_POST['email'],$_POST['password']);

	// if($logindatas == ""){
	// 	header("Location: signin.php?erroLogin");
	// }else{
	// 	$data = explode('-',$logindatas);
	// 	$_SESSION['logged_in_userid'] = $data[0];
	// 	$_SESSION['logged_in_user_role'] = $data[1];
	// 	header("Location: ../view/index.php");
	// }
}



/*logout*/
if(isset($_GET['logout'])){
	session_destroy();
	header("location: index.php");
}

/*Get Member Data*/
function getMemberData(){
	$where = " where status = 0 order by flat_no ASC";
	return myFunctions::getData('tbl_members',$where);
}

if(isset($_GET['attendanceSheetdownload'])){
	$dompdf = new Dompdf();
	$memberDetails = getMemberData();
	$fileName = 'attendanceSheet';

	$html = '<html>';
	$html.= '<head>
			  	<style>
				    @page { margin: 70px 50px; font-family: "Raleway", sans-serif; font-size: 14px; }
				    #header { left: 0px; top: -20px; right: 0px; height: 80px; border-bottom: 2px solid #000; line-height:0.1}
				   	#header-left {width:30%; float:left; text-align:left;}
				   	#header-right {width:70%; float:left; }
				   	#header-right table td {text-align:center;}
				   
				    h1,h2,h3{padding:0;}
				    #content h4 {text-align:center;}
				    #content table th {padding:3px 6px; font-size:12px;}
				    #content table td {padding:3px 6px;}
				    #content thead tr {background-color:#ddd;}
				    #content #memberTable thead tr th:nth-child(4),#content #memberTable thead tr th:nth-child(5),#content #memberTable thead tr th:nth-child(6){padding:0 60px;}
				    #content #memberTable tbody tr td:first-child,#content tbody tr td:nth-child(3) {text-align:center;}
				    #content #memberTable tbody tr td {padding: 20px 0;}
				    #content #guestTable thead tr th:nth-child(2){padding: 0 50px}
				    #content #guestTable thead tr th:nth-child(3),#content #guestTable thead tr th:nth-child(4),#content #guestTable thead tr th:nth-child(5){padding:0 60px;}
				    #content #guestTable tbody tr td:first-child,#content tbody tr td:nth-child(2) {text-align:center;}
				    #content #guestTable tbody tr td {padding: 20px 0;}
				</style>
			</head>
			<body>
		  		<div id="header">
                	<div id="header-left">
                  		<img src="assets/images/logo.png" width="100"/>
                	</div>
                	<div id="header-right">
                		<table cellpadding = "0" border="0" cellspacing = "0">
                			<tr>
                				<td><h2>SENIOR CITIZEN ASSOCIATION</h2></td>
            				</tr>
            				<tr>
            					<td><h3>PLATINUM HEIGHTS <i>(Regd.)</i></h3></td>
        					</tr>
    					</table>
                	</div>
		  		</div>
		  		
		  		<div id="content">
		  			<h4>ATTENDENCE SHEET</h4>

		  			<table id="memberTable" cellpadding = "0" border="1" cellspacing = "0">
		  			<thead>
		  				<tr>
			  				<th>S.No.</th>
			  				<th>NAME</th>
			  				<th>FLAT NO</th>
			  				<th></th>
			  				<th></th>
			  				<th></th>
		  				</tr>
	  				</thead>
	  				<tbody>';
	  				$i=1;
	  				foreach($memberDetails as $memberDetail){
	  					if($memberDetail['role'] == 1){
	  						$html.='<tr>';
		  					$html.='<td>'.$i.'</td>';
		  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$memberDetail['name'].'</td>';
		  					$html.='<td>'.$memberDetail['flat_no'].'</td>';
		  					$html.='<td></td><td></td><td></td>';
		  					$html.='</tr>';
		  					$i++;
	  					}
	  				}
	  				$j = $i+5;
	  				for($x = $i; $x<=$j; $x++){
	  					$html.= '<tr><td>'.$x.'</td><td></td><td></td><td></td><td></td><td></td></tr>';
	  				}
	$html.=	'		</tbody>
		  			</table>
		  			<h4>GUEST SHEET</h4>
		  			<table id="guestTable" cellpadding = "0" border="1" cellspacing = "0">
		  			<thead>
		  				<tr>
			  				<th>S.No.</th>
			  				<th width=100>GUEST NAME</th>
			  				<th width=50></th>
			  				<th width=50></th>
			  				<th width=50></th>
		  				</tr>
	  				</thead>
	  				<tbody>';
	  				$j=1;
	  				foreach($memberDetails as $memberDetail){
	  					if($memberDetail['role'] == 2){
	  						$html.='<tr>';
		  					$html.='<td>'.$j.'</td>';
		  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$memberDetail['name'].'</td>';
		  					$html.='<td></td><td></td><td></td>';
		  					$html.='</tr>';
		  					$j++;
	  					}
	  				}
	  				$k = $j+5;
	  				//for($y = $x+1; $y<=$k; $y++){
	  				for($y = $j+1; $y<=$k; $y++){
		  				$html.= '<tr><td>'.$y.'</td><td></td><td></td><td></td><td></td></tr>';
  					}
	$html.=	'		</tbody>
		  			</table>
  				</div>
    		</body>
    		</html>';

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream($fileName);
}

function getMemberDataByDob($month){
	$where = " where status = 0 and dob like '%".$month."%' order by dobFor * 1";
	return myFunctions::getData('tbl_members',$where);
}

function getMemberDataByDoa($month){
	$where = " where status = 0 and doa like '%".$month."%' order by doaFor * 1";
	return myFunctions::getData('tbl_members',$where);
}

if(isset($_GET['memberSheetdownload'])){
	$dompdf = new Dompdf();
	$memberDetails = getMemberData();
	$fileName = 'memberSheet';

	$html = '<html>';
	$html.= '<head>
			  	<style>
				    @page { margin: 70px 50px; font-family: "Raleway", sans-serif; font-size: 14px; }
				    #header { left: 0px; top: -20px; right: 0px; height: 80px; border-bottom: 2px solid #000; line-height:0.1}
				   	#header-left {width:30%; float:left; text-align:left;}
				   	#header-right {width:70%; float:left; }
				   	#header-right table td {text-align:center;}
				   
				    h1,h2,h3{padding:0;}
				    #content h4 {text-align:center;}
				    #content table th {padding:3px 6px; font-size:12px;}
				    #content table td {padding:3px 6px;}
				    #content thead tr {background-color:#ddd;}
				    
				    #content #memberTable tbody tr td {padding: 4px; text-align:center;}
				    #content #guestTable tbody tr td {padding: 4px; text-align:center;}
				</style>
			</head>
			<body>
		  		<!--div id="header">
                	<div id="header-left">
                  		<img src="assets/images/logo.png" width="100"/>
                	</div>
                	<div id="header-right">
                		<table cellpadding = "0" border="0" cellspacing = "0">
                			<tr>
                				<td><h2>SENIOR CITIZEN ASSOCIATION</h2></td>
            				</tr>
            				<tr>
            					<td><h3>PLATINUM HEIGHTS <i>(Regd.)</i></h3></td>
        					</tr>
    					</table>
                	</div>
		  		</div-->
		  		
		  		<div id="content">
		  			<h4>LIST OF MEMBERS AS ON '.date('d-m-Y').'</h4>

		  			<table id="memberTable" cellpadding = "0" border="1" cellspacing = "0">
		  			<thead>
		  				<tr>
			  				<th>#</th>
			  				<th>NAME</th>
			  				<th>FLAT NO.</th>
			  				<th>BIRTHDAY</th>
			  				<th>ANNIVERSARY</th>
			  				<th>BLOOD GROUP</th>
			  				<th>TELEPHONE</th>
			  				<th>EMERGENCY</th>
			  				<th>EMAIL</th>
		  				</tr>
	  				</thead>
	  				<tbody>';
	  				$i=1;
	  				foreach($memberDetails as $memberDetail){
	  					if($memberDetail['role'] == 1){
	  						$html.='<tr>';
		  					$html.='<td>'.$i.'</td>';
		  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$memberDetail['name'].'</td>';
		  					$html.='<td>'.$memberDetail['flat_no'].'</td>';
		  					$html.='<td>'.$memberDetail['dob'].'</td>';
		  					$html.='<td>'.$memberDetail['doa'].'</td>';
		  					$html.='<td>'.$memberDetail['blood_group'].'</td>';
		  					$html.='<td>'.$memberDetail['telephone_no'].'</td>';
		  					$html.='<td style="text-align:left;">'.$memberDetail['emergency_no'].'</td>';
		  					$html.='<td style="text-align:left;">'.$memberDetail['email_address'].'</td>';
		  					$html.='</tr>';
		  					$i++;
	  					}
	  				}
	$html.=	'		</tbody>
		  			</table>
		  			<h4>LIST OF GUESTS</h4>
		  			<table id="guestTable" cellpadding = "0" border="1" cellspacing = "0">
		  			<thead>
		  				<tr>
			  				<th>S.No.</th>
			  				<th>NAME</th>
			  				<th>ADDRESS</th>
			  				<th>BIRTHDAY</th>
			  				<th>ANNIVERSARY</th>
			  				<th>BLOOD GROUP</th>
			  				<th>TELEPHONE NO.</th>
			  				<th>EMERGENCY NO.</th>
			  				<th>EMAIL</th>
		  				</tr>
	  				</thead>
	  				<tbody>';
	  				$j=1;
	  				foreach($memberDetails as $memberDetail){
	  					if($memberDetail['role'] == 2){
	  						$html.='<tr>';
		  					$html.='<td>'.$j.'</td>';
		  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$memberDetail['name'].'</td>';
		  					$html.='<td style="text-align:left; padding-left:4px;">'.$memberDetail['flat_no'].', '.$memberDetail['society'].'</td>';
		  					$html.='<td>'.$memberDetail['dob'].'</td>';
		  					$html.='<td>'.$memberDetail['doa'].'</td>';
		  					$html.='<td>'.$memberDetail['blood_group'].'</td>';
		  					$html.='<td>'.$memberDetail['telephone_no'].'</td>';
		  					$html.='<td style="text-align:left;">'.$memberDetail['emergency_no'].'</td>';
		  					$html.='<td style="text-align:left;">'.$memberDetail['email_address'].'</td>';
		  					$html.='</tr>';
		  					$j++;
	  					}
	  				}
	  				
	$html.=	'		</tbody>
		  			</table>
  				</div>
    		</body>
    		</html>';

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream($fileName);
}

if(isset($_GET['eventSheetdownload'])){
	$dompdf = new Dompdf();
	$fileName = 'eventSheet';

	$html = '<html>';
	$html.= '<head>
			  	<style>
				    @page { margin: 70px 50px; font-family: "Raleway", sans-serif; font-size: 14px; }		   
				    h1,h2,h3{padding:0;}
				    h4{padding-bottom:2px; border-bottom:1px solid #000;}
				    #content-left{float:left;width:50%;}
				    #content-right{float:right;width:50%;padding-bottom:20px;}
				    .clear{clear:both;}
				</style>
			</head>
			<body>
		  		
		  		<div id="content">';

	$html.='	  	<div style="page-break-inside: avoid;"><h4>Januray</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Jan');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Jan');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div> </div>';

	$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>February</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Feb');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Feb');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';

	$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>March</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Mar');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Mar');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';

	$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>April</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Apr');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Apr');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';

	$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>May</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('May');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('May');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';

	$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>June</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Jun');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Jun');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';
$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>July</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Jul');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Jul');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';
$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>August</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Aug');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Aug');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';
$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>September</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Sep');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Sep');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';
$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>October</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Oct');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Oct');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';

	$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>November</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Nov');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Nov');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';


$html.='	  	<br/><br/><br/>
		  			<div class="clear"></div>

					<div style="page-break-inside: avoid;"><h4>December</h4>

		  			<div id="content-left">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Birthday</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
	  				
								$janDobs = getMemberDataByDob('Dec');
				  				foreach($janDobs as $janDob){
				  					$dob = explode('-',$janDob['dob']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDob['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$dob[0].'-'.$dob[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDob['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
						</table>
		  			</div>

		  			<div id="content-right">
		  				<table cellpadding = 3 width=370 style="border:1px solid #000000;">
		  					<thead>
				  				<tr>
					  				<th width=150 style="border-bottom:2px solid #000000;">Name</th>
					  				<th width=50 style="border-bottom:2px solid #000000;">Flat No</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Anniversary</th>
					  				<th width=75 style="border-bottom:2px solid #000000;">Phone</th>
				  				</tr>
	  						</thead>
	  						<tbody>';
				  				$janDoas = getMemberDataByDoa('Dec');
				  				$i=1;
				  				foreach($janDoas as $janDoa){
				  					$doa = explode('-',$janDoa['doa']);
			  						$html.='<tr>';
				  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px; border-bottom:2px dashed #cccccc;">'.$janDoa['name'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['flat_no'].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$doa[0].'-'.$doa[1].'</td>';
				  					$html.='<td style="border-bottom:2px dashed #cccccc;" align="center">'.$janDoa['telephone_no'].'</td>';
				  					$html.='</tr>';
				  				}
	$html.=	'				</tbody>
		  				</table>
		  			</div></div>';



  	$html.='			</div>
    		</body>
    		</html>';

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream($fileName);
}

if(isset($_POST['addMeeting'])){
	$dompdf = new Dompdf();
	$fileName = 'Meeting-Details';

	$currentMonth = date_format(date_create($_POST['meeting_date']),"M");
	$curDobs = getMemberDataByDob($currentMonth);
	$curDoas = getMemberDataByDoa($currentMonth);

	$nextMonth = date('M', strtotime('+1 month', strtotime($_POST['meeting_date'])));
	$nxtDobs = getMemberDataByDob($nextMonth);
	$nxtDoas = getMemberDataByDoa($nextMonth);

	$html = 'html';

	$html = '<html>';
	$html.= '<head>
			  	<style>
				    @page { margin: 70px 50px; font-family: "Raleway", sans-serif; font-size: 14px; }
				    #header { left: 0px; top: -20px; right: 0px; height: 80px; border-bottom: 2px solid #000; line-height:0.1}
				   	#header-left {width:30%; float:left; text-align:left;}
				   	#header-right {width:70%; float:left; }
				   	#header-right table td {text-align:center;}
				   	h3{padding:0;}
				</style>
			</head>
			<body>
		  		<div id="header">
                	<div id="header-left">
                  		<img src="assets/images/logo.png" width="100"/>
                	</div>
                	<div id="header-right">
                		<table cellpadding = "0" border="0" cellspacing = "0">
                			<tr>
                				<td><h2>SENIOR CITIZEN ASSOCIATION</h2></td>
            				</tr>
            				<tr>
            					<td><h3>PLATINUM HEIGHTS <i>(Regd.)</i></h3></td>
        					</tr>
    					</table>
                	</div>
		  		</div>
		  		
		  		<div id="content">
		  			<h2 style="text-align:center">CELEBRATION OF BIRTHDAYS / MARRIAGE ANNIVERSARIES</h3>

		  			<table id="memberTable" cellpadding = "1" border="0" cellspacing = "0" width="500">
		  			
	  				<tbody>

	  				<tr>
	  					<td align="left"><b>DAY & DATE</b></td>
	  					<td align="right"><b>'.date_format(date_create($_POST['meeting_date']),"l, d F Y").'</td>
  					</tr>
  					<tr>
	  					<td align="left"><b>TIME & VENUE</b></td>
	  					<td align="right"><b>'.$_POST['meeting_time'].' '.$_POST['venue'].'</b></td>
	  				</tr>';
	  				
	$html.=	'		</tbody>
		  			</table>

		  			<br/>
		  			
		  			<table id="currentMonthDob" cellpadding = "5" border="1" cellspacing = "0" width="500">
		  			<thead>
		  				<tr>
		  					<td align=center colspan=4><b>BIRTHDAYS THIS MONTH</b></td>
		  				</tr>
		  				<tr>
			  				<th width="30%">Name</th>
			  				<th width="30%">Flat No</th>
			  				<th width="20%">Birthdays</th>
			  				<th width="20%">Phone</th>
		  				</tr>
	  				</thead>
	  				<tbody>';

	  				foreach($curDobs as $curDob){
  						$html.='<tr>';
	  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$curDob['name'].'</td>';
						if($curDob['role'] == 1){
	  						$html.='<td align=center>'.$curDob['flat_no'].'</td>';
						}
						else{
							$html.='<td align=center>'.$curDob['society'].'</td>';
						}
	  					$html.='<td align=center>'.date_format(date_create($curDob['dob']),"d-F").'</td>';
	  					$html.='<td align=center>'.$curDob['telephone_no'].'</td>';
	  					$html.='</tr>';
	  				}
	  				
	$html.=	'		</tbody>
		  			</table>

		  			<br/>

		  			<table id="currentMonthDoa" cellpadding = "5" border="1" cellspacing = "0" width="500">
		  			<thead>
		  				<tr>
		  					<td align=center colspan=4><b>ANNIVERSARIES THIS MONTH</b></td>
		  				</tr>
		  				<tr>
			  				<th width="30%">Name</th>
			  				<th width="30%">Flat No</th>
			  				<th width="20%">Anniversaries</th>
			  				<th width="20%">Phone</th>
		  				</tr>
	  				</thead>
	  				<tbody>';

	  				foreach($curDoas as $curDoa){
  						$html.='<tr>';
	  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$curDoa['name'].'</td>';
						if($curDoa['role'] == 1){
	  						$html.='<td align=center>'.$curDoa['flat_no'].'</td>';
						}
						else{
							$html.='<td align=center>'.$curDoa['society'].'</td>';
						}
	  					$html.='<td align=center>'.date_format(date_create($curDoa['doa']),"d-F").'</td>';
	  					$html.='<td align=center>'.$curDoa['telephone_no'].'</td>';
	  					$html.='</tr>';
	  				}
	  				
	$html.=	'		</tbody>
		  			</table>

		  			<br/>

		  			<p style="text-align:center;"><b>MEMBERS ARE REQUESTED TO JOIN</b></p>

		  			<p style="border-top:1px dotted #000; border-bottom:0px dotted #000; padding:4px; text-align:center;">Note:<br><i>'.$_POST['notes'].'</i></p>
		  			
		  			<p style="text-align:right; margin-top:50px; font-size:.8em;">Page 1/2</p>

		  			</div>
  				
		  			<div style="page-break-before: always;" id="header">
	                	<div id="header-left">
	                  		<img src="assets/images/logo.png" width="100"/>
	                	</div>
	                	<div id="header-right">
	                		<table cellpadding = "0" border="0" cellspacing = "0">
	                			<tr>
	                				<td><h2>SENIOR CITIZEN ASSOCIATION</h2></td>
	            				</tr>
	            				<tr>
	            					<td><h3>PLATINUM HEIGHTS <i>(Regd.)</i></h3></td>
	        					</tr>
	    					</table>
	                	</div>
			  		</div>

			  		<br/>

			  		<div id="content">

		  			<table id="currentMonthDob" cellpadding = "5" border="1" cellspacing = "0" width="500">
		  			<thead>
		  				<tr>
		  					<td align=center colspan=4><b>BIRTHDAYS NEXT MONTH</b></td>
		  				</tr>
		  				<tr>
			  				<th width="30%">Name</th>
			  				<th width="30%">Flat No</th>
			  				<th width="20%">Birthdays</th>
			  				<th width="20%">Phone</th>
		  				</tr>
	  				</thead>
	  				<tbody>';

	  				foreach($nxtDobs as $nxtDob){
  						$html.='<tr>';
	  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$nxtDob['name'].'</td>';
						if($nxtDob['role'] == 1){
	  						$html.='<td align=center>'.$nxtDob['flat_no'].'</td>';
						}
						else{
							$html.='<td align=center>'.$nxtDob['society'].'</td>';
						}
	  					$html.='<td align=center>'.date_format(date_create($nxtDob['dob']),"d-F").'</td>';
	  					$html.='<td align=center>'.$nxtDob['telephone_no'].'</td>';
	  					$html.='</tr>';
	  				}
	  				
	$html.=	'		</tbody>
		  			</table>

		  			<br/>

		  			<table id="currentMonthDoa" cellpadding = "5" border="1" cellspacing = "0" width="500">
		  			<thead>
		  				<tr>
		  					<td align=center colspan=4><b>ANNIVERSARIES NEXT MONTH</b></td>
		  				</tr>
		  				<tr>
			  				<th width="30%">Name</th>
			  				<th width="30%">Flat No</th>
			  				<th width="20%">Anniversaries</th>
			  				<th width="20%">Phone</th>
		  				</tr>
	  				</thead>
	  				<tbody>';

	  				foreach($nxtDoas as $nxtDoa){
  						$html.='<tr>';
	  					$html.='<td style="text-transform:uppercase; text-align:left; padding-left:4px;">'.$nxtDoa['name'].'</td>';
						if($nxtDoa['role'] == 1){
	  						$html.='<td align=center>'.$nxtDoa['flat_no'].'</td>';
						}
						else{
							$html.='<td align=center>'.$nxtDoa['society'].'</td>';
						}
	  					$html.='<td align=center>'.date_format(date_create($nxtDoa['doa']),"d-F").'</td>';
	  					$html.='<td align=center>'.$nxtDoa['telephone_no'].'</td>';
	  					$html.='</tr>';
	  				}
	  				
	$html.=	'		</tbody>
		  			</table>

		  			<br/>

		  			<p style="text-align:center;"><b>PLEASE	WISH CONCERN MEMBERS ON	THEIR BIRTHDAYS	& ANNIVERSARIES</b></p>
		  			
		  			<p style="text-align:right; margin-top:100px; font-size:.8em;">Page 2/2</p>

  				</div>
    		</body>
    		</html>';
	

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream($fileName);
}
