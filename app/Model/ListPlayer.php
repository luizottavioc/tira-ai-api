<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property int $sport_id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class ListPlayer extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'list_players';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'sport_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
