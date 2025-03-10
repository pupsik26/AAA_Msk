<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 * @property integer $stars
 * @property City $city
 * @property AgencyHotelOption[] $agencyHotelOptions
 * @property HotelAgreement[] $hotelAgreements
 */
class Hotel extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['city_id', 'name', 'stars'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agencyHotelOptions()
    {
        return $this->hasMany('App\Models\AgencyHotelOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotelAgreements()
    {
        return $this->hasMany('App\Models\HotelAgreement');
    }
}
