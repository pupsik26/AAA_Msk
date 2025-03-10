<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $condition
 * @property int $equality
 * @property string $created_at
 * @property string $updated_at
 *
 * */
class Conditions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function saveModel(Rules $rule, array $objects, array $conditions, array $equality): void
    {
        foreach ($objects as $key => $object) {
            $model = self::firstOrNew([
                'name' => $object,
                'condition' => $conditions[$key],
                'equality' => $equality[$key]
            ]);
            $model->name = $object;
            $model->condition = $conditions[$key];
            $model->equality = $equality[$key];
            $model->save();

            $rule->conditions()->attach($model->id);
        }
    }

    public static function updateModel(array $data, int $id): int
    {
        $model = self::firstOrNew(['id' => $id]);
        $model->name = $data['object'];
        $model->condition = $data['condition'];
        $model->save();
        return $model->id;
    }
}
