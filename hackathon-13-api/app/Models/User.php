<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleName;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => UserRoleName::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user detail associated with the user.
     */
    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    /**
     * The positions that belong to the user.
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'employee_positions', 'employee', 'position_id');
    }

    /**
     * Get the employee detail associated with the user.
     */
    public function employeeDetail(): HasOne
    {
        return $this->hasOne(EmployeeDetail::class, 'employee', 'id');
    }
}
