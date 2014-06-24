<?php
// get the active menu item 
$uri = $_SERVER['REQUEST_URI'];
$page = explode("/", $_SERVER['REQUEST_URI']);  // -  $page[1] has the value of the toplevel menu active item

//echo $page[1]."=====111======<br/>";
//echo $page[2]."======222=====<br/>";

?>

<!--

<div class="suckertreemenu">
<ul id="treemenu1">
<li><a href="/" class="firstlevel" id="firstli" onclick="javascript:changeColour(this.id)" ><font color="white">Home</font></a></li>
<li><a href="/training/" class="firstlevel" id="firstTandE"><font color="white">Training &amp; Events</font></a></li>
<li><a href="/research/" class="firstlevel" id="firstResearch"><font color="white">Research</font></a></li>
<li><a href="http://eprints.ncrm.ac.uk/" class="firstlevel" id="firstPub"><font color="white">Publications</font></a></li>
<li><a href="/news/" class="firstlevel" id="firstNews"><font color="white">News</font></a></li>
<li><a href="/about/" class="firstlevel" id="firstAbout"><font color="white" >About us</font></a></li>
<li><a href="/contact/" class="firstlevel" id="firstContact"><font color="white">Contact</font></a></li>
<li id="lastli">&nbsp;</li>
</ul>
</div>

<br><br><br>

-->

<div class="menu">
	<ul>
		<li><a href="/" <?php if($page[1]==""){echo "class='active'";}?> >Home</a></li>
		<li><a href="/training/" <?php if($page[1]=="training"){echo "class='active'";}?> >Training &amp; Events</a></li>
		<li><a href="/research/" <?php if($page[1]=="research"){echo "class='active'";}?> >Research</a>
		
			<ul <?php if($page[1]=="research"){echo "class='active'";}?> >
				<li><a href="/research/" <?php if($page[2]==""){echo "class='active'";}?> >Phase 3 research 2011-14</a></li>
				<li><a href="/research/phase2.php" <?php if($page[2]=="phase2.php"){echo "class='active'";}?> >Phase 2 research 2008-11</a></li>
				<li><a href="/research/phase1.php" <?php if($page[2]=="phase1.php"){echo "class='active'";}?> >Phase 1 research 2005-08</a></li>
				<li><a href="/research/NMI/" <?php if($page[2]=="NMI"){echo "class='active'";}?> >Networks for methodological innovation</a></li>
				<li><a href="/research/collaborative.php" <?php if($page[2]=="collaborative.php"){echo "class='active'";}?> >Collaborative research across NCRM</a></li>
				<li><a href="/research/MIP/" <?php if($page[2]=="MIP"){echo "class='active'";}?> >Methodological Innovation Projects</a></li>
			</ul>
		
		</li>
		<li><a href="http://eprints.ncrm.ac.uk/" >Publications</a></li>
		<li><a href="/news/" <?php if($page[1]=="news"){echo "class='active'";}?> >News</a>	
				
			<ul <?php if($page[1]=="news"){echo "class='active'";}?>>
				<li><a href="/news/" <?php if($page[2]==""){echo "class='active'";}?> >News archive</a></li>
				<li><a href="/news/methodsnews.php" <?php if($page[2]=="methodsnews.php"){echo "class='active'";}?> >MethodsNews newsletter</a></li>
				<li><a href="/news/subscribe/index.php" <?php if($page[2]=="subscribe"){echo "class='active'";}?> >Subscription to mailing list</a></li>
			</ul>
		
		</li>
		<li><a href="/about/" <?php if($page[1]=="about"){echo "class='active'";}?> >About us</a></li>
		<li><a href="/contact/" <?php if($page[1]=="contact"){echo "class='active'";}?> >Contact</font></a></li>
		
	</ul>

</div>

<!--
<div class="menu_level2">
<?php 
if($page[1]=="research"){
	if ($page[2] !="teaching") 
	{ 
	?>
	<ul>
		<li><a href="/research/" <?php if($page[2]==""){echo "class='active'";}?> >research 2011-14</a></li>
		<li><a href="/research/phase2.php" <?php if($page[2]=="phase2.php"){echo "class='active'";}?> >2008-11</a></li>
		<li><a href="/research/phase1.php" <?php if($page[2]=="phase1.php"){echo "class='active'";}?> >2005-08</a></li>
		<li><a href="/research/NMI/" <?php if($page[2]=="NMI"){echo "class='active'";}?> >Networks for methodological innovation</a></li>
		<li><a href="/research/collaborative/" <?php if($page[2]=="collaborative"){echo "class='active'";}?> >Collaborative research across NCRM</a></li>
		<li><a href="/research/MIP/" <?php if($page[2]=="MIP"){echo "class='active'";}?> >Methodological Innovation Projects</a></li>
	</ul>
	<?php
		
	} else { 
	
	?>	
	<ul>
		<li><a href="/research/teaching/" <?php if($page[2]==""){echo "class='active'";}?> >Information and instructions</a></li>
	</ul>
	<?php
		
	} 
	
	
}?>

</div>
-->

<?php


if ($_SERVER['REQUEST_URI'] =='/') {
?>
 <style type="text/css">
#firstli{
background-color: #2a93ef;
}
</style>

<?php
}
?>
<br><br><br>
<br style="line-height:none" />