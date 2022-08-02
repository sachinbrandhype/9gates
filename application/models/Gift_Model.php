<?php

class Gift_Model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
    }


    function getAll()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('gift')->result();
    }


    function class_insert($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('gift')->num_rows();
    }

   


    function getById($id)
    {
        return $this->db->get_where('gift', array('id' => $id))->row();
    }

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function resize_image($source, $width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    function createThumbnail($source, $destination, $width, $height)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    function update($id)
    {
        $arr['heading'] = $this->input->post('heading');
        $arr['content'] = $this->input->post('content');
        $arr['url'] = $this->input->post('url');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        if (isset($_FILES['image']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                //$arr['image'] =
            }
        }


        $this->db->where(array('id' => $id));
        $this->db->update('gift', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('id' => $id));
        $this->db->delete('gift');
    }
}