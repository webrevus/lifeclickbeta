<?php
include_once("dbconfig.php");
$ExtFolderArg = '../';
?>
<!DOCTYPE html>
<?ob_start()?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>404 | %appname%</title>
<script src="<?=$ServerUrl?>/assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?=$ServerUrl?>/assets/js/bookmark.js" type="text/javascript"></script>
<link rel="stylesheet" media="all" href="<?=$ServerUrl?>/assets/css/style.css" type="text/css"/>
<?=$GoogleFont_1;?>
<?=$GoogleFont_2;?>

<script type="text/javascript">
$('document').ready(function(){
	$('.mic').click(function(){
		$('.mobile ul.menu.m').slideToggle();
	})
});
</script>
</head>
<body>
	<?php include_once("header.php");?>
<div class="wraper">
	<div class="title">
		<div class="container">
			<h1>404 Not Found!</h1>
		</div>
		</div>
		<div style='clear:both'>
		<div class="container">
		<div class="inner-content">
		
      <tr>
        <td align="left" valign="top"><h1>404 Not Found!</h1></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="body_txt">

			<table border=0 cellspacing=4 cellpadding=0 width="95%" >
				<tr>
					<td align="center">
						<span style="font-size: 14pt;">Not Found<br></span><br>You have landed on a 404-error page -- the result of a broken link. The information you were seeking may be available on our site, but it is not at the location specified. Please try one of the following:
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center">
						<UL>
							<li style="line-height: 20pt; text-align: center;">Check the spelling of the URL to make sure the address is correct (capitalization and punctuation are important)<BR><a href="javascript:window.location.reload()"><b>and then click this refresh button</b></a></li>
							<li style="line-height: 20pt; text-align: center;"><b></b><a href="javascript:history.go(-1)"><b>Click this Back button</b></a> to return to the previous page. 
						</UL>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center">
						<b>Error type 404 - Object Not Found</b>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center">
						<b><I>web server at <?=$ServerUrl;?></I></b>
					</td>
				</tr>
			</table>


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