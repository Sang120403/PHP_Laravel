{{-- <div class="modal fade" id="movie_genre" tabindex="-1" aria-labelledby="movie_title" aria-hidden="true">
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
                                @foreach($loaiphims as $genre)
                                    <div class="form-check form-check-info text-start">
                                        <input class="form-check-input" type="checkbox"
                                               @if(isset($movie))
                                                   @foreach($movie['movieGenres'] as $value)
                                                       @if($value['id'] == $genre['id'])
                                                           checked
                                                       @endif
                                                   @endforeach
                                               @endif
                                               name="movieGenres[]" value="{{ $genre->id }}"
                                               id="movieGenres">
                                        <label class="form-check-label" for="movieGenres">
                                            {{ $genre->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.save')</button>
            </div>
        </div>
    </div>
</div> --}}
