<?php
function usuarioOk($usuario, $contraseña): bool {

   if (strlen($usuario) < 8) {

      return false;
   }

   $contraseñaReves = strrev($usuario);

   if ($contraseña === $contraseñaReves) {

      return true;
   } 
   
   else {

      return false;
   }
}

function entradaComentarioOk(string $comentario) {

   $comentarioValido = htmlspecialchars(strip_tags(trim($comentario)), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

   if (strlen($comentarioValido) > 0) {

      return $comentarioValido;
   } 
   
   else {

      return false;
   }
}

function entradaTemaOk(string $tema) {

   $temaValido = htmlspecialchars(strip_tags(trim($tema)), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

   if (strlen($temaValido) > 0) {

      return $temaValido;
   } 
   
   else {

      return false;
   }
}

function contarPalabras(string $palabras) {

   return str_word_count($palabras);
}

function validarLongitud(string $texto) {

   if (strlen($texto) <= 300) {

      return $texto;
   } 
   
   else {

      return false;
   }
}

function palabraMasRepetida(string $comentarioCampo) {

   $comentarioCampo = strtolower($comentarioCampo);
   $palabrasComentario = str_word_count($comentarioCampo, 1);

   if (empty($palabrasComentario)) {

      return false;
   }

   $vecesRepetida = array_count_values($palabrasComentario);

   arsort($vecesRepetida);

   $palabraRepetida = array_key_first($vecesRepetida);

   return $palabraRepetida;
}

function letraMasRepetida (string $palabra) {

   $palabra = strtolower($palabra);

   if (strlen($palabra) == 0) {

      return false;
   }

   $letrasPalabra = mb_str_split($palabra);
   $contador = array_count_values($letrasPalabra);

   arsort($contador);

   $letraMasRepetida = array_key_first($contador);

   return $letraMasRepetida;
}
