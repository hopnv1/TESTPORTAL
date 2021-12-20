<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>





                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{-- modal add new --}}
                    <div wire:ignore.self class="modal fade" id="addNewPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @if(isset($message))
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col">
                                    <span class="alert alert-success">{{$message}}</span>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <input placeholder="Enter your title" type="text" id="title" class="form-control" required > <br>
                                    <textarea name="content" id="content" cols="50" rows="5" style="width: 100%;" placeholder="Enter your content of post"></textarea>
                                </div>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button wire:click.prevent="$emit('addPostScript')" type="button" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- end modal add new --}}


                    {{-- modal edit --}}
                    <div wire:ignore.self class="modal fade" id="editNewPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @if(isset($message))
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col">
                                    <span class="alert alert-success">{{$message}}</span>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <input placeholder="Enter your title" type="text" id="titleEdit" class="form-control" required > <br>
                                    <textarea name="content" id="contentEdit" cols="50" rows="5" style="width: 100%;" placeholder="Enter your content of post"></textarea>
                                   {{--  <select style="margin-top: 10px;" class="form-control" name="publish" id="publishEdit">
                                        <option value="publish">Publish</option>
                                        <option value="unpushlish">Unpublish</option>
                                    </select> --}}
                                </div>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button wire:click.prevent="$emit('editPostScript')" type="button" class="btn btn-primary">Save</button>
                            <input type="hidden" id="idEdit" wire:ignore>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- end modal edit --}}

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table light-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                         @can('publish-post')
                                         <th>Status</th>
                                         @endcan
                                        <th style="max-width: 150px;">
                                            <a data-toggle="modal" data-target="#addNewPostModal" href="#" id="btnAddPost" class="btn btn-primary plus-add">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus bold" viewBox="0 0 16 16">
                                          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>Add</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($listPost))
                                    @foreach($listPost as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->title}}
                                            <input type="hidden" id="title-{{$list->id}}" value="{{$list->title}}">
                                        </td>
                                        <td>{{$list->content}}
                                            <input type="hidden" id="content-{{$list->id}}" value="{{$list->content}}">
                                        </td>
                                         @can('publish-post')
                                         <td>
                                            @if($list->publish == 'unpublish')
                                             <a href="#" class="badge badge-secondary">{{$list->publish}}</a>
                                             @else
                                             <a href="#" class="badge badge-success">{{$list->publish}}</a>
                                             @endif
                                         </td>
                                         @endcan
                                        <td><a wire:click.prevent="$emit('deletePostScript', '{{$list->id}}')" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg></a> | <a wire:click.prevent="$emit('getDataPostScript', '{{$list->id}}')" data-toggle="modal" data-target="#editNewPostModal" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg></a> |

                                        @can('publish-post')
                                        <a wire:click.prevent="$emit('publishPostScript', '{{$list->id}}')" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-check-fill" viewBox="0 0 16 16">
                                          <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                          <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                                        </svg></a>
                                        @endcan


                                    </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $listPost->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

    <script src="{{ asset('js/postScript.js') }}"></script>

@endpush
