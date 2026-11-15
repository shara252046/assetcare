<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    protected $fillable = ['ticket_no', 'asset_id', 'issue', 'reporter', 'priority', 'status','source'];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

//Maintenance Schedule + Auto Ticket
// ticket make kore, T-101,T102...number boshai
    public static function createNumbered(array $attributes): self
{
    return DB::transaction(function () use ($attributes) {
        $ticket = static::create($attributes);
        $ticket->update(['ticket_no' => 'T-' . (100 + $ticket->id)]);

        return $ticket;
    });
}
}