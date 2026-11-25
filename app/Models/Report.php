<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $fillable = [
        'user_id','technician_id','title','category','location','description','photo',
        'status','admin_note','technician_note','evidence_photo','reported_on'
    ];
    protected function casts(): array { return ['reported_on' => 'date']; }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function technician(): BelongsTo { return $this->belongsTo(User::class, 'technician_id'); }
    public function histories(): HasMany { return $this->hasMany(ReportHistory::class)->latest(); }
}
