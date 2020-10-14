<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom
{

    private $CI;

    public function __construct()
    {
        // Assign by reference with "&" so we don't create a copy
        $this->CI = &get_instance();
    }

    public function CropImg($source, $dest, $width, $height, $x, $y)
    {
        $this->CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['library_path'] = '/usr/bin';
        $config['source_image'] = $source;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['x_axis'] = $x;
        $config['y_axis'] = $y;
        $config['new_image'] = $dest;
        $config['width'] = $width;
        $config['height'] = $height;
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->crop();
        $this->CI->image_lib->clear();
    }

    public function ResizeImg($source, $dest, $width, $height)
    {
        $this->CI->load->library('image_lib');
        $config['source_image'] = $source;
        $config['new_image'] = $dest;
        $config['maintain_ratio'] = false;
        $config['width'] = $width;
        $config['height'] = $height;
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->resize();
        $this->CI->image_lib->clear();
    }

    public function UploadImg($dest, $name, $field)
    {
        $this->CI->load->library('upload');
        $config['upload_path'] = "./{$dest}";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['max_width'] = '6000';
        $config['max_height'] = '6000';
        $config['file_name'] = $name;
        $this->CI->upload->initialize($config); //upload image data
        $this->CI->upload->do_upload($field);
    }

    public function sendMail($email, $subject, $message)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_timeout' => 60,
            'smtp_user' => 'sruku00@gmail.com', // change it to you
            'smtp_pass' => 'ruku1234', // change it to you

            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => '\r\n',
            'validation' => true,
            'wordwrap' => true,
        );

        $this->CI->load->library('email', $config);
        $this->CI->email->set_mailtype("html");
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from("sruku00@gmail.com"); // change it to you
        $this->CI->email->to($email); // change it to you
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        if ($this->CI->email->send()) {
            return true;
        }
        return false;
    }

    public function remember_me_cookie()
    {
        $id = $this->CI->session->userdata('id');
        if (!$id) {
            $tashfik = $this->CI->input->cookie('tashfik', true);
            if ($tashfik && strlen($tashfik) == 4) {
                $dt = $this->CI->om->view("*", "admins", ['remember_me' => $tashfik]);
                if ($dt) {
                    foreach ($dt as $d) {                       
						$sdata['id'] = $d->id;
						$sdata['type'] = $d->user_type;
						$sdata['name'] = $d->name;
						$sdata['email'] = $d->email;
						$sdata['picture'] = $d->picture;
						$sdata['designation'] = $d->designation;
						$sdata['mobile'] = $d->mobile;
                        $this->CI->input->set_cookie('tashfik', $tashfik, '604800');
                        $this->CI->session->set_userdata($sdata);
                        redirect(base_url("dashboard"), "refresh");
                    }
                }
            }
        }
    }
}
