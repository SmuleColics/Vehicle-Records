<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Vehicle;
use App\Models\ProfilePhoto;

class User extends Authenticatable
{
  /** @use HasFactory<UserFactory> */
  use HasFactory, Notifiable;

  const ROLE_ADMIN = 'admin';
  const ROLE_CLIENT = 'client';

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'phone',
    'gender',
    'address',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

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

  public function vehicles()
  {
    return $this->hasMany(Vehicle::class);
  }

  public function profilePhoto()
  {
    return $this->hasOne(ProfilePhoto::class);
  }

  public function isAdmin()
  {
    return $this->role === self::ROLE_ADMIN;
  }

  // demo accounts are shared by every visitor, so they can't be renamed, deleted or locked
  public function isDemo()
  {
    return in_array($this->email, config('demo.accounts'), true);
  }

  // where the user lands after logging in
  public function homeRoute()
  {
    return $this->isAdmin() ? route('dashboard') : route('portal');
  }

  public function avatarUrl()
  {
    if (!$this->profile_picture) {
      return asset('images/default.jpg');
    }

    // older uploads were saved as files in public/uploads
    if (file_exists(public_path('uploads/' . $this->profile_picture))) {
      return asset('uploads/' . $this->profile_picture);
    }

    // newer uploads live in the database, the file name doubles as a cache buster
    return route('avatar', ['id' => $this->id, 'v' => $this->profile_picture]);
  }
}
