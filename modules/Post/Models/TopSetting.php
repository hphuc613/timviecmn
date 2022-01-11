<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;

class TopSetting extends BaseModel {
    protected $table = "post_top_settings";

    protected $primaryKey = "id";

    protected $guarded = [];

    public $timestamps = false;

    const TOP_1 = "TOP_1";

    const TOP_2 = "TOP_2";

    /**
     * @return array
     */
    public static function getTopOption() {
        return [
            self::TOP_1 => 'Top 1',
            self::TOP_2 => 'Top 2',
        ];
    }
}
