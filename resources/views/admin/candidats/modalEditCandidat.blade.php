
  <!-- Modal -->
  <div class="modal fade" id="EditCandidat" tabindex="-1" aria-labelledby="EditCandidatLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditCandidatLabel"> تعديل المعلومات</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action=" {{ route('candidat_store', ['candidat' => $candidat->id]) }}" method="post" enctype="multipart/form-data">{{-- need to use route to easy insert parameter department_id--}}
                @csrf
               
            
                <div class="row g-7">
                      
                        <div class="row g-3">
                          
              
                          <div class="col-md-6">
                            <label for="pays_id" class="form-label">{{__('translation.pays')}}</label>
                            <input type="hidden" name="pays_id" id="pays_id" value="{{$candidat->pays_id}}">
                             {{--<select name="pays_id" id="pays_id" class="form-control" required>
                              <option value=""> ---</option>
                              @foreach ($pays as $p )
                                  @if ($p->zone==1)
                                      
                                      <option value="{{$p->id}}">zone 1: {{$p->nom_ar}}</option>
                                  
                                  @else
                                
                                      <option value="{{$p->id}}">zone 2:  {{$p->nom_ar}}</option>
                                 
                                  @endif
                              @endforeach
      
                          </select> --}}
                          <input type="text" name="pays_nom" id="pays_nom" value="{{ $candidat->pays_nom }}" class="form-control" required>
                          @error('pays_nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
              
                          <div class="col-md-6">
                            <label for="etablissement" class="form-label">{{__('translation.etablissement')}}</label>
                            <input type="text" value="{{ $candidat->etablissement }}" class="form-control" id="etablissement"  name="etablissement"  required>
                            @error('etablissement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                            
                            <div class="col-md-6">
                              <label for="objective_id" class="form-label text-md-end">{{ __('translation.objective') }}</label>
                    
                              <select name="objective_id" id="objective_id" class="form-control" required>
                                  
                                  @foreach ($objectives as $obj )
                                  @if ($candidat->objective_id == $obj->id)
                                  <option selected value="{{$obj->id}}">{{$obj->titre_ar}} - {{$obj->titre_fr}}</option>  
                                  @else
                                  <option value="{{$obj->id}}">{{$obj->titre_ar}} - {{$obj->titre_fr}}</option>   
                                  @endif
                                  
                                  @endforeach 
      
                              </select>
                                 
                                  @error('objective_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              
                          </div>
                          
                      
                       
                        
              
                        
                     
                    </div>
                  </div>
              
                <div class="row m-4">
                    <button class=" btn btn-primary" type="submit">حفظ المعلومات</button>
                     
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