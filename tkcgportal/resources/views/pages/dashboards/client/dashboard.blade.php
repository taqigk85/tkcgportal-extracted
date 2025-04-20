@extends('layout.default')
@section('title', 'Dashboard')
@section('content')
@if (session('success'))
    <div class="flex items-center gap-2 p-2.5 mb-2 border rounded-md text-sm font-bold bg-green-100 text-green-800 border-green-300">
        <span class="w-5 h-5">
            <svg viewBox="0 0 24 24" fill="none" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="green" stroke-width="2"/>
                <path d="M7 12l3 3 7-7" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="flex items-center gap-2 p-2.5 mb-2 border rounded-md text-sm font-bold bg-red-100 text-red-800 border-red-300">
        <span class="w-5 h-5">
            <svg viewBox="0 0 24 24" fill="none" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="red" stroke-width="2"/>
                <path d="M8 8l8 8M16 8l-8 8" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        {{ session('error') }}
    </div>
@endif

<div class="flex justify-between items-center pb-5 mt-16">
  <div class="w-full max-w-full flex items-center justify-between">
  <div class="">
       <div class="flex items-center justify-start">
          <h2 class="font-normal text-2xl">Dashboard</h2>
        </div>
  </div>
</div>
</div>

<div class="">
<div class="w-[280px] p-5 rounded-xl shadow-md border border-gray-200">
  <div class="w-[50px] h-[50px] rounded-full flex justify-center items-center border border-gray-300">
    <img src="{{ asset('public/images/agenda-bookmark@2x.png') }}" alt="Projects Icon" class="w-[24px] h-[24px]">
  </div>
  <p class="text-sm text-gray-600 mt-2">Projects</p>
  <h2 class="text-2xl font-bold text-black my-1.5">{{ $countAllPojects }}</h2>
</div>

  
  @if($Projects && $Projects->count() > 0)
  <div class="flex pt-7">
   <div class="w-full">
      <div class="">
          <h3 class="font-normal">Projects</h3>
      </div>
    <div class="flex flex-col justify-between mt-2 shadow-md rounded-md md:overflow-scroll ">
      <table class="mt-0 w-full border-collapse border-spacing-0 overflow-hidden">
      <thead>
          <tr>
              <th class="text-center border-l-0 rounded-tl-md bg-[#49b747] text-white border border-white p-[15px_5px] align-baseline whitespace-normal">#</th>
              <th class="bg-[#49b747] text-white border border-white p-[15px_5px] text-left align-baseline whitespace-normal">Project – Location</th>
              <th class="bg-[#49b747] text-white border border-white p-[15px_5px] text-left align-baseline whitespace-normal">Sign Type</th>
              <th class="bg-[#49b747] text-white border border-white p-[15px_5px] text-left align-baseline whitespace-normal">Created At</th>
              <th class="border-r-0 rounded-tr-[6px] border-b border-b-[#ddd] text-left align-baseline whitespace-normal bg-[#49b747] text-white border border-white p-[15px_5px]"></th>
          </tr>
      </thead>
      <tbody>
          @foreach ($Projects as $index => $project)
          <tr>
             <td class="!align-middle text-center rounded-bl-[6px] whitespace-normal p-[5px] text-[#333] border border-[#dddddd]">{{ $index + 1 }}</td>
              <td class="!align-middle whitespace-normal p-[5px] text-[#333] border border-[#dddddd] text-left">
                <p>{{ ucfirst($project->name) }}</p>
                <p>
                    @if($project->street)
                        {{ ucfirst($project->street) }},
                    @endif
                    @if($project->city)
                        {{ ucfirst($project->city) }},
                    @endif
                    @if($project->state)
                        {{ ucfirst($project->state) }}
                    @endif
                </p>
             </td>
               <td class="!align-middle whitespace-normal p-[5px] text-[#333] border border-[#dddddd] text-left">
                @if($project->wall_type == 'channel_letters')
                    Channel Letter
                @elseif($project->wall_type == 'raceway')
                    Raceway
                @elseif($project->wall_type == 'cabinet')
                    Cabinet
                @else
                    {{ ucfirst($project->wall_type) }}
                @endif
              </td>
              <td class="!align-middle whitespace-normal p-[5px] text-[#333] border border-[#dddddd] text-left">{{ $project->created_at->format('m/d/Y') }}</td>
              <td class="!align-middle whitespace-normal p-[5px] text-[#333] border border-[#dddddd] text-left rounded-br-[6px]">
                      <div class="list-action-container flex items-center justify-center m-0 -mx-[6px]">
                        
                          <a href="{{ route('client.project.view', $project->id) }}"
                              class="bg-[#F3EAFD] mx-[6px] rounded-[20px] inline-flex items-center justify-center w-[30px] h-[30px]"><img
                                  src="{{ asset('public/images/d_eye_icon.svg') }}" alt="View Icon" class="mx-w[16px]"></a>
          
                      </div>
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
   <div class="flex justify-end">
    <a href="{{ route('client.project.list') }}" class="inline-block mt-4 px-4 py-2 bg-gray-800 text-white rounded-md no-underline text-center uppercase text-sm">View All</a>
  </div>
   </div>
 </div>
 @endif
</div>

<script>
  $('.inner-list-container').matchHeight();
  $('.wrap-table-list').matchHeight();
</script>
@endsection
