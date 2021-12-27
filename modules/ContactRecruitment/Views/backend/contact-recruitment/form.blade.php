<div>
    {{ csrf_field() }}
    <div class="px-4">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">{{ trans('Name') }}</label>
                <div>{{ $cr_data->name ?? NULL }}</div>
            </div>
            <div class="form-group col-md-6">
                <label for="career">{{ trans('Career') }}</label>
                <div>{{ $cr_data->career->name ?? NULL }}</div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">{{ trans('Email') }}</label>
                <div>{{ $cr_data->email ?? NULL }}</div>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">{{ trans('Phone') }}</label>
                <div>{{ $cr_data->phone ?? NULL }}</div>
            </div>
            <div class="form-group col-md-12">
                <label for="address">{{ trans('Address') }}</label>
                <div>{{ $cr_data->address ?? NULL }}</div>
            </div>
            <div class="form-group col-md-12">
                <label for="content">{{ trans('Content') }}</label>
                <textarea name="content" class="form-control" id="content" rows="6"
                          style="background-color: transparent" readonly>{{ $cr_data->content ?? NULL }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="status" class="title">{{ trans('Status') }}</label>
                </div>
                <div class="col-md-6">
                    <h4>{{ $cr_statuses[$cr_data->status] }}</h4>
                </div>
            </div>
        </div>
        @if(isset($cr_data->created_at) || isset($cr_data->updated_at))
            <div class="d-flex">
                <div class="form-group w-50">
                    <label for="tags" class="title">{{ trans('Updated At') }}</label>
                    <div>{{ formatDate(strtotime($cr_data->updated_at), 'd-m-Y H:i:s') }}</div>
                </div>
                <div class="form-group w-50">
                    <label for="tags" class="title">{{ trans('Created At') }}</label>
                    <div>{{ formatDate(strtotime($cr_data->created_at), 'd-m-Y H:i:s') }}</div>
                </div>
            </div>
        @endif
    </div>
</div>
