<?php

namespace App\Exceptions;

use Exception;

class LoginNaoAutorizadoException extends Exception
{
    public function __construct()
    {
        $mensagem = "E-mail ou senha estão incorretos.";
        parent::__construct($mensagem);
    }

    public function customErrorMessage() {
        $message = "Erro na linha " . $this->getLine() . " no arquivo " . $this->getFile() . ": " . $this->getMessage();
        return $message;
    }
    
}