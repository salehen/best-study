<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Result extends CI_Controller
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
		$select = 'teachers.*, subjects.name as sname';
		$data['title'] = 'Results';
		$data['teacher'] = $this->om->view($select, 'teachers', '', '', '', ['subjects' => 'subjects.id=teachers.subject_id']);
		$data['pages'] = $this->load->view('admin/result', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function addResult()
	{
		$data['js'] = [
			'assets/js/custom/myjs',
			'assets/admin/js/custom/result'
		];
		$this->load->helper('form');
		$tID = $this->session->userdata('id');
		$select = 'exam.*, exam_type.name as etname, sections.name as sec_name, subjects.name as sub_name, class.name as cname, teachers.name as tname';
		$join = [
			'exam_type' => 'exam_type.id = exam.exam_type_id',
			'sections' => 'sections.id = exam.section_id',
			'subjects' => 'subjects.id = exam.subject_id',
			'class' => 'class.id = sections.class_id',
			'teachers' => 'teachers.id = exam.teacher_id'
		];
		$result = $this->om->view($select, 'exam', ['exam.teacher_id' => $tID], ['exam.date', 'ASC'], '', $join);
		$data['exam'] = $result;
		$data['class'] = $this->om->view('*', 'class');
		$data['country'] = $this->om->view('*', 'country');
		$data['subject'] = $this->om->view('*', 'subjects');
		$data['title'] = 'Add-Result';
		$data['pages'] = $this->load->view('admin/add-result', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}
	public function admission()
	{
		$data['js'] = [
			'assets/js/custom/myjs',
			'assets/admin/js/custom/myScript'
		];
		$data['title'] = 'Admission';
		$data['class'] = $this->om->view('*', 'class');
		$data['pages'] = $this->load->view('admin/admission', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function admissionConfirm()
	{
		$data['js'] = [
			'assets/js/custom/myjs',
			'assets/admin/js/custom/adConfirm'
		];
		$data['title'] = 'Admission-Confirm';
		$data['class'] = $this->om->view('*', 'class');
		$data['pages'] = $this->load->view('admin/admission-confirm', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function admissionResult()
	{
		$data['js'] = [
			'assets/admin/js/custom/adResult'
		];
		$this->load->helper('form');
		$data['title'] = 'Admission-Result';
		$data['class'] = $this->om->view('*', 'class');
		$data['pages'] = $this->load->view('admin/admission-result', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function admissionResultSave()
	{
		$id = $this->input->post('id', true);
		$marks = $this->input->post('marks', true);
		foreach ($id as $k => $v) {
			foreach ($marks as $key => $mark) {
				if ($k == $key) {
					$this->om->UpdateData('admissions', ['marks' => $mark], ['id' => $v]);
				}
			}
		}
		$this->session->set_flashdata('msg', 'Admission Test Marks Update Successfully.');
		redirect(base_url('dashboard/admission-result'), "refresh");
	}

	public function admissionSetup()
	{
		$this->load->helper('form');
		$data['class'] = $this->om->view('*', 'class');
		$data['setupList'] = $this->om->view('admission_settings.*, class.name as cname', 'admission_settings', '', '', '', ['class' => 'class.id=admission_settings.class_id']);
		$data['title'] = 'Admission-Setup';
		$data['pages'] = $this->load->view('admin/admission-setup', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}

	public function admissionSetupSave()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules('class[]', 'class', 'required', array('required' => 'class Required'));
		$this->form_validation->set_rules('start_date', 'Start Date', 'required', array('required' => 'Start Date Required'));
		$this->form_validation->set_rules('end_date', 'End Date', 'required', array('required' => 'End Date Required'));
		$this->form_validation->set_rules('exam_date', 'Exam Date', 'required', array('required' => 'Exam Date Required'));
		$this->form_validation->set_rules('exam_type[]', 'Exam Type', 'required', array('required' => 'Exam Type Required'));

		if ($this->form_validation->run() == false) {
			$data['class'] = $this->om->view('*', 'class');
			$data['setupList'] = $this->om->view('admission_settings.*, class.name as cname', 'admission_settings', '', '', '', ['class' => 'class.id=admission_settings.class_id']);
			$data['pages'] = $this->load->view('admin/admission-setup', $data, TRUE);
			$this->load->view('admin/dashboard', $data);
		} else {
			$class = $this->input->post('class', true);

			if ($this->input->post('exam_type', true)) {
				$examType = implode(", ", $this->input->post('exam_type', true));
			} else {
				$examType = '';
			}
			foreach ($class as $cl) {
				$classChack = $this->om->view('*', 'admission_settings', ['class_id' => $cl]);
				if ($classChack) {
					$sdata = [
						'class_id' => $cl,
						'start_date' => $this->input->post('start_date', true),
						'end_date' => $this->input->post('end_date', true),
						'exam_type' => $examType,
						'exam_date' => $this->input->post('exam_date', true),
						'total_marks' => $this->input->post('total_marks', true),
						'pass_marks' => $this->input->post('pass_marks', true),
					];
					$this->om->UpdateData('admission_settings', $sdata, ['class_id' => $cl]);
				} else {
					$sdata = [
						'class_id' => $cl,
						'start_date' => $this->input->post('start_date', true),
						'end_date' => $this->input->post('end_date', true),
						'exam_type' => $examType,
						'exam_date' => $this->input->post('exam_date', true),
						'total_marks' => $this->input->post('total_marks', true),
						'pass_marks' => $this->input->post('pass_marks', true),
					];
					$this->om->InsertData('admission_settings', $sdata);
				}
			}
			$this->session->set_flashdata('msg', 'Admission Setting Save Successfully.');
			redirect(base_url('dashboard/admission-setup'), "refresh");
		}
	}
}
