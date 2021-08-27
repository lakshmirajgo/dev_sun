<?php
//include("../../../../../admin/includes/functions/general_functions.php");	
//include("../../../../../admin/includes/functions/page_functions.php");	

include("/home/valuvet/public_html/admin/includes/functions/general_functions.php");	
include("/home/valuvet/public_html/admin/includes/functions/page_functions.php");
//include("http://" . $_SERVER['HTTP_HOST'] . "/admin/includes/functions/page_functions.php");	
$all_pages = get_all_pages();
//echo "" . $_SERVER['DOC_ROOT'] . "/admin/includes/functions/general_functions.php";
//echo "" . $_SERVER['DOC_ROOT'] . "/admin/includes/functions/page_functions.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_insert_link_title}</title>
	<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="jscripts/functions.js"></script>
	<link href="css/advlink.css" rel="stylesheet" type="text/css" />
	<base target="_self" />
</head>
<body id="advlink" onLoad="tinyMCEPopup.executeOnLoad('init();');" style="display: none">
    <form action="#" enctype="multipart/form-data" name="linkform" onSubmit="insertAction();return false;">
  <div class="tabs">
			<ul>
				<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onMouseDown="return false;">{$lang_advlink_general_tab}</a></span></li>
				<li id="popup_tab"><span><a href="javascript:mcTabs.displayTab('popup_tab','popup_panel');" onMouseDown="return false;">{$lang_advlink_popup_tab}</a></span></li>
				<li id="events_tab"><span><a href="javascript:mcTabs.displayTab('events_tab','events_panel');" onMouseDown="return false;">{$lang_advlink_events_tab}</a></span></li>
				<li id="advanced_tab"><span><a href="javascript:mcTabs.displayTab('advanced_tab','advanced_panel');" onMouseDown="return false;">{$lang_advlink_advanced_tab}</a></span></li>
			</ul>
		</div>

		<div class="panel_wrapper">
			<div id="general_panel" class="panel current">
				<fieldset>
					<legend>{$lang_advlink_general_props}</legend>

					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
						  <td nowrap="nowrap"><label id="hreflabel" for="href">{$lang_insert_link_url}</label></td>
						  <td><table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><input id="href" name="href" type="text" value="" onChange="selectByValue(this.form,'linklisthref',this.value);" /></td>
                                <td id="hrefbrowsercontainer">&nbsp;</td>
                              </tr>
                          </table></td>
					    </tr>
						<tr>
						  <td nowrap="nowrap"><label id="hreflabel" for="href">Select a page to link to</label></td>
						  <td><table border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td id="hrefbrowsercontainer">
                                <script language="javascript">
									function update_link(pagelink){
										//The http://domainname link below needs to be pulled from the database
										//alert('i am here');
										document.forms['linkform'].href.value = 'http://www.valuvet.com/'+pagelink;
									}
								</script>
                                <select name="pages" id="pages" onChange="update_link(this.value);">
                                  <option value="">Click to select a page</option>
                                  <?php
								  foreach($all_pages as $value){
                                  echo '<option value="pages.php?page_name='. $value['page_name']. '">'. $value['page_title']. '</option>';
                                  }
								  ?>
                                </select>
                                </td>
                              </tr>
                          </table>
					      <label></label></td>
					  </tr>
						<tr id="linklisthrefrow">
							<td class="column1"><label for="linklisthref">{$lang_link_list}</label></td>
							<td colspan="2" id="linklisthrefcontainer">&nbsp;</td>
						</tr>
						<tr>
							<td class="column1"><label for="anchorlist">{$lang_advlink_anchor_names}</label></td>
							<td colspan="2" id="anchorlistcontainer">&nbsp;</td>
						</tr>
						<tr>
							<td><label id="targetlistlabel" for="targetlist">{$lang_insert_link_target}</label></td>
							<td id="targetlistcontainer">&nbsp;</td>
						</tr>
						<tr>
							<td nowrap="nowrap"><label id="titlelabel" for="title">{$lang_theme_insert_link_titlefield}</label></td>
							<td><input id="title" name="title" type="text" value="" /></td>
						</tr>
						<tr>
							<td><label id="classlabel" for="classlist">{$lang_class_name}</label></td>
							<td>
								 <select id="classlist" name="classlist" onChange="changeClass();">
									<option value="" selected>{$lang_not_set}</option>
								 </select>							</td>
						</tr>
					</table>
			  </fieldset>
			</div>

			<div id="popup_panel" class="panel">
				<fieldset>
					<legend>{$lang_advlink_popup_props}</legend>

					<input type="checkbox" id="ispopup" name="ispopup" class="radio" onClick="setPopupControlsDisabled(!this.checked);buildOnClick();" />
					<label id="ispopuplabel" for="ispopup">{$lang_advlink_popup}</label>

					<table border="0" cellpadding="0" cellspacing="4">
						<tr>
							<td nowrap="nowrap"><label for="popupurl">{$lang_advlink_popup_url}</label>&nbsp;</td>
							<td>
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" name="popupurl" id="popupurl" value="" onChange="buildOnClick();" /></td>
										<td id="popupurlbrowsercontainer">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap"><label for="popupname">{$lang_advlink_popup_name}</label>&nbsp;</td>
							<td><input type="text" name="popupname" id="popupname" value="" onChange="buildOnClick();" /></td>
						</tr>
						<tr>
							<td nowrap="nowrap"><label>{$lang_advlink_popup_size}</label>&nbsp;</td>
							<td nowrap="nowrap">
								<input type="text" id="popupwidth" name="popupwidth" value="" onChange="buildOnClick();" /> x
								<input type="text" id="popupheight" name="popupheight" value="" onChange="buildOnClick();" /> px
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap" id="labelleft"><label>{$lang_advlink_popup_position}</label>&nbsp;</td>
							<td nowrap="nowrap">
								<input type="text" id="popupleft" name="popupleft" value="" onChange="buildOnClick();" /> /                                
								<input type="text" id="popuptop" name="popuptop" value="" onChange="buildOnClick();" /> (c /c = center)
							</td>
						</tr>
					</table>

					<fieldset>
						<legend>{$lang_advlink_popup_opts}</legend>

						<table border="0" cellpadding="0" cellspacing="4">
							<tr>
								<td><input type="checkbox" id="popuplocation" name="popuplocation" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popuplocationlabel" for="popuplocation">{$lang_advlink_popup_location}</label></td>
								<td><input type="checkbox" id="popupscrollbars" name="popupscrollbars" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupscrollbarslabel" for="popupscrollbars">{$lang_advlink_popup_scrollbars}</label></td>
							</tr>
							<tr>
								<td><input type="checkbox" id="popupmenubar" name="popupmenubar" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupmenubarlabel" for="popupmenubar">{$lang_advlink_popup_menubar}</label></td>
								<td><input type="checkbox" id="popupresizable" name="popupresizable" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupresizablelabel" for="popupresizable">{$lang_advlink_popup_resizable}</label></td>
							</tr>
							<tr>
								<td><input type="checkbox" id="popuptoolbar" name="popuptoolbar" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popuptoolbarlabel" for="popuptoolbar">{$lang_advlink_popup_toolbar}</label></td>
								<td><input type="checkbox" id="popupdependent" name="popupdependent" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupdependentlabel" for="popupdependent">{$lang_advlink_popup_dependent}</label></td>
							</tr>
							<tr>
								<td><input type="checkbox" id="popupstatus" name="popupstatus" class="checkbox" onChange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupstatuslabel" for="popupstatus">{$lang_advlink_popup_statusbar}</label></td>
								<td><input type="checkbox" id="popupreturn" name="popupreturn" class="checkbox" onChange="buildOnClick();" checked="checked" /></td>
								<td nowrap="nowrap"><label id="popupreturnlabel" for="popupreturn">{$lang_advlink_popup_return}</label></td>
							</tr>
						</table>
					</fieldset>
				</fieldset>
			</div>

			<div id="advanced_panel" class="panel">
			<fieldset>
					<legend>{$lang_advlink_advanced_props}</legend>

					<table border="0" cellpadding="0" cellspacing="4">
						<tr>
							<td class="column1"><label id="idlabel" for="id">{$lang_advlink_id}</label></td> 
							<td><input id="id" name="id" type="text" value="" /></td> 
						</tr>

						<tr>
							<td><label id="stylelabel" for="style">{$lang_advlink_style}</label></td>
							<td><input type="text" id="style" name="style" value="" /></td>
						</tr>

						<tr>
							<td><label id="classeslabel" for="classes">{$lang_advlink_classes}</label></td>
							<td><input type="text" id="classes" name="classes" value="" onChange="selectByValue(this.form,'classlist',this.value,true);" /></td>
						</tr>

						<tr>
							<td><label id="targetlabel" for="target">{$lang_advlink_target_name}</label></td>
							<td><input type="text" id="target" name="target" value="" onChange="selectByValue(this.form,'targetlist',this.value,true);" /></td>
						</tr>

						<tr>
							<td class="column1"><label id="dirlabel" for="dir">{$lang_advlink_langdir}</label></td> 
							<td>
								<select id="dir" name="dir"> 
										<option value="">{$lang_not_set}</option> 
										<option value="ltr">{$lang_advlink_ltr}</option> 
										<option value="rtl">{$lang_advlink_rtl}</option> 
								</select>
							</td> 
						</tr>

						<tr>
							<td><label id="hreflanglabel" for="hreflang">{$lang_advlink_target_langcode}</label></td>
							<td><input type="text" id="hreflang" name="hreflang" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label id="langlabel" for="lang">{$lang_advlink_langcode}</label></td> 
							<td>
								<input id="lang" name="lang" type="text" value="" />
							</td> 
						</tr>

						<tr>
							<td><label id="charsetlabel" for="charset">{$lang_advlink_encoding}</label></td>
							<td><input type="text" id="charset" name="charset" value="" /></td>
						</tr>

						<tr>
							<td><label id="typelabel" for="type">{$lang_advlink_mime}</label></td>
							<td><input type="text" id="type" name="type" value="" /></td>
						</tr>

						<tr>
							<td><label id="rellabel" for="rel">{$lang_advlink_rel}</label></td>
							<td><select id="rel" name="rel"> 
									<option value="">{$lang_not_set}</option> 
									<option value="alternate">Alternate</option> 
									<option value="designates">Designates</option> 
									<option value="stylesheet">Stylesheet</option> 
									<option value="start">Start</option> 
									<option value="next">Next</option> 
									<option value="prev">Prev</option> 
									<option value="contents">Contents</option> 
									<option value="index">Index</option> 
									<option value="glossary">Glossary</option> 
									<option value="copyright">Copyright</option> 
									<option value="chapter">Chapter</option> 
									<option value="subsection">Subsection</option> 
									<option value="appendix">Appendix</option> 
									<option value="help">Help</option> 
									<option value="bookmark">Bookmark</option> 
								</select> 
							</td>
						</tr>

						<tr>
							<td><label id="revlabel" for="rev">{$lang_advlink_rev}</label></td>
							<td><select id="rev" name="rev"> 
									<option value="">{$lang_not_set}</option> 
									<option value="alternate">Alternate</option> 
									<option value="designates">Designates</option> 
									<option value="stylesheet">Stylesheet</option> 
									<option value="start">Start</option> 
									<option value="next">Next</option> 
									<option value="prev">Prev</option> 
									<option value="contents">Contents</option> 
									<option value="index">Index</option> 
									<option value="glossary">Glossary</option> 
									<option value="copyright">Copyright</option> 
									<option value="chapter">Chapter</option> 
									<option value="subsection">Subsection</option> 
									<option value="appendix">Appendix</option> 
									<option value="help">Help</option> 
									<option value="bookmark">Bookmark</option> 
								</select> 
							</td>
						</tr>

						<tr>
							<td><label id="tabindexlabel" for="tabindex">{$lang_advlink_tabindex}</label></td>
							<td><input type="text" id="tabindex" name="tabindex" value="" /></td>
						</tr>

						<tr>
							<td><label id="accesskeylabel" for="accesskey">{$lang_advlink_accesskey}</label></td>
							<td><input type="text" id="accesskey" name="accesskey" value="" /></td>
						</tr>
					</table>
				</fieldset>
			</div>

			<div id="events_panel" class="panel">
			<fieldset>
					<legend>{$lang_advlink_event_props}</legend>

					<table border="0" cellpadding="0" cellspacing="4">
						<tr>
							<td class="column1"><label for="onfocus">onfocus</label></td> 
							<td><input id="onfocus" name="onfocus" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onblur">onblur</label></td> 
							<td><input id="onblur" name="onblur" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onclick">onclick</label></td> 
							<td><input id="onclick" name="onclick" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="ondblclick">ondblclick</label></td> 
							<td><input id="ondblclick" name="ondblclick" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onmousedown">onmousedown</label></td> 
							<td><input id="onmousedown" name="onmousedown" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onmouseup">onmouseup</label></td> 
							<td><input id="onmouseup" name="onmouseup" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onmouseover">onmouseover</label></td> 
							<td><input id="onmouseover" name="onmouseover" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onmousemove">onmousemove</label></td> 
							<td><input id="onmousemove" name="onmousemove" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onmouseout">onmouseout</label></td> 
							<td><input id="onmouseout" name="onmouseout" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onkeypress">onkeypress</label></td> 
							<td><input id="onkeypress" name="onkeypress" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onkeydown">onkeydown</label></td> 
							<td><input id="onkeydown" name="onkeydown" type="text" value="" /></td> 
						</tr>

						<tr>
							<td class="column1"><label for="onkeyup">onkeyup</label></td> 
							<td><input id="onkeyup" name="onkeyup" type="text" value="" /></td> 
						</tr>
					</table>
				</fieldset>
			</div>
		</div>

		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="insert" name="insert" value="{$lang_insert}" onClick="insertAction();" />
			</div>

			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="{$lang_cancel}" onClick="tinyMCEPopup.close();" />
			</div>
		</div>
    </form>
</body>
</html>
