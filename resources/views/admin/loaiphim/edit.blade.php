<form action="admin/loaiphim/edit/{{ $value['id_loai_phim'] }}" method="POST">
    @csrf
    <div class="modal fade" id="editModal{{ $value['id_loai_phim'] }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">@lang('lang.movie_genre')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ten_loai_phim" class="form-control-label">@lang('lang.genre')</label>
                                    <input class="form-control" id="ten_loai_phim" type="text" value="{{ $value['ten_loai_phim'] }}" name="ten_loai_phim">
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
