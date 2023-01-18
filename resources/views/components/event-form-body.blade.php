<div>
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $event->name) }}" aria-describedby="nameHelp" required>
        <div id="nameHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="description" class="form-control" name="description" value="{{ old('description', $event->description) }}">
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control datepicker" id="date" name="date" aria-describedby="dateHelp" value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" name="id_type" aria-label="Type" required>
            @foreach ($types as $type)
                <option value="{{ $type->id_type }}" @selected(old('id_type', isset($event->type)? $event->type->id_type: '') == $type->id_type)>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>