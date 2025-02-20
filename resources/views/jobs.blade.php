
<x-layout>
<x-slot:heading>
        Job Listings
    </x-slot:heading>
    <ul>
@foreach($jobs as $job)

<li>
    <a href="/jobs/{{$job['id']}}" class="block px-4 py-6 border border-gray-200">
    <strong>{{ $job['title']  }}</strong>: Pays{{ $job['salary'] }} per month.
    </a>
</li>

@endforeach
    </ul>
</x-layout>