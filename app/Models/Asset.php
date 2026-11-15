<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = ['code', 'name', 'category', 'warranty_end', 'warranty_notified_at',
        'service_interval_days', 'last_service_date', 'next_service_date'];

//when warranty alert is needed, in that time this function is added
    protected function casts(): array
    {
        return [
            'warranty_end' => 'date',
            'warranty_notified_at' => 'date',
            'last_service_date' => 'date',
            'next_service_date' => 'date',
            'service_interval_days' => 'integer',
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

    // porer service koto din baki 
    public function serviceDaysLeft(): ?int
    {
        if (! $this->next_service_date) {
            return null;
        }

        return (int) round(today()->diffInDays($this->next_service_date->copy()->startOfDay(), false));
    }

// service sehsh hole,porer due date nije update hoi
    public function completeService(): void
    {
        $this->last_service_date = today();
        $this->next_service_date = $this->service_interval_days
            ? today()->addDays($this->service_interval_days)
            : null;
        $this->save();
    }
}