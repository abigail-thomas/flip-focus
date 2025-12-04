
<script>
    const flashcards = @json($set->flashcards);
</script>

<x-layout>
    <div class="max-w-150 flex flex-col justify-center items-align mx-auto gap-6">
        
        <div class="flex justify-between items-center text-center mx-12">
            <div class="flex flex-col">
                <h1 class="font-bold text-3xl text-[var(--primary)] px-4">{{ $set->title }}</h1>
                <p class="pl-4 pt-1 text-sm  text-[var(--primary)]/60 flex items-center gap-1">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ $set->user->name }}</span>
                </p>
            </div>
        <!-- add an edit button for users studying their own set/-->
        
        <!-- save sets /-->
        <i class="star text-2xl bi bi-star text-[var(--secondary)]/60 font-bold px-4"></i>

    </div>



    @if($set->flashcards->isNotEmpty())

        <!-- progress bar  /-->


        <div class="flex justify-center align-center">
            <!-- https://codepen.io/mehedihasan06/pen/bGQgBZW some refernce code stuff /-->
            <div class="flashcard relative  !mt-5 mx-auto bg-black/3 p-10 text-center h-75 w-125 rounded-xl transition duration-1000 ease-in-out" style="transform-style: preserve-3d;">

                <!-- <h1 class="text text-center">{{ $set->flashcards[0]->term }}</h1> /-->
                <div class="front absolute inset-0 flex items-center justify-center [backface-visibility:hidden]">
                    <h1 class="text-[var(--primary)]">{{ $set->flashcards[0]->term }}</h1>
                </div>

                <div class="back absolute inset-0 flex items-center justify-center [backface-visibility:hidden] [transform:rotateY(180deg)]">
                    <h1 class="text-[var(--primary)]">{{ $set->flashcards[0]->definition }}</h1>
                </div>
            </div> 
        </div> 
        @else 
            <p class="text-xl ">No flashcards yet...</p>
    @endif

        <!-- idk style these better /-->
        <div class="arrows flex justify-center items-align text-4xl gap-2 mb-10 ">
            <i class="arrow-back bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70
                text-[#f8f8f8] rounded-xl p-2 bi bi-arrow-left
                transition duration-300 ease-in-out hover:scale-105 hover:translate-z-1"></i>
                    
                <!-- nums /-->
                <div class="text-xl font-semibold text-[#f8f8f8] rounded-xl
                    bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70
                    inline-block">
                    <h5 class="num rounded-lg p-2 m-1">1/{{ $set->flashcards->count()}}</h5>
                </div>

            <i class="arrow-next bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70
                text-[#f8f8f8] rounded-xl p-2 bi bi-arrow-right
                transition duration-300 ease-in-out hover:scale-105 hover:translate-z-1"></i>
        </div>

    </div>


    <!-- i gotta add js for the flip to definition im guessing --DONE /-->
    <script>

        const flashcard = document.querySelector('.flashcard');
        const numShown = document.querySelector('.num');

        let index = 0;
        let isFlipped = false;


        function changeCards() {
            const termSide = flashcard.querySelector('.front');
            const defSide = flashcard.querySelector('.back');

            
            // flip back to term when card switches 
            // causing issues, showing term of next card bc it switches before flipping
            // disbale the transitions for a moment
            flashcard.style.transition = 'none';

            flashcard.style.transform = 'rotateY(0deg)';
            isFlipped = false;

            // forces no trnaisiton
            flashcard.getBoundingClientRect();


            // new card text
            termSide.innerHTML = `<h1 class="text-2xl font-semibold text-[var(--primary)]">${flashcards[index].term}</h1>`;
            defSide.innerHTML = `<h1 class="text-2xl font-semibold text-[var(--primary)]">${flashcards[index].definition}</h1>`;

            numShown.textContent = `${index + 1}/${flashcards.length}`;
            
            // add transition back 
            // not working tho 
            flashcard.style.transition = 'transform 1s ease-in-out';
                
        }
        // let showTerm = true;

        flashcard.addEventListener('click', () => {
            if (isFlipped) {
                flashcard.style.transform = 'rotateY(0deg)';
            }
            else {
                flashcard.style.transform = 'rotateY(180deg)';
                // i want to make the def side different color
                // flashcard.classList.remove('bg-black/3');
                // flashcard.classList.add('bg-[var(--secondary)]/20');

            }
            isFlipped = !isFlipped;
        });

        // the arrows to go back and next
        // back 
        document.querySelector('.arrow-back').addEventListener('click', () => {
            if (index > 0) {
                index--;
                changeCards();
            }
        });

        // next
        document.querySelector('.arrow-next').addEventListener('click', () => {
            if (index < flashcards.length - 1) {
                index++;
                
                changeCards();
                // console.log(index);
                // reaches last card, increment num studies
                if (index === flashcards.length - 1) {
                    console.log('here');
                    
                }
        
            }
        });

        // star toggling 
        star = document.querySelector('.star')
        let filled = false;

        star.addEventListener('click', () => {
            if (filled) {
                star.classList.add('bi-star');
                star.classList.remove('bi-star-fill')
            }
            else {
                star.classList.remove('bi-star');
                star.classList.add('bi-star-fill')
            }
            filled = !filled;


        });



        changeCards();
        



    </script>
</x-layout>

