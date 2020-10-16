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
	public function examMarkSave()
	{
		$examID = $this->input->post('examID', true);
		$status = $this->input->post('status', true);
		$studentID = $this->input->post('studentID', true);
		$marks = $this->input->post('marks', true);
		// echo "<pre>";
		// print_r($_POST);
		// die();
		if ($status != 1) {
			foreach ($studentID as $k => $sid) {
				foreach ($marks as $key => $mark) {
					if ($k == $key) {
						$data = [
							'marks' => $mark,
							'exam_id' => $examID,
							'student_id' => $sid
						];
						$this->om->InsertData('results', $data);
					}
				}
			}
			$this->om->UpdateData('exam', ['status' => 1], ['id' => $examID]);
			$this->session->set_flashdata('msg', 'Result Inserted Successfully.');
			redirect(base_url('dashboard/result'), "refresh");
		} else if ($status == 1) {
			foreach ($studentID as $k => $sid) {
				foreach ($marks as $key => $mark) {
					if ($mark) {
						if ($k == $key) {
							$data = [
								'marks' => $mark,
								'exam_id' => $examID,
								'student_id' => $sid
							];
							$this->om->UpdateData('results', $data, ['exam_id' => $examID, 'student_id' => $sid]);
						}
					}
				}
			}
			$this->session->set_flashdata('msg', 'Result Updated Successfully.');
			redirect(base_url('dashboard/result'), "refresh");
		}
	}
}
