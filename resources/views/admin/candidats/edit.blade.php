@extends('layouts.dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('translation.info_personal') }}</h4>
                
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5></h5>
                    
                    <h5>  {{ __('translation.candidat') }}: {{ $candidat->user->nom_ar }} {{ $candidat->user->prenom_ar }}</h5>
                    {{ $candidat->user->email }} <br/>
                    {{ $candidat->user->phone }}     
                    <div style="direction: ltr; padding-bottom: 10px;">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#EditCandidat">
                                <i class="bi bi-credit-card-2-back"></i>  تعديل المعلومات
                            </button>
                        </div>

                        
                        <div class="card">
                            <div class="card-body"> 
                                <?php
                                $etatList_1 = array(array('id'=>'Accepté','name_ar'=>'مقبول','color'=>'success'), array('id'=>'Refusé','name_ar'=>'مرفوض','color'=>'danger'),array('id'=>'Acceptée sous réserve','name_ar'=>'قبول بشرط','color'=>'warning'),array('id'=>'Non traité','name_ar'=>'غير معالج','color'=>'light'));
                                ?>
                                        
                    <p> الوضعية:  
                    @foreach ( $etatList_1 as $state)
                    @if ($candidat->etat == $state['id'])
                    <span class="alert alert-{{$state['color']}} ">{{$state["name_ar"]}}  / {{ $candidat->etat }}</span>
                    @endif
                    @endforeach  
                    
                    </p>
                @if ($candidat->etat !="Accepté")
                <p>السبب: {{ $candidat->motif }}</p>   
                @endif
                <div style="direction: ltr ; padding-top: 5px;"> 
                    <button type="button" data-bs-target="#EtatChangeModal" id="etatchange" class="btn btn-warning edit" data-bs-toggle="modal" >
                        <i class="bi bi-hourglass-split"></i>   معالجة الملف
                    </button>
                </div> 
            </div>
        </div>
                    <p> 
                        {{-- <a href="{{asset($student->file_path)}}"></a> --}}
                        {{ __('translation.note_file_check') }}
                    
                    <br/> 
                    </p>
                    @include('candidat.list_doc')
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('get_print',["candidat"=>$candidat->id]) }}"  target="_blank" class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('translation.print') }}</a>
                        </div>
                    </div>
                    {{-- if resultat: imprimer obligatoirement leur résultat d'acceptation a fin de compléter leur
                    dossier d'inscription. --}}
                </div>
            </div>
            </div>
        </div>
    </div>
    @include('admin.candidats.modalEditCandidat')

    @include('admin.candidats.modelEtatChange')
@endsection
@push('scripts')

<script type="text/javascript">

    $(document).ready(function() {
      


           $("#etat").change(function(){
               if( ($(this).val() == "Acceptée sous réserve") || ($(this).val()=="Refusé") )
               {
               $("#motif").removeAttr("readonly"); 
               $("#motif").val('{{$candidat->motif }}').change();
               console.log('{{$candidat->motif }}');

               }else if( ($(this).val()=="Accepté" )|| ($(this).val()=="Non traité"))
               {
               $("#motif").val("-").change();
               $("#motif").attr("readonly",true);
               }
               
           });

      
       
     });
    
    </script>

@endpush
