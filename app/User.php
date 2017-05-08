<?php

namespace App;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//Authenticatable
//use Illuminate\Support\Facades\Facade;
class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'backend_user',
        'ip_address',
        'website',
        'telephone',
        'mobile',
        'address',
        'city',
        'country',
        'company',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Quotes()
    {
        return $this->hasMany('App\Models\Quotation\Quote');
    }

    public function Orders()
    {
        return $this->hasMany('App\Models\Order\Order');
    }

    public static function UserRole($id)
    {
        return Sentinel::findById($id)->roles()->first()->name;
    }

    
    public static function isSuperAdmin()
    {
        if (Sentinel::check()) {
            if(Sentinel::inRole('super-admin'))
                return true;
            else
                return false;
        }

        return false;
    }

    public static function isSupervisor()
    {
        if (Sentinel::check()) {
            if(Sentinel::inRole('supervisor') || Sentinel::inRole('super-admin'))
                return true;
            else
                return false;
        }

        return false;
    }

    public static function isSalesExecutive()
    {
        if (Sentinel::check()) {
            if(Sentinel::inRole('sales-executive') || Sentinel::inRole('super-admin'))
                return true;
            else
                return false;
        }

        return false;
    }

    public static function getId()
    {
        if (Sentinel::check()) 
            return Sentinel::getUser()->id;
                
         
    }

    public static function getUser()
    {
        if (Sentinel::check()) {

            $userId= Sentinel::getUser()->id;
            $user = User::find($userId);
            return $user;
        }
                
         
    }

    public static function isActivated($id){

       return Activation::completed(Sentinel::findById($id));
    }



}
