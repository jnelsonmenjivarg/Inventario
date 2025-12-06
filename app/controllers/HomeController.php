<?php

class HomeController extends Controller
{
    public function index()
    {
        Auth::requireLogin();
        $this->view('dashboard/home');
    }
}