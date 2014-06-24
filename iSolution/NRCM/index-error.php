<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/generic.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<?php $pathRoot = $_SERVER['DOCUMENT_ROOT'] . '/';
include $pathRoot.'site-resources/headfoot/auto-head-above.php'; ?>
<!-- InstanceBeginEditable name="title" --> 
<title>NCRM Research</title>
<script type="text/javascript">
	var pageUrl = new Array();			
	pageUrl[1] = "/research/phase3/all.php";
	pageUrl[2] = "/research/phase3/hub.php";
	pageUrl[3] = "/research/phase3/lemma3.php";
	pageUrl[4] = "/research/phase3/mode.php";
	pageUrl[5] = "/research/phase3/novella.php";
	pageUrl[6] = "/research/phase3/pathways.php";
	pageUrl[7] = "/research/phase3/pepa.php";
	pageUrl[8] = "/research/phase3/talisman.php";
</script>
<link href="/incoming/furniture/css/tabnodes.css" rel="stylesheet" type="text/css" />
<style type="text/css">		
	#tab1 { width:78px; }
			
	#tab2 { width:83px; }
			
	#tab3 { width:83px; }
	
	#tab4 { width:73px; }
			
	#tab5 { width:93px; }
			
	#tab6 { width:98px; }
			
	#tab7 { width:63px; }
			
	#tab8 { width:93px; }
			
</style>

<script type="text/javascript" src="/incoming/furniture/js/tabnodes.js"></script>

<![if IE]> 
<style type="text/css">			
.container
	{
	padding-top:6px;
}
</style>	
<![endif]>

<![if !IE]> 
<style type="text/css">			
.container
	{
	padding-top:0px;
}
</style>	
<![endif]>

<![if IE 8]> 
<style type="text/css">			
.container
	{
	padding-top:0px;
}
</style>	
<![endif]>

			
<!-- InstanceEndEditable -->
<?php include $pathRoot.'site-resources/headfoot/auto-head-below.php'; ?>
</head>

<body onLoad="checkJavaScriptValidity()">
<?php include $pathRoot.'site-resources/headfoot/auto-header.php'; ?>
	 <!-- InstanceBeginEditable name="page" --> 
	
	
<div class="container">
	<div class="navcontainer">
	<ul>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(1)" id="tab1" href="?n=1">ALL</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(2)" id="tab2" href="?n=2">The Hub</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(3)" id="tab3" href="?n=3">LEMMA 3</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(4)" id="tab4" href="?n=4">MODE</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(5)" id="tab5" href="?n=5">NOVELLA</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(6)" id="tab6" href="?n=6">PATHWAYS</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(7)" id="tab7" href="?n=7">PEPA</a></h2></div></li>
	<li><div align="center"><h2><a onclick="javascript:ChangeColour(8)" id="tab8" href="?n=8">TALISMAN</a></h2></div></li>
	</ul>
	</div>

	
</div>
<?php 
if (isset($_GET['n'])) {
	if ($_GET['n'] == '1') { ?>
	<script type="text/javascript">loadTab(1);ChangeColour(1);</script> <? } 
	elseif ($_GET['n'] == '2') { ?>
	<script type="text/javascript">loadTab(2);ChangeColour(2);</script> <? }
	elseif ($_GET['n'] == '3') { ?>
	<script type="text/javascript">loadTab(3);ChangeColour(3);</script> <? }
	elseif ($_GET['n'] == '4') { ?>
	<script type="text/javascript">loadTab(4);ChangeColour(4);</script> <? }
	elseif ($_GET['n'] == '5') { ?>
	<script type="text/javascript">loadTab(5);ChangeColour(5);</script> <? } 
	elseif ($_GET['n'] == '6') { ?>
	<script type="text/javascript">loadTab(6);ChangeColour(6);</script> <? }
	elseif ($_GET['n'] == '7') { ?>
	<script type="text/javascript">loadTab(7);ChangeColour(7);</script> <? }
	elseif ($_GET['n'] == '8') { ?>
	<script type="text/javascript">loadTab(8);ChangeColour(8);</script> <? }
}
else { ?>
<script type="text/javascript">loadTab(1);ChangeColour(1);</script> <? } ?>
<div id="tabcontent">
</div>


 
	 <!-- InstanceEndEditable -->
<?php include $pathRoot.'site-resources/headfoot/auto-footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
