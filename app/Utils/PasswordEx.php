<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 11/11/2018
 * Time: 18:28
 */

namespace App\Utils;


class PasswordEx
{
   public function gerarSenha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos)
   {
       $senha = "";
       $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
       $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
       $nu = "0123456789"; // $nu contem os números
       $si = "!@#$%¨&*()_+="; // $si contem os símbolos

       if ($maiusculas) {
           // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
           $senha .= str_shuffle($ma);
       }

       if ($minusculas) {
           // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
           $senha .= str_shuffle($mi);
       }

       if ($numeros) {
           // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
           $senha .= str_shuffle($nu);
       }

       if ($simbolos) {
           // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
           $senha .= str_shuffle($si);
       }

       // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
       return substr(str_shuffle($senha), 0, $tamanho);
   }
}
