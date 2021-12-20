<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'posts';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'user_id'];

    /**
     * PostModel belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
