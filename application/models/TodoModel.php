<?php

/*
 * toDO Model
 */

class TodoModel extends CI_Model {
    /*
     * Tasks database name
     */

    private $table = 'todo';

    /*
     * Tasks form validation rules
     */

    public $rules = array(
        'taskTitle' => array(
            'field' => 'taskTitle',
            'label' => 'Task title',
            'rules' => 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[32]'
        ),
        'taskDescription' => array(
            'field' => 'taskDescription',
            'label' => 'Task description',
            'rules' => 'trim|required'
        )
    );


    /*
     * Add task to database function
     */

    public function addTask($taskTitle, $taskDescription) {

        // Set values

        $data = array(
            'title' => $taskTitle,
            'description' => $taskDescription
        );

        // Insert record into database

        $this->db->insert($this->table, $data);

        return true;
    }

    /*
     * Update task in database function
     */

    public function editTask($id, $taskTitle, $taskDescription) {

        // Set values

        $data = array(
            'title' => $taskTitle,
            'description' => $taskDescription
        );

        // Set 'where' and update record in database

        $this->db->where('id', $id);
        $this->db->update($this->table, $data);

        return true;
    }

    /*
     * Delete task from database function
     */

    public function deleteTask($id) {

        // Set 'where' and delete record from database

        $this->db->where('id', $id);
        $this->db->delete($this->table);

        return true;
    }

    /*
     *  Mark task as completed in database function
     */

    public function completedTask($id) {

        // Set values

        $data = array(
            'completed' => 1,
            'completed_date' => date("Y-m-d H:i:s")
        );

        // Set 'where' and update record in database

        $this->db->where('id', $id);
        $this->db->update($this->table, $data);

        return true;
    }

    /*
     *  Check if record exist in database function (also getting values)
     */

    public function checkExist($id) {

        // Select record from database

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->row();
    }

    /*
     * Get all tasks from database function
     */

    public function getTasks($order='completedASC') {

        // Select tasks from database

        $this->db->select('*');
        $this->db->from($this->table);


        // Check and set order rule

        if ($order == 'completedASC') $this->db->order_by('completed ASC, completed_date DESC, id DESC');
        elseif ($order == 'idDESC') $this->db->order_by('id DESC');

        $query = $this->db->get();

        return $query->result();
    }
}