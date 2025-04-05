<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    Validator::extend('rut_valido', function ($attribute, $value, $parameters, $validator) {
        // Elimina puntos y guiones del RUT
        $rut = str_replace(['.', '-'], '', $value);

        // Verifica si el RUT tiene la longitud correcta
        if (strlen($rut) < 8 || strlen($rut) > 9) {
            return false;
        }

        // Verifica si el RUT tiene la parte numérica y el dígito verificador (último carácter)
        $numero = substr($rut, 0, -1);
        $dv = strtoupper(substr($rut, -1));

        // Calcula el dígito verificador del RUT
        $sum = 0;
        $mul = 2;
        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $sum += $numero[$i] * $mul;
            $mul = ($mul == 7) ? 2 : $mul + 1;
        }

        $calculatedDV = 11 - ($sum % 11);
        if ($calculatedDV == 11) {
            $calculatedDV = '0';
        } elseif ($calculatedDV == 10) {
            $calculatedDV = 'K';
        } else {
            $calculatedDV = (string) $calculatedDV;
        }

        // Verifica si el dígito verificador coincide
        return $dv === $calculatedDV;
    });

    // Otros servicios de validación si es necesario
}
}
