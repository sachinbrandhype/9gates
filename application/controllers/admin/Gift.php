<?php
class Gift extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gift_Model','giftmodel', true);
    }

    function index($offset=0)
    {
        $data['gif'] = $this->giftmodel->getAll();
        $this->load->view('admin/giftcard/index',$data);
    }

    function add()
    {
        $this->load->view('admin/giftcard/add-gift');
    }

    function savegift()
    {

        $arr['heading'] = $this->input->post('heading');
        $arr['content'] = $this->input->post('content');
        $arr['url'] = $this->input->post('url');
        $arr['createdate'] = date("Y-m-d H:i:s");


        if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                
            }
        }

     

            $this->giftmodel->save('gift',$arr);

            $id = $this->db->insert_id();

        
            redirect('admin/gift/index');

        }

        function edit($id)
        {

            $data['gif'] = $this->giftmodel->getById($id);
            $this->load->view('admin/giftcard/edit-gift',$data);
        }

        function update($id)
        {
            $this->giftmodel->update($id);
            redirect('admin/gift/index');
        }

        function delete($id)
        {
            $this->giftmodel->delete($id);
            redirect('admin/gift/index');
        }

    }