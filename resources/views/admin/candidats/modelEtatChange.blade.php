<!-- Modal -->
<div class="modal fade" id="EtatChangeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">معالجة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('candidat_setEtat',0) }}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id_st" id="id_st" value="{{ $candidat->id }}" required>
            <div class="form-group">
           
                  
            
              <label for="etat">الوضعية</label>
              <select  class="form-control" name="etat" id="etat" required>

                  @foreach ( $etatList_1 as $state)
                  @if ($candidat->etat == $state['id'])
                  <option value="{{$state['id']}}" selected>{{$state["name_ar"]}}</option>
                  @else
                  <option value="{{$state['id']}}" >{{$state['name_ar']}}</option>
                  @endif
               @endforeach  
                {{--<option value="Accepté">Accepté</option>
                <option value="Refusé">Refusé</option>
                <option value="Acceptée sous réserve" >Acceptée sous réserve</option>
                <option value="Non traité" >Non traité</option>--}}
              </select>
            </div>

            <div class="form-group">
              <label for="motif">السبب</label>
              <input class="form-control" id="motif" value="{{$candidat->motif }}" name="motif"  required >
           
            </div>

           
            <div class="row m-4">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button   type="submit" class="btn btn-primary">حـفظ</button>
        </div>
      </form>
      </div>
    </div>
  </div>
 