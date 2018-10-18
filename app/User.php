<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified', //verifica mail mediante codigo verificacion
        'verification_token',
        'admin',//permite saber si es administrador
    ];

    // Creando mutadores para guardar la información en minusculas
    public function setNameAttribute($valor){
        $this->attributes['name'] = strtolower($valor);
    }
    
    // Creando mutadores para guardar la información en minusculas
    public function setEmailAttribute($valor){
        $this->attributes['email'] = strtolower($valor);
    }

    // Creando accesor para visualizar la información en el postman
    public function getNameAttribute($valor){
        //return ucfirst($valor); Cambia a mayuscula la Primera letra de la frase
        return ucwords($valor); //Cambia a mayuscula la Primera letra de cada palabra
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',//token recuerda cuando el usuario inicia sesion y si este debe mantenerse
        'verification_token',//nadie ni un administrador podra tener acceso al token de verificacion de un usuario especifico.
    ];

    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function esAdministrador()
    {
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generarVerificationToken()
    {
        return str_random(40);
    }
}
