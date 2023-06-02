<div class="table-redoconsive">
    <table  id="documents-table" class="table table-striped table-sm" style="min-height: 200px">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"> الملف</th>
          
          <th scope="col">Actions</th>
        </tr>
      </thead>
     
      <tbody>
     
        @foreach ($docs as $doc)
        
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <a href="{{ url('show_uploaded_file/'.$doc->id)}}" target="_blank" >{{ $doc->doc_nom->nom_ar}}   </a>
                           
            </td>
           
            <td>
                  
              <div class="dropdown">
                  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Actions
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li> <a type="submit" class="dropdown-item" href="#"><i class="bi bi-pencil-square m-1"></i> تعديل</a></li>
                    
                    @if($doc->is_deleted)
                  <li>
                      <form action="{{url('/document_restor/'.$doc->id)}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-eye m-1"></i>  ارجاع</button>
                      </form> 
                    </li>
                    @else
                  <li>
                    <form action="{{url('/document_archived/'.$doc->id)}}" method="post" enctype="multipart/form-data">
                      @csrf
                      
                       <li><button type="submit" onclick="confirmAction()" class="dropdown-item"><i class="bi bi-archive m-1"></i> حذف</button></li>
                    </form>
                  </li>
                    @endif
                  </ul>
              </div>
            </td>
          </tr>
         
        @endforeach
        
      </tbody>
    </table>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-file-plus"></i> اضافة ملف
          </button> 
    </div>


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">اضافة ملف</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('document_store') }}" method="post" enctype="multipart/form-data">{{-- need to use route to easy insert parameter department_id--}}
                @csrf
               
                <div class="form-group g-4">
                    <label class="col-md-6 col-form-label ">{{ __('translation.file') }}: </label>
                
                </div>
                <div class="row g-7">
                    <select name="doc_nom_id" id="doc_nom_id" class="form-control" required>
                        <option ></option>
                        <option value="1">•	طلب خطي ممضي من طرف المسؤول المباشر</option>
                        <option value="2"> •	مقرر التعيين و شهادة عمل.*</option>
                        <option value="3">•	شهادة التسجيل في الدكتوراه ابتداءا من التسجيل الثاني. / شهادة جامعية أو شهادة معادلة لها*</label>
                        </option>
                        <option value="4">   •	نسخة من الصفحة الأولى لجواز السفر</option>
                        <option value="5">•	مشروع عمل يشمل كل الأهداف و المنهجية من التربص موقع عليه من طرف المسؤول المباشر * أو من طرف المشرف على الأطروحة بالنسبة للأساتذة المساعدين .*
                        </option>
                        <option value="6"> •	تقديم رسالة استقبال من طرف الهيئة المستقبلة أو البحثية في الخارج ذات قدرات علمية و تكنولوجية عالية مع التقييد بتوصيات الوزارة الوصية في مجال البلدان المستقبلة خاصة بطلبة الدكتوراه 
                        </option>
                      </select>
        
                    <div class="col-md-8 pt-3" dir="ltr">
                        <input id="file" type="file" accept="application/pdf" class="form-control " name="file" required="">

                       
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خروج</button>
          
        </div>
    
      </div>
   
    </div>
  </div>
  {{---------------------}}
  
<script type="text/javascript">
            const confirmAction = () => {
                const response = confirm("Are you sure you want to Delet the file that?");

                if (response) {
                    alert("Ok ");
                } else {
                    alert("Cancel ");
                }
            }
        </script>

  
  