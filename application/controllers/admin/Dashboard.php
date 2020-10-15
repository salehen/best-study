<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$id = $this->session->userdata('id');
		if (!$id) {
			redirect(base_url('login'), "refresh");
		}
		$this->custom->remember_me_cookie();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['pages'] = $this->load->view('admin/home', '', TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function event()
	{
		$data['title'] = 'Event';
		$data['pages'] = $this->load->view('admin/event', '', TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata("id");
		$this->session->unset_userdata("type");
		$this->session->unset_userdata("name");
		$this->session->unset_userdata("email");
		$this->session->unset_userdata("picture");
		$this->session->unset_userdata("designation");
		$this->session->unset_userdata("mobile");
		$this->input->set_cookie('tashfik', '', '-1');
		redirect(base_url(), "refresh");
	}

	public function class()
	{
		$data['js'] = [
			'assets/admin/js/custom/class-section'
		];
		$select = 'class.*, count(sections.class_id) as totalSection';
		$data['title'] = 'Class-List';
		$data['class'] = $this->om->view($select, 'class', '', '', '', ['sections' => 'sections.class_id=class.id'], 'sections.class_id');
		$data['pages'] = $this->load->view('admin/class', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function section()
	{
		$data['js'] = [
			'assets/admin/js/custom/class-section'
		];
		$select = 'sections.*, class.name as cname';
		$data['title'] = 'Section-List';
		$data['section'] = $this->om->view($select, 'sections', '', '', '', ['class' => 'sections.class_id=class.id']);
		$data['pages'] = $this->load->view('admin/section', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function teacher()
	{
		$data['js'] = [
			'assets/admin/js/custom/teacher'
		];
		$select = 'teachers.*, subjects.name as sname';
		$data['title'] = 'Teacher-List';
		$data['teacher'] = $this->om->view($select, 'teachers', '', '', '', ['subjects' => 'subjects.id=teachers.subject_id']);
		$data['pages'] = $this->load->view('admin/teacher', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addTeacher()
	{
		$data['js'] = [
			'assets/js/custom/load-city',
			'assets/admin/js/custom/teacher'
		];
		$this->load->helper('form');
		$data['country'] = $this->om->view('*', 'country');
		$data['subject'] = $this->om->view('*', 'subjects');
		$data['title'] = 'Add-Teacher';
		$data['pages'] = $this->load->view('admin/add-teacher', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}
	public function addTeacherCheck()
	{
		$data['js'] = [
			'assets/js/custom/load-city',
			'assets/admin/js/custom/teacher'
		];
		$this->load->library('form_validation');

		$this->form_validation->set_rules(
			'name',
			'Name',
			'required',
			array(
				'required' => '* Teacher Name Required'
			)
		);
		$this->form_validation->set_rules(
			'email',
			'E-mail',
			'required|valid_email|is_unique[teachers.email]',
			array(
				'required' => '* Teacher E-mail Required',
				'valid_email' => '*E-mail Must be Valid.',
				'is_unique' => '* This E-mail Already Register.'
			)
		);
		$this->form_validation->set_rules(
			'mobile',
			'Mobil',
			'required|numeric',
			array(
				'required' => '* Teachers Mobile Number Required',
				'numeric' => '*Mobile Number Must be Valid.'
			)
		);
		$this->form_validation->set_rules(
			'subject',
			'subject',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* subject Required',
				'greater_than_equal_to' => '* Subject Must Be Assign.'
			)
		);
		$this->form_validation->set_rules(
			'city',
			'city',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* city Required',
				'greater_than_equal_to' => '* city Must Be Selected.'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$this->load->helper('form');
			$data['country'] = $this->om->view('*', 'country');
			$data['subject'] = $this->om->view('*', 'subjects');
			$data['title'] = 'Add-Teacher';
			$data['pages'] = $this->load->view('admin/add-teacher', $data, TRUE);
			$this->load->view('admin/dashboard', $data);
		} else {
			$this->load->helper('string');
			$vCode = random_string('alnum', 20);
			$email = $this->input->post('email', true);
			$tdata = [
				'name' => $this->input->post('name', true),
				'gender' => $this->input->post('gender', true),
				'address' => $this->input->post('address', true),
				'city_id' => $this->input->post('city', true),
				'post_code' => $this->input->post('post_code', true),
				'email' => $this->input->post('email', true),
				'mobile' => $this->input->post('mobile', true),
				'subject_id' => $this->input->post('subject', true),
				'designation' => $this->input->post('designation', true),
				'employee_id' => $this->input->post('employee_id', true),
				'joining_date' => $this->input->post('joining_date', true),
				'verify_code' => $vCode
			];
			if ($this->om->InsertData('teachers', $tdata)) {
				$tid = $this->om->Id;
				$message = "<!DOCTYPE><html><head></head><body><div style='background-color: #F5F5F5; padding: 0; margin: 0; color: #666674; font-family: 		sans-serif; font-size: 14px; line-height: 22px;'>
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

						<h4 style='text-align: center; margin-top: 50px;'><a href='" . base_url() . "teacher-verification/{$vCode}" . "' style='color: white; width: 225px;  height: 50px; background-color: #FEA641; display: inline-block; line-height: 50px; border-radius: 3px; text-decoration: none;'>Verify Account</a></h4>

						<p style='padding: 15px 0;'>If that doesn't work, copy and paste the following link in your browser:</p>
						<a href='" . base_url() . "teacher-verification/{$vCode}" . "' style='padding: 15px 0; color: #FEA641; line-height: 22px;'>" . base_url() . "teacher-verification/{$vCode}" . "</a>
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
					</div></body></html>";
				echo $message;
				//  $this->custom->sendMail($email, 'Account Verification', $message);

				$this->session->set_flashdata('msg', 'Teacher Profile Created Successfully.');
				// redirect(base_url("dashboard/teacher"), "refresh");
			} else {
				$this->session->set_flashdata('msg', 'Something Went Wrong.........Try Again.');
				$this->load->helper('form');
				$data['country'] = $this->om->view('*', 'country');
				$data['subject'] = $this->om->view('*', 'subjects');
				$data['title'] = 'Add-Teacher';
				$data['pages'] = $this->load->view('admin/add-teacher', $data, TRUE);
				$this->load->view('admin/dashboard', $data);
			}
		}
	}

	public function subject()
	{
		$data['js'] = [
			'assets/admin/js/custom/subject'
		];
		$data['subject'] = $this->om->view('*', 'subjects');
		$data['title'] = 'Subject-List';
		$data['pages'] = $this->load->view('admin/subject', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addSubject()
	{
		$data['js'] = [
			'assets/admin/js/custom/subject',
			'assets/admin/js/dropzone/dropzone'
		];
		$this->load->helper('form');
		$data['title'] = 'Add-Subject';
		$data['pages'] = $this->load->view('admin/add-subject', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}


	public function routine()
	{
		$data['js'] = [
			'assets/js/custom/myjs',
			'assets/admin/js/custom/routine',
		];
		$data['routine'] = $this->om->view('*', 'routine');
		$data['class'] = $this->om->view('*', 'class');
		$data['title'] = 'Class Routine';
		$data['pages'] = $this->load->view('admin/routine', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addRoutine()
	{
		$data['js'] = [
			'assets/js/custom/myjs'
		];
		$this->load->helper('form');
		$data['title'] = 'Add-Routine';
		$data['class'] = $this->om->view('*', 'class');
		$data['subject'] = $this->om->view('*', 'subjects');
		$data['teacher'] = $this->om->view('teachers.id, teachers.name, subjects.name as sname', 'teachers', '', '', '', ['subjects' => 'subjects.id=teachers.subject_id']);
		$data['pages'] = $this->load->view('admin/add-routine', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addRoutineCheck()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules(
			'section',
			'Section',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* Section Name Required',
				'greater_than_equal_to' => '* Section Must Be Selected.'
			)
		);
		$this->form_validation->set_rules(
			'start_time',
			'start_time',
			'required',
			array(
				'required' => '* Start Time Required'
			)
		);
		$this->form_validation->set_rules(
			'end_time',
			'end_time',
			'required',
			array(
				'required' => '* End Time Required'
			)
		);
		$this->form_validation->set_rules(
			'teacher',
			'Teacher',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* Teacher Required',
				'greater_than_equal_to' => '* Teacher Must Be Assign.'
			)
		);
		$this->form_validation->set_rules(
			'subject',
			'subject',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* subject Required',
				'greater_than_equal_to' => '* Subject Must Be Assign.'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['js'] = [
				'assets/js/custom/myjs'
			];
			$this->load->helper('form');
			$data['title'] = 'Add-Routine';
			$data['class'] = $this->om->view('*', 'class');
			$data['subject'] = $this->om->view('*', 'subjects');
			$data['teacher'] = $this->om->view('teachers.id, teachers.name, subjects.name as sname', 'teachers', '', '', '', ['subjects' => 'subjects.id=teachers.subject_id']);
			$data['pages'] = $this->load->view('admin/add-routine', $data, TRUE);
			$this->load->view('admin/dashboard', $data);
		} else {
			$rdata = [
				'teacher_id' => $this->input->post('teacher', true),
				'section_id' => $this->input->post('section', true),
				'start_time' => $this->input->post('start_time', true),
				'end_time' => $this->input->post('end_time', true),
				'subject_id' => $this->input->post('subject', true)
			];
			if ($this->om->InsertData('routine', $rdata)) {
				$this->session->set_flashdata('msg', 'Routine Added Successfully.');
				redirect(base_url("dashboard/routine"), "refresh");
			} else {
				$this->session->set_flashdata('msg', 'Something Went Wrong.........Try Again.');
				$data['js'] = [
					'assets/js/custom/myjs'
				];
				$this->load->helper('form');
				$data['title'] = 'Add-Routine';
				$data['class'] = $this->om->view('*', 'class');
				$data['subject'] = $this->om->view('*', 'subjects');
				$data['teacher'] = $this->om->view('teachers.id, teachers.name, subjects.name as sname', 'teachers', '', '', '', ['subjects' => 'subjects.id=teachers.subject_id']);
				$data['pages'] = $this->load->view('admin/add-routine', $data, TRUE);
				$this->load->view('admin/dashboard', $data);
			}
		}
	}

	public function exam()
	{
		$data['js'] = [
			'assets/js/custom/myjs',
			'assets/admin/js/custom/exam'
		];
		$data['class'] = $this->om->view('*', 'class');
		$data['title'] = 'Exam';
		$data['pages'] = $this->load->view('admin/exam', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addExam()
	{
		$data['js'] = [
			'assets/js/custom/myjs',
			'assets/admin/js/custom/exam'
		];
		$this->load->helper('form');
		$data['class'] = $this->om->view('*', 'class');
		$data['exam_type'] = $this->om->view('*', 'exam_type');
		$data['title'] = 'Add Exam';
		$data['pages'] = $this->load->view('admin/add-exam', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addExamCheck()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules(
			'section',
			'Section',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* Section Name Required',
				'greater_than_equal_to' => '* Section Must Be Selected.'
			)
		);
		$this->form_validation->set_rules(
			'start_time',
			'start_time',
			'required',
			array(
				'required' => '* Start Time Required'
			)
		);
		$this->form_validation->set_rules(
			'exam_date',
			'exam_date',
			'required',
			array(
				'required' => '* Exam Date Required'
			)
		);
		$this->form_validation->set_rules(
			'duration',
			'duration',
			'required',
			array(
				'required' => '* Exam Duration Required'
			)
		);
		$this->form_validation->set_rules(
			'exam_type',
			'exam_type',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* Exam Type Required',
				'greater_than_equal_to' => '* Exam Type Required.'
			)
		);
		$this->form_validation->set_rules(
			'subject',
			'subject',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* subject Required',
				'greater_than_equal_to' => '* Subject Must Be Assign.'
			)
		);
		$this->form_validation->set_rules(
			'teacher',
			'teacher',
			'required|greater_than_equal_to[1]',
			array(
				'required' => '* Teacher Required',
				'greater_than_equal_to' => '* Teacher Must Be Assign.'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['js'] = [
				'assets/js/custom/myjs'
			];
			$this->load->helper('form');
			$data['class'] = $this->om->view('*', 'class');
			$data['subject'] = $this->om->view('*', 'subjects');
			$data['exam_type'] = $this->om->view('*', 'exam_type');
			$data['title'] = 'Add Exam';
			$data['pages'] = $this->load->view('admin/add-exam', $data, TRUE);
			$this->load->view('admin/dashboard', $data);
		} else {
			$edata = [
				'teacher_id' => $this->input->post('teacher', true),
				'subject_id' => $this->input->post('subject', true),
				'exam_type_id' => $this->input->post('exam_type', true),
				'section_id' => $this->input->post('section', true),
				'date' => $this->input->post('exam_date', true),
				'time' => $this->input->post('start_time', true),
				'duration' => $this->input->post('duration', true)
			];
			if ($this->om->InsertData('exam', $edata)) {
				$this->session->set_flashdata('msg', 'Exam Schedule Added Successfully.');
				redirect(base_url("dashboard/exam"), "refresh");
			} else {
				$this->session->set_flashdata('msg', 'Something Went Wrong.........Try Again.');
				$data['js'] = [
					'assets/js/custom/myjs'
				];
				$this->load->helper('form');
				$data['class'] = $this->om->view('*', 'class');
				$data['subject'] = $this->om->view('*', 'subjects');
				$data['exam_type'] = $this->om->view('*', 'exam_type');
				$data['title'] = 'Add Exam';
				$data['pages'] = $this->load->view('admin/add-exam', $data, TRUE);
				$this->load->view('admin/dashboard', $data);
			}
		}
	}




	// public function admission()
	// {
	// 	$data['js'] = [			
	// 		'assets/js/custom/myjs',
	// 		'assets/admin/js/custom/myScript'
	// 		];
	// 	$data['title'] = 'Admission';
	// 	$data['class'] = $this->om->view('*', 'class');
	// 	$data['pages'] = $this->load->view('admin/admission', $data, TRUE);
	// 	$this->load->view('admin/dashboard', $data);
	// }
	// public function admissionConfirm()
	// {
	// 	$data['js'] = [			
	// 		'assets/js/custom/myjs',
	// 		'assets/admin/js/custom/adConfirm'
	// 		];
	// 	$data['title'] = 'Admission';
	// 	$data['class'] = $this->om->view('*', 'class');
	// 	$data['pages'] = $this->load->view('admin/admission-confirm', $data, TRUE);
	// 	$this->load->view('admin/dashboard', $data);
	// }
	// public function applicantConfirm()
	// {
	// 	$aid = $this->input->post('apConfirm', true);
	//     if ($aid) {
	// 		$result = $this->om->UpdateData('admissions', ['status' => 1], ['id' => $aid]);
	//         if ($result) {
	// 			$this->session->set_flashdata('msg', 'Applicant Confirmation Successful.');
	// 			redirect(base_url("dashboard/admission"), "refresh");
	//         } else {
	//             return false; 
	//         }
	// 	} else{
	// 		return false;
	// 	}
	// }



}
