<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = ['ticket_no', 'asset_id', 'issue', 'reporter', 'priority', 'status'];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}