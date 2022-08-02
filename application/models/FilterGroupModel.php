<?php

class FilterGroupModel extends CI_Model
{
    function allFilterGroupData()
    {

        //$query = $this->db->query("SELECT `fitergroup`.`filtergroup`, `subject`.`subject`, `school`.`school_name`, `classes`.`class_name` FROM `fitergroup` INNER JOIN `school` ON `fitergroup`.`school_name` =`school`.`id` INNER JOIN `classes` ON `fitergroup`.`class_name` = `classes`.`class_name` INNER JOIN `subject` ON `fitergroup`.`subject` = `subject`.`id` GROUP BY fitergroup.filtergroup");
        /* $this->db->select ('fitergroup.filtergroup,fitergroup.id, subject.subject, school.school_name, classes.class_name' );
         $this->db->from ( 'fitergroup' );
         $this->db->join ( 'school', 'fitergroup.school_name =school.id ' , 'inner' );
         $this->db->join ( 'classes', 'fitergroup.class_name  = classes.class_name' , 'inner' );
         $this->db->join ( 'subject', 'fitergroup.subject  = subject.id' , 'inner' );
         $this->db->group_by('fitergroup.filtergroup');
         $query = $this->db->get ();
         return $query->result();*/

        $this->db->order_by('id DESC');
        return $this->db->get('fitergroup')->result();


    }


    function  getAllSubject()
    {

        $this->db->order_by('id DESC');
        return $this->db->get('subject')->result();

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


    function getflgData($id)
    {

        return $this->db->get_where('fitergroup', array('id' => $id))->row();

    }

    function  getAllScholl()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('school')->result();
    }


    function fetchSubjects($class_name)
    {
        $this->db->where('class_name', $class_name);
        $query = $this->db->get('subject');
        $output = '<option value="">Select Subject</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->subject . '</option>';
        }
        return $output;
    }


    function fetchClasses($school_name)
    {
        $this->db->where('school_name', $school_name);
        $query = $this->db->get('classes');
        $output = '<option value="">Select Class Name</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->class_name . '">Class-' . $row->class_name . '</option>';
        }
        return $output;
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
        return $this->db->get('fitergroup')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('fitergroup')->num_rows();
    }


}