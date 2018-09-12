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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function decode()
    {
        return $this->hasOne(Decode::class, 'secret_code_id');
    }
}
