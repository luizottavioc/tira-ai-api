<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property int $power 
 * @property int $list_player_id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Player extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'players';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'power' => 'integer', 'list_player_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
