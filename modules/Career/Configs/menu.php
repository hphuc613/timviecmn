<?php
return [
    'name'       => trans('Career'),
    'route'      => route('get.career.list'),
    'sort'       => 4,
    'active'     => TRUE,
    'id'         => 'career',
    'icon'       => '<i class="fa fa-briefcase" aria-hidden="true"></i>',
    'middleware' => ['career'],
    'group'      => []
];
