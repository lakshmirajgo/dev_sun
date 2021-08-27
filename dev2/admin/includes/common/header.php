<?php 		
	$company_info = get_company_info();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/master.css" rel="stylesheet" type="text/css"><title>IWS Site Manager Ver 2.0 - <?php echo $company_info['company']; ?></title>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="js/date.js"></script>
<script language=javascript>

checked=false;
function checkedAll (field) {
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < field.length; i++) 
	{
	 field[i].checked = checked;
	}
      }
</script>
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
if ($_SERVER['PHP_SELF'] == "/admin/vehicle_manager.php") {
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
}
if ($_SERVER['PHP_SELF'] == "/admin/page_manager.php" || $_SERVER['PHP_SELF'] == "/admin/email_manager.php") {
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
	//if(form.username.value==''){
		//alert('Please enter your username');
		//form.username.focus();
		//return false;
	//}
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
<?php
if ($_SERVER['PHP_SELF'] == "/admin/reservation_manager.php" || $_SERVER['PHP_SELF'] == "/admin/index.php" || $_SERVER['PHP_SELF'] == "/admin/index_search.php" || $_SERVER['PHP_SELF'] == "/admin/report_manager.php" || $_SERVER['PHP_SELF'] == "/admin/get_report.php" || $_SERVER['PHP_SELF'] == '/admin/testimony_manager.php' || $_SERVER['PHP_SELF'] == '/admin/get_report_sanford.php') {
?>
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<?php
}
?>
<?php
if ($_SERVER['PHP_SELF'] == "/admin/index.php") {
?>
<script src="../lib/prototype.js" type="text/javascript"></script>
<script src="../src/scriptaculous.js" type="text/javascript"></script>
<?php
}
?>


<style>
body {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: .8em;
	}

/* the div that holds the date picker calendar */
.dpDiv {
	}


/* the table (within the div) that holds the date picker calendar */
.dpTable {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align: center;
	color: #505050;
	background-color: #ece9d8;
	border: 1px solid #AAAAAA;
	}


/* a table row that holds date numbers (either blank or 1-31) */
.dpTR {
	}


/* the top table row that holds the month, year, and forward/backward buttons */
.dpTitleTR {
	}


/* the second table row, that holds the names of days of the week (Mo, Tu, We, etc.) */
.dpDayTR {
	}


/* the bottom table row, that has the "This Month" and "Close" buttons */
.dpTodayButtonTR {
	}


/* a table cell that holds a date number (either blank or 1-31) */
.dpTD {
	border: 1px solid #ece9d8;
	}


/* a table cell that holds a highlighted day (usually either today's date or the current date field value) */
.dpDayHighlightTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	}


/* the date number table cell that the mouse pointer is currently over (you can use contrasting colors to make it apparent which cell is being hovered over) */
.dpTDHover {
	background-color: #aca998;
	border: 1px solid #888888;
	cursor: pointer;
	color: red;
	}


/* the table cell that holds the name of the month and the year */
.dpTitleTD {
	}


/* a table cell that holds one of the forward/backward buttons */
.dpButtonTD {
	}


/* the table cell that holds the "This Month" or "Close" button at the bottom */
.dpTodayButtonTD {
	}


/* a table cell that holds the names of days of the week (Mo, Tu, We, etc.) */
.dpDayTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	color: white;
	}


/* additional style information for the text that indicates the month and year */
.dpTitleText {
	font-size: 12px;
	color: gray;
	font-weight: bold;
	}


/* additional style information for the cell that holds a highlighted day (usually either today's date or the current date field value) */ 
.dpDayHighlight {
	color: 4060ff;
	font-weight: bold;
	}


/* the forward/backward buttons at the top */
.dpButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	padding: 0px;
	}


/* the "This Month" and "Close" buttons at the bottom */
.dpTodayButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	}

</style>



<?php
if ($_SERVER['PHP_SELF'] == "/admin/locked_dates_manager.php") {
?>

<link href="/admin/js/datetime/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="/admin/js/datetime/jquery-ui-theme.min.css" rel="stylesheet" type="text/css">
<link href="/admin/js/datetime/timepicker.css" rel="stylesheet" type="text/css">
<link href="/admin/js/datetime/custom.css" rel="stylesheet" type="text/css">


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/admin/js/datetime/jquery-ui.min.js" type="text/javascript"></script>
<script src="/admin/js/datetime/timepicker.js" type="text/javascript"></script>

<?php
}
?>











</head>
<body>
<table class="maintable" align="center" border="0" cellpadding="0" cellspacing="0" height="58" width="1320">
  <tbody><tr>
    <td align="center" background="images/topBG.jpg" valign="middle" class="maintxt"><?php echo $company_info['company']; ?></td>
  </tr>
</tbody></table>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="1320">
  <tbody>
  <tr>
    <td style="padding-bottom: 50px; padding-top: 20px; padding-left: 20px; padding-right: 20px;" align="center" bgcolor="#ffffff" height="282" valign="top">