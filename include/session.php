<?php 
session_start();

function Message(){
	if(isset($_SESSION['Errormessage'])){
		$Output = "<div class=\" alert alert-danger \" >";
		$Output .= htmlentities($_SESSION['Errormessage']);
		$Output .= "</dib>";
		$_SESSION['Errormessage'] = null;

		return $Output ;
	}
}

function SuccessMessage(){
	if(isset($_SESSION['Successmessage'])){
		$Output = "<div class=\" alert alert-success \" >";
		$Output .= htmlentities($_SESSION['Successmessage']);
		$Output .= "</dib>";
		$_SESSION['Successmessage'] = null;

		return $Output ;
	}
}


 ?>