<?php
return [
    'name' => trans('Applicant'),
    'route' => route('get.applicant.list'),
    'sort' => 3,
    'active'=> TRUE,
    'id'=> 'applicant',
    'icon' => '<i class="fa fa-address-book-o" aria-hidden="true"></i>',
    'middleware' => ['applicant'],
    'group' => []
];
