<?php
/**
 * FORMLY PHP - Easyly create and validate forms with php
 * Author - Minhaz <minhazav@gmail.com>
 */

if (!defined(FORMLYFIED)) {
	// ^ to avoid multiple redeclaration error
	define('FORMLYFIED', true);
	define('FORMLY_DIR', __DIR__ .'/conf/');

	class formly {

		private $json;

		/**
		 * FUNCTION - Constructor
		 * @param - (string) formid, the id of the form
		 * @return - void
		 */
		function __construct($formid) {
			// Task one load this form from the direc

			try {
				$d = file_get_contents(FORMLY_DIR .$formid);
			} catch (Exception $ex) {
				die('FORMLY - [ ' .$formid .' ]form config file not found! Script quits!');
			}

			$this->json = json_decode($d);
			if (!$this->json) {
				die('FORMLY - [ ' .$formid .' ]invalid config file! Script quits!');
			}
		}


		/**
		 * Function to create the forms in the html page
		 */
		function plot() {
			// Insert the form
			echo '<form action="' .$this->json->action .'" method="' .$this->json->method .'" name="' .$this->json->name .'" class="formely-form">';

			foreach ($this->json->kvp as $key => $value) {
				if ($value->print_label) {
					echo '<label>' .$value->label .': </label>';
				}
				if ($value->type == 'select' || $value->type == 'textarea') {

				} else {
					self::div();
					echo '<input ' .'type="' .$value->type .'"';
					foreach ($value->attr as $k => $v) {
						echo ' ' .$k .'="' .$v .'"';
					}

					echo ' data-regex="' .$value->regex .'"';

					echo '>';
					self::_div();

				}
			}

			echo '</form>';
		}

		public static function div() {
			echo '<div>';
		}
		public static function _div() {
			echo '</div>';
		}
	};

}