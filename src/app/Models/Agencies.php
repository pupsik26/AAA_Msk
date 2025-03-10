<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property Rule[] $rules
 * @property AgencyHotelOption[] $agencyHotelOptions
 */
class Agencies extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rules()
    {
        return $this->hasMany('App\Models\Rule');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agencyHotelOptions()
    {
        return $this->hasMany('App\Models\AgencyHotelOption');
    }

    public static function getAgenciesList(): array
    {
        $data = Agencies::all();
        if ($data->isNotEmpty()) {
            return $data->toArray();
        }
        return [];
    }
}
