<div class="form-group">
    <label>Judul</label>

    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
    value="{{ old('title', $update ? $video->title:'') }}" required>

    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Deskripsi</label>

    <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $update ? $video->description:'') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>File Video</label>

    <input name="file" type="file" class="form-control @error('file') is-invalid @enderror"
    value="{{ old('file', $update ? $video->file:'') }}" @if(!$update) required @endif>

    @if($update)
    <small id="fileHelp" class="form-text text-muted">
        Kosongkan bila tidak ingin mengganti video
    </small>
    @endif

    @error('file')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
