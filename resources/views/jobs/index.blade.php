<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs'=>route('jobs.index')]"/>
    <x-card class="mb-4 text-sm">
        <form action="{{route('jobs.index')}}" method="GET" id="filtering-form">
            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" formId="filtering-form" value="{{request('search')}}" placeholder="Search for any job"/>
                </div>
                <div class="">
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" formId="filtering-form" value="{{request('min_salary')}}" placeholder="From"/>
                        <x-text-input name="max_salary" formId="filtering-form" value="{{request('max_salary')}}" placeholder="To"/>   
                    </div>
                </div>
                <div class="">
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-group name="experience" :options="array_combine(array_map('ucfirst',\App\Models\Job::$experience),\App\Models\Job::$experience)"/>
                </div>
                <div class="">
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="\App\Models\Job::$category"/>
                </div>
            </div>
            <x-button class="w-full mt-4" type="submit">Filter</x-button>
        </form>
    </x-card>
    <div class="">
        @foreach ($jobs as $job )
            <x-job-card class="mb-4" :$job>
                <div class="">
                    <x-link-button :href="route('jobs.show',$job)">
                        See Details
                    </x-link-button>
                </div>
            </x-job-card>
            @endforeach
        </div>
</x-layout>