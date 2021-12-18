<form action="" method="post" id="applicant-form" enctype=multipart/form-data>
    @csrf
    @php($prompt = ['' => trans('Select')])
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="title">{{ trans('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="slug" class="title">{{ trans('Slug') }}</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ $data->slug ?? NULL }}" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" class="title">{{ trans('Status') }}</label>
                {!! Form::select('status', $statuses, $data->status ?? NULL, [
                    'id' => 'status',
                    'class' => 'select2 form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="email" class="title">{{ trans('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $data->email ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="address" class="title">{{ trans('Address') }}</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $data->address ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="phone" class="title">{{ trans('Phone') }}</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone ?? NULL }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="birthday" class="title">{{ trans('Birthday') }}</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="{{isset($data->birthday) ? date('Y-m-d',strtotime($data->birthday)) : NULL }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="website" class="title">{{ trans('Website') }}</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $data->website ?? NULL }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="start_date" class="title">{{ trans('Start Date') }}</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{isset($data->start_date) ? date('Y-m-d',strtotime($data->start_date)) : NULL }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="expected_salary" class="title">{{ trans('Expected Salary') }}</label>
                <input type="text" class="form-control" id="expected_salary" name="expected_salary" value="{{ $data->expected_salary ?? NULL }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="experience" class="title">{{ trans('Experience') }}</label>
                <textarea name="experience" id="experience" class="form-control" rows="10">{{ $data->experience ?? NULL }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="resume" class="title">{{ trans('Resume') }}</label>
                <textarea name="resume" id="resume" class="form-control" rows="10">{{ $data->resume ?? NULL }}</textarea>
            </div>
        </div>
    </div>
    @if(isset($data))
        <div class="col-md-9">
            {{--                <div class="form-group">--}}
            {{--                    <label for="tags" class="title">{{ trans('Updated By') }}</label>--}}
            {{--                    <div>{{ $data->updatedBy->name ?? "N/A" }}</div>--}}
            {{--                </div>--}}
            <div class="form-group">
                <label for="tags" class="title">{{ trans('Updated At') }}</label>
                <div>{{ formatDate(strtotime($data->updated_at), 'd-m-Y H:i:s') }}</div>
            </div>
            {{--                <div class="form-group">--}}
            {{--                    <label for="tags" class="title">{{ trans('Created By') }}</label>--}}
            {{--                    <div>{{ $data->author->name ?? "N/A" }}</div>--}}
            {{--                </div>--}}
            <div class="form-group">
                <label for="tags" class="title">{{ trans('Created At') }}</label>
                <div>{{ formatDate(strtotime($data->created_at), 'd-m-Y H:i:s') }}</div>
            </div>
        </div>
    @endif
    <div class="input-group">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
@push('js')
    {!! JsValidator::formRequest('Modules\Applicant\Requests\ApplicantRequest','#applicant-form') !!}

    <script !src="">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.tag-select2').select2({
                tags: true
            })
        })
    </script>
@endpush
