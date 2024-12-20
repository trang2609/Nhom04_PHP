<!-- Modal -->
<div class="modal fade modal-lg" id="RoomCreateModal_Theater_{{ $theater->id }}" tabindex="-1" aria-labelledby="RoomCreateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="RoomCreateModalLabel">Thêm phòng chiếu phim</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="admin/room/create" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="name" class="form-label">Tên phòng</label>
                                <input class="form-control" id="name" type="text" name="name" placeholder="Nhập tên phòng chiếu...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="row" class="form-label">Số hàng</label>
                                <input class="form-control" id="row" type="number" name="row" min="0" max="24"
                                       placeholder="Nhập số lượng hàng...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="col" class="form-control-label">Số cột</label>
                                <input class="form-control" id="col" type="number" name="col" min="0" max="50"
                                       placeholder="Nhập số lượng cột...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="roomType" class="form-label">Loại phòng</label>
                                <select class="form-select" id="roomType" type="text" name="roomType">
                                    @foreach($roomTypes as $roomType)
                                        <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="theaterId" value="{{ $theater->id }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#TheaterEditModal{{ $theater->id }}">Đóng
                    </button>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
