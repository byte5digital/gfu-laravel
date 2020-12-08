<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BlogEntry
 *
 * @property      int $id
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property      string|null $headline
 * @property      string|null $content
 * @property      int $user_id
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry newModelQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry newQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry query()
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry whereContent($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry whereCreatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry whereHeadline($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry whereId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry whereUpdatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder|BlogEntry whereUserId($value)
 * @mixin         \Eloquent
 * @property-read \App\User $user
 */

class BlogEntry extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
