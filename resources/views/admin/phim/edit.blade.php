@extends('admin.layout.index')
@section('content')
    {{-- @can('movies') --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="post" action="/admin/phim/edit/{!! $phim['id_phim'] !!}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">@lang('lang.movies')</p>
                                <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto">@lang('lang.submit')</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">@lang('lang.edit')</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tenphim" class="form-control-label">@lang('lang.movie_name')</label>
                                        <input class="form-control" name="tenphim" id="tenphim" type="text" value="{!! $phim['ten_phim'] !!}" placeholder="@lang('lang.movie_name')">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="thoiluongphim">@lang('lang.showtime')</label>
                                        <input id="thoiluongphim" class="form-control" name="thoiluongphim" type="number" value="{!! $phim['thoi_luong_phim'] !!}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="quocgiasx" class="form-control-label">@lang('lang.national')</label>
                                        <select class="form-select" name="quocgiasx" id="quocgiasx">
                                            <option value="">@lang('lang.national')</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Aland Islands">Quần đảo Aland</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Nam Cực</option>
                                            <option value="Antigua and Barbuda">Antigua và Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Châu Úc</option>
                                            <option value="Austria">Áo</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">nước Bỉ</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius và Saba</option>
                                            <option value="Bosnia and Herzegovina">Bosnia và Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Đảo Bouvet</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">Lãnh thổ Ấn Độ Dương thuộc Anh</option>
                                            <option value="Brunei Darussalam">Vương quốc Bru-nây</option>
                                            <option value="Bulgaria">Bungari</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Campuchia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Quần đảo Cayman</option>
                                            <option value="Central African Republic">Cộng hòa trung phi</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">Trung Quốc</option>
                                            <option value="Christmas Island">Đảo giáng sinh</option>
                                            <option value="Cocos (Keeling) Islands">Quần đảo Cocos (Keeling)</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, Democratic Republic of the Congo">Congo, Cộng hòa Dân chủ Congo</option>
                                            <option value="Cook Islands">Quần đảo Cook</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Curacao">rượu cam bì</option>
                                            <option value="Cyprus">Síp</option>
                                            <option value="Czech Republic">Cộng hòa Séc</option>
                                            <option value="Denmark">Đan mạch</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Cộng hòa Dominica</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Ai cập</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Quần đảo Falkland (Malvinas)</option>
                                            <option value="Faroe Islands">Quần đảo Faroe</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Phần Lan</option>
                                            <option value="France">Nước pháp</option>
                                            <option value="French Guiana">Guiana thuộc Pháp</option>
                                            <option value="French Polynesia">Polynesia thuộc Pháp</option>
                                            <option value="French Southern Territories">Lãnh thổ phía Nam của Pháp</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">nước Đức</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Hy Lạp</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Đảo Heard và Quần đảo McDonald</option>
                                            <option value="Holy See (Vatican City State)">Tòa thánh (Nhà nước thành phố Vatican)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hồng Kông</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Nước Iceland</option>
                                            <option value="India">Ấn Độ</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran (Cộng hòa Hồi giáo</option>
                                            <option value="Iraq">I-rắc</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Đảo Man</option>
                                            <option value="Israel">Người israel</option>
                                            <option value="Italy">Nước Ý</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Nhật Bản</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Hàn Quốc, Cộng hòa Dân chủ Nhân dân</option>
                                            <option value="Korea, Republic of">Hàn Quốc, Cộng hòa</option>
                                            <option value="Kosovo">Kosovo</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Cộng hòa Dân chủ nhân dân Lào</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, the Former Yugoslav Republic of">Macedonia, Cộng hòa Nam Tư cũ của</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">đảo Marshall</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Liên bang</option>
                                            <option value="Moldova, Republic of">Moldova, Cộng hòa</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mông Cổ</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Maroc</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">nước Hà Lan</option>
                                            <option value="Netherlands Antilles">Đảo Antilles của Hà Lan</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Đảo Norfolk</option>
                                            <option value="Northern Mariana Islands">Quần đảo Bắc Mariana</option>
                                            <option value="Norway">Na Uy</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Lãnh thổ Palestine, bị chiếm đóng</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Phi-líp-pin</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Ba lan</option>
                                            <option value="Portugal">Bồ Đào Nha</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Sum họp</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Liên bang Nga</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Barthelemy">Saint Barthelemy</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts và Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Martin">Saint martin</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre và Miquelon</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent và Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome và Principe</option>
                                            <option value="Saudi Arabia">Ả Rập Saudi</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Xéc-bi-a</option>
                                            <option value="Serbia and Montenegro">Serbia và Montenegro</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Sint Maarten">St Martin</option>
                                            <option value="Slovakia">Xlô-va-ki-a</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Quần đảo Solomon</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">Nam Phi</option>
                                            <option value="South Georgia and the South Sandwich Islands">Nam Georgia và Quần đảo Nam Sandwich</option>
                                            <option value="South Sudan">phía nam Sudan</option>
                                            <option value="Spain">Tây ban nha</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard và Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Thụy Điển</option>
                                            <option value="Switzerland">Thụy sĩ</option>
                                            <option value="Syrian Arab Republic">Cộng Hòa Arab Syrian</option>
                                            <option value="Taiwan, Province of China">Đài Loan, tỉnh của Trung Quốc</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, Cộng hòa Thống nhất</option>
                                            <option value="Thailand">nước Thái Lan</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo">Đi</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad và Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">gà tây</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Quần đảo Turks và Caicos</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">các Tiểu Vương Quốc Ả Rập Thống Nhất</option>
                                            <option value="United Kingdom">Vương quốc Anh</option>
                                            <option value="United States">Hoa Kỳ</option>
                                            <option value="United States Minor Outlying Islands">Các đảo nhỏ xa xôi hẻo lánh của Hoa Kỳ</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">U-dơ-bê-ki-xtan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Việt Nam</option>
                                            <option value="Virgin Islands, British">Quần đảo Virgin thuộc Anh</option>
                                            <option value="Virgin Islands, U.s.">Quần đảo Virgin, Hoa Kỳ</option>
                                            <option value="Wallis and Futuna">Wallis và Futuna</option>
                                            <option value="Western Sahara">Phía tây Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="daodiens" class="form-control-label">@lang('lang.directors')</label>
                                        <select id="daodiens" class="form-control director-input" name="daodiens[]" multiple>
                                            @foreach($daodiens as $item)
                                                <option value="{{ $item->id_dao_dien }}">{!! $item->ten_dao_dien !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ngayphathanh" class="form-control-label">@lang('lang.release_date')</label>
                                        <input name="ngayphathanh"  id="ngayphathanh" class="form-control datepicker" value="{!! $phim['ngay_phat_hanh'] !!}"  type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ngayketthuc" class="form-control-label">@lang('lang.end_date')</label>
                                        <input id="ngayketthuc" name="ngayketthuc" class="form-control datepicker" value="{!! $phim['ngay_ket_thuc'] !!}"  type="text">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="gioihandotuoi" class="form-label">@lang('lang.rated')</label>
                                        <select id="gioihandotuoi" class="form-select" name="gioihandotuoi">
                                            @foreach($gioihandotuois as $item)
                                                <option
                                                @if(isset($phim))
                                                    @if($phim['id_gioi_han_do_tuoi'] == $item['id_gioi_han_do_tuoi'])
                                                       selected
                                                    @endif
                                                @endif
                                                value="{{ $item->id_gioi_han_do_tuoi }}" class="fw-bold" title="{{ $item->mieu_ta }}">{{ $item->ten_gioi_han}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    // In giá trị của biến $gioihandotuoi ra console
                                </script>
                                <div class="col-md-6">
                                    <div class="form-group file-uploader">
                                        <label for="movieImage" class="form-label">@lang('lang.image')</label>
                                        <input id="movieImage" type="file" name="image" class="form-control image-movie">
                                        @if(request()->hasFile('image'))
                                            hihi
                                        <!-- Nếu người dùng đã chọn một file mới để tải lên -->
                                        <img style="width: 300px" src="{{ asset('images_phim/'. $phim['image']) }}" class="img_movie" alt="user1">
                                            <!-- Nếu người dùng không chọn file mới, hiển thị ảnh cũ -->
                                            @else
                                            <img style="width: 300px" src="{{ asset('images_phim/'. $phim['image']) }}" class="img_movie" alt="user2">
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="trailer" class="form-label">Trailer</label>
                                        <input class="form-control" name="trailer" placeholder="https://www.youtube.com/watch?v=" value="{!! $phim['trailer'] !!}"/>
                                        <iframe style="height: 450px;" width="700px" src="@if(isset($phim['trailer']))
                                            https://www.youtube.com/embed/{!! $phim['trailer'] !!}
                                            @endif" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dienviens" class="form-label">@lang('lang.casts')</label>
                                        <select id="dienviens" class="form-control cast-input" name="dienviens[]" multiple>
                                            @foreach($dienviens as $item)
                                                <option value="{{ $item->id_dien_vien }}">{{ $item->ten_dien_vien }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="loaiphims">@lang('lang.genre')</label>
                                        <select id="loaiphims" class="form-select cast-input" name="loaiphims[]" multiple>
                                            @foreach($loaiphims as $item)
                                                <option value="{{ $item->id_loai_phim }}">{{ $item->ten_loai_phim }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mieuta" class="form-label">@lang('lang.description')</label>
                                        <textarea class="form-control" name="mieuta" id="editor"
                                                  placeholder="mieuta">{!! $phim['mieu_ta'] !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @else
        <h1 align="center">Permissions Deny</h1>
    @endcan --}}
@endsection
@section('scripts')
    <script>
        flatpickr(  $("#ngayketthuc"),{
            dateFormat: "Y-m-d ",
            "locale": "@lang('lang.language')"
        });
        flatpickr(  $("#ngayphathanh"),{
            dateFormat: "Y-m-d ",
            "locale": "@lang('lang.language')"
        });
        $(document).ready(function () {
            $("#quocgiasx option[value='{!! $phim['quoc_giasx'] !!}']").prop("selected",true);

            $('.director-input').val([
                @foreach($phim['daodiens'] as $director)
                {!! $director['id_dao_dien'] !!},
                    @endforeach
            ]);

            $('.cast-input').val([
                @foreach($phim['dienviens'] as $cast)
                {!! $cast['id_dien_vien'] !!},
                @endforeach
            ]);

            $('.director-input').select2({
                tags: true
            });

            $('.cast-input').select2({
                tags: true
            });

            $('#quocgiasx').select2();
        });
    </script>
    <script>
        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function (e) {
        //             $('.file-uploader .img_movie').attr('src', e.target.result).removeClass('d-none');
        //         }
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

        // $(".image-movie").change(function () {
        //     readURL(this);
        // });
    </script>
@endsection
