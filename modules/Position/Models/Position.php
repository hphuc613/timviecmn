<?php

namespace Modules\Position\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Career\Models\Career;

class Position extends BaseModel
{
    use SoftDeletes;

    protected $table = "positions";

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

    protected static function boot() {
        parent::boot();

        static::deleting(function ($position) {
            $position->careers->each->delete();
        });
    }

    /**
     * @return HasMany
     */
    public function careers() {
        return $this->hasMany(Career::class, 'position_id');
    }
}
