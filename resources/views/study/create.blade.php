
<x-layout>
    <div class="flex flex-row justify-center mx-auto items-center">
        <div class="p-[20px] m-[40px] text-[#5b5a76] text-center">
            <div>
        <h1 class="text-4xl lg:text-5xl font-bold text-[var(--primary)] mb-4 text-center"
                    >Create Study Set</h1>  
        <p class="text-xl text-[var(--accent)]/70 mb-6">
        Build you own flashcards and share with the world!
        </p>

            </div>
            
        <form action="{{ route('study.store') }}" method="POST" class="flex flex-col form w-full bg-gradient-to-br from-black/5 to-black/2  m-4 mb-8 p-8 rounded-xl">
            @csrf
        <div class="bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70 rounded-xl p-6 mx-auto max-w-175">
                
                <!-- <label for="set-title"><h3>Title</h3></label> /-->
                <input type="text" name="title" id="title" placeholder="Title: e.g., Advanced Topics in Web" required
                class="w-full bg-[#F8F8F8] p-4 my-2 rounded-xl  focus:none">

                <!-- <label for="set-subject"><h3>Subject</h3></label> /-->
                <select name="subject" id="subject" class="w-full bg-[#F8F8F8] p-4 my-2 rounded-xl focus:none text-gray-400"
                required>
                    <option value="">Select a subject</option>
                    <option value="math">Mathematics</option>
                    <option value="science">Science</option>
                    <option value="history">History</option>
                    <option value="language">Language Arts</option>
                    <option value="foreign-language">Foreign Language</option>
                    <option value="social-studies">Social Studies</option>
                    <option value="computer-science">Computer Science</option>
                    <option value="other">Other</option>
                </select>

                <!-- <label for="set-desc"><h3>Description</h3></label> /-->
                <textarea class="w-full h-40 bg-[#F8F8F8] p-4 my-2 rounded-xl focus:none focus:border-transparent resize-none"
                name="description" id="description" placeholder="Describe the study set..." required></textarea>

                
            </div>

            <div id="flashcard-container" class="mt-2">
                <div  class="flashcard bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70 rounded-xl p-6 mx-auto my-4 max-w-175" id="flashcards-container">
                    <!-- delete term and def  /-->
                    <div class="flex justify-between">
                        <h3 class="text-left text-[#F8F8F8] p-2">1.</h3>
                    </div>

                        <input type="text" name="term[]" placeholder="Term" required class="w-full bg-[#F8F8F8] p-4  my-2 rounded-xl  focus:none ">
                        <input type="text" name="definition[]" placeholder="Definition" required class="w-full bg-[#F8F8F8] p-4 my-2 rounded-xl  focus:none ">
                </div>


                <!-- buttons /-->
            <div class="flex flex-row m-4 p-4 items-align justify-center gap-4 ">
                <button
                class="add-btn uppercase w-fit h-fit text-[var(--accent)] p-4 rounded-xl font-bold
                        bg-transparent shadow-lg outline-dashed
                        hover:text-[var(--secondary)] transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl"
                    type="button"
                    id="add-card-btn"
                    onClick="addCard()"
                    style="font-family: 'Roboto Condensed';"
                    >

                + Add New Card</a> <!-- create a new card-->

                <div class="create-set">
                    <button type="submit" class="btn ">Create Set</a> <!-- create the set -->
                </div>
            </div>
            </div>


            
        </form>
        </div>
    </div>

    <script>
        let cardCount = 1; // start at one duh

        // function to add cards
        function addCard() {
            const container = document.getElementById('flashcards-container');

            const cardHTML = `
                <div class="flashcard mt-4">
                    <div class="flex justify-between">
                        <h3 class="text-left text-[#F8F8F8] p-2">${cardCount + 1}.</h3>
                        <button type="button" class="delete-btn p-2 focus:outline-none hover:bg-[var(--accent)]/30 rounded-xl">
                            <i class="bi bi-trash text-[var(--accent)] text-lg"></i>
                        </button>
                    </div>
                    <input type="text" name="term[]" placeholder="Term" required class="w-full bg-[#F8F8F8] p-4 my-2 rounded-xl">
                    <input type="text" name="definition[]" placeholder="Definition" required class="w-full bg-[#F8F8F8] p-4 my-2 rounded-xl">
                </div>
        `;
            container.insertAdjacentHTML('beforeend', cardHTML);
            cardCount++;
        }

        // when delted, the number on term and def shoudl change grrrrr
        document.getElementById('flashcards-container').addEventListener('click', function(e) {
            if(e.target.closest('.delete-btn')) {
                e.target.closest('.flashcard').remove();
            }
        });

    </script>

</x-layout>