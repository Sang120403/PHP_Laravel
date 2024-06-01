<!-- Search bar -->
<div class="py-4 container-lg d-lg-flex justify-content-end" style="background: #ffffff">
    <div class="row">
        <form action="/search" method="get">
            <div class="input-group col-5 float-end">
                <input type="text" class="form-control" name="word" placeholder="Nhập từ khóa..." aria-label="search">
                <button class="btn btn-danger" type="submit">
                    @lang('lang.search')
                </button>
            </div>
        </form>
    </div>
</div>

