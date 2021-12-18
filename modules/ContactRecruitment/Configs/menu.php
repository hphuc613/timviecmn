<?php
return [
    'name' => trans('Contact Recruitment'),
    'route' => route('get.contact_recruitment.list'),
    'sort' => 6,
    'active'=> TRUE,
    'id'=> 'contact_recruitment',
    'icon' => '<i class="fa fa-id-card-o" aria-hidden="true"></i>',
    'middleware' => ['contact_recruitment'],
    'group' => []
];
