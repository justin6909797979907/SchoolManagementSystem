<?php

require_once __DIR__ . '/../models/PsyBorrow.php';

class PsyBorrowController
{
    public function index()
    {
        $borrow = new PsyBorrow();

        $borrows = $borrow->getAll();

        require __DIR__ . '/../views/barrow/psychology/psy_borrow.php';
    }

    public function create()
    {
        $borrow = new PsyBorrow();

        $borrow->create($_POST);

        header("Location: " . BASE_URL . "/psy_borrow");
        exit;
    }

    public function view($id)
    {
        $borrow = new PsyBorrow();

        echo json_encode($borrow->getById($id));
    }

    public function update()
    {
        $borrow = new PsyBorrow();

        $borrow->update($_POST);

        header("Location: " . BASE_URL . "/psy_borrow");
        exit;
    }

    public function delete($id)
    {
        $borrow = new PsyBorrow();

        $borrow->delete($id);

        header("Location: " . BASE_URL . "/psy_borrow");
        exit;
    }
}