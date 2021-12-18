<?php

namespace Modules\Career\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Company\Models\Company;
use Modules\ContactRecruitment\Models\ContactRecruitment;

class Career extends BaseModel
{
    use SoftDeletes;

    protected $table = "careers";

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
        if (isset($filter['status'])) {
            $data = $data->where('status', $filter['status']);
        }

        return $data;
    }

    /**
     * @return HasMany
     */
    public function companys() {
        return $this->hasMany(Company::class, 'career_id');
    }

    /**
     * @return HasMany
     */
    public function contactrecruiments() {
        return $this->hasMany(ContactRecruitment::class, 'career_id');
    }
}
