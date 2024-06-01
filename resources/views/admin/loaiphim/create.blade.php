<form action="admin/loaiphim/create" method="POST">
    @csrf
    <div class="modal fade" id="loai_phim" tabindex="-1" aria-labelledby="movie_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movie_title">@lang('lang.movie_genre')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">@lang('lang.genre')</label>
                                    <input class="form-control" type="text" value="" name="ten_loai_phim" placeholder="@lang('lang.type') @lang('lang.genre')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
                </div>
            </div>
        </div>
    </div>
</form>
