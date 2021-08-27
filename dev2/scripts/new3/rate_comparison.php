<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");

$page = get_pages_view('rate_comparison');
?>
<?php echo $page['page_content'];?>
            <br /><br />
            <div align="right"><a href="#" class="lbAction" rel="deactivate"><button>Cancel</button></a></div>