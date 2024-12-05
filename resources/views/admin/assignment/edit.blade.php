@section('title', 'Edit Tugas Materi')

@section('content')
    <div class="container">
        <h1>Edit Tugas</h1>

        <form action="{{ route('dashboard.assignment.update', $assignment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="material_id" class="form-label">Pilih Materi</label>
                <select name="material_id" id="material_id" class="form-control" required>
                    @foreach ($materials as $material)
                        <option value="{{ $material->id }}"
                            {{ $material->id == $assignment->material_id ? 'selected' : '' }}>
                            {{ $material->name }} - {{ $material->topic->course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $assignment->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $assignment->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                <input type="date" name="due_date" id="due_date" class="form-control"
                    value="{{ old('due_date', $assignment->due_date) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
