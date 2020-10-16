<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

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

	public function teacherCheckMail()
	{
		$email = $this->input->post('email', true);
		if ($email) {
			$result = $this->om->view('*', 'teachers', ['email' => $email]);
			if ($result) {
				echo "<p>Email Not Available.</p>";
			} else {
				echo "<p style='color:green'>Email Available.</p>";
			}
		}
	}

	public function loadAdmission()
	{
		$sid = $this->input->post('sid', true);
		$sec = [];
		if ($sid) {
			$result = $this->om->view('*', 'admissions', ['section_id' => $sid, 'status' => 0]);
			if ($result) {
				foreach ($result as $k => $v) {
					$sec[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($sec);
	}

	public function adConfirmList()
	{
		$sid = $this->input->post('sid', true);
		$sec = [];
		if ($sid) {
			// $result = $this->om->view('*', 'admissions', ['section_id' => $sid, 'status' => 1]);
			$result = $this->om->view('admissions.*, admission_settings.pass_marks as pmark, class.name as cname, sections.name as sname', 'admissions', ['admissions.section_id' => $sid, 'admissions.status' => 1], '', '', ['admission_settings' => 'admission_settings.class_id=admissions.class', "sections" => "sections.id=admissions.section_id", "class" => "class.id=sections.class_id"]);
			if ($result) {
				foreach ($result as $k => $v) {
					$sec[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($sec);
	}

	public function applicantInfo()
	{
		$aid = $this->input->post('aid', true);
		$sec = [];
		if ($aid) {
			$result = $this->om->view('admissions.*, class.name as cname, sections.name as sname', 'admissions', ['admissions.id' => $aid, 'status' => 0], '', '', array("sections" => "sections.id=admissions.section_id", "class" => "class.id=sections.class_id"));
			if ($result) {
				foreach ($result as $k => $v) {
					$sec[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($sec);
	}

	public function appConfirmInfo()
	{
		$aid = $this->input->post('aid', true);
		$sec = [];
		if ($aid) {
			$result = $this->om->view('admissions.*, class.name as cname, sections.name as sname', 'admissions', ['admissions.id' => $aid, 'admissions.status' => 1], '', '', array("sections" => "sections.id=admissions.section_id", "class" => "class.id=sections.class_id"));
			if ($result) {
				foreach ($result as $k => $v) {
					$sec[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($sec);
	}

	public function applicantConfirm()
	{
		$aid = $this->input->post('aid', true);
		if ($aid) {
			$result = $this->om->UpdateData('admissions', ['status' => 1], ['id' => $aid]);
			if ($result) {
				//e-mail sending code will be hear at any time.
				echo 'Applicant Confirmation Successful.';
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function applicantDelete()
	{
		$aid = $this->input->post('aid', true);
		if ($aid) {
			$result = $this->om->DeleteData('admissions', ['id' => $aid]);
			if ($result) {
				echo 'Application Delete Successfully.';
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function admittedConfirm()
	{
		$this->load->helper('string');
		$aid = $this->input->post('aid', true);
		if ($aid) {
			$result = $this->om->UpdateData('admissions', ['status' => 2], ['id' => $aid]);
			if ($result) {
				$sData = $this->om->view('*', 'admissions', ['id' => $aid]);
				$newData = [
					'verify_code' => random_string('alnum', 20)
				];
				foreach ($sData as $r) {
					$this->om->UpdateData('students', $newData, ['email' => $r->email]);
				}
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

						<h4 style='text-align: center; margin-top: 50px;'><a href='" . base_url() . "student-verification/{$newData['verify_code']}" . "' style='color: white; width: 225px;  height: 50px; background-color: #FEA641; display: inline-block; line-height: 50px; border-radius: 3px; text-decoration: none;'>Verify Account</a></h4>

						<p style='padding: 15px 0;'>If that doesn't work, copy and paste the following link in your browser:</p>
						<a href='" . base_url() . "student-verification/{$newData['verify_code']}" . "' style='padding: 15px 0; color: #FEA641; line-height: 22px;'>" . base_url() . "student-verification/{$newData['verify_code']}" . "</a>
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
				echo 'Admitted Confirmation Successful.';
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function studentList()
	{
		$sid = $this->input->post('sid', true);
		$stu = [];
		if ($sid) {
			$select = 'students.id, students.name, students.gender, students.address, sections.name as sname, class.name as cname';
			$join = [
				'sections' => 'sections.id=students.section_id',
				'class' => 'class.id=sections.class_id'
			];
			$result = $this->om->view($select, 'students', ['section_id' => $sid], '', '', $join);
			// $result = $this->om->view('admissions.*, admission_settings.pass_marks as pmark, class.name as cname, sections.name as sname', 'admissions', ['admissions.section_id' => $sid, 'admissions.status' => 1], '', '', ['admission_settings' => 'admission_settings.class_id=admissions.class', "sections" => "sections.id=admissions.section_id", "class" => "class.id=sections.class_id"]);
			if ($result) {
				foreach ($result as $k => $v) {
					$stu[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				return false;
			}
		} else {
			return false;
		}
		echo json_encode($stu);
	}

	public function studentInfo()
	{
		$sid = $this->input->post('sid', true);
		$stu = [];
		if ($sid) {
			$select = 'students.*, sections.name as sname, class.name as cname';
			$join = [
				'sections' => 'sections.id=students.section_id',
				'class' => 'class.id=sections.class_id'
			];
			$result = $this->om->view($select, 'students', ['students.id' => $sid], '', '', $join);
			if ($result) {
				foreach ($result as $k => $v) {
					$stu[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				return false;
			}
		} else {
			return false;
		}
		echo json_encode($stu);
	}

	public function classInfo()
	{
		$cid = $this->input->post('cid', true);
		$stu = [];
		if ($cid) {
			$select = 'class.*, sections.name as sname, (SELECT count(students.id) FROM students WHERE students.section_id=sections.id and sections.class_id=' . $cid . ') AS totalStudents, (SELECT count(sections.id) FROM sections WHERE sections.class_id=' . $cid . ') AS totalSec';
			$join = [
				'sections' => 'sections.class_id=class.id',
				'students' => 'students.section_id=sections.id'
			];
			$result = $this->om->view($select, 'class', ['class.id' => $cid], '', '', $join, 'students.section_id');
			if ($result) {
				foreach ($result as $k => $v) {
					$stu[$k] = $v;
				}
				//    $data['adm'] = $sec;			   
			} else {
				$select = 'class.*, sections.name as sname, (SELECT count(sections.id) FROM sections WHERE sections.class_id=' . $cid . ') AS totalSec';
				$join = [
					'sections' => 'sections.class_id=class.id'
				];
				$result = $this->om->view($select, 'class', ['class.id' => $cid], '', '', $join);
				if ($result) {
					foreach ($result as $k => $v) {
						$stu[$k] = $v;
					}
					// $stu[] = $v;
					//    $data['adm'] = $sec;			   
				}
			}
		} else {
			return false;
		}
		echo json_encode($stu);
	}

	public function loadRoutine()
	{
		$sid = $this->input->post('sid', true);
		$data = [];
		if ($sid) {
			$select = 'routine.*, teachers.name as tname, sections.name as sec_name, subjects.name as sub_name, class.name as cname';
			$join = [
				'teachers' => 'teachers.id = routine.teacher_id',
				'sections' => 'sections.id = routine.section_id',
				'subjects' => 'subjects.id = routine.subject_id',
				'class' => 'class.id = sections.class_id'
			];
			$result = $this->om->view($select, 'routine', ['routine.section_id' => $sid], '', '', $join);
			if ($result) {
				foreach ($result as $k => $v) {
					$data[$k] = $v;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($data);
	}

	public function loadExam()
	{
		$sid = $this->input->post('sid', true);
		$data = [];
		if ($sid) {
			$select = 'exam.*, exam_type.name as etname, sections.name as sec_name, subjects.name as sub_name, class.name as cname, teachers.name as tname';
			$join = [
				'exam_type' => 'exam_type.id = exam.exam_type_id',
				'sections' => 'sections.id = exam.section_id',
				'subjects' => 'subjects.id = exam.subject_id',
				'class' => 'class.id = sections.class_id',
				'teachers' => 'teachers.id = exam.teacher_id'
			];
			$result = $this->om->view($select, 'exam', ['exam.section_id' => $sid], '', '', $join);
			if ($result) {
				foreach ($result as $k => $v) {
					$data[$k] = $v;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($data);
	}

	public function loadExamResult()
	{
		$sid = $this->input->post('sid', true);
		$data = [];
		if ($sid) {
			$select = 'exam.*, exam_type.name as etname, sections.name as sec_name, subjects.name as sub_name, class.name as cname';
			$join = [
				'exam_type' => 'exam_type.id = exam.exam_type_id',
				'sections' => 'sections.id = exam.section_id',
				'subjects' => 'subjects.id = exam.subject_id',
				'class' => 'class.id = sections.class_id'
			];
			$result = $this->om->view($select, 'exam', ['exam.section_id' => $sid], '', '', $join);
			if ($result) {
				foreach ($result as $k => $v) {
					$data[$k] = $v;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($data);
	}

	public function exam()
	{
		$sid = $this->input->post('sID', true);
		$data = [];
		if ($sid) {
			$select = 'exam.*, exam_type.name as etname, sections.name as sec_name, subjects.name as sub_name, class.name as cname';
			$join = [
				'exam_type' => 'exam_type.id = exam.exam_type_id',
				'sections' => 'sections.id = exam.section_id',
				'subjects' => 'subjects.id = exam.subject_id',
				'class' => 'class.id = sections.class_id'
			];
			$result = $this->om->view($select, 'exam', ['exam.section_id' => $sid], '', '', $join);
			if ($result) {
				foreach ($result as $k => $v) {
					$data[$k] = $v;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}

		echo json_encode($data);
	}

	public function examSubject()
	{
		$sid = $this->input->post('sID', true);
		if ($sid) {
			$result = $this->om->view('routine.subject_id as sid, subjects.name as sname', 'routine', ['routine.section_id' => $sid], '', '', ['subjects' => 'subjects.id = routine.subject_id']);
			if ($result) {
				$sec = '';
				foreach ($result as $v) {
					$sec .= "<option value=" . $v->sid . ">" . $v->sname . "</option>";
				}
				echo $sec;
			} else {
				echo "<p>No Section.</p>";
			}
		}
	}

	public function examTeacher()
	{
		$sid = $this->input->post('sID', true);
		if ($sid) {
			$result = $this->om->view('routine.teacher_id as tid, teachers.name as tname', 'routine', ['routine.subject_id' => $sid], '', '', ['teachers' => 'teachers.id = routine.teacher_id'], 'routine.teacher_id');
			if ($result) {
				$sec = '';
				foreach ($result as $v) {
					$sec .= "<option value=" . $v->tid . ">" . $v->tname . "</option>";
				}
				echo $sec;
			} else {
				echo "<p>No Section.</p>";
			}
		}
	}

	public function examMarkInput()
	{
		$examID = $this->input->post('examID', true);
		if ($examID) {
			$select = 'exam.*, exam_type.name as etname, sections.name as sec_name, subjects.name as sub_name, class.name as cname, students.id as sid, students.name as sname, students.gender, students.mobile';
			$join = [
				'exam_type' => 'exam_type.id = exam.exam_type_id',
				'sections' => 'sections.id = exam.section_id',
				'subjects' => 'subjects.id = exam.subject_id',
				'class' => 'class.id = sections.class_id',
				'students' => 'students.section_id = exam.section_id'
			];
			$result = $this->om->view($select, 'exam', ['exam.id' => $examID], '', '', $join);
			if ($result) {
				foreach ($result as $k => $v) {
					$data[$k] = $v;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
		echo json_encode($data);
	}
}
