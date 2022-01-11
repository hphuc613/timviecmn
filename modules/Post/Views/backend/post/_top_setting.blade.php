<div id="form-top-setting">
    <form action="" method="post" id="add-top-post">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cate_id" class="title">Top</label>
                    {!! Form::select('top_option', $top_options,  NULL, [
                        'id' => 'top_option',
                        'class' => 'select2 form-control']) !!}
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group" id="post-dropdown">
                    <label for="post_id" class="title">{{ trans('Post') }}</label>
                    {!! Form::select('post_id', $posts, NULL, [
                        'id' => 'post_id',
                        'class' => 'select2 form-control']) !!}
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">{{ trans('Save') }}</button>
            </div>
        </div>
        <hr>
        <div id="top-listing">
            <div class="top-post-list mb-5">
                <h5>Top 1</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>{{ trans('Post') }}</th>
                        <th style="width: 150px" class="text-center">{{ trans('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($top1_posts as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center">
                                <a href="{{ route('get.post.delete_post_top_setting', ['TOP_1', 'post_id' => $item->id]) }}"
                                   class="btn btn-danger delete-post">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="top-post-list">
                <h5>Top 2</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>{{ trans('Post') }}</th>
                        <th style="width: 150px" class="text-center">{{ trans('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($top2_posts as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center">
                                <a href="{{ route('get.post.delete_post_top_setting', ['TOP_2', 'post_id' => $item->id]) }}"
                                   class="btn btn-danger delete-post">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
