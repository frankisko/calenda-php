@extends("../base")

@section("title", "Calenda - List types")

@section("content")
<div class="row">
    <div class="col-lg-12">
        <h1 class="text-center">Types</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table id="table" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->id_type }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->color }}</td>
                        <td>{{ $type->duration() }}</td>
                        <td>
                            <a href="{{ route('types.edit', $type) }}"><i class="fa fa-pencil"> </i></a>
                            &nbsp;
                            <a href="{{ route('types.show', $type) }}"><i class="fa fa-eye"> </i></a>
                            &nbsp;
                            <a href="#" class="delete" data-id="{{ $type->id_type }}"><i class="fa fa-times"> </i></a>
                            <form action="{{ route('types.destroy', $type) }}" class="form_{{ $type->id_type }}" method="POST">
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
            <a class="btn btn-info" href="{{ route('types.create') }}">Create</a>
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
                    { data: 'id_type' },
                    { data: 'name' },
                    { data: 'color' },
                    { data: 'duration' },
                    { orderable: false },
                ]
            });
        });
    </script>
@endsection