<?php

require_once __DIR__ . '/../models/PhysBorrow.php';

class PhysBrwController
{
    public function index()
    {
        $borrow = new PhysBorrow();

        $borrows = $borrow->getAll();

        require __DIR__ . '/../views/barrow/physics/phys-borrow.php';
    }

    public function create()
    {
        $borrow = new PhysBorrow();

        $borrow->create($_POST);

        header("Location: " . BASE_URL . "/borrow");
        exit;
    }

    public function view($id)
    {
        $borrow = new PhysBorrow();

        echo json_encode($borrow->getById($id));
    }

    public function update()
    {
        $borrow = new PhysBorrow();

        $borrow->update($_POST);

        header("Location: " . BASE_URL . "/borrow");
        exit;
    }

    public function delete($id)
    {
        $borrow = new PhysBorrow();

        $borrow->delete($id);

        header("Location: " . BASE_URL . "/borrow");
        exit;
    }
}