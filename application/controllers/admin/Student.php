<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
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
		$data['js'] = [
			'assets/admin/js/custom/student'
		];
		$data['class'] = $this->om->view('*', 'class');
		$data['title'] = 'All-Students';
		$data['pages'] = $this->load->view('admin/all-student', $data, TRUE);
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
		$data['title'] = 'Admission';
		$data['class'] = $this->om->view('*', 'class');
		$data['pages'] = $this->load->view('admin/admission-confirm', $data, TRUE);
		$this->load->view('admin/dashboard', $data);
	}
	public function applicantConfirm()
	{
		$aid = $this->input->post('apConfirm', true);
		if ($aid) {
			$result = $this->om->UpdateData('admissions', ['status' => 1], ['id' => $aid]);
			if ($result) {
				$this->session->set_flashdata('msg', 'Applicant Confirmation Successful.');
				redirect(base_url("dashboard/admission"), "refresh");
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
