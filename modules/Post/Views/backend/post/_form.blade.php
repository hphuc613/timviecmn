<form action="" method="post" class="form-material" id="post-form" enctype=multipart/form-data>
    @csrf
    @php($prompt = ['' => trans('Select')])
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="title">{{ trans('Title') }}</label>
                <input type="text" class="form-control form-control-line" id="title" name="title" value="{{ $data->title ?? NULL }}">
            </div>
        </div>
        <div class="col-md-3 form-group">
            <label for="position" class="title">{{ trans('Position') }}
                <a href="javascript:" id="position-refresh"><i class="fa fa-refresh" aria-hidden="true"></i></a>
            </label>
            @php($position_selected = isset($data) ? json_decode(!empty($data->position_ids) ? $data->position_ids : "[]", 1) : NULL)
            {!! Form::select('position_ids[]', $positions, $position_selected, [
                            'id' => 'position',
                            'multiple' => 'multiple',
                            'class' => 'select2 form-control w-100']) !!}
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="status" class="title">{{ trans('Status') }}</label>
                {!! Form::select('status', $statuses, $data->status ?? NULL, [
                    'id' => 'status',
                    'class' => 'select2 form-control w-100']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="slug" class="title">{{ trans('Slug') }}</label>
                <input type="text" class="form-control" id="slug" value="{{ $data->slug ?? NULL }}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cate_id" class="title">{{ trans('Company') }}</label>
                {!! Form::select('company_id', $prompt + $companies, $data->company_id ?? NULL, [
                    'id' => 'company_id',
                    'class' => 'select2 form-control']) !!}
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="description" class="title">{{ trans('Description') }}</label>
                <textarea name="description" id="description" class="form-control" rows="10">{{ $data->description ?? NULL }}</textarea>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="image" class="title">{{ trans('Image') }}</label>
                <input type="file" id="image" class="dropify" name="image" data-default-file="{{ asset($data->image ?? NULL) }}"/>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="ckeditor" class="title">{{ trans('Content') }}</label>
                <textarea name="content" id="ckeditor">{{ $data->content ?? NULL }}</textarea>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="input-file-now-custom-1" class="title">{{ trans('Tag') }}</label>
                @php($tag_selected = isset($data) ? $data->tags->pluck("name")->toArray() : NULL)
                {!! Form::select('tags[][name]', $tags, $tag_selected, [
                    'id' => 'tags',
                    'multiple' => 'multiple',
                    'class' => 'tag-select2 form-control']) !!}
            </div>
            <div class="form-group">
                <label for="work_type" class="work_type">{{ trans('Work Type') }}</label>
                {!! Form::select('work_type', $prompt + $work_type, $data->work_type ?? NULL, [
                    'id' => 'work_type',
                    'class' => 'select2 form-control']) !!}
            </div>
            <div class="form-group">
                <label for="is_hot" class="title">{{ trans('Hot Post') }}</label>
                <div class="w-100">
                    <label class="switch-hot mb-0">
                        <input type="checkbox" name="is_hot" value="1" {{isset($data->is_hot) && $data->is_hot == 1 ? 'checked' : ''}}>
                        <span class="slider-round"></span>
                    </label>
                </div>
            </div>
            @if(isset($data))
                <div class="form-group">
                    <label for="tags" class="title">{{ trans('Updated By') }}</label>
                    <div>{{ $data->updatedBy->name ?? "N/A" }}</div>
                </div>
                <div class="form-group">
                    <label for="tags" class="title">{{ trans('Updated At') }}</label>
                    <div>{{ formatDate(strtotime($data->updated_at), 'd-m-Y H:i:s') }}</div>
                </div>
                <div class="form-group">
                    <label for="tags" class="title">{{ trans('Created By') }}</label>
                    <div>{{ $data->author->name ?? "N/A" }}</div>
                </div>
                <div class="form-group">
                    <label for="tags" class="title">{{ trans('Created At') }}</label>
                    <div>{{ formatDate(strtotime($data->created_at), 'd-m-Y H:i:s') }}</div>
                </div>
            @endif
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
@push('js')
    {!! JsValidator::formRequest('Modules\Post\Requests\PostRequest','#post-form') !!}

    <script !src="">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.tag-select2').select2({
                tags: true
            });

            $(document).on('click', '#position-refresh', function () {
                var dropdown = $(this).parents('.form-group').find('#position');
                $.ajax({
                    url: "{{ route('get.post.updatePositionDropdown') }}",
                    type: "get"
                }).done(function (response) {
                    dropdown.find("option").remove();
                    dropdown.select2({
                        data: jQuery.parseJSON(response)
                    });
                })
            })
        })
    </script>
@endpush
