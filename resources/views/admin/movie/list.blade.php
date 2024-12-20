@extends('admin.layout.index')
@section('content')
@can('movies')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>
                        Quản lý phim
                        <label for="search">
                            <input type="text" placeholder="Nhập tên phim..." class="form-controller" id="search" name="search" />
                        </label>
                    </h6>
                    <a href="admin/movie/create" style="float:right;padding-right:30px;">
                        <button class=" btn bg-gradient-success float-right mb-3">Thêm</button>
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Thể loại phim</th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Tên phim</th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Thời lượng</th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Quốc gia</th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Ngày phát hành</th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7">Ngày kết thúc</th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movies as $movie)
                                <tr>
                                    <td class="align-middle text-center">
                                        @foreach($movie->movieGenres as $genre)
                                        <h6 class="mb-0 text-sm ">{{ $genre->name }}</h6>
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center">
                                        @if(strstr($movie->image,"https") == "")
                                        <img style="width: 300px" src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{$movie->image}}.jpg" alt="user1">
                                        @else
                                        <img style="width: 300px" src="{{ $movie->image }}" alt="user1">
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="accordion-body mt-4 mb-3 w-100">
                                            {{ $movie->name }}
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold">{{ $movie->showTime }} @lang('lang.minutes')</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm ">{{ $movie->national }}</h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold">{!! date("d-m-Y", strtotime($movie->releaseDate )) !!}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold">{!! date("d-m-Y", strtotime($movie->endDate)) !!}</span>
                                    </td>
                                    <td id="status{!! $movie['id'] !!}" class="align-middle text-center text-sm">
                                        @if($movie['status'] == 1)
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $movie['id'] !!},0)">
                                            <span class="badge badge-sm bg-gradient-success">Online</span>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $movie['id'] !!},1)">
                                            <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="admin/movie/edit/{!! $movie['id'] !!}" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                    <a href="javascript:;" data-url="{{ url('admin/movie/delete', $movie['id'] ) }}" class="text-danger font-weight-bold text-xs delete-movie" data-toggle="tooltip"
                                    data-original-title="Delete movie">
                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                    </a>
                                    </td> 
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="paginate" class="d-flex justify-content-center mt-3">
                        {!! $movies->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<h1 align="center">Permissions Deny</h1>
@endcan
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('.delete-movie').on('click', function () {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Bạn có chắc chắn muốn xóa phim không?") === true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        if (data['success']) {
                            // alert(data.success);
                            trObj.parents("tr").remove();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }

        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $paginate = $('#paginate');
        $flag = false;
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: "{{ URL::to('admin/movie/search') }}",
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                    if ($value == '' && $flag == true) {
                        $('.card-body').append($paginate);
                        $flag = false;
                    } else {
                        $('#paginate').remove();
                        $flag = true;
                    }

                }
            });
        })
    });
</script>
<script>
    function changestatus(movie_id, active) {
        if (active === 1) {
            $("#status" + movie_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + movie_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + movie_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + movie_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/movie/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'movie_id': movie_id
            },
            success: function(data) {
                if (data['success']) {
                    // alert(data.success);
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }
</script>
@endsection