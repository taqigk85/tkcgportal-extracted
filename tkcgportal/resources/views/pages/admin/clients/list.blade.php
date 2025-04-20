@extends('layout.default')
@section('title', 'Client list')
@section('content')
<style>
.dt-layout-row.dt-layout-table{
    overflow: scroll;
}
</style>
@if (session('success'))
    <div class="flex items-center gap-2 p-3 mb-3 text-sm font-bold text-green-800 bg-green-100 border border-green-300 rounded-md alert">
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
    <div class="flex items-center gap-2 p-3 mb-3 text-sm font-bold text-red-800 bg-red-100 border border-red-300 rounded-md alert">
        <span class="w-5 h-5">
            <svg viewBox="0 0 24 24" fill="none" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="red" stroke-width="2"/>
                <path d="M8 8l8 8M16 8l-8 8" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        {{ session('error') }}
    </div>
@endif
    <div class="mx-auto my-5 mt-16 bg-white p-5 rounded-md shadow-md">
        <div class="w-full">
            <div class="flex justify-between items-center pb-5 mt-0">
                <div class="list-header">
                    <h2 class="font-normal text-2xl">Client List</h2>
                </div>
                <div class="list-header">
                    <a href="{{route('admin.client.add')}}" class="rounded-md flex items-center no-underline bg-gray-700 text-white text-sm px-3 py-2 uppercase">Add New Client</a>
                </div>
            </div>
            <div class="">
            <table class="project-list-table overflow-hidden" id="myTable">
                <thead>
                    <tr>
                        <th class="border-l-0 rounded-tl-md bg-green-600 text-white border border-white align-baseline whitespace-normal p-3">#</th>
                        <th class="bg-green-600 text-white border border-white align-baseline whitespace-normal p-3">Client Name</th>
                        <th class="bg-green-600 text-white border border-white align-baseline whitespace-normal p-3">Client Email</th>
                        <th class="bg-green-600 text-white border border-white align-baseline whitespace-normal border-b border-gray-300 rounded-tr-md"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Users as $index => $user)
                    <tr>
                        <td class="!align-middle !text-center border border-gray-300 rounded-bl-md whitespace-normal text-gray-800">{{ $index + 1 }}</td>
                        <td class="!align-middle text-gray-800 whitespace-normal border border-gray-300">{{ucfirst($user->name)}}</td>
                        <td class="!align-middle text-gray-800 whitespace-normal border border-gray-300">{{ucfirst($user->email)}}</td>
                         <td class="!align-middle whitespace-normal text-gray-800 border border-gray-300">
                                <div class="flex items-center justify-center -mx-1.5">
                                    <a href="{{ route('admin.client.edit', $user->id) }}"
                                        class="bg-[#EBF0F9] mx-1.5 rounded-[20px] inline-flex items-center justify-center w-[30px] h-[30px] p-[7px]"><img
                                            src="{{ asset('public/images/icons_edit.svg') }}" alt="Edit Icon"></a>
                                    <a href="{{ route('admin.client.view', $user->id) }}"
                                        class="bg-[#F3EAFD] mx-1.5 rounded-[20px] inline-flex items-center justify-center w-[30px] h-[30px] p-[7px]"><img
                                            src="{{ asset('public/images/d_eye_icon.svg') }}" alt="View Icon"></a>
                                    <a href="javascript:void(0);" class="bg-[#FDEDEB] mx-1.5 rounded-[20px] inline-flex items-center justify-center w-[30px] h-[30px] p-[7px] action-delete-btn"
                                        data-delete-url="{{route('admin.client.delete.post', $user->id)}}"
                                        data-client-id="{{$user->id}}"><img
                                            src="{{ asset('public/images/delete_icon.svg') }}" alt="Delete Icon"></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
     </div>
    </div>
    <script>
        let table = new DataTable('#myTable', {
            order: [[0, 'asc']], 
            columnDefs: [
                { orderable: false, searchable: false, targets: -1 }
            ]
        });
        $('body').on('click', '.action-delete-btn', function (e) {
            var that = $(this);
            const deleteUrl = $(this).data('delete-url');
            const deleteId = $(this).data('client-id');
            Swal.fire({
                title: 'Are you sure want to delete?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'YES, DELETE IT!',
                cancelButtonText: 'NO, CANCEL'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                                'id': deleteId,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                let tableRowLen = $(that).closest('tr').parent('tbody').find('tr').length;
                                $(that).parents("tr").remove();
                                Swal.fire({
                                    title: 'User has been deleted',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: '',
                                        title: '',
                                        actions: '',
                                    },

                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload(true);
                                    }
                                    else {
                                        window.location.reload(true);
                                    }
                                });
                            }
                            else {
                                console.log('Error occured');
                            }
                        },
                         error: function (data) {
                            console.log(data.message);
                        }
                    });
                }
            })
        });
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => alert.style.display = 'none');
    }, 3000);
    </script>

@endsection