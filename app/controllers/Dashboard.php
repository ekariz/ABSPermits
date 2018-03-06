<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Abs_model','payroll');
        $this->load->model('crud_model','employees');
    }

    public function index()
    {

    $data                   = [];

    $this->load->view('dashboard_view', $data);

    }

}
