<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * TO DO CONTROLLER
 * @michal_kowalczyk
 */

class TodoController extends CI_Controller {

    /*
     * Construct function
     */

    public function __construct() {
        parent::__construct();

        // Load toDo Model
        $this->load->model('TodoModel');
    }

    /*
     * Index function
     */
	
    public function index() {

        // Load views

        $this->load->view('header');

        $this->load->view('todo/index');

        $this->load->view('footer');
    }

    /*
     * Lists function
     * @route: /todo/lists
     */

    public function lists() {

        // Get list of tasks

        $getTasks = $this->TodoModel->getTasks();

        // Set variable to view

        $vars = array(
            'tasks' => $getTasks
        );

        // Load views

        $this->load->view('header');

        $this->load->view('todo/lists', $vars);

        $this->load->view('footer');
    }

    /*
     * Manage function
     * @route: /todo/manage
     */

    public function manage() {

        // Get list of tasks with order by ID DESC

        $getTasks = $this->TodoModel->getTasks('idDESC');

        // Set variable to view

        $vars = array(
            'tasks' => $getTasks
        );

        // Load views

        $this->load->view('header');

        $this->load->view('todo/manage', $vars);

        $this->load->view('footer');
    }

    /*
     * Add task function
     * @route: /todo/add
     */

    public function add() {

        // Load form helper and form validation library

        $this->load->helper('form');
        $this->load->library('form_validation');

        // Set validation rules from model

        $rules = $this->TodoModel->rules;
        $this->form_validation->set_rules($rules);

        // Run validation

        if ($this->form_validation->run() !== false) {

            // Get inputs value

            $taskTitle = $this->input->post('taskTitle');
            $taskDescription = $this->input->post('taskDescription');


            // Add task to database

            $this->TodoModel->addTask($taskTitle, $taskDescription);

            // Set success message and redirect

            $this->session->set_flashdata('msg', 'New task added successfully!');

            redirect('/todo/lists', 'location');
        }

        // Load views

        $this->load->view('header');

        $this->load->view('todo/add');

        $this->load->view('footer');
    }

    public function edit($id) {

        // Check if task exist
        $checkExist = $this->TodoModel->checkExist($id); // If yes get values

        if (!$checkExist) {

            // Set message if task doesn't exist and redirect

            $this->session->set_flashdata('msg', "Wrong ID, task doesn't exist");

            redirect('/todo/manage', 'location');

            return false;
        }

        // Load form helper and form validation library

        $this->load->helper('form');
        $this->load->library('form_validation');

        // Set validation rules from model

        $rules = $this->TodoModel->rules;
        $this->form_validation->set_rules($rules);

        // Run validation

        if ($this->form_validation->run() !== false) {

            // Get inputs value

            $taskTitle = $this->input->post('taskTitle');
            $taskDescription = $this->input->post('taskDescription');


            // Update task in database

            $this->TodoModel->editTask($id, $taskTitle, $taskDescription);

            // Set success message and redirect

            $this->session->set_flashdata('msg', 'Task edited successfully!');

            redirect('/todo/manage', 'location');
        }

        // Set variable to view

        $vars = array (
            'task' => $checkExist
        );


        // Load views

        $this->load->view('header');

        $this->load->view('todo/edit', $vars);

        $this->load->view('footer');
    }

    /*
     * Delete function
     * @route: /todo/delete/(:num)
     */

    public function delete($id) {

        // Check if task exist

        $checkExist = $this->TodoModel->checkExist($id);

        if (!$checkExist) {

            // Set message if task doesn't exist and redirect

            $this->session->set_flashdata('msg', "Wrong ID, task doesn't exist");

            redirect('/todo/manage', 'location');

            return false;
        }

        // Delete task from database

        $this->TodoModel->deleteTask($id);

        // Set success message and redirect

        $this->session->set_flashdata('msg', "Task deleted successfully!");

        redirect('/todo/manage', 'location');
    }

    /*
     * Mark task as completed function
     * @route: /todo/completed/(:num)
     */

    public function completed($id) {

        // Check if task exist

        $checkExist = $this->TodoModel->checkExist($id);

        if (!$checkExist) {

            // Set message if task doesn't exist and redirect

            $this->session->set_flashdata('msg', "Wrong ID, task doesn't exist");

            redirect('/todo/manage', 'location');

            return false;
        }

        // Mark task as completed

        $this->TodoModel->completedTask($id);

        // Set success message and redirect

        $this->session->set_flashdata('msg', "Task marked as completed successfully!");

        redirect('/todo/lists', 'location');
    }
}
