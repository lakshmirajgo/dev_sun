<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/page_functions.php");	

	if ($_POST['action'] == 'create_new') {
		if(add_pages())
		echo '<script language="javascript">alert(\'Page created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating page\');</script>';


	}
	
	if ($_GET['cAction'] == 'edit'){
		$page_view = get_pages_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_pages($_GET['id'])) {
			echo '<script language="javascript">alert(\'Page updated successfully\');</script>';
						$page_view = get_pages_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating page\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_pages($delete_id))
		echo '<script language="javascript">alert(\'Page Deleted Successfully\');window.location=\'page_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the page\n\nPlease try again\');window.location=\'page_manager.php\';</script>';
		$all_pages = get_all_pages();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_pages($_POST['id']))
		echo '<script language="javascript">alert(\'Page Deleted Successfully\')</script>';
		$all_pages = get_all_pages();
	}
		
	include ("includes/common/header.php");	
	//$message = NULL;
	//$message = $_SESSION['notice'];
	//if (isset($message)) {
	//echo '<p>', $message, '</p>';
	//}
    $all_pages = get_all_pages();
	 include ("includes/common/menu.php");	
	// Show all pages
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete'){
	?>
	 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>PAGE MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="page_manager.php?cAction=create_new"><img src="images/add_page.jpg" border="0" type="image" alt="Add a New Page" title="Add a New Page"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="page_manager.php">
		<input type="hidden" value="" name="action">
		<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="37" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="22"></td>
                      <td width="484" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Page Title</td>
                      <td width="22"></td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					if(count($all_pages)>=1){
					foreach($all_pages as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="484" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Page"><?php echo $value['page_title']; ?></a></td>                      <td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this page?\n\nNotice: deleted page cannot be restored')" /></a></td> 
                      <td width="5"></td>
                    </tr>
                    <? } 
					
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no pages in the database. <a href="page_manager.php?cAction=create_new" class="link1">Create a new page</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
					<tr>
					<td colspan="5"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected page(s)?\n\nNotice: deleted page(s) cannot be restored')"> </td>
					</tr>
                  </table>  
                 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    </form>
	<?php
	}
	?>
    <?php
	// Create a New Page
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="page_manager.php" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="create_new">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW PAGE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Page Name:</strong> Enter one or two words without spaces that describe this page (example: home, about_us, contacts) Note: This must be unique to this page only, you cannot use the same word for any other page</td>
                <td align="left" height="30" width="62%" class="ot2"><input name="page_name" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Page Title</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="page_title" class="bodytxt" size="39" type="text"></td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>SEO Description:</strong> Short description of the page. Please enter a short page description. This helps in search engine indexing</td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="meta_description" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>SEO Keywords:</strong> Enter a few keywords seperated by a comma for this page. This is also used in search engine optimization for your site. Note: avoid repetitive words or phrases - Max</td>
                <td align="left" height="30" width="62%" class="ot"><textarea name="meta_keywords" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Page Content:</strong> Enter your page content here. Use the text formatting icons to make your text more appealing<br /><textarea name="page_content" rows="20" style="width:100%"  class="mceEditor"></textarea>
				</td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_create.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
	</form>
	<?php
	}
	?>
    <?php
	// Edit Page
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_page" style="padding-bottom:0px;" name="edit_page" method="post" action="page_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="edit">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT PAGE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Page Name:</strong> Enter one or two words without spaces that describe this page (example: home, about_us, contacts) Note: This must be unique to this page only, you cannot use the same word for any other page</td>
                <td align="left" height="30" width="62%" class="ot2"><input name="page_name" class="bodytxt" size="39" type="text" value="<?php echo $page_view['page_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Page Title</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="page_title" class="bodytxt" size="39" type="text" value="<?php echo $page_view['page_title']; ?>"></td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>SEO Description:</strong> Short description of the page. Please enter a short page description. This helps in search engine indexing</td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="meta_description" rows="3" cols="36" class="bodytxt"><?php echo $page_view['meta_description']; ?></textarea></td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>SEO Keywords:</strong> Enter a few keywords seperated by a comma for this page. This is also used in search engine optimization for your site. Note: avoid repetitive words or phrases - Max</td>
                <td align="left" height="30" width="62%" class="ot"><textarea name="meta_keywords" rows="3" cols="36" class="bodytxt"><?php echo $page_view['meta_keywords']; ?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Page Content:</strong> Enter your page content here. Use the text formatting icons to make your text more appealing<br /><textarea name="page_content" rows="20" style="width:100%"  class="mceEditor"><?php echo $page_view['page_content']; ?></textarea>
				</td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
	</form>
	<?php
	}
	?>
<?php
include ("includes/common/footer.php");
?>