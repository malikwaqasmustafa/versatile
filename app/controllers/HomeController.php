<?php
class HomeController extends Controller {
    public function index() {
        $data = ['title' => 'Welcome', 'message' => 'Hello, MVC!'];
        $this->view('home', $data);
    }

    public function about() {
        $data = ['title' => "About", 'message' => 'Hello About Us'];
        $this->view('about', $data);
    }

    /*public function fetchUsers() {
        $users = new User();
        dd($users->all());
    }*/

}
