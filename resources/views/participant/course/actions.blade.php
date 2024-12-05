<div class="btn-group">
    <!-- Tombol Update Status -->
    <a href="{{ route('dashboard.enrollment.update', $enrollment->id) }}" class="btn btn-sm btn-success">
        Update
    </a>

    <!-- Tombol Hapus -->
    <form action="{{ route('dashboard.enrollment.destroy', $enrollment->id) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-error"
            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
            Hapus
        </button>
    </form>
</div>
