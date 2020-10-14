<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admission extends CI_Controller
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
		$data['js'] = [
			'assets/js/custom/check-email',
			'assets/js/custom/myjs',
			'assets/js/custom/common'
		];
		$this->load->helper('form');
		$data['sub'] = $this->om->view('*', 'class');
		$data['setupList'] = $this->om->view('admission_settings.*, class.name as cname', 'admission_settings', '', '', '', ['class' => 'class.id=admission_settings.class_id']);
		$data['title'] = 'Admission';
		$data['pages'] = $this->load->view('frontend/admission', $data, TRUE);
		$this->load->view('master', $data);
	}
	public function check()
	{
		$data['js'] = [
			'assets/js/custom/check-email',
			'assets/js/custom/myjs'
		];
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules(
			'name',
			'Full Name',
			'required',
			array(
				'required' => '* Students Name Required'
			)
		);
		$this->form_validation->set_rules(
			'fa_name',
			'Father Name',
			'required',
			array(
				'required' => '* Father Name Required'
			)
		);
		$this->form_validation->set_rules(
			'mo_name',
			'Mother Name',
			'required',
			array(
				'required' => '* Mother Name Required'
			)
		);
		$this->form_validation->set_rules(
			'bi_date',
			'Date of Birth',
			'required',
			array(
				'required' => '* Date of Birth Required'
			)
		);
		$this->form_validation->set_rules(
			'class',
			'class',
			'required',
			array(
				'required' => '* class Required'
			)
		);
		$this->form_validation->set_rules(
			'section',
			'section',
			'required',
			array(
				'required' => '* section Required'
			)
		);
		// $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/]');

		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|valid_emails',
			array(
				'required' => '* Email Required',
				'valid_emails' => '* E-mail Must be Valid Formate.'
			)
		);
		$this->form_validation->set_rules(
			'phone',
			'Phone',
			'required',
			array('required' => '* Phone Number Required')
		);
		$this->form_validation->set_rules(
			'class',
			'Class',
			'',
			array('required' => 'Class Required')
		);
		if (empty($_FILES['picture']['name'])) {
			$this->form_validation->set_rules(
				'picture',
				'Picture',
				'required',
				array('required' => '* Picture Required')
			);
		}

		// $this->form_validation->set_rules('agreement', 'Terms & Condition', 'required');


		if ($this->form_validation->run() == FALSE) {
			$data['sub'] = $this->om->view('*', 'class');
			$data['pages'] = $this->load->view('frontend/admission', $data, TRUE);
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
				'name' => $this->input->post('name', true),
				'father_name' => $this->input->post('fa_name', true),
				'mother_name' => $this->input->post('mo_name', true),
				'birth_date' => $this->input->post('bi_date', true),
				'gender' => $this->input->post('gender', true),
				'email' => $this->input->post('email', true),
				'phone' => $this->input->post('phone', true),
				'class' => $this->input->post('class', true),
				'section_id' => $this->input->post('section', true),
				'nationality' => $this->input->post('nationality', true),
				'address' => $this->input->post('address', true),
				'country' => $this->input->post('country', true),
				'city' => $this->input->post('city', true),
				'post_code' => $this->input->post('post_code', true),
				'picture' => $ext
			];
			if ($this->om->InsertData('admissions', $sdata)) {
				$id = $this->om->Id;
				$this->session->set_userdata('laid', $id);

				$this->custom->UploadImg("assets/images/admission/", "{$id}_org.{$ext}", "picture");

				$temp_img_src = "assets/images/admission/{$id}_org.{$ext}";
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

				$this->custom->CropImg("./{$temp_img_src}", "./assets/images/admission/{$id}_org.{$ext}", $new_width, $new_height, $x, $y);
				// $this->custom->ResizeImg("./assets/images/admission/{$id}_org.{$ext}", "./assets/images/admission/{$id}_org_xl.{$ext}", '1000', '1500');
				// $this->custom->ResizeImg("./assets/images/admission/{$id}_org.{$ext}", "./assets/images/admission/{$id}_org_lg.{$ext}", '800', '1200');
				// $this->custom->ResizeImg("./assets/images/admission/{$id}_org.{$ext}", "./assets/images/admission/{$id}_org_sm.{$ext}", '600', '900');
				// $this->custom->ResizeImg("./assets/images/admission/{$id}_org.{$ext}", "./assets/images/admission/{$id}_org_xs.{$ext}", '400', '600');	

				redirect(base_url('view-form'), "refresh");
			} else {
				$data['msg'] = 'Something Went Wrong Try Again Later.';
				$data['pages'] = $this->load->view('frontend/admission', '', TRUE);
				$this->load->view('master', $data);
			}
		}
	}

	public function viewForm()
	{
		$data['formData'] = $this->om->view('*', 'admissions', ['id' => $this->session->userdata('laid')]);
		$data['title'] = 'Admission-Form';
		$data['pages'] = $this->load->view('frontend/view-form', $data, TRUE);
		$this->load->view('master', $data);
	}

	public function studentVerification()
	{
		$data['js'] = [
			'assets/js/custom/student-verify'
		];
		$code = $this->uri->segment(2);
		if (strlen($code) != 20) {
			redirect(base_url('/'), "refresh");
		}
		$result = $this->om->view('students.*, class.name as cname, sections.name as sname', 'students', ['students.verify_code' => $code], '', '', ['class' => 'class.id=students.class_id', 'sections' => 'sections.id=students.section_id']);
		if ($result) {
			$this->load->helper('form');
			$data['studentInfo'] = $result;
			$data['pages'] = $this->load->view('frontend/student-verify', $data, true);
			$this->load->view('master', $data);
		} else {
			redirect(base_url('/'), "refresh");
		}
	}

	public function studentVerificationConfirm()
	{
		$data['js'] = [
			'assets/js/custom/student-verify'
		];

		$this->load->library('form_validation');

		$sid = $this->input->post('sid', TRUE);
		$result = $this->om->view('students.*, class.name as cname, sections.name as sname', 'students', ['students.id' => $sid], '', '', ['class' => 'class.id=students.class_id', 'sections' => 'sections.id=students.section_id']);

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
		$this->form_validation->set_rules(
			'gname',
			'Name',
			'required',
			array(
				'required' => '* Guardian Name Required'
			)
		);
		$this->form_validation->set_rules(
			'gEmail',
			'E-mail',
			'required|valid_email',
			array(
				'required' => '* Guardian E-mail Required',
				'valid_email' => '*E-mail Must be Valid.'
			)
		);
		$this->form_validation->set_rules(
			'gmobile',
			'Mobil',
			'required|numeric',
			array(
				'required' => '* Guardian Mobile Number Required',
				'numeric' => '*Mobile Number Must be Valid.'
			)
		);
		$this->form_validation->set_rules(
			'relation',
			'Relation',
			'required',
			array(
				'required' => '* Relation with Guardian Required'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$this->load->helper('form');
			$data['studentInfo'] = $result;
			$data['pages'] = $this->load->view('frontend/student-verify', $data, true);
			$this->load->view('master', $data);
		} else {
			$this->load->helper('string');
			$gemail = $this->input->post('gEmail', true);
			$gresult = $this->om->view('id', 'guardians', ['email' => $gemail]);
			if (!$gresult) {
				$vCode = random_string('alnum', 20);
				$gdata = [
					'name' => $this->input->post('gname', true),
					'email' => $this->input->post('gEmail', true),
					'mobile' => $this->input->post('gmobile', true),
					'verify_code' => $vCode
				];
				if ($this->om->InsertData('guardians', $gdata)) {
					$gid = $this->om->Id;
					$message = "<div style='background-color: #F5F5F5; padding: 0; margin: 0; color: #666674; font-family: 		sans-serif; font-size: 14px; line-height: 22px;'>
						<table style='background-color: #099181; width: 100%; height: 100px;'>
						<tr>
						<td>
						<p style='text-align:center; margin: 0'><img src='https://www.newsounds.net/assets/images/footer-logo.png' height='60' alt='NewSounds'></p>

						</td>
						</tr>
						</table>

						<table style='width: 100%; padding: 0; margin: 0'>
						<tr>
						<td style='width: 20%'>&nbsp;</td>
						<td>
						<table style='width: 600px; height: auto; z-index: 15; margin: 0; background: white; border: 2px solid #FFFFFF; border-radius: 0 0 5px 5px; box-shadow: 0 0 2px rgba(0, 0, 0, .4); padding:  0 25px;'>
						<tr>
						<td>
						<h1 style='text-align: center; font-size: 2.5em; margin-top: 60px; margin-bottom: 50px; color: #000;'>Welcome to Best Study!</h1>

						<p style='margin-top: 40px;'>You are one step away from joining the most complete event platform online. <br />
						First you need to confirm your account. Just press the button below.</p>

						<h4 style='text-align: center; margin-top: 50px;'><a href='" . base_url() . "guardian-verification/{$vCode}" . "' style='color: white; width: 225px;  height: 50px; background-color: #FEA641; display: inline-block; line-height: 50px; border-radius: 3px; text-decoration: none;'>Verify Account</a></h4>

						<p style='padding: 15px 0;'>If that doesn't work, copy and paste the following link in your browser:</p>
						<a href='" . base_url() . "guardian-verification/{$vCode}" . "' style='padding: 15px 0; color: #FEA641; line-height: 22px;'>" . base_url() . "guardian-verification/{$vCode}" . "</a>
						<p style='padding: 15px 0;'>If you have any question, just reply this email-we're always happy to help out.</p>
						<p style='padding: 15px 0;'>Cheers,<br />Best Study Team</p>
						</td>
						</tr>
						</table>
						</td>
						<td style='width: 20%'>&nbsp;</td>
						</tr>
						</table>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
					</div>";
					echo $message;
					// $this->custom->sendMail($email, 'Password Recovery', $message);
					$sdata = [
						'password' => md5($this->input->post('password', true)),
						'guardian_id' => $gid,
						'relation' => $this->input->post('relation', true),
						'verify_code' => ''
					];
					$this->om->UpdateData('students', $sdata, ['id' => $sid]);
					$this->session->set_flashdata('msg', 'You are all set. Now you login to account.');
					redirect(base_url("login"), "refresh");
				}
			} else {
				foreach ($gresult as $gid) {
					$sdata = [
						'password' => md5($this->input->post('password', true)),
						'guardian_id' => $gid->id,
						'relation' => $this->input->post('relation', true),
						'verify_code' => ''
					];
				}
				$this->om->UpdateData('students', $sdata, ['id' => $sid]);
				$this->session->set_flashdata('msg', 'You are all set. Now you login to account.');
				redirect(base_url("login"), "refresh");
			}
		}
	}
	public function guardianVerification()
	{
		$data['js'] = [
			'assets/js/custom/student-verify',
			'assets/js/custom/load-city'
		];
		$code = $this->uri->segment(2);
		if (strlen($code) != 20) {
			redirect(base_url('/'), "refresh");
		}
		$result = $this->om->view('*', 'guardians', ['verify_code' => $code]);
		if ($result) {
			$this->load->helper('form');
			$data['guardianInfo'] = $result;
			$data['country'] = $this->om->view('*', 'country');
			$data['pages'] = $this->load->view('frontend/guardian-verify', $data, true);
			$this->load->view('master', $data);
		} else {
			redirect(base_url('/'), "refresh");
		}
	}

	public function guardianVerificationConfirm()
	{
		$data['js'] = [
			'assets/js/custom/student-verify',
			'assets/js/custom/load-city'
		];

		$this->load->library('form_validation');

		$gid = $this->input->post('gid', TRUE);
		$this->form_validation->set_rules(
			'des',
			'Designation',
			'required',
			array(
				'required' => '* Designation Required'
			)
		);
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
		$this->form_validation->set_rules(
			'country',
			'Country',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* Country Required',
				'greater_than_equal_to' => '* Country Required'
			)
		);
		$this->form_validation->set_rules(
			'city',
			'City',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* City Required',
				'greater_than_equal_to' => '* City Required'
			)
		);
		$this->form_validation->set_rules(
			'address',
			'Address',
			'required',
			array(
				'required' => '* Address Required'
			)
		);
		$this->form_validation->set_rules(
			'post_code',
			'Post Code',
			'required|numeric',
			array(
				'required' => '* Post Code Required',
				'numeric' => '* Post Code Must be Valid.'
			)
		);
		if (empty($_FILES['picture']['name'])) {
			$this->form_validation->set_rules('picture', 'Document', 'required', array(
				'required' => '* Picture Required'
			));
		}

		if ($this->form_validation->run() == FALSE) {
			$this->load->helper('form');
			$data['country'] = $this->om->view('*', 'country');
			$data['guardianInfo'] = $this->om->view('*', 'guardians', ['id' => $gid]);
			$data['pages'] = $this->load->view('frontend/guardian-verify', $data, true);
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
				'designation' => $this->input->post('des', true),
				'password' => md5($this->input->post('password', true)),
				'address' => $this->input->post('address', true),
				'city_id' => $this->input->post('city', true),
				'post_code' => $this->input->post('post_code', true),
				'picture' => $gid . '_org.' . $ext,
				'verify_code' => ''

			];
			if ($this->om->UpdateData('guardians', $sdata, ['id' => $gid])) {
				$this->custom->UploadImg("assets/images/guardians/", "{$gid}_org.{$ext}", "picture");

				$temp_img_src = "assets/images/guardians/{$gid}_org.{$ext}";
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

				$this->custom->CropImg("./{$temp_img_src}", "./assets/images/guardians/{$gid}_org.{$ext}", $new_width, $new_height, $x, $y);
				$this->session->set_flashdata('msg', 'You are all set. Now you login to account.');
				redirect(base_url("login"), "refresh");
			}
		}
	}
}
