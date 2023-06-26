@extends('layouts.dashboard.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">  
                @if (isset( $title)) 
                {{$title}}
                @endif
            </div>
            @if(Auth::user()->hasRole('superAdmin'))
            <form id="filter-form" class="form-group">
                @csrf
                <div class="row g-3 align-items-center">
                   
                    <div class="col-auto">
                        <label for="relex_service_id">القائمة خاص بـ</label>
                    </div>
                    
                    <div class="col-auto">
                        <select  name="relex_service_id"  onchange="applyFilter()"  id="relex_service_id" class="form-control">

                            <option value="all">الكل</option>
                            <option value="1">رئاسة الجامعة</option>
                            <option value="2"> كلية الحقوق</option>
                            <option value="3"> كلية العلوم الإسلامية</option>
                            <option value="4"> كلية الطب</option>
                            <option value="5"> كلية الصيدلة </option>
                            <option value="6"> كلية العلوم </option>

                        </select>
                    </div>
                </div>

                 {{-- <button type="submit" class="btn btn-primary">Apply Filter</button>  --}}
            </form>
            @endif
            <div class="card-body">
                {{ $dataTable->table() }}
                <table id="users-table">
                    <!-- Table content -->
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  
    <script>
        function applyFilter() {
            var serviceId = $('#relex_service_id').val();
             // Redirect to the datatable page with the user_id filter
            if (serviceId=='all')
            window.location.href =  "{{ route('candidats') }}"; 
            else
            window.location.href =  "{{ route('candidats') }}?relex_service_id=" + serviceId;
        
        }
    </script>
   
    <script type="text/javascript">
     $(document).ready(function() {
        let searchParams = new URLSearchParams(window.location.search)
       if ( searchParams.has('relex_service_id'))
       {
        let param = searchParams.get('relex_service_id')
        //console.log(param )
        $("#relex_service_id option[value='"+ param +"']").attr("selected", "selected");
       
        //Last, if you have multiple entries for the same parameter (like ?id=1&id=2), you can use
        //let param = searchParams.getAll('id')
   
       } // true
//for model
$('#view_candidats-table').on('click', '.edit', function() {
               
               let data =$(this).data('edit'); 
               $('#etat').val(data.etat); 
               $('#motif').val(data.motif); 
               
               $('#id_st').val(data.id);
               $('#id').val(data.id);
               
               $('#EtatChangeModal').modal('show');
               
           });


           $("#etat").change(function(){
               if($(this).val()=="Refusé"){
               $("#motif").removeAttr("disabled");
               }else if($(this).val()=="Accepté"){
               $("#motif").val("null");
               $("#motif").attr("disabled",true);
               }else{
                   $("#motif").attr("disabled","true");
               }
           });

           //Modal Events - show.bs.modal
           //Modal Events - hide.bs.modal
           $("#EtatChangeModal").on('hidden.bs.modal', function(){
               
               $("#motif").attr("disabled",true);
               $('#oriented_to_speciality').empty();
           });
//end for model
      
       
     });
    
    </script>
@endpush