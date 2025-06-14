@if($errors->has($fieldName))
    <div class="text-danger small">
        {{ $errors->first($fieldName) }}
    </div>
@endif
