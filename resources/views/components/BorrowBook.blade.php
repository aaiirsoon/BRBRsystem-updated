<div x-show="showModal" x-cloak>
    <!-- borrow book modal -->
    <div x-show="open" x-transition x-cloak
        class="fixed inset-0 flex items-center justify-center z-20">
        <div x-cloak class="bg-gray-800 bg-opacity-75 absolute inset-0"></div>
        <div x-cloak class="bg-[#FCFCFF] p-6 rounded-lg z-10 w-1/2 h-auto">
            <h2
                class="uppercase bg-green-800 rounded-lg text-lg text-white p-2 font-semibold mb-4 text-center mb-6">
                Borrow Book</h2>
            <div class="flex overflow-y-auto justify-center">
                <div class="md:w-1/6 lg:w-4/6 w-2/4 ">
                    <img src="{{ asset('images/scan gif.gif') }}" alt="Description of the GIF">
                </div>
            </div>

            <div class="flex justify-center">
                <form id="borrowForm" name="borrowForm" class="form-horizontal">
                    @csrf
                    <input type="text" name="borrow_book_id" id="borrow_book_id" placeholder=" Click to read RFID" class="bg-slate-100 p-2 mb-2 border rounded w-96 text-lg">

            </div>

            {{-- NAKUHA NATIN ID GALING SA bookdescription.blade.php , TAKE NOTE, YUNG :bookId ang name variable , galing yan sa <x-BorrowBook :bookId="$bookId" /> --}}
            <div>
                <input type="hidden" id="book_id" value=" {{ $bookId }}">
            </div>

            <p id="dataContainer"> aaaaaaa</p>

            <p class="font-medium text-lg px-2 text-center text-md"><span
                    class="text-red-400 font-normal">Note: </span>Kindly scan the RFID
                Card to the
                RFID Scanner to complete the transaction.
            </p>
            <div class="mt-2">
                <div class="flex px-2">
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Borrower's Name
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_name" type="text" required disabled>
                    </div>
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Patron Type
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_type" type="text" required disabled>
                    </div>
                </div>
                <div class="flex px-2">
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Book Title
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_book" type="text" required disabled>
                    </div>
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Current Time & Date
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_time" type="text" required disabled>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-end gap-2 mt-2">
                <button  class="hidden" type="submit" id="borrowBtn"
                    class="mt-4 bg-green-700 hover:bg-green-800 px-4 py-2 rounded-lg text-white font-medium">Borrow</button>
                <button x-on:click="showModal = false" type="button"
                    class="mt-4 bg-red-400 hover:bg-red-500 px-4 py-2 rounded-lg text-white font-medium">Cancel</button>
            </div>
        </form>
        </div>
    </div>

</div>



<script>

$(document).ready(function() {
    $('#borrowBtn').on('click', function() {
        // var rfidId = $('#borrow_book_id').val();
        const bookId = "{{ $bookId }}";
        var rfidId = $('#borrow_book_id').val().trim();

        $.ajax({
            url: '/description/borrow/' + bookId +'/' + rfidId,
            type: 'GET',
            success: function(response) {

                alert('Borrowed successfully!');

            },
            error: function(xhr, status, error) {
                alert('The book is already borrowed');
            }
        });
    });
});


$(document).ready(function() {
    $('#borrowForm').on('submit', function(e) {
        e.preventDefault(); // Prevent lang sa pag submit para d mag next page or refresh
        const bookId = "{{ $bookId }}";
        // $('#book_id').val(bookId);

        var rfidId = $('#borrow_book_id').val().trim();
        var url = '/patron/borrow/' + rfidId + '/' + bookId;

        // Perform an AJAX request to fetch data based on the RFID ID
        if (rfidId !== '') {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    lagayValueSaInputFields(data);

                    $('#bookForm').off('submit').submit();
                },
                error: function(xhr, status, error) {
                  
                    alert('RFID ID is not existing');
                }
            });
        } else {
            
            alert('RFID ID is empty. Cannot proceed with form submission.');
        }
    });
});



function lagayValueSaInputFields(data) {


    var date = new Date(data.book.updated_at);
    var options = { month: 'short', day: 'numeric', year: 'numeric' };
    var formattedDate = date.toLocaleDateString('en-US', options);


    $('#borrower_name').val(data.patron.name || '');
        $('#borrower_type').val(data.patron.type || '');
        $('#borrower_book').val(data.book.title || '');
        $('#borrower_time').val(formattedDate || '');

    }





</script>