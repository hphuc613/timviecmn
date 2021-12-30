@extends("Base::backend.master")

@section("content")
    <div id="applicant-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans("Applicant") }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("Home") }}</a></li>
                        <li class="breadcrumb-item active">{{ trans("Applicant") }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{route('get.applicant.import')}}" class="btn btn-info mr-2" data-toggle="modal"
               data-title="{{ trans("Import") }}" data-target="#form-modal">
                <i class="fa fa-plus"></i>
                {{ trans("Import") }}
            </a>
            <a href="{{ route('get.applicant.list', array_merge(request()->query(), ['export' => true])) }}"
               class="btn btn-warning mr-2">{{ trans('Export') }}</a>
            <a href="{{ route('get.applicant.create') }}" class="btn btn-primary"
               data-title="{{ trans("Create Applicant") }}">
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
                                <label for="text-input">{{ trans("Applicant name") }}</label>
                                <input type="text" class="form-control" id="text-input" name="name" value="">
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
                                <label for="text-input">{{ trans("Post name") }}</label>
                                <input type="text" class="form-control" id="text-input" name="post_name" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">{{ trans('Status') }}</label>
                                {!! Form::select('status', $prompt + $statuses, $filter['status'] ?? NULL, ['class' => 'select2 form-control w-100']) !!}
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
                            <th>{{ trans('Post') }}</th>
                            <th>{{ trans('CV') }}</th>
                            <th>{{ trans('Email') }}</th>
                            <th>{{ trans('Phone') }}</th>
                            <th>{{ trans('Address') }}</th>
                            <th>{{ trans('Status') }}</th>
                            <th>{{ trans('Created At') }}</th>
                            <th class="action">{{ trans('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                        @foreach($data as $item)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{ trans($item->name) }}</td>
                                <td>
                                    @if(!empty($item->post_id) && !empty($item->post) && isset($item->post))
                                        <a href="{{ route('get.frontend.detail', [$item->post_id, $item->post->slug]) }}"
                                           class="w-100" target="_blank">{{ $item->post->title }}</a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($item->file))
                                        <a href="{{ asset($item->file) }}" class="w-100"
                                           target="_blank">{{ trans('CV file') }}</a>
                                    @endif
                                </td>
                                <td>{{ trans($item->email) }}</td>
                                <td>{{ trans($item->phone) }}</td>
                                <td>{{ trans($item->address) }}</td>
                                <td>
                                    {!! Form::select('status', $statuses, $item->status ?? NULL, ['class' => 'select2 update-status form-control', 'data-id' => $item->id]) !!}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s')}}</td>
                                <td class="link-action">
                                    <a href="{{ route('get.applicant.update', $item->id) }}" class="btn btn-primary"
                                       data-title="{{ trans("Update Applicant") }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="{{ route('get.applicant.delete', $item->id) }}"
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
@push('js')
    <script !src="">
        $(document).ready(function () {
            $('.update-status').on('change', function () {
                window.location.href = "{{ route('get.applicant.updateStatus', '') }}/" + $(this).attr("data-id") + "?status=" + $(this).val();
            })
        })
    </script>
@endpush
