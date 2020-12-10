<?php

namespace App;

use App\Http\Controllers\JobController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Support\Carbon;
use App\Jobs\SendMail;
use Artisan;

/**
 * App\User
 *
 * @property      int $id
 * @property      string $name
 * @property      string $email
 * @property      \Illuminate\Support\Carbon|null $email_verified_at
 * @property      string $password
 * @property      string|null $remember_token
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method        static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|User query()
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin         \Eloquent
 * @mixin         IdeHelperUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BlogEntry[] $blogEntries
 * @property-read int|null $blog_entries_count
 */

class User extends Authenticatable implements MustVerifyEmail
{
   use Notifiable;

   const ADMIN_TYPE = 'admin';
   const DEFAULT_TYPE = 'default';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name', 'email', 'password',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      'password', 'remember_token',
   ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
   ];

   public function blogEntries()
   {
      return $this->hasMany(BlogEntry::class, 'user_id');
   }

   public function isAdmin()
   {
      return $this->type === self::ADMIN_TYPE;
   }

   // overwrite verify mail of MustVerifyEmail with CustomVerifyEmail
   public function sendEmailVerificationNotification()
   {

      //delays notification by 1 minute
      // $when = now()->addMinutes(1);
      // $this->notify((new CustomVerifyEmail)->delay($when));

      // sends notification instantly
    $this->notify(new CustomVerifyEmail);
   }

   public function startQueue(){
      Artisan::call('queue:listen');
   }
}
