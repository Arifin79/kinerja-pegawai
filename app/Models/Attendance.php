<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'batas_start_time',
        'end_time',
        'batas_end_time',
        'code'
    ];

    protected $appends = ['data'];

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->calculateData()
        );
    }

    private function calculateData()
    {
        $now = now();
        $startTime = Carbon::parse($this->start_time);
        $batasStartTime = Carbon::parse($this->batas_start_time);
        $endTime = Carbon::parse($this->end_time);
        $batasEndTime = Carbon::parse($this->batas_end_time);
        $isHolidayToday = $this->isHolidayToday();

        return [
            'now' => $now,
            'start_time' => $startTime,
            'batas_start_time' => $batasStartTime,
            'end_time' => $endTime,
            'batas_end_time' => $batasEndTime,
            'is_holiday_today' => $isHolidayToday,
        ];
    }

    private function isHolidayToday(): bool
    {
        return Holiday::query()
            ->where('holiday_date', now()->toDateString())
            ->exists();
    }

    public function scopeForCurrentUser($query, $userPositionId)
    {
        $query->whereHas('positions', function ($query) use ($userPositionId) {
            $query->where('position_id', $userPositionId);
        });
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
