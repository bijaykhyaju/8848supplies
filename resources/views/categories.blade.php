@extends('layouts.user-layout')

@section('mainSection')
<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/dashboard")}}'>Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
      </nav>

        <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">

                    <div class="card-header" style="display:block;min-height: 62px;">
                          <div class="top-bar">
                              <div class="left-element">
                                <h4>Categories</h4>
                              </div>

                              <div class="right-element">
                                <a href="{{url('/categories/add')}}"><button type="button" class="btn btn-info" id="add-music">Add Category</button></a>
                              </div>
                          </div>
                      </div>
                        <div class="card-body">
                        
                      @if($categoryCount>0)
                            <ul id="sorter" class="polaroid">

                             @foreach($categories as $index => $cat)
                            
                              <li id="sortdata" >
                                  <div class="polaroidimg">
                                      <a href="{{url('/categories/edit/'.$cat->id)}}"><img src="{{ asset('/storage/uploads/images/categories/'.$cat->image) }}" width="200" height="250"  border="0" /></a>
                                  </div>
                                  <div class="polaroidlabel">
                                      <div class="tr">
                                        <div class="td">
                                            <span class="cat_sn">{{++$index}}.</span>&nbsp; {{ucwords($cat->name)}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="polaroidoption">

                                      <a href="JavaScript:void(0);" class="cat_del_link delete-course" data-toggle="modal" data-target="#deleteLessonModal" rel="{{$cat->id}}"><img src="{{ asset('images/icon_delete.png') }}" width="24" height="24" border="0" /></a>

                                      
                                      
                                  </div>
                              </li>

                             @endforeach



                             </ul>

                             @else
                             <div>No categories found. Click "Add Category" button to create category.</div>
                            

                          @endif
                          

                                <!-- Modal -->
                                <div class="modal fade" id="deleteLessonModal" tabindex="-1" role="dialog" aria-labelledby="deleteLessonModal" aria-hidden="true" data-backdrop="false">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this category?</h5>

                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <p class="err-msg">This will delete this category including all the products. Are you sure you want to continue?</p>

                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteCatBtn">Confirm</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                </tbody>
                                <input name="category_id" id="category_id_delete" value="" hidden>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
  $('#add-course').click(function(){
    location.href = '/course';

  });
  $('.edit-course').click(function(){
    var musicId = $(this).attr('rel');
    //alert(musicId);
    location.href = '/courses/'+musicId;
  });

  $('.delete-course').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#category_id_delete').val(id);

  });



  $('#deleteCatBtn').click(function(){
        var mId = $('#category_id_delete').val();
        //alert(mId);
        var delBtn = $(this);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(CSRF_TOKEN);
        $.ajax({
          url: '/categories/delete',
          type: 'post',
          data: { _token : CSRF_TOKEN, id: mId},
          beforeSend: function() {
              // setting a timeout
              //alert('hello');
              delBtn.html('Deleting');
          },
          error:function(data){
            delBtn.html('Confirm');
            console.log(data);
          },
          success: function(data){
            console.log(data+"Deleted");
            location.href = '{{url("/categories")}}';

          }


          });

  });


</script>



@endsection
