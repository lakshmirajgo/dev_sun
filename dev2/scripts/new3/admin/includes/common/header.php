<?php 		
	$company_info = get_company_info(); 
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/master.css" rel="stylesheet" type="text/css"><title>IWS Site Manager Ver 2.0 - <?php echo $company_info['company']; ?></title>
<script type="text/javascript" src="js/validate.js"></script>
<SCRIPT language="JavaScript">
function submitform()
{
  document.loginform.submit();
}

function submitform2()
{
  document.loginforum.submit();
}
</SCRIPT>
<?php
if ($_SERVER['PHP_SELF'] == "/new/admin/vehicle_manager.php") {
?>
<!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple",
		editor_selector : "mceEditor",
		editor_deselector : "mceNoEditor"
	});
</script>
<!-- TinyMCE -->
<?php
} else {
?> 
<!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		editor_selector : "mceEditor",
		editor_deselector : "mceNoEditor",
	plugins : "spellchecker,style,layer,table,save,advhr,advimage,ibrowser,advlink,emotions,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,ibrowser,separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,insertimage",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		theme_advanced_statusbar_location : "bottom",
		plugin_insertdate_dateFormat : "%m-%d-%y",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],iframe[src|width|height|scrolling],script[src|type|language],form[name|method|action|target],input[type|name|value|size]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinyfck_field = field_name;
		tinyfck = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinyfck", "modal,width=600,height=400");
	};
</script>
<!-- /TinyMCE -->
<?php
}
?>

<script type="text/JavaScript">
<!--
function validate(form){
	if(form.username.value==''){
		alert('Please enter your username');
		form.username.focus();
		return false;
	}
		if(form.password.value==''){
		alert('Please enter  your password');
		form.password.focus();
		return false;
	}

}

function validate2(form){
	if(form.username.value==''){
		alert('Please enter your username');
		form.username.focus();
		return false;
	}
		if(form.password_old.value==''){
		alert('Please enter  your old password');
		form.password_old.focus();
		return false;
	}
	
	if(form.password_new.value==''){
		alert('Please enter  your new password');
		form.password_new.focus();
		return false;
	}
	
	if(form.password_confirm.value==''){
		alert('Please confirm your new password');
		form.password_confirm.focus();
		return false;
	}

}
//-->
</script>
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<script src="../lib/prototype.js" type="text/javascript"></script>
<script src="../src/scriptaculous.js" type="text/javascript"></script>
</head><body>
<table class="maintable" align="center" border="0" cellpadding="0" cellspacing="0" height="58" width="880">
  <tbody><tr>
    <td align="center" background="images/topBG.jpg" valign="middle" class="maintxt"><?php echo $company_info['company']; ?></td>
  </tr>
</tbody></table>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="880">
  <tbody>
  <tr>
    <td style="padding-bottom: 50px; padding-top: 20px; padding-left: 20px; padding-right: 20px;" align="center" bgcolor="#ffffff" height="282" valign="top">