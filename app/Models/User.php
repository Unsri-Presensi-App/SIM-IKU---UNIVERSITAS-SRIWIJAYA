<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'unit_kerja'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // -- Helper peran --
    public function isOperator(): bool  { return $this->role === 'operator'; }
    public function isValidator(): bool { return $this->role === 'validator'; }
    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isViewer(): bool    { return $this->role === 'viewer'; }

    /** Boleh menginput/mengedit data IKU? (operator & admin) */
    public function bisaInput(): bool
    {
        return in_array($this->role, ['operator', 'admin'], true);
    }

    /** Boleh memvalidasi ajuan? (validator & admin) */
    public function bisaValidasi(): bool
    {
        return in_array($this->role, ['validator', 'admin'], true);
    }

    public function labelRole(): string
    {
        return [
            'operator'  => 'Operator Unit',
            'validator' => 'Validator Direktorat',
            'admin'     => 'Administrator',
            'viewer'    => 'Pengamat',
        ][$this->role] ?? ucfirst($this->role ?? 'operator');
    }
}