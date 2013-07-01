<?php
/*
Plugin Name: Stop Registration Spam
Plugin URI: https://uproot.us/
Description: Prevent user registration spam.
Version: 1.0.0
Author: Matt Gibbs
Author URI: https://uproot.us/

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/>.
*/

$rpb = new SRS();

class SRS
{
	function __construct() {
		add_action('init', array($this, 'init'));
	}

	function init() {
		//add_action('admin_menu', array($this, 'admin_menu'));
		add_action('register_form', array($this, 'registration_page'));
		add_action('registration_errors', array($this, 'check_registration'), 10, 3);
	}

	/*
	function admin_menu() {
		add_submenu_page('options-general.php', 'Registration Spam Blocker', 'Registration Spam Blocker', 'manage_options', 'rsb', array($this, 'admin_page'));
	}

	function admin_page() {
		echo 'hello world';
	}
	*/

	function registration_page() {
	?>
		<label for="validate"><a href="https://www.google.com/search?q=what+is+the+capital+of+Virginia" target="_blank">What is the capital of Virginia?</a></label>
		<input type="text" name="validate" id="validate" class="input" size="20" />
	<?php
	}

	function check_registration($errors, $user_login, $user_email) {
		$answer = $_POST['validate'];
		if ('richmond' != strtolower($answer)) {
			$errors->add('validation_failed', '<strong>ERROR</strong>: The validation code is incorrect.');
		}

		return $errors;
	}
}
