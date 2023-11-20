<x-layout>
    <x-breadcrumbs :links="['My Jobs'=>'#']" class="mb-4"/>
    <div class="mb-8 text-right">
        <x-link-button href="{{route('my-jobs.create')}}">Add New</x-link-button>
    </div>
    
    @forelse ($jobs as $job )
            <x-job-card class="mb-4" :$job>
                <div class="text-xs">
                    @forelse ($job->jobApplications as $application)
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <div>{{$application->user->name}}</div>
                                <div>Appiled {{$application->created_at->diffForHumans()}}</div>
                                <div>Download Cv</div>
                            </div>
                            <div> ${{number_format($application->expected_salary)}} </div>
                        </div>
                    @empty
                        <div class="mb-4">No applications yet</div>
                    @endforelse
                    <div class="flex items-center justify-between space-x-2">
                        <x-link-button href="{{route('my-jobs.edit',$job)}}">Edit</x-link-button>
                        
                        @if (!$job->deleted_at)
                            <form action="{{route('my-jobs.destroy',$job)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button >Delete</x-button>
                            </form>
                        @else
                            <span class="text-xs text-red-500">Deleted</span>
                        @endif
                    </div>
                </div>
            </x-job-card>
        @empty
            <div class="rounded-md border border-dashed border-slate-700 p-8">
                <div class="text-center font-medium"> 
                    No Jobs Yet
                </div>
                <div class="text-center">Post your first job <a href="{{route('my-jobs.create')}}" class="text-indigo-500 hover:underline">here!</a></div>
            </div>
        @endforelse
</x-layout>