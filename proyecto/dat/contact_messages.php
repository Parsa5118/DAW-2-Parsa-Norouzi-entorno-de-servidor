<?php

require_once "Clase.php";

class contact_messages extends Clase {

    private string $name;
    private string $email;
    private string $message;
    private string $createdAt;

    public function __construct(
        string $name = "",
        string $email = "",
        string $message = "",
        string $createdAt = ""
    ) {
        $this->name = $name;
        $this->email     = $email;
        $this->message   = $message;
        $this->createdAt = $createdAt;
    }

    public function getUserLogin(): string {
        return $this->name;
    }

    public function setUserLogin(string $name): void {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }
}
