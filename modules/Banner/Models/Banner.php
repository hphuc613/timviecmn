<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $table = "banners";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    const HOME_PAGE = 'Home Page';

    /**
     * @return array
     */
    public static function getPageList(){
        return [
            'HOME_PAGE' => self::HOME_PAGE
        ];
    }

}
