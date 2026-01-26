<?php

require_once "Clase.php";

class Userapp extends Clase {

    private string $login;
    private string $password;

    public function __construct(string $login = "", string $password = "") {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function setLogin(string $login): void {
        $this->login = $login;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
}
?>