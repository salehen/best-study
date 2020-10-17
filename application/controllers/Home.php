<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/Home
	 *	- or -
	 * 		http://example.com/index.php/Home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/Home/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = 'Best Study';
		$data['pages'] = $this->load->view('frontend/home', '', TRUE);
		$this->load->view('master', $data);
	}

	public function course()
	{
		$data['title'] = 'Course';
		$data['pages'] = $this->load->view('frontend/course', '', TRUE);
		$this->load->view('master', $data);
	}

	public function gallery()
	{
		$data['title'] = 'Gallery';
		$data['pages'] = $this->load->view('frontend/Gallery', '', TRUE);
		$this->load->view('master', $data);
	}
	public function contact()
	{
		$data['title'] = 'Contact';
		$data['pages'] = $this->load->view('frontend/contact', '', TRUE);
		$this->load->view('master', $data);
	}

	public function about()
	{
		$data['title'] = 'About';
		$data['pages'] = $this->load->view('frontend/about', '', TRUE);
		$this->load->view('master', $data);
	}

	public function teacherVerification()
	{
		$code = $this->uri->segment(2);
		if (strlen($code) != 20) {
			redirect(base_url('/'), "refresh");
		}
		$result = $this->om->view('*', 'teachers', ['verify_code' => $code]);
		if ($result) {
			$this->load->helper('form');
			$data['teacherInfo'] = $result;
			$data['pages'] = $this->load->view('frontend/teacher-verify', $data, true);
			$this->load->view('master', $data);
		} else {
			redirect(base_url('/'), "refresh");
		}
	}

	public function teacherVerificationConfirm()
	{
		$this->load->library('form_validation');

		$tid = $this->input->post('tid', TRUE);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|min_length[6]',
			array(
				'required' => '* password Required',
				'min_length' => '* Password Must Be 6 Charter or more.'
			)
		);
		$this->form_validation->set_rules(
			'rPassword',
			'Confirm Password',
			'required|matches[password]',
			array(
				'required' => '*Confirm Password Required',
				'matches' => '*Confirm Password Not Match'
			)
		);
		if (empty($_FILES['picture']['name'])) {
			$this->form_validation->set_rules('picture', 'Document', 'required', array(
				'required' => '* Picture Required'
			));
		}

		if ($this->form_validation->run() == FALSE) {
			$this->load->helper('form');
			$data['teacherInfo'] = $this->om->view('*', 'teachers', ['id' => $tid]);
			$data['pages'] = $this->load->view('frontend/teacher-verify', $data, true);
			$this->load->view('master', $data);
		} else {
			$ext = "";
			if ($_FILES['picture']['name']) {
				$extention = pathinfo($_FILES['picture']['name']);
				$ext = strtolower($extention['extension']);
				if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
					$ext = "";
				}
			}
			$sdata = [
				'password' => md5($this->input->post('password', true)),
				'picture' => $tid . '_org.' . $ext,
				'verify_code' => ''

			];
			if ($this->om->UpdateData('teachers', $sdata, ['id' => $tid])) {
				$this->custom->UploadImg("assets/images/teachers/", "{$tid}_org.{$ext}", "picture");

				$temp_img_src = "assets/images/teachers/{$tid}_org.{$ext}";
				list($org_width, $org_height) = getimagesize($temp_img_src);
				// echo $org_width . "<br>" . $org_height . '';

				$new_width = $org_width;
				$new_height = $org_height;
				if ($org_width > $org_height) {
					$new_width = round($org_height * (2 / 3));
				} elseif ($org_height > $org_width) {
					$new_height = round($org_width * (3 / 2));
				} else {
					$new_width = round($org_height * (2 / 3));
				}

				$x = round(($org_width - $new_width) / 2);
				$y = round(($org_height - $new_height) / 2);

				$this->custom->CropImg("./{$temp_img_src}", "./assets/images/teachers/{$tid}_org.{$ext}", $new_width, $new_height, $x, $y);
				$this->session->set_flashdata('msg', 'You are all set. Now you login to you account.');
				redirect(base_url("login"), "refresh");
			}
		}
	}
}
