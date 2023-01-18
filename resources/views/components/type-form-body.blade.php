<div>
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $type->name) }}" aria-describedby="nameHelp" required>
        <div id="nameHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="color" class="form-control form-control-color" name="color" value="{{ old('color', $type->color) }}" title="Choose your color" required>
    </div>
    <div class="mb-3">
        <label for="duration" class="form-label">Duration</label>
        <select class="form-select" name="duration" aria-label="Duration" required>
            @foreach ($durations as $k => $v)
                <option value="{{ $k }}" @selected(old('duration', $type->duration) == $k)>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>