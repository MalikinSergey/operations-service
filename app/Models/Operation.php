<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Operation extends Model
{

    protected $guarded = ['transaction_id', 'type'];

    protected $casts = [
        'sender' => 'object',
        'receiver' => 'object',
        'info' => 'object',
    ];
}
