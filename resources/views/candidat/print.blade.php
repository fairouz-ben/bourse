@extends('layouts.print_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
       
        <main>
         
            <div class="card" style="width: 100%;">
            
              <img class="card-img-top" src="{{asset('ban.png')}}" alt="logo" height="100px" width="400px">
             
             <div class="card-body text-center">
                <h5 class="card-title">{{__('translation.title')}}</h5>
                <h4>  {{$user->relex_service->name_ar}}</h4>

                <p class="card-text">
                  <h5>{{__('translation.form_title')}}</h5>
                  
                 
                </p>
              </div>
              <div class="card-body">
                <table  class="table "> 
                  <tr>
                    <td>{{__('translation.candidat')}}</td>
                    <td>{{$user->nom_ar}} {{$user->prenom_ar}}
                    <br/>{{$user->nom_fr}}  {{$user->prenom_fr}}</td>
                  </tr>

                  <tr>
                    <td>{{__('translation.phone')}}</td>
                    <td>{{$user->phone}}</td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.email')}}</td>
                    <td>{{$user->email}}</td>
                    
                  </tr>

                  <tr>
                    <td>{{__('translation.grade')}}</td>
                    <td>{{$user->candidat->grade->titre_ar}} </td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.fonction')}}</td>
                    <td>{{$user->candidat->fonction}} </td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.pays')}}</td>
                    <td>{{--$user->candidat->pays->nom_ar---}} {{$user->candidat->pays_nom}}</td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.etablissement') }} </td>
                    <td style="p-2"> {{$user->candidat->etablissement}} </td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.objective')}}</td>
                    <td> {{$user->candidat->objective->titre_ar}} </td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.year_last')}}</td>
                    <td>{{$user->candidat->year_of_last_benefit}} </td>
                    
                  </tr>

                </table> 
              </div>
              
              
            </div>
       </main>
        
    </div>
</div>
@endsection
@section('script')
    <script>
        window.print();
    </script>
@endsection