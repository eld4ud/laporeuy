<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'class_name'];
    protected $hidden = ['password', 'remember_token'];
    protected function casts(): array { return ['email_verified_at' => 'datetime', 'password' => 'hashed']; }

    public function reports(): HasMany { return $this->hasMany(Report::class); }
    public function assignedReports(): HasMany { return $this->hasMany(Report::class, 'technician_id'); }
    public function isRole(string ...$roles): bool { return in_array($this->role, $roles, true); }
}
