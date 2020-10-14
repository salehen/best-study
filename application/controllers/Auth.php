<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id');
        if ($id) {
            redirect(base_url('dashboard'), "refresh");
        }
        $this->custom->remember_me_cookie();
    }

    public function login()
    {
		$this->load->helper('form');
        $this->load->library('facebook');
        $data['title'] = 'Login';
        $data['pages'] = $this->load->view('frontend/login', '', true);
        $this->load->view('master', $data);
    }

    public function login_check()
    {
        $this->load->library('form_validation');
		$this->load->helper('form');
        $this->load->library('facebook');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails',
            array(
                'required' => '* Email Required.',
                'valid_emails' => '* Email Must be Valid Formate.'));
        $this->form_validation->set_rules('password', 'Password', 'required',
            array('required' => '* Password Required'));
        $this->form_validation->set_rules('userType', 'User Type', 'required',
            array('required' => '* You Have To Select A User Type'));

        if ($this->form_validation->run() == false) {
            $data['pages'] = $this->load->view('frontend/login', '', true);
            $this->load->view('master', $data);
        } else {
            $password = md5($this->db->escape_str($this->input->post("password")));
            $password = $this->db->escape_like_str($password);

            $email = $this->db->escape_str($this->input->post("email"));
            $email = $this->db->escape_like_str($email);

            $userType = $this->input->post("userType");

            $datas = array(
                "email" => $email,
                "password" => $password,
            );
            if ($userType == 1) {
                $dt = $this->om->view("*", "admins", $datas);
            } elseif ($userType == 2) {
                $dt = $this->om->view("*", "teachers", $datas);
            } elseif ($userType == 3) {
                $dt = $this->om->view("*", "guardians", $datas);
            } elseif ($userType == 4) {
                $dt = $this->om->view("*", "students", $datas);
            }

            if ($dt) {
                foreach ($dt as $d) {
                    $sdata['id'] = $d->id;
                    $sdata['type'] = $d->user_type;
                    $sdata['name'] = $d->name;
                    $sdata['email'] = $d->email;
                    $sdata['picture'] = $d->picture;
                    $sdata['designation'] = $d->designation;
                    $sdata['mobile'] = $d->mobile;
                    $remember_me = $this->input->post('remember_me');
                    if ($remember_me) {
                        $str = rand(1000, 9999);
                        $this->om->UpdateData('admins', ['remember_me' => $str], ['id' => $d->id]);
                        $this->input->set_cookie('tashfik', $str, '604800');
                    }
                    $this->session->set_userdata($sdata);
                    redirect(base_url('dashboard'), "refresh");
                }
            } else {
                $msg['msg'] = "Incorrect email or password";
                $this->session->set_flashdata($msg);
                redirect(base_url('login'));
            }
        }
    }

    public function register()
    {
        $this->load->helper('form');
        $data['title'] = 'Register';
        $data['pages'] = $this->load->view('frontend/register', '', true);
        $this->load->view('master', $data);
    }

    public function register_check()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->form_validation->set_rules('user_name', 'Full Name', 'required|min_length[6]',
            array(
                'required' => 'User Name Required',
                'min_length' => 'User Name Must be 6 character Long.',
            ));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/]');
        $this->form_validation->set_rules('rPassword', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails', array('required' => 'Email Required'));
        $this->form_validation->set_rules('agreement', 'Terms & Condition', 'required');

        if ($this->form_validation->run() == false) {
            $data['pages'] = $this->load->view('frontend/register', '', true);
            $this->load->view('master', $data);
        } else {
            $data['pages'] = $this->load->view('frontend/login', '', true);
            $this->load->view('master', $data);
        }
    }

    public function forgat_password()
    {
        $this->load->helper('form');
        $data['title'] = 'Forget Password';
        $data['pages'] = $this->load->view('frontend/forgat-password', '', true);
        $this->load->view('master', $data);
    }

    public function reset_password()
    {
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->helper('date');
        $this->load->helper('email');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails',
            array(
                'required' => '* Email Required.',
                'valid_emails' => '* Email Must be Valid Formate.'));
        if ($this->form_validation->run() == false) {
            $data['pages'] = $this->load->view('frontend/forgat-password', '', true);
            $this->load->view('master', $data);
        } else {
            $email = $this->input->post("email");
            $result = $this->om->view('*', 'admins', ['email' => $email]);
            if ($result) {
                $newData = [
                    'reset_code' => random_string('alnum', 20),
                    'reset_time' => date('Y-m-d H:i:s'),
                ];
                foreach ($result as $r) {
                    $this->om->UpdateData('admins', $newData, ['id' => $r->id]);
                    $this->session->set_userdata('tempId', $r->id);
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
						<h1 style='text-align: center; font-size: 2.5em; margin-top: 60px; margin-bottom: 50px; color: #000;'>Welcome to NewSounds!</h1>

						<p style='margin-top: 40px;'>You are one step away from joining the most complete event platform online. <br />
						First you need to confirm your account. Just press the button below.</p>

						<h4 style='text-align: center; margin-top: 50px;'><a href='" . base_url() . "new-password/{$newData['reset_code']}" . "' style='color: white; width: 225px;  height: 50px; background-color: #FEA641; display: inline-block; line-height: 50px; border-radius: 3px; text-decoration: none;'>Reset Password</a></h4>

						<p style='padding: 15px 0;'>If that doesn't work, copy and paste the following link in your browser:</p>
						<a href='" . base_url() . "new-password/{$newData['reset_code']}" . "' style='padding: 15px 0; color: #FEA641; line-height: 22px;'>" . base_url() . "new-password/{$newData['reset_code']}" . "</a>
						<p style='padding: 15px 0;'>If you have any question, just reply this email-we're always happy to help out.</p>
						<p style='padding: 15px 0;'>Cheers,<br />NewSounds Team</p>
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
            } else {
                $this->session->set_flashdata('msg', 'This email is not associated with any account.');
                redirect(base_url("forgat-password"), "refresh");
            }
        }
    }

    public function new_password()
    {
        $this->load->helper('form');
        $code = $this->uri->segment(2);
        if (strlen($code) != 20) {
            redirect(base_url('/'), "refresh");
        }
        $result = $this->om->view('*', 'admins', ['reset_code' => $code]);
        if ($result) {
            foreach ($result as $r) {
                $diff_time = (strtotime(date("Y/m/d H:i:s")) - strtotime($r->reset_time)) / 60;
                if ($diff_time <= 120) {
                    $data['tempId'] = $r->id;
                    $data['pages'] = $this->load->view('frontend/new-password', $data, true);
                    $this->load->view('master', $data);
                } else {
                    $this->session->set_flashdata('msg', 'Sorry the password reset link expired! Try again.');
                    redirect(base_url("reset-password"), "refresh");
                }
            }
        }
    }

    public function confirm_password()
    {
        $pw1 = $this->input->post("password");
        $inputData = [
            'password' => md5($pw1),
            'reset_code' => null,
            'reset_time' => null,
        ];
        $this->om->UpdateData('admins', $inputData, ['id' => $this->session->userdata('tempId')]);
        $this->session->set_flashdata('msg', 'Your password was successfully updated! Login Now.');
        redirect(base_url("login"), "refresh");
    }

}
