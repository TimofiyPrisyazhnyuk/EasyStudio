<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecretCode extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'code_name',
        'secret_code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function decode()
    {
        return $this->hasMany(Decode::class, 'secret_code_id');
    }
}
