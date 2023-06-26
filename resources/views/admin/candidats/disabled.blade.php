@extends('layouts.dashboard.app')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">disabled </h2>
    <table id="candidats-table" class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>nom_ar</th>
                <th>prenom_ar</th>
                <th>grade_ar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
 
@push('scripts')
<script type="text/javascript">
    $(function () {
      var status = "{!! $status !!}";
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('candidats.status',['status' => $status])  }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'nom_ar', name: 'nom_ar'},
              {data: 'prenom_ar', name: 'prenom_ar'},
              {data: 'grade_ar', name: 'grade_ar'},
              
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
      
    });
  </script>
<script>
    /*$(document).ready(function() {
        
        
       var status = "{!! $status !!}";

        $('#candidats-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('candidats.status', ['status' => $status]) }}",
            columns: [
                { data: 'id', name: 'nom' },
                { data: 'user_id', name: 'prenom' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });*/
</script>
@endpush
