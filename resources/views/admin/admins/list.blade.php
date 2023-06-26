@extends('layouts.dashboard.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Admins</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="text/javascript">
        const confirmAction = () => {
            const response = confirm("Are you sure you want to disable the user?");
    
            if (response) {
                alert("Ok ");
            } else {
                alert("Cancel ");
            }
        }
    </script>
@endpush