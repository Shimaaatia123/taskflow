<button {{ $attributes->merge(['type' => 'submit', 'class' => 'taskflow-btn-primary']) }}>
    {{ $slot }}
</button>