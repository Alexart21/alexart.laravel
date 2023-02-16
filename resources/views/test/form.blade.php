@php

@endphp
<x-layouts.test title="Test form">
<x-form>
    <div class="form-floating mb-3">
    <x-form-input name="last_name"  id="floatingInput1" class="form-control" />
    <label for="floatingInput1">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Адрес электронной почты</label>
    </div>
{{--    <x-form-select name="country_code" :options="$options" />--}}
{{--    <x-form-select name="interests[]" :options="$multiOptions" label="Select your interests" multiple />--}}

    <!-- \Spatie\Translatable\HasTranslations -->
    <x-form-textarea name="biography" language="nl" placeholder="Dutch Biography" />
    <x-form-textarea name="biography" language="en" placeholder="English Biography" />

    <!-- Inline radio inputs -->
    <x-form-group name="newsletter_frequency" label="Newsletter frequency" inline>
        <x-form-radio name="newsletter_frequency" value="daily" label="Daily" />
        <x-form-radio name="newsletter_frequency" value="weekly" label="Weekly" />
    </x-form-group>

    <x-form-group>
        <x-form-checkbox name="subscribe_to_newsletter" label="Subscribe to newsletter" />
        <x-form-checkbox name="agree_terms" label="Agree with terms" />
    </x-form-group>

    <x-form-submit />
</x-form>
</x-layouts.test>
