<div class="dropdown">
    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
        aria-expanded="false">
        إجراءات
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li> <a type="link" class="btn btn-primary dropdown-item"
                href="#">
                <i class="bi bi-pencil-square m-1"></i>
                تعديل</a>
        </li>


        @if (!$data->is_active)
            <li>
                <form action="{{ route('user_enable', ['user' => $data->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bi bi-eye m-1"></i> تنشيط</button>
                </form>
            </li>
        @else
            <li>
                <form action="{{ route('user_disable', ['user' => $data->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

            <li><button type="submit" onclick="confirmAction()" class="dropdown-item"><i class="bi bi-eye-slash m-1"></i>
                تعطيل</button></li>
            </form>
            </li>
        @endif
    </ul>
</div>

