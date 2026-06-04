<?php

class HomeController extends Controller
{
    public function index() {
    // No definimos $seccion_activa, por lo que el header mostrará la welcome-screen
    require_once '../app/views/layout/header.php';
    //require_once '../app/views/layout/footer.php';
}
}