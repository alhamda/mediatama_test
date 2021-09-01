<div class="form-group">
    <label>Nama Lengkap</label>

    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
    value="{{ old('name', $update ? $customer->name:'') }}" required>

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Email</label>

    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
    value="{{ old('email', $update ? $customer->email:'') }}" required>

    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Password</label>

    <input name="password" minlength="6" maxlength="16"
    type="password" class="form-control @error('password') is-invalid @enderror"
    @if(!$update) required @endif>

    @if($update)
    <small id="passHelp" class="form-text text-muted">
        Kosongkan password bila tidak ingin mengganti
    </small>
    @endif

    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="form-group">
    <label>No. Handphone</label>

    <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror"
    value="{{ old('phone', $update ? $customer->phone:'') }}" required>

    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Alamat</label>

    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror"
    value="{{ old('address', $update ? $customer->address:'') }}" required>

    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

