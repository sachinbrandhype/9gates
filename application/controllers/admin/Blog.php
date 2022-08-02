<?php
class Blog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Blog_Model','blogmodel', true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/blog/index');
        $config['total_rows'] = $this->blogmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['blog'] = $this->blogmodel->getAll($config['per_page'],$offset);
        $this->load->view('admin/blog/index',$data);
    }

    function add()
    {
        $this->load->view('admin/blog/add-blog');
    }

    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['name'] = $this->input->post('name');
        $arr['url'] = $this->input->post('url');
        $arr['content'] = $this->input->post('content');
        $arr['shourt_content'] = $this->input->post('shourt_content');
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

        $this->blogmodel->save('blog',$arr);

        $this->session->set_flashdata('success','Blog saved successfully');
        redirect('admin/blog/index');

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
        $data['blog'] = $this->blogmodel->getById($id);
        $this->load->view('admin/blog/edit-blog',$data);
    }

    function update($id)
    {
        $this->blogmodel->update($id);
        $this->session->set_flashdata('success','Blog updated successfully');
        redirect('admin/blog/index');
    }

    function delete($id)
    {
        $this->blogmodel->delete($id);
        $this->session->set_flashdata('success','Blog deleted successfully');
        redirect('admin/blog/index');
    }

}