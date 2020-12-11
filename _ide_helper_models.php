<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\BlogEntry
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $headline
 * @property string|null $content
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogEntry whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 */
	class IdeHelperBlogEntry extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BlogEntry[] $blogEntries
 * @property-read int|null $blog_entries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperCategory extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BlogEntry[] $blogEntries
 * @property-read int|null $blog_entries_count
 */
	class IdeHelperUser extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

