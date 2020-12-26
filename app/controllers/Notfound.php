<?php defined('BASEPATH') or exit('No direct script access allowed');

class Notfound extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Not Found';
        $data = array_merge($data, path_info());
        $this->parser->parse('Notfound/index', $data);
    }

}
