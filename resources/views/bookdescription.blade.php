@extends('layouts.app')


@section('nav')
@endsection

@section('content')
<div class="min-h-screen bg-[#F6FFF1] w-full">
        <!-- CONTAINER -->
        <div class="flex w-full mt-2 py-10 h-[90vh]">
            <div class="flex w-full mx-64 gap-4">
                <div class="button-container sticky top-10 z-10">
                    <button
                        class="bg-green-700 rounded px-3 py-1.5 text-white hover:bg-[#14532D] flex justify-center items-center gap-1 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        <span>back</span>
                    </button>
                </div>

                <div class="flex w-full gap-6">
                    <div class="w-1/4 h-full">
                        <div class="flex flex-col items-center h-full">
                            <div class="w-full border-2 border-gray-600 rounded-lg">
                                <img class="w-full object-cover" src="../Atomic+Habits.png" alt="Atomic Habits Image">
                            </div>

                            <div class="w-full h-[60vh] overflow-y-auto mt-6 px-3 pt-4 ">
                                <p class="font-medium text-lg">Book Title: <span class="font-normal text-lg title"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Location Rack: <span
                                        class="font-normal text-lg location_rack"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Edition: <span class="font-normal text-lg edition"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Author: <span class="font-normal text-lg author"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Publisher: <span
                                        class="font-normal text-lg publisher"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Copyright Year: <span
                                        class="font-normal text-lg copyright_year"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Category: <span
                                        class="font-normal text-lg category"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Condition: <span
                                        class="font-normal text-lg condition"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">ISBN: <span
                                        class="font-normal text-lg isbn"></span></p>
                                <!-- <hr> -->
                            </div>

                        </div>
                    </div>

                    <!--FROM API TO ng BorrowController@Show , GAGAMITIN ANG UNIQUE ID-->
                    @if($selectedBook->id)
                    <p>ID of the selected book: {{ $selectedBook->id }}</p>
                    @else
                    <p>No book found</p>
                    @endif


                    <div class="w-full h-full">
                        <div class="flex flex-col p-1 h-full">
                            <div class="flex justify-between items-center">
                                <p class="font-medium text-3xl title"></p>
                                <p class="text-xl">Status: <span class="font-medium text-xl status condition"></span></p>
                            </div>
                            <p class="text-lg">Author/s:<p class="author"><p></p>
                            <hr class="my-3">
                            <div>
                                <p class="font-semibold text-xl text-gray-500">Description</p>
                            </div>
                            <div class="h-[50vh] overflow-y-auto">
                                <p class="text-xl text-justify text-gray-800 leading-6 description"></p>
                            </div>
                            <hr class="my-4">

                            <p class="font-semibold text-xl font-md text-gray-600">Borrow History</p>
                            <div class="h-[25vh] overflow-y-auto">
                                <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2" id="data-table">
                                    <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                        <tr class="bg-green-800 text-white text-center">
                                            <th
                                                class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                BORROW NO.
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                BORROWER'S NAME
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                borrower TYPE
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                Date BORROWED
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                DATE Returned
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableBody">
                                        <tr id="noRecordsMessage" class="text-center ">
                                            <td class="py-8 px-8 border-b border-gray-200 text-gray-500" colspan="5">
                                                No existing records found.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end gap-2">
                                <!-- borrow modal -->
                                <div x-data="{ showModal: false }" class="mb-4 flex justify-end" id="borrowModal">               
                                    <button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"
                                        class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium mt-4">Borrow
                                    </button>   

                                    @php
                                        $bookId = request()->segment(count(request()->segments()));
                                    @endphp

                                {{-- ETONG PHP CODE SA TAAS  KINUHA UNG ID IPAPASOK SA BORROW MODAL SA BABA --}}

                                    <x-BorrowBook :bookId="$bookId" />
                                                            
                                </div>
                                 <!-- borrow modal -->
                                {{-- BORROWING AND RETURN MAGSHARE NLNG SILA DYAN SA MODAL, SA CONDITION NALANG MAG CHECK
                                    IF BORROWED , DISPLAY NAME NG BUTTON "RETURN" 
                                    IF HINDI NAMAN BORROWED, DISPLAY NAME BUTTON " BORROW " --}}
                                  
                            </div>

                        </div>
                    </div>
                </div>

                <!-- End Right Column -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // purpose nito ay para hindi magsara ung modal... pag nagsusubmit kasi automatic close ung modal
    $('#borrowForm').on('submit', function(e) {
        e.preventDefault(); 

        // var bookId = '{{ $bookId }}'; 

        // alert(bookId);
    });
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/description/' + {{ $selectedBook->id}},
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('.title').text(data.title); 
            $('.location_rack').text(data.location_rack); 
            $('.edition').text(data.edition);
            $('.author').text(data.author);  
            $('.publisher').text(data.publisher); 
            $('.copyright_year').text(data.copyright_year); 
            $('.category').text(data.category); 
            $('.condition').text(data.condition); 
            $('.isbn').text(data.isbn); 
            $('.description').text(data.description); 
        }
    });

    var table = $('#data-table').DataTable({
                dom: 'lrtip',
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/borrowhistory/' + {{ $selectedBook->id}},
                    type: 'GET'
                },
                columns: [    
                    { data: 'id', name: 'id' },
                    { data: 'patron_name', name: 'patron_name' },
                    { data: 'patron_type', name: 'patron_type' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }


                ]

           
    });

    




  




});



</script>

@endsection
