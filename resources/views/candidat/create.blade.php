@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
       
        <main>
           
            <div class=" row mb-3">   
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                </div>
            </div> 
            <div class="row g-5">
              
              <div class="col">
                <h4 class="mb-3">{{__('translation.ask')}}</h4>
                <hr>
                <h5>{{__('translation.info_personal')}}</h5>
                <form method="POST" action="{{ route('candidat.store') }}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  <div class="card">
                    <div class="card-body">
                      {{__('translation.candidat')}}: <b>{{$user->nom_ar}} {{$user->prenom_ar}} </b> 
                      -
                      <b>{{$user->nom_fr}} {{$user->prenom_fr}} </b>
                        <br/>
                        {{__('translation.relex_service')}}:<b>  {{$user->relex_service->name_ar}}</b> 
                    </div>
                  </div>
                  
                  <div class="row g-3">
                    <div class="col-md-6 ">
                      <label for="fonction" class="form-label">{{__('translation.fonction')}}</label>
                      <input type="text" class="form-control" id="fonction" name="fonction" placeholder="" value="{{ old('fonction') }}" required>
                      @error('fonction')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
        
                    <div class="col-md-6 ">
                      <label for="grade_id" class="form-label">{{__('translation.grade')}}</label>
                    <select name="grade_id" id="grade_id" class="form-control" required>
                        <option value=""> ---</option>
                        @foreach ($grades as $g )
                          @if(App::isLocale('ar'))
                            <option value="{{$g->id}}">{{$g->titre_ar}}</option>
                          @else
                            <option value="{{$g->id}}">{{$g->titre_fr}}</option>
                            @endif
                        @endforeach

                    </select>
                      @error('grade_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="pays_id" class="form-label">{{__('translation.pays')}}</label>
                      <input type="hidden" name="pays_id" id="pays_id" value="1">
                      {{-- <select name="pays_id" id="pays_id" class="form-control" required>
                        <option value=""> ---</option>
                        @foreach ($pays as $p )
                            @if ($p->zone==1)
                                
                                <option value="{{$p->id}}">zone 1: {{$p->nom_ar}}</option>
                            
                            @else
                          
                                <option value="{{$p->id}}">zone 2:  {{$p->nom_ar}}</option>
                           
                            @endif
                        @endforeach

                    </select> --}}
                    <input type="text" name="pays_nom" id="pays_nom" value="{{ old('pays_nom') }}" class="form-control" required>
                    @error('pays_nom')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
        
                    <div class="col-md-6">
                      <label for="etablissement" class="form-label">{{__('translation.etablissement')}}</label>
                      <input type="text" class="form-control" id="etablissement"  name="etablissement" value="{{ old('etablissement') }}" required>
                      @error('etablissement')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                      
                      <div class="col-md-6">
                        <label for="objective_id" class="form-label text-md-end">{{ __('translation.objective') }}</label>
          
                        <select name="objective_id" id="objective_id" class="form-control" required>
                            <option value="">----</option>
                            @foreach ($objectives as $obj )
                            <option value="{{$obj->id}}">{{$obj->titre_ar}} - {{$obj->titre_fr}}</option>
                            @endforeach

                        </select>
                           
                            @error('objective_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                    </div>
                    <div class="col-md-4">
                        <label for="year_of_last_benefit" class="form-label text-md-end">{{ __('translation.year_last') }}</label>
            
                        <input id="year_of_last_benefit" type="number" min="1980" max="2023" step="1" value="2022"   class="form-control @error('year_of_last_benefit') is-invalid @enderror" name="year_of_last_benefit"  value="{{ old('year_of_last_benefit') }}"  >
            
                            @error('year_of_last_benefit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                
                 
                  
        
                  
                  
        
                  <hr class="my-4">
        
                  <button class="w-100 btn btn-primary btn-lg" type="submit">{{__('translation.btn_submit_form')}}</button>
                </form>
              </div>
            </div>
          </main>
        
    </div>
</div>
@endsection
