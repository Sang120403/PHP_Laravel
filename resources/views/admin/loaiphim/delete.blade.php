<form action="admin/loaiphim/delete/{{ $value['id_loai_phim'] }}" method="POST">
    @csrf
    <div class="modal fade" id="deleteModal{{ $value['id_loai_phim'] }}" tabindex="-1" aria-labelledby="deleteModalLable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLable">@lang('lang.movie_genre')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                                <h3>Ban Co Muon Xoa Khong?</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
