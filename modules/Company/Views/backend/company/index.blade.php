@extends("Base::backend.master")

@section("content")
    <div id="company-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans("Company") }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("Home") }}</a></li>
                        <li class="breadcrumb-item active">{{ trans("Company") }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-3 btn-group">
            <a href="{{ route('get.company.list', array_merge(request()->query(), ['export' => true])) }}"
               class="btn btn-warning mr-2">{{ trans('Export') }}</a>
            <a href="{{ route('get.company.create') }}" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; {{ trans("Add New") }}
            </a>
        </div>
    </div>
    <!--Search box-->
    @php($prompt = ['' => trans('Select')])
    <div class="search-box">
        <div class="card">
            <div class="card-header" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false"
                 aria-controls="form-search-box">
                <div class="title">{{ trans("Search") }}</div>
            </div>
            <div class="card-body collapse show" id="form-search-box">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans("Company name") }}</label>
                                <input type="text" class="form-control" id="text-input" name="name" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans('Career') }}</label>
                                {!! Form::select('career', $prompt + $careers, $filter['career'] ?? NULL, ['class' => 'select2 form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans('City') }}</label>
                                {!! Form::select('city', $prompt + $cities, $filter['city'] ?? NULL, ['class' => 'select2 form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans("Email") }}</label>
                                <input type="text" class="form-control" id="text-input" name="email" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans("Address") }}</label>
                                <input type="text" class="form-control" id="text-input" name="address" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans("Phone") }}</label>
                                <input type="text" class="form-control" id="text-input" name="phone" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans('Status') }}</label>
                                {!! Form::select('status', $prompt + $statuses, $filter['status'] ?? NULL, ['class' => 'select2 form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn btn-info mr-2">{{ trans("Search") }}</button>
                        <button type="button" class="btn btn-default clear">{{ trans("Cancel") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="listing">
        <div class="card">
            <div class="card-body">
                <div class="sumary">
                    {!! summaryListing($data) !!}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('Name') }}</th>
                            <th>{{ trans('Career') }}</th>
                            <th>{{ trans('City') }}</th>
                            <th>{{ trans('Email') }}</th>
                            <th>{{ trans('Phone') }}</th>
                            <th>{{ trans('Address') }}</th>
                            <th>{{ trans('Status') }}</th>
                            <th>{{ trans('Created At') }}</th>
                            <th>{{ trans('Updated At') }}</th>
                            <th class="action">{{ trans('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                        @foreach($data as $item)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{ trans($item->name) }}</td>
                                <td>{{!empty($item->career->name) ? trans($item->career->name) : NULL}}</td>
                                <td>{{!empty($item->city->name) ? trans($item->city->name) : NULL }}</td>
                                <td>{{ trans($item->email) }}</td>
                                <td>{{ trans($item->phone) }}</td>
                                <td>{{ trans($item->address) }}</td>
                                <td>{{ \Modules\Base\Models\Status::getStatus($item->status) ?? NULL }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s')}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s')}}</td>
                                <td class="link-action">
                                    <a href="{{ route('get.company.update', $item->id) }}" class="btn btn-primary"
                                       data-title="{{ trans("Update Company") }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="{{ route('get.company.delete', $item->id) }}"
                                       class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 pagination-style">
                        {{ $data->withQueryString()->render("vendor/pagination/default") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! getModal(["class" => "modal-ajax"]) !!}
@endsection
