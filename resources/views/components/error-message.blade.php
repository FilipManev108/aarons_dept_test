@props(['message'])

<div role="alert" {{ $attributes->merge(["class" => "alert alert-danger mt-2"]) }}>
    {{ $message }}
</div>