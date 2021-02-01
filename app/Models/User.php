<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

/***
 * User
 *
 * @mixin \Eloquent;
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    //<editor-fold desc="Fields">
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'notification_email_unassigned_tickets' => 'boolean',
        'notification_email_assigned_tickets' => 'boolean',
        'notification_email_replies' => 'boolean',
        'notification_email_messages' => 'boolean'
    ];

    protected $appends = ['companyName', 'unreadNotificationCount', 'fullName'];
    //</editor-fold>

    //<editor-fold desc="Relationships">
    public function company() {
        return $this->belongsTo(Company::class);
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }
    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }
    //</editor-fold>

    //<editor-fold desc="Attributes">
    public function getCompanyNameAttribute()
    {
        return $this->company->name;
    }
    public function getUnreadNotificationCountAttribute()
    {
        return $this->unreadNotifications()->count();
    }
    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }
    public function getAvatarUrlAttribute()
    {
        return Storage::disk('s3')->url($this->avatar);
    }
    //</editor-fold>
}
