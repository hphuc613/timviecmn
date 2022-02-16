<form action="" method="post" id="import-form" enctype="multipart/form-data">
    @csrf
    <div class="input-group">
        <input name="file" type="file" id="file" class="upload-style w-100" accept=".xlsx, .xls, .csv, .ods">
        <label id="upload-display" class="d-block bg-info  w-100" for="file">
            <i class="fa fa-upload"></i>
            <span>{{ trans("Choose File...") }}</span>
        </label>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-success mr-2">{{ trans('Import') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
{!! JsValidator::formRequest('Modules\Applicant\Requests\ApplicantImportRequest', "#import-form")->ignore('file') !!}
