@extends('layouts.dashboard.app')

@section('content')
<div class="container" style="margin-top: 30px;">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">تعديل </h1>
  <div class="btn-toolbar mb-2 mb-md-0">
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <form action="{{ url('document.store') }}" method="post">{{-- need to use route to easy insert parameter department_id--}}
        @csrf
        <input type="hidden" class="form-control" name="document_id" value="{{$document->id}}" required>
        <input type="hidden" class="form-control" name="candidat_id" value="{{$document->candidat_id}}" required>
       
        <div class="form-group">
          <label for="title">الاسم</label>
          <input type="text" class="form-control" name="title"  value="{{$document->nom}}" required>
        
        </div>
        <div class="row g-6">
            <label for="file_1" class="col-md-6 col-form-label ">{{ __('translation.file') }}: </label>
            <select name="nom" id="nom" class="form-control">
                <option value="doc_1">•	طلب خطي ممضي من طرف المسؤول المباشر</option>
                <option value="doc_2"> •	مقرر التعيين و شهادة عمل.*</option>
                <option value="doc_3">•	شهادة التسجيل في الدكتوراه ابتداءا من التسجيل الثاني. / شهادة جامعية أو شهادة معادلة لها*</label>
                </option>
                <option value="doc_4">   •	نسخة من الصفحة الأولى لجواز السفر</option>
                <option value="doc_5">•	مشروع عمل يشمل كل الأهداف و المنهجية من التربص موقع عليه من طرف المسؤول المباشر * أو من طرف المشرف على الأطروحة بالنسبة للأساتذة المساعدين.*
                </option>
                <option value="doc_6"> •	تقديم رسالة استقبال من طرف الهيئة المستقبلة أو البحثية في الخارج ذات قدرات علمية و تكنولوجية عالية مع التقييد بتوصيات الوزارة الوصية في مجال البلدان المستقبلة خاصة بطلبة الدكتوراه 
                </option>
              </select>

            <div class="col-md-8">
                <input id="file" name="file"  type="file" accept="application/pdf" class="form-control @error('file') is-invalid @enderror"  required  >

                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
      
        <div class="row m-4">
          <button class="btn btn-primary">حفظ</button>
        </div>
      </form>
    </div>
    <div class="col-3"></div>
  </div>
</div>
</div>
@endsection