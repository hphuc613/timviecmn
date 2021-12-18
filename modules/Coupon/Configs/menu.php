<?php
return [
    'name' => trans('Coupon'),
    'route' => route('get.coupon.list'),
    'sort' => 5,
    'active'=> FALSE,
    'id'=> 'coupon',
    'icon' => '<i style="display: inline-flex; align-items: center"><img src="' .asset('assets/backend/images/icon/coupon.png').'" width="15px" alt="coupon-icon"></i>',
    'middleware' => ['coupon'],
    'group' => []
];
