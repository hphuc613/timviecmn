<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Career\Models\Career;

class Company extends BaseModel {
    use SoftDeletes;

    protected $table = "companys";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    /**
     * @param $filter
     * @return Builder
     */
    public static function filter($filter) {
        $data = self::query()->with('career');
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

        return $data;
    }

    /**
     * @return BelongsTo
     */
    public function career() {
        return $this->belongsTo(Career::class, 'career_id');
    }
}
