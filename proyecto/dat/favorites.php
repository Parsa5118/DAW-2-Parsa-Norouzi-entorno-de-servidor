<?php

require_once "Clase.php";

class favorites extends Clase {

    private string $userLogin;
    private string $gameCode;
    private string $platform;
    private ?string $gameTitle;

    public function __construct(
        string $userLogin = "",
        string $gameCode = "",
        string $platform = "",
        ?string $gameTitle = null
    ) {
        $this->userLogin = $userLogin;
        $this->gameCode  = $gameCode;
        $this->platform  = $platform;
        $this->gameTitle = $gameTitle;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function setUserLogin(string $userLogin): void {
        $this->userLogin = $userLogin;
    }

    public function getGameCode(): string {
        return $this->gameCode;
    }

    public function setGameCode(string $gameCode): void {
        $this->gameCode = $gameCode;
    }

    public function getPlatform(): string {
        return $this->platform;
    }

    public function setPlatform(string $platform): void {
        $this->platform = $platform;
    }

    public function getGameTitle(): ?string {
        return $this->gameTitle;
    }

    public function setGameTitle(?string $gameTitle): void {
        $this->gameTitle = $gameTitle;
    }
}
