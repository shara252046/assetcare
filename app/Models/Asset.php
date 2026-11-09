<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = ['code', 'name', 'category'];

//when warranty alert is needed, in that time this function is added
    protected function casts(): array
    {
        return [
            'warranty_end' => 'date',
            'warranty_notified_at' => 'date',
        ];
    }


//  qr issue report korar time a aita kora hoise
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }


    // Warranty shesh hote r koto din baki (shesh hoye gele wrinattok, date na thakle null)
    public function daysLeft(): ?int
    {
        if (! $this->warranty_end) {
            return null;
        }

        return (int) round(today()->diffInDays($this->warranty_end->copy()->startOfDay(), false));
    }
}