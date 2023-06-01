@extends('layouts.dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('translation.info_personal') }}</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>{{Auth::user()->candidat->id}}</h5>
                    
                    <h5>  {{ __('translation.candidat') }}: {{ Auth::user()->nom_ar }}</h5>
                    <p> 
                        {{-- <a href="{{asset($student->file_path)}}"></a> --}}
                        {{ __('translation.note_file_check') }}
                         <ul>
                            @if ($docs)
                            @foreach ($docs as $doc )
                            <li>
                                <a href="{{ url('show_uploaded_file/'.$doc->id)}}" target="_blank" >{{ $doc->nom}}   </a>
                           
                            </li>
                           
                            @endforeach
                                
                            @endif

                        </ul>
                    <br/>  
                    </p>
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
@endsection
