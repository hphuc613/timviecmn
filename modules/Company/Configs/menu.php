<?php
return [
    'name'       => trans('Company'),
    'route'      => route('get.company.list'),
    'sort'       => 3,
    'active'     => TRUE,
    'id'         => 'company',
    'icon'       => '<i class="fa fa-building-o" aria-hidden="true"></i>',
    'middleware' => ['company'],
    'group'      => []
];
