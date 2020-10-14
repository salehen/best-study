<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *         http://example.com/index.php/Home
	 *    - or -
	 *         http://example.com/index.php/Home/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/Home/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function checkEmail()
	{
		$email = $this->input->post('email', true);
		if ($email) {
			$result = $this->om->view('*', 'admissions', ['email' => $email]);
			if ($result) {
				echo "<p>Email Not Available.</p>";
			} else {
				echo "<p style='color:green'>Email Available.</p>";
			}
		}
	}
	public function gdCheckEmail()
	{
		$email = $this->input->post('email', true);
		$ch = $this->input->post('ch', true);
		if ($ch == 0) {
			if ($email) {
				$result = $this->om->view('*', 'guardians', ['email' => $email]);
				if ($result) {
					echo json_encode("<p>Email Not Available.</p>");
				} else {
					echo json_encode("<p style='color:green'>Email Available.</p>");
				}
			} else {
				return false;
			}
		} elseif ($ch == 1){
			if ($email) {
				$result = $this->om->view('id, name, email, mobile', 'guardians', ['email' => $email]);
				if ($result) {
					echo json_encode($result);
				} else {
					echo json_encode("<p>** E-mail Not Found. Enter Guardian Information Manually.</p>");
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function loadSection()
	{
		$cid = $this->input->post('cID', true);
		if ($cid) {
			$result = $this->om->view('*', 'sections', ['class_id' => $cid]);
			if ($result) {
				$sec = '';
				foreach ($result as $v) {
					$sec .= "<option value=" . $v->id . ">" . $v->name . "</option>";
				}
				echo $sec;
			} else {
				echo "<p>No Section.</p>";
			}
		}
	}
	public function loadCity()
	{
		$cid = $this->input->post('cID', true);
		if ($cid) {
			$result = $this->om->view('*', 'city', ['country_id' => $cid]);
			if ($result) {
				$sec = '';
				foreach ($result as $v) {
					$sec .= "<option value=" . $v->id . ">" . $v->name . "</option>";
				}
				echo $sec;
			} else {
				echo "<p>No City Found.</p>";
			}
		}
	}

	public function loadCityName()
	{
		$cid = $this->input->post('cID', true);
		if ($cid) {
			$result = $this->om->view('name', 'city', ['id' => $cid]);
			if ($result) {
				$sec = '';
				foreach ($result as $v) {
					$sec = $v->name;
				}
				echo $sec;
			}
		}
	}
}
