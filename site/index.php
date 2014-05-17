<?php
error_reporting(E_ALL); @ini_set('display_errors', true);
	$pages = array(
		'0'	=> array('id' => '1', 'alias' => 'Home', 'file' => '1.php'),
		'1'	=> array('id' => '4', 'alias' => 'Exercises', 'file' => '4.php'),
		'2'	=> array('id' => '2', 'alias' => 'Diet', 'file' => '2.php'),
		'3'	=> array('id' => '3', 'alias' => 'Supplements', 'file' => '3.php'),
		'4'	=> array('id' => '5', 'alias' => 'Chest', 'file' => '5.php'),
		'5'	=> array('id' => '6', 'alias' => 'Back', 'file' => '6.php'),
		'6'	=> array('id' => '7', 'alias' => 'Legs', 'file' => '7.php'),
		'7'	=> array('id' => '8', 'alias' => 'login', 'file' => '8.php'),
		'8'	=> array('id' => '9', 'alias' => 'signup', 'file' => '9.php'),
		'9'	=> array('id' => '10', 'alias' => 'checklogin', 'file' => '10.php'),
		'10'	=> array('id' => '11', 'alias' => 'check', 'file' => '11.php'),
		'11'	=> array('id' => '12', 'alias' => 'forgotten', 'file' => '12.php'),
		'12'	=> array('id' => '13', 'alias' => 'success', 'file' => '13.php'),
		'13'	=> array('id' => '14', 'alias' => 'logout', 'file' => '14.php'),
		'14'	=> array('id' => '15', 'alias' => 'plan', 'file' => '15.php'),
		'15'	=> array('id' => '16', 'alias' => 'bodyfat', 'file' => '16.php'),
		'16'	=> array('id' => '17', 'alias' => 'bfpercent', 'file' => '17.php'),
		'17'	=> array('id' => '18', 'alias' => 'Contact', 'file' => '18.php')
	);
	$forms = array(

	);
	$base_dir = dirname(__FILE__);
	$base_url = '/';
	$show_comments = false;
	include dirname(__FILE__).'/functions.inc.php';
	$home_page = '1';
	$page_id = parse_uri();
	$user_key = "hlKLHJmIP7rpja9tUd/K1J35BdQgDy4S";
	$user_hash = "a3f2570bfe74e117";
	$comment_callback = "http://us.zyro.com/comment_callback/";
	$preview = false;
	$mod_rewrite = true;
	$page = isset($pages[$page_id]) ? $pages[$page_id] : null;
	if (!is_null($page)) {
		handleComments($page['id']);
		if (isset($_POST["wb_form_id"])) handleForms($page['id']);
	}
	ob_start();
	if (isset($_REQUEST['view']) && $_REQUEST['view'] == 'news')
		include dirname(__FILE__).'/news.php';
	else if (isset($_REQUEST['view']) && $_REQUEST['view'] == 'blog')
		include dirname(__FILE__).'/blog.php';
	else if ($page) {
		$fl = dirname(__FILE__).'/'.$page['file'];
		if (is_file($fl)) {
			ob_start();
			include $fl;
			$out = ob_get_clean();
			$ga_out = '';
			if (is_file($ga_file = dirname(__FILE__).'/ga_code') && $ga_code = file_get_contents($ga_file)) {
				$ga_out = str_replace('{{ga_code}}', $ga_code, file_get_contents(dirname(__FILE__).'/ga.php'));
			}
			$out = str_replace('{{ga_code}}', $ga_out, $out);
			$out = str_replace('{{base_url}}', 'http://'.$_SERVER['HTTP_HOST'].'/', $out);
			header('Content-type: text/html; charset=utf-8', true);
			echo $out;
		}
	} else {
		header("Content-type: text/html; charset=utf-8", true, 404);
		echo "<!DOCTYPE html>\n";
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>404 Not found</title>\n";
		echo "</head>\n";
		echo "<body>\n";
		echo "404 Not found\n";
		echo "</body>\n";
		echo "</html>";
}
	ob_end_flush();

?>