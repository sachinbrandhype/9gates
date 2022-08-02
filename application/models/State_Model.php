<?php

class State_Model extends CI_Model
{
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
        return $this->db->get('vendor')->result();
    }


    function getStateList()
    {
        return $this->db->get('states')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('vendor')->num_rows();
    }

    function getById($id)
    {
        return $this->db->get_where('vendor', array('id' => $id))->row();
    }

    function save()
    {
        $arr['state'] = $this->input->post('state');
        $arr['gst'] = $this->input->post('gst');
        $arr['username'] = $this->input->post('username');
        $arr['email'] = $this->input->post('email');
        $arr['phone'] = $this->input->post('phone');
        $arr['address'] = $this->input->post('address');
        $arr['password'] = $this->input->post('password');
        $arr['state'] = $this->input->post('state');
        $this->db->insert('vendor', $arr);
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
        $arr['state'] = $this->input->post('state');
        $arr['gst'] = $this->input->post('gst');
        $arr['username'] = $this->input->post('username');
        $arr['email'] = $this->input->post('email');
        $arr['phone'] = $this->input->post('phone');
        $arr['address'] = $this->input->post('address');
        $arr['password'] = $this->input->post('password');
        $arr['state'] = $this->input->post('state');

        $this->db->where(array('id' => $id));
        $this->db->update('vendor', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('id' => $id));
        $this->db->delete('vendor');
    }
}