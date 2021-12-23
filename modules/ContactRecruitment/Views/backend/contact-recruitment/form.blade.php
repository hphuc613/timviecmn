<form action="" method="post">
    {{ csrf_field() }}
    <div class="px-4">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">{{ trans('Name') }}</label>
                <div>{{ $data->name ?? NULL }}</div>
                {{--                <input type="hidden" class="form-control" id="name" name="name" value="{{ $data->name ?? NULL }}">--}}
            </div>
            <div class="form-group col-md-6">
                <label for="career">{{ trans('Career') }}</label>
                <div>{{ $data->career->name ?? NULL }}</div>
                {{--                <input type="hidden" class="form-control" id="career_id" name="career_id" value="{{ $data->career_id ?? NULL }}">--}}
            </div>
            <div class="form-group col-md-6">
                <label for="email">{{ trans('Email') }}</label>
                <div>{{ $data->email ?? NULL }}</div>
                {{--                <input type="hidden" class="form-control" id="email" name="email" value="{{ $data->email ?? NULL }}">--}}
            </div>
            <div class="form-group col-md-6">
                <label for="phone">{{ trans('Phone') }}</label>
                <div>{{ $data->phone ?? NULL }}</div>
                {{--                <input type="hidden" class="form-control" id="phone" name="phone" value="{{ $data->phone ?? NULL }}">--}}
            </div>
            <div class="form-group col-md-12">
                <label for="address">{{ trans('Address') }}</label>
                <div>{{ $data->address ?? NULL }}</div>
                {{--                <input type="hidden" class="form-control" id="address" name="address" value="{{ $data->address ?? NULL }}">--}}
            </div>
            <div class="form-group col-md-12">
                <label for="content">{{ trans('Content') }}</label>
                <textarea name="content" class="form-control" id="content" rows="6" style="background-color: transparent" readonly>{{ $data->content ?? NULL }}</textarea>
            </div>
        </div>
        @php($prompt = ['' => trans('Select')])
        <div class="form-group">
            <label for="status" class="title">{{ trans('Status') }}</label>
            {!! Form::select('status', $statuses, $data->status ?? NULL, [
                'id' => 'status',
                'class' => 'select2 form-control']) !!}
        </div>
        @if(isset($data->created_at) || isset($data->updated_at))
            <div class="d-flex">
                <div class="form-group w-50">
                    <label for="tags" class="title">{{ trans('Updated At') }}</label>
                    <div>{{ formatDate(strtotime($data->updated_at), 'd-m-Y H:i:s') }}</div>
                </div>
                <div class="form-group w-50">
                    <label for="tags" class="title">{{ trans('Created At') }}</label>
                    <div>{{ formatDate(strtotime($data->created_at), 'd-m-Y H:i:s') }}</div>
                </div>
            </div>
        @endif

        <div class="text-center">
            <button type="submit" class="btn btn-info">{{ trans("Update") }}</button>
        </div>
    </div>
</form>
