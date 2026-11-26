<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{

// ticket system make korar time a use hoi
    protected $fillable = [
        'ticket_no', 'asset_id', 'issue', 'reporter', 'priority', 'status', 'source',
        'technician_id', 'technician_note', 'cost', 'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'cost' => 'decimal:2',
            'resolved_at' => 'datetime',
        ];
    }

    //ai porjonto ticket system.

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

//Maintenance Schedule + Auto Ticket
// ticket make kore, T-101,T102...number boshai
    public static function createNumbered(array $attributes): self
{
    return DB::transaction(function () use ($attributes) {
        //  Fix: Create korar somoy ekta temporary ticket_no diye dicchi
        $attributes['ticket_no'] = 'TMP-' . uniqid(); 
        
        $ticket = static::create($attributes);
        
        // Tarpor original format e update korchi
        $ticket->update(['ticket_no' => 'T-' . (100 + $ticket->id)]);

        return $ticket;
    });
}
}