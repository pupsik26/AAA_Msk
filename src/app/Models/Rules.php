<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Krlove\EloquentModelGenerator\Model\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property int $agency_id
 * @property string $text
 * @property int $is_active
 * @property int $equality
 * @property string $created_at
 * @property string $updated_at
 *
 * */
class Rules extends Model
{
    use HasFactory;

    protected $guarded = [];

    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;

    /**
     * @param array $data
     * @return Rules
     */
    public static function saveModel(array $data): Rules
    {
        $model = new self([
            'name' => $data['name'],
            'agency_id' => $data['agency_id'],
            'text' => $data['text'],
            'is_active' => isset($data['is_active']) ? self::IS_ACTIVE : self::IS_NOT_ACTIVE,
        ]);
        $model->save();

        return $model;
    }

    /**
     * @deprecated
     * @param array $data
     * @param int $id
     * @return int
     */
    public static function updateModel(array $data, int $id): int
    {
        $model = self::find(['id' => $id])->first();
        $model->name = $data['name'];
        $model->agency_id = $data['agency_id'];
        $model->condition_id = $id;
        $model->text = $data['text'];
        $model->is_active = isset($data['is_active']) ? self::IS_ACTIVE : self::IS_NOT_ACTIVE;
        $model->equality = $data['equality'];
        $model->save();
        return $model->id;
    }

    public function agency(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Agencies::class, 'id', 'agency_id');
    }

    public function conditions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Conditions::class, 'rules_condition', 'rule_id', 'condition_id');
    }
}
