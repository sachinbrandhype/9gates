<?php
class Testimonial extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('Testimonial_Model','testimonial', true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/testimonial/index');
        $config['total_rows'] = $this->testimonial->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->testimonial->getAll($config['per_page'],$offset);
        $this->load->view('admin/testimonial/index',$data);
    }

    function addtestimonial()
    {
        $this->load->view('admin/testimonial/addtestimonial');
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

        $this->testimonial->save('testimonial',$arr);

        $this->session->set_flashdata('success','Testimonial saved successfully');
        redirect('admin/testimonial/index');

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
        $data['cll'] = $this->testimonial->getById($id);
        $this->load->view('admin/testimonial/edittestimonial',$data);
    }

    function update($id)
    {
        $this->testimonial->update($id);
        $this->session->set_flashdata('success','Testimonial updated successfully');
        redirect('admin/testimonial/index');
    }

    function delete($id)
    {
        $this->testimonial->delete($id);
        $this->session->set_flashdata('success','Testimonial deleted successfully');
        redirect('admin/testimonial/index');
    }

}