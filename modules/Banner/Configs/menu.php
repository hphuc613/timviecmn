<?php
return [
    'name' => trans('Banner'),
    'route' => route('get.banner.list'),
    'sort' => 12,
    'active'=> TRUE,
    'id'=> 'banner',
    'icon' => '<i class="fa fa-plus"></i>',
    'middleware' => ['banner'],
    'group' => []
];
