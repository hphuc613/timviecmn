<?php

namespace Modules\Applicant\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Position\Models\Position;
use Modules\Post\Models\Post;

class Applicant extends Model
{
    use SoftDeletes;

    protected $table = "applicants";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = TRUE;

    const STATUS_NOT_HIRED = 1;

    const STATUS_HIRED = 2;

    /**
     * @param $filter
     * @return Builder
     */
    public static function filter($filter){
        $data = self::query()->with('post');
        if (isset($filter['name'])){
            $data = $data->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }
        if (isset($filter['email'])){
            $data = $data->where('email', 'LIKE', '%' . $filter['email'] . '%');
        }
        if (isset($filter['phone'])){
            $data = $data->where('phone', 'LIKE', '%' . $filter['phone'] . '%');
        }
        if (isset($filter['status'])) {
            $data = $data->where('status', $filter['status']);
        }
        if (isset($filter['post_name'])){
            $data = $data->whereHas('post', function ($c) use ($filter) {
                $c->where('title', 'LIKE', '%' . $filter['post_name'] . '%');
            });
        }

        return $data;
    }

    public static function getStatuses(){
        return [
            self::STATUS_NOT_HIRED => trans('Not Hired'),
            self::STATUS_HIRED     => trans('Hired'),
        ];
    }

    /**
     * @param $status
     *
     * @return string
     */
    public static function getStatus($status){
        if (array_key_exists($status, self::getStatuses())){
            return self::getStatuses()[$status];
        }
    }

    /**
     * @return BelongsTo
     */
    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * @return BelongsTo
     */
    public function position() {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
