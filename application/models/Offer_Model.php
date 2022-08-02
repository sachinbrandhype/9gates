<?php

class Blog_Model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'offer';
    }

    function getAll($limit, $offset)
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id DESC');
        return $this->db->get('offer')->result();
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
        return $this->db->get('offer')->num_rows();
    }


    function getById($id)
    {
        return $this->db->get_where('offer', array('id' => $id))->row();
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
        $arr['name'] = $this->input->post('name');
        $arr['content'] = $this->input->post('content');
        $arr['shourt_content'] = $this->input->post('shourt_content');

        if (isset($_FILES['image']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = APPPATH . '../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                $this->resize_image(APPPATH . '../uploads/' . $arr['image'], 900);
                $this->createThumbnail(PPPATH . '../uploads/' . $arr['image'], APPPATH . '../uploads/thumbnail/' . $arr['image'], 400, 300);
                //$arr['image'] =
            }
        }

        $this->db->where(array('id' => $id));
        $this->db->update('offer', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('id' => $id));
        $this->db->delete('offer');
    }
}