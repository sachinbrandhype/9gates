<?php

class Subject_Model extends CI_Model
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
        return $this->db->get('subject')->result();
    }

    function getAllData()
    {
        $this->db->select('school.school_name,classes.class_name,subject.subject,subject.id');
        $this->db->from('subject');
        $this->db->join('school', 'subject.school_name =school.id ', 'inner');
        $this->db->join('classes', 'subject.class_name  = classes.id', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_School($school_name)
    {
        $this->db->where('school_name', $school_name);
        $query = $this->db->get('classes');
        $output = '<option value="">Select Class Name</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->class_name . '">Class-' . $row->class_name . '</option>';
        }
        return $output;
    }

    function  getAllClassSchool()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('school')->result();
    }


    function  getAllClass()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('classes')->result();
    }

    function  getAllSchool()
    {

        $this->db->order_by('id DESC');
        return $this->db->get('school')->result();

    }

    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('subject')->num_rows();
    }

    function getSubjectById($id)
    {
        return $this->db->get_where('subject', array('id' => $id))->row();
    }

    function save()
    {
        $arr['class_name'] = $this->input->post('class_name');
        $arr['url'] = $this->input->post('url');
        $arr['school_name'] = $this->input->post('school_name');
        $arr['subject'] = $this->input->post('subject');
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

        $this->db->insert('subject', $arr);
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
        $arr['school_name'] = $this->input->post('school_name');
        $arr['url'] = $this->input->post('url');
        $arr['class_name'] = $this->input->post('class_name');
        $arr['subject'] = $this->input->post('subject');

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
        $this->db->update('subject', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('id' => $id));
        $this->db->delete('subject');
    }
}