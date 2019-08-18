<?php


class Sklad
{
    private $user;
    public function __construct( MOF_User $user)
    {
        $this->user = $user;
    }
}