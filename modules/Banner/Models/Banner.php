<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model {
    use SoftDeletes;

    protected $table = "banners";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = TRUE;

    const HOME_PAGE    = 'HOME_PAGE';
    const LISTING_PAGE = 'LISTING_PAGE';
    const DETAIL_PAGE  = 'DETAIL_PAGE';
    const RECRUIT_FORM = 'RECRUIT_FORM';

    /**
     * @return array
     */
    public static function getPageList() {
        return [
            self::HOME_PAGE    => trans("Home Page"),
            self::LISTING_PAGE => trans("Listing Page"),
            self::DETAIL_PAGE  => trans("Detail Page"),
            self::RECRUIT_FORM => trans("Recruit Form"),
        ];
    }

    /**
     * @param $page_id
     * @return mixed
     */
    public static function getBanner($page_id) {
        return self::query()->where('page_id', $page_id)->first()->image ?? 'assets/backend/images/background/dark.jpg';
    }
}
