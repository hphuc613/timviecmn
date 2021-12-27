<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Career\Models\Career;
use Modules\City\Models\City;

class Company extends BaseModel {
    use SoftDeletes;

    protected $table = "companies";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    /**
     * @param $filter
     * @return Builder
     */
    public static function filter($filter) {
        $data = self::query()->with('career')->with('city');
        if (isset($filter['name'])) {
            $data = $data->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }
        if (isset($filter['email'])) {
            $data = $data->where('email', 'LIKE', '%' . $filter['email'] . '%');
        }
        if (isset($filter['address'])) {
            $data = $data->where('address', 'LIKE', '%' . $filter['address'] . '%');
        }
        if (isset($filter['phone'])) {
            $data = $data->where('phone', 'LIKE', '%' . $filter['phone'] . '%');
        }
        if (isset($filter['status'])) {
            $data = $data->where('status', $filter['status']);
        }
        if (isset($filter['career'])) {
            $data = $data->where('career_id', $filter['career']);
        }
        if (isset($filter['city'])) {
            $data = $data->where('city_id', $filter['city']);
        }

        return $data;
    }

    /**
     * @return BelongsTo
     */
    public function career() {
        return $this->belongsTo(Career::class, 'career_id');
    }

    /**
     * @return BelongsTo
     */
    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }
}
