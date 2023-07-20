<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" value="{{ $product->name ?? old('name') }}" class="form-control" id="name">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="description" rows="3">
        {{ $product->description ?? old('description') }}
    </textarea>
</div>
<div class="col-md-6 mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text" name="price" value="{{ $product->price ?? old('price') }}" class="form-control" id="price">
</div>

<div class="col-md-6 mb-3">
    <select class="form-select" name="status" aria-label="Default select example">
        @foreach(\App\Enums\ProductStatusEnum::cases() as $status)
            <option value="{{ $status->value }}" @selected($product->status == $status->value ?? old('status'))>{{ $status->name }}</option>
        @endforeach
    </select>
</div>
