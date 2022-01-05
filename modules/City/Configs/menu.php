<?php
return [
    'name' => trans('City'),
    'route' => route('get.city.list'),
    'sort' => 2,
    'active'=> TRUE,
    'id'=> 'city',
    'icon' => '<i class="fa fa-location-arrow" aria-hidden="true"></i>',
    'middleware' => ['city'],
    'group' => []
];
