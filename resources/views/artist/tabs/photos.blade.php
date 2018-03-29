<div class="row">
    <div class="col-sm-12">
        @if ($photos->count())
            <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Sort Order</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center">Price<span> (USD)</span></th>
                    <th class="text-center">Prints sold</th>
                    <th class="text-center">Visibility</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($photos as $photo)
                    <tr>
                        <td class="primary">
                            <a href="javascript:void(0)"
                               class="editable-input"
                               id="editable-sort_order-{{ $photo->id }}"
                               data-type="text"
                               data-title="Enter Sort Order"
                               data-pk="{{ $photo->id }}"
                               data-name="sort_order"
                               data-url="{{ URL::route('artist.photo.update_field') }}"
                            >{{{ $photo->sort_order }}}</a>
                            <a href="javascript:void(0)" class="photo-edit"  data-ref="editable-sort_order-{{ $photo->id }}">(edit)</a>
                        </td>
                        <td class="primary">
                            <a href="javascript:void(0)"
                               class="editable-input"
                               id="editable-title-{{ $photo->id }}"
                               data-type="text"
                               data-title="Enter title"
                               data-pk="{{ $photo->id }}"
                               data-name="title"
                               data-url="{{ URL::route('artist.photo.update_field') }}"
                            >{{{ $photo->title }}}</a>
                            <a href="javascript:void(0)" class="photo-edit"  data-ref="editable-title-{{ $photo->id }}">(edit)</a>
                        </td>
                        <td class="primary" width="55%">
                            <a href="javascript:void(0)"
                               class="editable-input"
                               id="editable-description-{{ $photo->id }}"
                               data-type="textarea"
                               data-title="Enter description"
                               data-pk="{{ $photo->id }}"
                               data-name="description"
                               data-url="{{ URL::route('artist.photo.update_field') }}"
                                    >{{{ $photo->description }}}</a>
                            <a href="javascript:void(0)" class="photo-edit"  data-ref="editable-description-{{ $photo->id }}">(edit)</a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)"
                               class="editable-input"
                               id="editable-price-{{ $photo->id }}"
                               data-type="text"
                               data-title="Enter price"
                               data-pk="{{ $photo->id }}"
                               data-name="price"
                               data-url="{{ URL::route('artist.photo.update_field') }}"
                                    >{{{ $photo->price }}}</a>
                            <a href="javascript:void(0)" class="photo-edit" data-ref="editable-price-{{ $photo->id }}">(edit)</a>
                        </td>
                        <td class="text-center">{{ App\Models\Order::with('photo')->where('paid', '=', 1)->where('photo_id', '=', $photo->id)->count() }}</td>
                        <td class="text-center"><p class="status{{ $photo->id }}">{{ $photo->hide_photo?"Hidden":"Visible" }}</p></td>
                        <td class="text-center">
                            <button href="javascript:void(0)" class="btn btn-danger hidePhoto{{ $photo->id }} @if($photo->hide_photo==1) hidden @endif" onclick="hidePhoto({{$photo->id}})">Hide</button>
                            <button href="javascript:void(0)" class="btn btn-success showPhoto{{ $photo->id }}  @if($photo->hide_photo==0) hidden @endif" onclick="showPhoto({{ $photo->id }})">Show</button>
                                &nbsp;&nbsp;
                            <button href="javascript:void(0)" class="btn btn-danger deletePhoto{{ $photo->id }}" onclick="deletePhoto({{ $photo->id }})">Delete</button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            {{ $photos->links() }}
        @else
            <p>Sorry, there are no photos to display.</p>
        @endif
    </div>
</div>
<script>
 function deletePhoto(id) {
     if(confirm('Are you sure you want to delete this photo?')){
         $.post('/artist/photo/update_field',{
             'name':'delete',
             'value':true,
             'pk':id
         },function(data){
             if(data.status === 'success'){
                 $('.deletePhoto'+id).closest('tr').hide();
             }
         })
     }
 }
 function showPhoto(id) {
     $.post('/artist/photo/update_field',{
         'name':'hide_photo',
         'value':0,
         'pk':id
     },function(data){
         if(data.status === 'success') {
             $('.showPhoto'+id).addClass('hidden');
             $('.hidePhoto'+id).removeClass('hidden');
             $('.status'+id).text('Visible');
         }
     })
 }
 function hidePhoto(id) {
     $.post('/artist/photo/update_field',{
         'name':'hide_photo',
         'value':1,
         'pk':id
     },function(data){
         if(data.status === 'success'){
             $('.showPhoto' + id).removeClass('hidden');
             $('.hidePhoto' + id).addClass('hidden');
             $('.status'+id).text('Hidden');
         }
     })

 }
</script>