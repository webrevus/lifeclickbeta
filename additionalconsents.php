<?php
$IsRedirectToTest = 1;
$HttpsOnly =1;
include_once("dbconfig.php");
redirect2https();

if($_SESSION['LoggedIn1'] != true AND $_SESSION["UserID"] =='')
{
	session_destroy();
	header("Location: ".$LogoutUrl);
	die;
}
if($_SESSION['IsExternal'] > 0)
{
	header("location: ".$ShortVersionUgradePage);
	die;

	/*if($_SESSION['IsAccountExpired'] > 0)
	{
		header("location: edit_registration.php");
		die;
	}
	else
	{
		header("location: sections.php");
		die;
	}*/

}
if($_GET['mode'] == 'download')
{
	dl_file(urldecode($_GET['file']));
	die;
}

$CheckInformedHCG = 1;
$CheckIntegrativeMedicine = 1;
$CheckPalletConsentFemale = 1;
$CheckPalletConsentMale = 1;

 $CheckInformedHCG = CheckInformedHCG($_SESSION['UserID'],date('Y'));
 $CheckIntegrativeMedicine = CheckIntegrativeMedicine($_SESSION['UserID'],date('Y'));
if($_SESSION['Gender'] == 'female')
{
	 $CheckPalletConsentFemale = CheckPelleteFemale($_SESSION['UserID'],date('Y'));
}
else
{
	 $CheckPalletConsentMale = CheckPelleteMale($_SESSION['UserID'],date('Y'));
}

$endyear = date("Y");

$HCGConsentQuery		= mysql_query(" SELECT * FROM nhc_user_informed_hcg WHERE userid='".$_SESSION['UserID']."' AND year='".$endyear."' ");
$HCGConsentPDF			= @mysql_result($HCGConsentQuery,0,"filename");

$IntegrativeConsentQuery		= mysql_query(" SELECT * FROM nhc_user_integrative_medicine WHERE userid='".$_SESSION['UserID']."' AND year='".$endyear."' ");
$IntegrativeConsentPDF			= @mysql_result($IntegrativeConsentQuery,0,"filename");

if($_SESSION['Gender'] == 'male')
{
	$PelletConsentQuery		= mysql_query(" SELECT * FROM nhc_user_pellet_consent WHERE userid='".$_SESSION['UserID']."' AND year='".$endyear."' AND formtype='male'");
	$PelletConsentPDF			= @mysql_result($PelletConsentQuery,0,"filename");
}
else
{
	$PelletConsentQuery		= mysql_query(" SELECT * FROM nhc_user_pellet_consent WHERE userid='".$_SESSION['UserID']."' AND year='".$endyear."' AND formtype='female'");
	echo $PelletConsentPDF		= @mysql_result($PelletConsentQuery,0,"filename");
}
?>
<!DOCTYPE html>
<?ob_start()?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>%appname%</title>
<script src="<?=$ServerUrl?>/assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?=$ServerUrl?>/assets/js/jquery.bxslider.js" type="text/javascript"></script>
<script src="<?=$ServerUrl?>/assets/js/bookmark.js" type="text/javascript"></script>
<link rel="stylesheet" media="all" href="<?=$ServerUrl?>/assets/css/style.css" type="text/css"/>
<?=$GoogleFont_1;?>
<?=$GoogleFont_2;?>

<script type="text/javascript" src="<?=$ServerUrl;?>/assets/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$ServerUrl;?>/assets/colorbox/colorbox.css"/>
<script type="text/javascript">
$('document').ready(function(){
	$('.mic').click(function(){
		$('.mobile ul.menu.m').slideToggle();
	})
});
function showforms(formurl)
{
	$.colorbox({iframe:true, href:formurl, retinaImage:true, retinaUrl:true, fixed:true, <?if($IsMobile>0 && $IsTablet < 1){echo 'width:"100%",height:"80%"';}else{echo 'width:"80%",height:"80%"';}?>});
}

