<?php

namespace Modules\Applicant\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use SoftDeletes;

    protected $table = "applicants";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    /**
     * @param $filter
     * @return Builder
     */
    public static function filter($filter) {
        $data = self::query();
        if (isset($filter['name'])) {
            $data = $data->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }
        if (isset($filter['email'])) {
            $data = $data->where('email', 'LIKE', '%' . $filter['email'] . '%');
        }
        if (isset($filter['phone'])) {
            $data = $data->where('phone', 'LIKE', '%' . $filter['phone'] . '%');
        }
        if (isset($filter['status'])) {
            $data = $data->where('status', $filter['status']);
        }

        return $data;
    }
}
