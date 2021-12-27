<?php

namespace Modules\ContactRecruitment\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Career\Models\Career;

class ContactRecruitment extends Model{

    use SoftDeletes;

    protected $table = "contact_recruitments";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = TRUE;

    const STATUS_NEW = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_APPROVED = 3;

    /**
     * @param $filter
     *
     * @return Builder
     */
    public static function filter($filter){
        $data = self::query()->with('career');
        if (isset($filter['name'])){
            $data = $data->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }
        if (isset($filter['email'])){
            $data = $data->where('email', 'LIKE', '%' . $filter['email'] . '%');
        }
        if (isset($filter['address'])){
            $data = $data->where('address', 'LIKE', '%' . $filter['address'] . '%');
        }
        if (isset($filter['phone'])){
            $data = $data->where('phone', 'LIKE', '%' . $filter['phone'] . '%');
        }
        if (isset($filter['status'])){
            $data = $data->where('status', $filter['status']);
        }
        if (isset($filter['career'])){
            $data = $data->where('career_id', $filter['career']);
        }

        return $data;
    }

    /**
     * @return BelongsTo
     */
    public function career(){
        return $this->belongsTo(Career::class, 'career_id');
    }

    public static function getStatuses(){
        return [
            self::STATUS_NEW        => trans('New'),
            self::STATUS_PROCESSING => trans('Processing'),
            self::STATUS_APPROVED   => trans('Approved')
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
}
