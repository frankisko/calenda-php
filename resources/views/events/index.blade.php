@extends("../base")

@section("title", "Calenda - List events")

@section("content")
<div class="row">
    <div class="col-lg-12">
        <h1 class="text-center">Events</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table id="table" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id_event }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date->format("Y-m-d") }}</td>
                        <td>{{ $event->type->name }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event) }}"><i class="fa fa-pencil"> </i></a>
                            &nbsp;
                            <a href="{{ route('events.show', $event) }}"><i class="fa fa-eye"> </i></a>
                            &nbsp;
                            <a href="#" class="delete" data-id="{{ $event->id_event }}"><i class="fa fa-times"> </i></a>
                            <form action="{{ route('events.destroy', $event) }}" class="form_{{ $event->id_event }}" method="POST">
                                @method('delete')
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12  pt-lg-5">
        <div class="text-center">
            <a class="btn btn-info" href="{{ route('events.create') }}">Create</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete record</h5>
      </div>
      <div class="modal-body">
        Do you want to delete record  <span id="record_id"></span> ?
      </div>
      <div class="modal-footer">
        <button type="button" id="close_modal" class="btn btn-secondary">Cancel</button>
        <button type="button" id="confirm_modal" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section("scripts_footer")
    <script>
        var app = {
            show_confirmation: function(id) {
                $("#record_id").text(id);
                $("#modal").modal("show");
            },
            close_modal: function() {
                $("#modal").modal("hide");
            },
            confirm_modal: function() {
                $("#modal").modal("hide");
                var record_id = $("#record_id").text();
                $(".form_" + record_id).submit();
            }
        };

        $(document).ready(function(){
            $("#container").on("click", ".delete", function(){
                app.show_confirmation($(this).data("id"));
            });

            $("#container").on("click", "#close_modal", function(){
                app.close_modal();
            });

            $("#container").on("click", "#confirm_modal", function(){
                app.confirm_modal();
            });

            $('#table').DataTable({
                columns: [
                    { data: 'id_event' },
                    { data: 'name' },
                    { data: 'date' },
                    { data: 'id_type' },
                    { orderable: false },
                ]
            });
        });
    </script>
@endsection