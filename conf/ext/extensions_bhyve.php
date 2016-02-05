<?php
/*
extensions_bhyve.php
*/
require("auth.inc");
require("guiconfig.inc");
$savemsg = "I begin prepare extension for bhyve virtual machines. <br />Now ready commandline interface only, please wait, I work for webgui<br />I add manual page for commands<br />Extension may be upgraded ober webgui page config";
$pgtitle = array("Extensions", "Virtual Machine BHYVE");
if ( !isset( $config['bhyve']['homefolder']) ) {
	if (is_file("/tmp/bhyve.install")) {
		header("Location: extensions_bhyve_config.php"); 
		exit;
	} else { $input_errors[] = "Bhive not installed"; }
}
if ($_POST) {
	if (isset($_POST['Submit']) && $_POST['Submit'] == "Save") {
		//check errors section here
		$config['bhyve']['enable']= isset($_POST['enable']) ? true : false;
		write_config();
		rc_update_service("vm");
	}
}
$pconfig['enable'] = isset($config['bhyve']['enable']);
include("fbegin.inc");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr><td class="tabnavtbl">
		<ul id="tabnav">
			<li class="tabact"><a href="extensions_bhyve.php"><span><?="VM Bhyve";?></span></a></li>
			
			<li class="tabinact"><a href="extensions_bhyve_config.php"><span><?="Extension config";?></span></a></li>
			<li class="tabinact"><a href="extensions_bhyve_manual.php"><span><?="VM Manual";?></span></a></li>
					</span> </a>
				</li>
		</ul>
	</td></tr>
	<tr>
		<td class="tabcont">
			<?php if (!empty($input_errors)) print_input_errors($input_errors); ?>
			<?php if (!empty($savemsg)) print_info_box($savemsg); ?>
			<table width="100%" border="0" cellpadding="6" cellspacing="0">
			<form action="extensions_bhyve.php" method="post" name="iform" id="iform">
				<?php html_titleline_checkbox("enable", "Bhyve virtual machines", $pconfig['enable'], gettext("Enable"), "enable_change(false)" ); ?>
			</table>
			<div id="submit">
					<input name="Submit" type="submit" class="formbtn" value="Save"  />
			</div>
			<?php include("formend.inc");?>
			</form>
		</td>
	</tr>
</table>
<?php include("fend.inc"); ?>