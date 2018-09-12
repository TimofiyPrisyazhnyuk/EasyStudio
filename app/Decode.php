<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decode extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'secret_code_id',
        'decode_code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secretCode()
    {
        return $this->belongsTo(SecretCode::class);
    }

}
