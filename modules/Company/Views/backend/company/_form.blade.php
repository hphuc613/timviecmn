@php($action = (isset($data) && !empty($data)) ? route('post.company.update', $data->id) : route('post.company.create'))
<form action="{{ $action }}" method="post" class="" id="company-form" enctype=multipart/form-data>
    @csrf
    @php($prompt = ['' => trans('Select')])

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="title">{{ trans('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? NULL }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="slug" class="title">{{ trans('Slug') }}</label>
                <input type="text" class="form-control" id="slug" name="slug"
                       value="{{ $data->slug ?? old('slug') }}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="career_id" class="title">{{ trans('Career') }}</label>
                {!! Form::select('career_id', $prompt + $careers, $data->career_id ?? NULL, [
                    'id' => 'career_id',
                    'class' => 'select2 form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="career_id" class="title">{{ trans('City') }}</label>
                {!! Form::select('city_id', $prompt + $cities, $data->city_id ?? NULL, [
                    'id' => 'city_id',
                    'class' => 'select2 form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone" class="title">{{ trans('Phone') }}</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       value="{{ $data->phone ?? NULL }}">
            </div>
            <div class="form-group">
                <label for="email" class="title">{{ trans('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ $data->email ?? NULL }}">
            </div>
            <div class="form-group">
                <label for="address" class="title">{{ trans('Address') }}</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="{{ $data->address ?? NULL }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="status" class="title">{{ trans('Status') }}</label>
                {!! Form::select('status', $statuses, $data->status ?? NULL, [
                    'id' => 'status',
                    'class' => 'select2 form-control']) !!}
            </div>
            <div class="form-group">
                <label for="logo" class="title">{{ trans('Logo') }}</label>
                <input type="file" id="logo" class="dropify" name="logo"
                       data-default-file="{{ asset($data->logo ?? NULL) }}"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="remarks" class="title">{{ trans('Remarks') }}</label>
                <textarea name="remarks" id="remarks" class="form-control"
                          rows="10">{{ $data->remarks ?? NULL }}</textarea>
            </div>
        </div>
    </div>
    <div class="input-group">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
@push('js')
    {!! JsValidator::formRequest('Modules\Company\Requests\CompanyRequest','#company-form') !!}

    <script !src="">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.tag-select2').select2({
                tags: true
            })
        })
    </script>
@endpush
