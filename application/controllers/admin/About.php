<?php
class About extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('About_Model','aboutmodel', true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/aboutus/index');
        $config['total_rows'] = $this->aboutmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->aboutmodel->getAll($config['per_page'],$offset);
        $this->load->view('admin/aboutus/index',$data);
    }

    function addabout()
    {
        $this->load->view('admin/aboutus/addabout');
    }

    function save()
    {

        $arr['name'] = $this->input->post('name');
        $arr['content'] = $this->input->post('content');
        if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = APPPATH.'../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                $this->resize_image(APPPATH.'../uploads/'.$arr['image'],900);
                $this->createThumbnail(PPPATH.'../uploads/'.$arr['image'],APPPATH.'../uploads/thumbnail/'.$arr['image'],400,300);
                //$arr['image'] =
            }
        }

        $this->aboutmodel->save('about',$arr);

        $this->session->set_flashdata('success','About saved successfully');
        redirect('admin/aboutus/index');

    }
    function resize_image($source,$width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    function createThumbnail($source,$destination,$width,$height)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = FALSE;
        $config['width']         = $width;
        $config['height'] = $height;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    function edit($id)
    {
        $data['cll'] = $this->aboutmodel->getById($id);
        $this->load->view('admin/aboutus/editabout',$data);
    }

    function update($id)
    {
        $this->aboutmodel->update($id);
        $this->session->set_flashdata('success','About updated successfully');
        redirect('admin/about/index');
    }

    function delete($id)
    {
        $this->aboutmodel->delete($id);
        $this->session->set_flashdata('success','About deleted successfully');
        redirect('admin/aboutus/index');
    }

}