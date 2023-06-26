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
                    
                    <h5>  {{ __('translation.candidat') }}: {{ Auth::user()->nom_ar }} {{ Auth::user()->prenom_ar }}</h5>
                        <div style="direction: ltr">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#EditCandidat">
                                <i class="bi bi-credit-card-2-back"></i>  تعديل المعلومات
                            </button>
                        </div>
                    
                
                    <p> 
                        {{-- <a href="{{asset($student->file_path)}}"></a> --}}
                        {{ __('translation.note_file_check') }}
                    
                    <br/>  
                    </p>
                    @include('candidat.list_doc')
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('print') }}"  target="_blank" class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('translation.print') }}</a>
                        </div>
                    </div>
                    {{-- if resultat: imprimer obligatoirement leur résultat d'acceptation a fin de compléter leur
                    dossier d'inscription. --}}
                </div>
            </div>
            </div>
        </div>
    </div>
    @include('candidat.modalEditCandidat')
@endsection


