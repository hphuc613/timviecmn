<?php
return [
    'name' => trans('Member'),
    'route' => route('get.member.list'),
    'sort' => 2,
    'active'=> FALSE,
    'id'=> 'member',
    'icon' => '<i class="icon-people"></i>',
    'middleware' => ['member'],
    'group' => []
];
