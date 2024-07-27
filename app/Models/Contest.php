<?php

namespace App\Models;

use App\Models\Character;
use App\Models\Contest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CharacterController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'win',
        'history',
        'place_id',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class)
            ->withPivot('hero_hp', 'enemy_hp');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function getEnemy($contestId)
    {

        $enemyCharacterId = DB::table('character_contest')->where('contest_id', $contestId)->value('enemy_id');

        if ($enemyCharacterId) {
            $enemyName = Character::findOrFail($enemyCharacterId);
            return $enemyName;
        }

        return null;
    }

    
    
    public function getEnemyId($contestId){
        return DB::table('character_contest')->where('contest_id', $contestId);
    }

    public function getEnemyHp($contestId){
        return DB::table('character_contest')->where('contest_id', $contestId)->value('enemy_hp');
    }
    
    public function getCharacterHp($contestId){
        return DB::table('character_contest')->where('contest_id', $contestId)->value('character_hp');
    }

    public function updateEnemyHp($contestId, int $newEnemyHp)
    {
        DB::table('character_contest')
            ->where('contest_id', $contestId)
            ->update(['enemy_hp' => $newEnemyHp]);
    }

    public function updateCharacterHp($contestId, int $newCharacterHp)
    {
        DB::table('character_contest')
            ->where('contest_id', $contestId)
            ->update(['character_hp' => $newCharacterHp]);
    }
}
