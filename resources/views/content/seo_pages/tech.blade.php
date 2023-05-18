@php
    use App\Models\Content;
    $data = new Content();
    $data->title_seo = '';
    $data->description = '';
@endphp
<x-layouts.main :data="$data">
    tech
</x-layouts.main>
