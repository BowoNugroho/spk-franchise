<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{

    var $sess;

    public function __construct()
    {
        parent::__construct();
        // $this->sess = $this->session->userdata();

        // // Pagination config
        // $config_pagination['full_tag_open'] = '<ul class="pagination pagination-sm float-right">';
        // $config_pagination['full_tag_close'] = '</ul>';
        // $config_pagination['attributes'] = ['class' => 'page-link'];
        // $config_pagination["first_link"] = "&Lang;";
        // $config_pagination["last_link"] = "&Rang;";
        // $config_pagination['first_tag_open'] = '<li class="page-item">';
        // $config_pagination['first_tag_close'] = '</li>';
        // $config_pagination['prev_link'] = '&lang;';
        // $config_pagination['prev_tag_open'] = '<li class="page-item">';
        // $config_pagination['prev_tag_close'] = '</li>';
        // $config_pagination['next_link'] = '&rang;';
        // $config_pagination['next_tag_open'] = '<li class="page-item">';
        // $config_pagination['next_tag_close'] = '</li>';
        // $config_pagination['last_tag_open'] = '<li class="page-item">';
        // $config_pagination['last_tag_close'] = '</li>';
        // $config_pagination['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        // $config_pagination['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        // $config_pagination['num_tag_open'] = '<li class="page-item">';
        // $config_pagination['num_tag_close'] = '</li>';
        // $config_pagination['num_links'] = 3;
        // $this->pagination->initialize($config_pagination);
    }

    public function authorize($nav, $field)
    {
        if ($nav[$field] == false) redirect(site_url() . '/error/403');
    }

    public function render($content, $data = array())
    {

        // $data['menu']  = $this->m_menu->_getMenu($data['menu']['menu_id']);
        $data['title'] = $data['menu']['menu_nm'];
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view($content, $data);
        $this->load->view('template/footer');
    }
}
