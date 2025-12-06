<?php
// core/Controller.php
class Controller
{
    protected function view(string $view, array $data = [])
    {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}
