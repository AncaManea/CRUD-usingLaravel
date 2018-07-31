@extends('layouts.base')

@section('content')
<h2>All tasks are here</h2>
@if (!$tasks->isEmpty())
<table class="table table-responsive">
        <thead>
                <th>
                        ID
                </th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>User id</th>
                <th>
                        Actions
                </th>
        </thead>
        <tbody>

                @foreach($tasks as $eachtask)
                        <tr>
                                <td>
                                        {{$eachtask->id}}
                                </td>
                                <td>{{$eachtask->name}}</td>
                                <td>{{$eachtask->description}}</td>
                                <td>@if ($eachtask->status == "1") <a class="btn btn-success">Finished</a> @else <a class="btn btn-danger">Unfinished</a> @endif</td>
                                <td>{{$eachtask->user_id}}</td>
                                <td><button class="btn btn-info"  data-toggle="modal"  data-target="#edit" data-name="{{$eachtask->name}}"  data-task_id = "{{$eachtask->id}}" data-mydescription="{{$eachtask->description}}" data-status="{{$eachtask->status}}" data-userid="{{$eachtask->user_id}}">Edit</button>
                                         <button data-task_id = "{{$eachtask->id}}" data-toggle="modal"  data-target="#delete" class="btn btn-danger">Delete</button>
                                 </td>
                        </tr>
                @endforeach


        </tbody>
</table>
@else
        <h1>No tasks added yet.</h1>
@endif
<!-- Button trigger modal -->

<button type="button" class="btn btn-primary"data-toggle="modal" data-target="#myModal">
        Add new task
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">New task</h4>
                        </div>
                        <form action="{{route('tasks.store')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">
                                        <input type="hidden" name="assign" id="assign" value="{{Auth::user()->id}}"/>
                                        <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" />
                                        </div>
                                        <div class="form-group">
                                                <label for="des">Description</label>
                                                <textarea name="description" id="des" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                        <option value="1">
                                                                Finished
                                                        </option>
                                                        <option value="0">
                                                                Unfinished
                                                        </option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="user_id">User id</label>
                                                <input name="user_id" id="user_id" type="text" class="form-control"/>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>

                </div>
        </div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit</h4>
                        </div>
                        <form action="{{route('tasks.update', 'test')}}" method="post">
                                {{method_field('patch')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                        <input type="hidden" id="task_id" name="task_id" value=""/>
                                        <input type="hidden" name="assign" id="assign" value="{{Auth::user()->id}}"/>
                                        <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" value=""/>
                                        </div>
                                        <div class="form-group">
                                                <label for="des">Description</label>
                                                <textarea  name="description" id="des" cols="20" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                        <option value="1">
                                                                Finished
                                                        </option>
                                                        <option value="0">
                                                                Unfinished
                                                        </option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="user_id">User id</label>
                                                <input value="" name="user_id" id="user_id" type="text" class="form-control"/>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>

                </div>
        </div>
</div>

<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="text-center modal-title" id="myModalLabel">DELETE Article Confirmation</h4>
                        </div>
                        <form action="{{route('tasks.destroy', 'test')}}" method="post">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                        <p class="text-center">
                                                Are you sure you want to delete this article?
                                        </p>
                                        <input type="hidden" id="task_id" name="task_id" value=""/>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning">Delete Article</button>
                                </div>
                        </form>

                </div>
        </div>
</div>

@endsection
