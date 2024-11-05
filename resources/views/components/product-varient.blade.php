<div class="product-variant">
    <div class="row">
        <div class="mb-3 col-6">
            <label for="size" class="form-label w-100">Size</label>
            <input type="text" placeholder="Size" class="form-control @error('product_variants.{{ $index }}.size') is-invalid @enderror" id="size" name="product_variants[{{ $index }}][size]" value="{{ old('product_variants.'.$index.'.size') }}">
            @error('product_variants.'.$index.'.size')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-6">
            <label for="mileage" class="form-label">Mileage</label>
            <input type="text" placeholder="Mileage" class="form-control @error('product_variants.{{ $index }}.mileage') is-invalid @enderror" id="mileage" name="product_variants[{{ $index }}][mileage]" value="{{ old('product_variants.'.$index.'.mileage') }}">
            @error('product_variants.'.$index.'.mileage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="wholesale_price" class="form-label">Wholesale Price</label>
            <input type="number" placeholder="Wholesale Price" class="form-control @error('product_variants.{{ $index }}.wholesale_price') is-invalid @enderror" id="wholesale_price" name="product_variants[{{ $index }}][wholesale_price]" value="{{ old('product_variants.'.$index.'.wholesale_price') }}">
            @error('product_variants.'.$index.'.wholesale_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-6">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" placeholder="Unit Price" class="form-control @error('product_variants.{{ $index }}.unit_price') is-invalid @enderror" id="unit_price" name="product_variants[{{ $index }}][unit_price]" value="{{ old('product_variants.'.$index.'.unit_price') }}">
            @error('product_variants.'.$index.'.unit_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>