@extends('layouts.dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
       
        <main>
            {{--<div class="py-5 text-center">
              <img class="d-block mx-auto mb-4" src="{{asset('ban.png')}}" alt="logo" height="150px" width="600px">
              <h2></h2>
              <p class="lead">{{__('translation.relex_service')}}
                <b>  {{Auth::user()->relex_service->name_ar}}</b> 
              </p>
            </div>--}}
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
                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="candidat_id" value="{{$candidat->id}}">
                  <div class="card">
                    <div class="card-body">
                      {{__('translation.candidat')}}: <b>{{Auth::user()->nom_ar}} {{Auth::user()->prenom_ar}} </b> 
                      -
                      <b>{{Auth::user()->nom_fr}} {{Auth::user()->prenom_fr}} </b>
                        <br/>
                        {{__('translation.relex_service')}}:<b>  {{Auth::user()->relex_service->name_ar}}</b> 
                    </div>
                  </div>
                  
                  <div class="row g-3">
                    
                
                 
                  
                    <div class="alert alert-danger" role="alert">
                      {{ __('translation.doc_alert_message') }}
                        
                      </div>
                 
                  {{--<div class="row g-3">
                    <label for="file" class="col-md-3 col-form-label ">{{ __('translation.file') }} الشامل</label>
        
                    <div class="col-md-4">
                        <input id="file" name="file"  type="file" accept="application/pdf" class="form-control @error('file') is-invalid @enderror"  required  >
        
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>--}}
                <div class="row g-3">
                  <label for="file_1" class="col-md-6 col-form-label ">{{ __('translation.file') }} 1
                    •	طلب خطي ممضي من طرف المسؤول المباشر
                  </label>
      
                  <div class="col-md-4">
                      <input id="file_1" name="file_1"  type="file" accept="application/pdf" class="form-control @error('file_1') is-invalid @enderror"  required  >
      
                      @error('file_1')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row g-3">
                <label for="file_2" class="col-md-6 col-form-label ">{{ __('translation.file') }} 2
                  •	مقرر التعيين و شهادة عمل.*
                </label>
    
                <div class="col-md-4">
                    <input id="file2_" name="file_2"  type="file" accept="application/pdf" class="form-control @error('file_2') is-invalid @enderror"  required  >
    
                    @error('file_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row g-3">
              <label for="file3" class="col-md-6 col-form-label ">{{ __('translation.file') }} 3
                •	شهادة التسجيل في الدكتوراه ابتداءا من التسجيل الثاني. / شهادة جامعية أو شهادة معادلة لها*</label>
  
              <div class="col-md-4">
                  <input id="file_3" name="file_3"  type="file" accept="application/pdf" class="form-control @error('file_3') is-invalid @enderror"  required  >
  
                  @error('file_3')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
          <div class="row g-3">
            <label for="file_4" class="col-md-6 col-form-label ">{{ __('translation.file') }} 4
              •	نسخة من الصفحة الأولى لجواز السفر
            </label>

            <div class="col-md-4">
                <input id="file_4" name="file_4"  type="file" accept="application/pdf" class="form-control @error('file_4') is-invalid @enderror"  required  >

                @error('file_4')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row g-3">
          <label for="file_5" class="col-md-6 col-form-label ">{{ __('translation.file') }} 5
            •	مشروع عمل يشمل كل الأهداف و المنهجية من التربص موقع عليه من طرف المسؤول المباشر * أو من طرف المشرف على الأطروحة بالنسبة للأساتذة المساعدين.*
          </label>

          <div class="col-md-4">
              <input id="file_5" name="file_5"  type="file" accept="application/pdf" class="form-control @error('file_5') is-invalid @enderror"  required  >

              @error('file_5')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>
      <div class="row g-3">
        <label for="file_6" class="col-md-6 col-form-label ">{{ __('translation.file') }} 6
          •	تقديم رسالة استقبال من طرف الهيئة المستقبلة أو البحثية في الخارج ذات قدرات علمية و تكنولوجية عالية مع التقييد بتوصيات الوزارة الوصية في مجال البلدان المستقبلة خاصة بطلبة الدكتوراه 
        </label>

        <div class="col-md-4">
            <input id="file_6" name="file_6"  type="file" accept="application/pdf" class="form-control @error('file_6') is-invalid @enderror"  required  >

            @error('file_6')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
        
                  
                  
        
                  <hr class="my-4">
        
                  <button class="w-100 btn btn-primary btn-lg" type="submit">{{__('translation.btn_submit_files')}}</button>
                </form>
              </div>
            </div>
          </main>
        
    </div>
</div>
@endsection