</script>
<?include_once "ga-code.php";?>
<script>
function popitup(url,wwidth,wheight)
{
	newwindow=window.open(url,'dname','height='+wheight+',width='+wwidth+',top='+((screen.height/2)-(wheight/2))+',left='+((screen.width/2)-(wwidth/2))+',scrollbars=1,resizable=1');
}
</script>
</head>
<body>
	<?php include_once("header.php");?>
<div class="wraper">
	<div class="title">
		<div class="container">
			<h1>Additional Consents</h1>
		</div>
		</div>
		<div style='clear:both'>
		<div class="container">
		<div class="inner-content" >
					<div align='center'>
						<a href="downloaduseragreements.php">Click Here To Download User Agreements<a>
						<hr>
					</div>
					<br />
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td align="center">
								<?
								if($CheckInformedHCG > 0)
								{
								?>
									<a href="?mode=download&file=<?=urlencode($uploadAgreements.$HCGConsentPDF);?>" class="GreenExtraLargeButton">HCG Consent Agreement <?=date("Y")?></a> 
								<?
								}
								else
								{
								?>
									<a href="javascript:void(0);" class="GreenExtraLargeButton" onclick="showforms('<?=$ServerUrl;?>/informed-consent-hcg.php')">HCG Consent Agreement <?=date("Y")?></a> 
								<?
								}?>
							</td>
						</tr>
						<tr>
							<td align='center'>
							<?
								if($CheckIntegrativeMedicine > 0)
								{
								?>
									<a href="?mode=download&file=<?=urlencode($uploadAgreements.$IntegrativeConsentPDF);?>" class="GreenExtraLargeButton">Integrative Medicine Agreement <?=date("Y")?></a> 
								<?
								}
								else
								{
								?>
									<a href="javascript:void(0);" onclick="showforms('<?=$ServerUrl;?>/integrative-medicine.php')" class="GreenExtraLargeButton">Integrative Medicine Agreement <?=date("Y")?></a> 
								<?
								}
								?>
							</td>
						</tr>
						<tr>
							<td align="center">
							<?
							if(strtolower($_SESSION['Gender']) == 'male')
							{
								if($CheckPalletConsentMale > 0)
								{
								?>
									<a href="?mode=download&file=<?=urlencode($uploadAgreements.$PelletConsentPDF);?>" class="GreenExtraLargeButton">Pellet Consent Agreement <?=date("Y")?></a> 
								<?
								}
								else
								{
								?>
									<a href="javascript:void(0);" onclick="showforms('<?=$ServerUrl;?>/pellete-consent-male.php')" class="GreenExtraLargeButton">Pellet Consent Agreement <?=date("Y")?></a> 
								<?
								}
							}
							else
							{
								if($CheckPalletConsentFemale > 0)
								{
								?>
									<a href="?mode=download&file=<?=urlencode($uploadAgreements.$PelletConsentPDF);?>" class="GreenExtraLargeButton">Pellet Consent Agreement <?=date("Y")?></a> 
								<?
								}
								else
								{
								?>
									<a href="javascript:void(0);" onclick="showforms('<?=$ServerUrl;?>/pellete-consent-female.php')" class="GreenExtraLargeButton">Pellet Consent Agreement <?=date("Y")?></a> 
								<?
								}
							}
							?>
							</td>
						</tr>
					</table>

		</div>
		</div>
</div><!-- end of wraper -->
	<?php include_once("footer.php");?>
</body>
</html>
<?
$PageDescription = ob_get_contents();
$PageDescription = stripslashes($PageDescription);
$PageDescription = str_replace("%appname%",$SiteName,$PageDescription);
$PageDescription = str_replace("%adminemail%",$SiteAdminEmail,$PageDescription);
if($_SERVER["HTTPS"] == 'on')
{
	$PageDescription = ReplaceHttp2Https($PageDescription);
}
ob_clean();
echo $PageDescription;
?>