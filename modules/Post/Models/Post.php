<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Modules\Base\Models\BaseModel;
use Modules\Career\Models\Career;
use Modules\City\Models\City;
use Modules\Company\Models\Company;
use Modules\Position\Models\Position;
use Modules\Tag\Models\Tag;
use Modules\User\Models\User;

class Post extends BaseModel {

    use SoftDeletes;

    protected $table = "posts";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = TRUE;

    const HTLV_FULL_TIME = "FULL_TIME";

    const HTLV_PART_TIME = "PART_TIME";

    const HTLV_INTERN = "INTERN";

    const HTLV_REMOTE = "REMOTE";

    protected static function boot() {
        parent::boot();

        $author_id = Auth::guard('admin')->user()->id ?? 1;
        static::creating(function ($model) use ($author_id) {
            $model->created_by = $author_id;
            $model->updated_by = $author_id;
        });

        static::updating(function ($model) use ($author_id) {
            $model->updated_by = $author_id;
        });
    }

    /**
     * @param $filter
     *
     * @return Builder
     */
    public static function filter($filter) {
        $data = self::query()->with('category')->with('author')->with('updatedBy');
        if (isset($filter['title'])) {
            $data = $data->where('title', 'LIKE', '%' . $filter['title'] . '%');
        }
        if (isset($filter['company'])) {
            $data = $data->whereHas('company', function ($c) use ($filter) {
                $c->where('name', 'LIKE', '%' . $filter['company'] . '%');
            });
        }
        if (isset($filter['career'])) {
            $data = $data->whereHas('company', function ($c) use ($filter) {
                $career = Career::query()->where('slug', $filter['career'])->first();
                if (!empty($career)) {
                    $c->where('career_id', $career->id);
                }
            });
        }
        if (isset($filter['city'])) {
            $data = $data->whereHas('company', function ($c) use ($filter) {
                $city = City::query()->where('slug', $filter['city'])->first();
                if (!empty($city)) {
                    $c->where('city_id', $city->id);
                }
            });
        }
        if (isset($filter['working_form'])) {
            $data = $data->where('work_type', $filter['working_form']);
        }
        if (isset($filter['position'])) {
            $position = Position::query()->where('slug', $filter['position'])->first();
            if (!empty($position)) {
                $data = $data->where('position_id', $position->id);
            }
        }
        if (isset($filter['company_id'])) {
            $data = $data->where('company_id', $filter['company_id']);
        }
        if (isset($filter['position_id'])) {
            $data = $data->where('position_id', $filter['position_id']);
        }
        if (isset($filter['status'])) {
            $data = $data->where('status', $filter['status']);
        }
        if (isset($filter['created_by'])) {
            $data = $data->where('created_by', $filter['created_by']);
        }

        return $data;
    }

    /**
     * @return BelongsTo
     */
    public function category() {
        return $this->belongsTo(PostCategory::class, 'cate_id');
    }

    /**
     * @return BelongsTo
     */
    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @return MorphToMany
     */
    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return BelongsTo
     */
    public function author() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }


    public static function getWorkTypes() {
        return [
            self::HTLV_FULL_TIME => trans('Full Time'),
            self::HTLV_PART_TIME => trans('Part Time'),
            self::HTLV_INTERN    => trans('Intern'),
            self::HTLV_REMOTE    => trans('Remote'),
        ];
    }

    /**
     * @param $key
     *
     * @return string
     */
    public static function getWorkType($key) {
        if (array_key_exists($key, self::getWorkTypes())) {
            return self::getWorkTypes()[$key];
        }
    }
}
