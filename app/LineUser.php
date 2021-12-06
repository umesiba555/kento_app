<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;

class LineUser extends Model implements AuthenticatableContract
{
     use Authenticatable, Notifiable;
     
      protected $fillable = [
        'name', 'provider', 'provided_user_id',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        // We don't use password login.
        return '';
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // We don't use this.
        return '';
    }
}
