<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    @foreach ($jobs as $job)
        <div class="space-y-4">
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200">
                <div class="font-bold text-blue-500 text-sm">{{ $job->employer->name }}</div>
                <div><strong>{{ $job['title'] }}</strong>: Pays{{ $job['salary'] }} per month.
                </div>
            </a>
        </div>
        
    @endforeach
    <div>
        {{ $jobs->links() }}
    </div>
</x-layout>
