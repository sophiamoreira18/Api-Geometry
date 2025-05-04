<?php
 
namespace Math;
 
class Geometria
{
    /**
     * Calcula a área de um triângulo.
     * @return int|float
     */
    public function calcularAreaTriangulo(int|float $base, int|float $altura)
    {
        return $base * $altura / 2;
    }

     
        /**
         * Calcula a área de um retângulo.
         * @return int|float
         */
        public function calcularAreaRetangulo(int|float $base, int|float $altura)
        {
            return $base * $altura;
        }
    }