<?php
return [
    'name'       => trans('Position'),
    'route'      => route('get.position.list'),
    'sort'       => 5,
    'active'     => TRUE,
    'id'         => 'position',
    'icon'       => '<i class="fa fa-sitemap" aria-hidden="true"></i>',
    'middleware' => ['position'],
    'group'      => []
];
