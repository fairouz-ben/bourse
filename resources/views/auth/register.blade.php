@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('translation.register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-md-6 ">
                            <label for="relex_service" class="form-label">{{__('translation.relex_service')}}</label>
                            <select name="relex_service_id" id="relex_service_id" class="form-control" required>

                                 <option value="">----</option>
                                 <option value="1">رئاسة الجامعة</option>
                                 <option value="2"> الحقوق</option>
                                 <option value="3"> العلوم الإسلامية</option>
                                 <option value="4"> الطب</option>
                                 <option value="5"> الصيدلة</option>
                                 <option value="6"> كلية العلوم </option>

                            </select>
                            @error('relex_service')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        <div class="row g-3">
                           
                            <div class="col-md-6 ">
                              <label for="nom_ar" class="form-label">{{__('translation.name_ar')}}</label>
                              <input type="text" class="form-control" id="nom_ar" name="nom_ar" placeholder="" value="{{ old('nom_ar') }}" required>
                              @error('nom_ar')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                
                            <div class="col-md-6 ">
                              <label for="prenom_ar" class="form-label">{{__('translation.prenom_ar')}}</label>
                              <input type="text" class="form-control" id="prenom_ar"  name="prenom_ar" placeholder="" value="{{ old('prenom_ar') }}"  required>
                              @error('prenom_ar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                              <label for="nom_fr" class="form-label">{{__('translation.name_fr')}}</label>
                              <input type="text" class="form-control" id="nom_fr"  name="nom_fr" value="{{ old('nom_fr') }}" required>
                              @error('nom_fr')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                
                            <div class="col-md-6">
                              <label for="prenom_fr" class="form-label">{{__('translation.prenom_fr')}}</label>
                              <input type="text" class="form-control" id="prenom_fr"  name="prenom_fr" value="{{ old('prenom_fr') }}" required>
                              @error('prenom_fr')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                            <div class="row  p-2">
                              <div class="col-md-6">
                                <label for="date_nais" class="form-label text-md-end">{{ __('translation.date_nais') }}</label>
                  
                                
                                    <input id="date_nais" type="date" class="form-control @error('date_nais') is-invalid @enderror" name="date_nais" value="{{ old('date_nais') }}" required >
                  
                                    @error('date_nais')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                              </div>
                            
                                <div class="col-md-6 ">
                                    <label for="phone" class=" form-label ">{{ __('translation.phone') }}</label>
                      
                                   
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  >
                      
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                </div>
                              </div>
                            <div class="col-md-6">
                              <label for="email" class="form-label text-md-end">{{ __('translation.email') }}</label>
                
                            
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                             
                          </div>
                          <div class="row  p-3">
                          <div class="col-md-6">
                              <label for="password" class="form-label text-md-end">{{ __('translation.password') }}</label>
                
                              
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    <span class="text-danger"> Votre mot de passe doit comporter au moins 8 caractères.
                                        <br/>
                                        يجب أن تتكون كلمة المرور الخاصة بك من 8 أحرف على الأقل
                                    </span>
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              
                          </div>
                
                          <div class="col-md-6">
                              <label for="password-confirm" class="form-label text-md-end">{{ __('translation.password-confirm') }}</label>
                
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
                             
                          </div>
                        </div>
                       
                        
                

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="w-100 btn btn-lg btn-primary">
                                    {{ __('translation.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection