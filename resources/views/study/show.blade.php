
<script>
    const flashcards = @json($set->flashcards);
</script>

    <!-- confetti !!!! https://preline.co/docs/confetti.html /-->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="max-w-150 flex flex-col justify-center items-align mx-auto gap-6 p-2">
        
        <div class="flex justify-between items-center text-center mx-12">
            <div class="flex flex-col">
                <h1 class="font-bold text-3xl text-[var(--primary)] px-4">{{ $set->title }}</h1>
                <p class="pl-4 pt-1 text-sm  text-[var(--primary)]/60 flex items-center gap-1">
                    <!-- link to profiles, not implemented yet but want to do this later /-->
                    <a href="">
                        <i class="bi bi-person-circle"></i>
                        <span>{{ $set->user->name }}</span>
                    </a>
                </p>
            </div>
        <!-- add an edit button for users studying their own set/-->
            <!-- if user clicks on their own study set, have edit button/-->
        @if ($set->user_id === auth()->id())
            <!--<a href="{{ route('edit', ['set' =>$set->id]) }}"></a>/-->
            <!-- took out of a link bc edit not functional, wont be for presentation /-->
            <i class="bi bi-pencil-square  text-2xl  text-[var(--secondary)]/60 font-bold px-4 hover:text-[var(--accent)]"></i>
            
            <!-- else show the save set with bookmark /-->
            @else
                <i
                class="bookmark bi {{ auth()->user()?->savedSets->contains($set->id) ? 'bi-bookmark-fill' : 'bi-bookmark' }} text-2xl text-[var(--secondary)]/60 font-bold px-4 cursor-pointer transition duration-300 ease-in-out hover:-translate-y-1"
                data-set="{{ $set->id }}"></i>
        @endif

    </div>



    @if($set->flashcards->isNotEmpty())

        <!-- progress bar  https://flowbite.com/docs/components/progress/ /-->
        <div class=" mx-auto w-125 bg-black/3 rounded-full">
            <div class="bg-gradient-to-r from-[var(--accent)]/50 to-[var(--secondary)]/70
                        text-xs font-medium text-white text-center leading-none rounded-full h-6 flex items-center justify-center
                        progress_bar transition-[width] duration-500 ease-out" style="width: 0%"></div>
        </div>

        <div class="flex justify-center align-center">
            <!-- https://codepen.io/mehedihasan06/pen/bGQgBZW some refernce code stuff /-->
            <div class=" relative mx-auto">
                <div class="flashcard bg-black/3 p-5 text-center h-75 w-125 rounded-xl transition duration-1000 ease-in-out text-2xl font-semibold"
                    style="transform-style: preserve-3d;">
                
                    <!-- <h1 class="text text-center">{{ $set->flashcards[0]->term }}</h1> /-->
                    <div class="front p-2 m-2 absolute inset-0 flex items-center justify-center [backface-visibility:hidden]">
                        <h1 class="text-[var(--primary)]">{{ $set->flashcards[0]->term }}</h1>
                    </div>

                    <div class="back  p-2 m-2 absolute inset-0 flex items-center justify-center [backface-visibility:hidden] [transform:rotateY(180deg)]">
                        <h1 class="text-[var(--primary)]">{{ $set->flashcards[0]->definition }}</h1>
                    </div>
                </div>

            </div>
        </div>
        
        
        @else 
            <p class="text-xl ">No flashcards yet...</p>
    @endif

        <!-- idk style these better /-->
        <div class="arrows flex justify-center items-align text-4xl gap-2 ">
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
        <div class="flex justify-end text-xl font-bold text-[var(--primary)] gap-4 mb-10 mr-14">
            <i class="bi bi-gear transition duration-300 ease-in-out hover:-translate-y-1"></i>
            <i id="shuffle" class="bi bi-shuffle transition duration-300 ease-in-out hover:-translate-y-1"></i>
            <i class="bi bi-flag transition duration-300 ease-in-out hover:-translate-y-1"></i>
        </div>


    </div>


    <!-- i gotta add js for the flip to definition im guessing --DONE /-->
    <script>

        const flashcard = document.querySelector('.flashcard');
        const numShown = document.querySelector('.num');

        let index = 0;
        let isFlipped = false;
        let canFlip = true;


        // getting percentage for the progress bar
        const progress_bar = document.querySelector('.progress_bar');
        const totalCards = {{ $set->flashcards->count()}};
        console.log("Total Cards: ", totalCards);

        function updateProgress() {
            const percent = Math.min(Math.round((index / totalCards) * 100), 100);

            progress_bar.style = `width: ${percent}%`;
            progress_bar.textContent = `${percent}%`;

        }

        // percentage = (index + 1) / totalCards;
        // console.log(percentage, "%");

        // confetti
        // if can flip (cannot flip on last card )
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
        // add that space bar flips eventually (also arrows go on to next card and previous)
        flashcard.addEventListener('click', () => {

            if (!canFlip) {
                return; // dont allow flipping on last slide basically 
            }

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
            canFlip = true; // set back to true 
            console.log("index: ", index);
            if (index > 0) {
                index--;

                updateProgress();
                changeCards();

            }

            // take away the styling 
            flashcard.classList.add('bg-black/3');
                flashcard.classList.remove(
                    'bg-gradient-to-br',
                    'from-[var(--accent)]/40',
                    'to-[var(--secondary)]/60'
                );

            //flashcard.id = ' id="hs-run-on-click-run-confetti" ';
            
            updateProgress();
        });

        // next
        document.querySelector('.arrow-next').addEventListener('click', () => {
            console.log("index: ", index);
            if (index < flashcards.length -1) {
                index++;
                updateProgress();
                changeCards();
                return;
            }
                // console.log(index);
                // reaches last card, increment num studies
            if (index === flashcards.length - 1) {
                // percentage = 100;
                index = totalCards;
                updateProgress();
                canFlip = false;
                console.log("100% done !!!");

                // style for completion
                flashcard.classList.remove('bg-black/3');
                flashcard.classList.add(
                    'bg-gradient-to-br',
                    'from-[var(--accent)]/40',
                    'to-[var(--secondary)]/60',
                );

                const termSide = flashcard.querySelector('.front');
                const defSide = flashcard.querySelector('.back');


                termSide.innerHTML = `
                    <div class="flex flex-col items-center justify-center gap-4">
                        <i class="bi bi-check-circle text-5xl text-[var(--bg)]"></i>
                        <h1 class="text-3xl font-bold text-[var(--bg)]">
                            All Done!
                        </h1>
                        <p class="text-sm text-[var(--bg)]/70">
                            Nice work — you finished the studying
                        </p>
                    </div>
                `;

                // make the def bc if you go from def to the last card it doesnt flip oopsie bug hard coded fix 
                defSide.innerHTML = `
                    <div class="flex flex-col items-center justify-center gap-4">
                        <i class="bi bi-check-circle text-5xl text-[var(--bg)]"></i>
                        <h1 class="text-3xl font-bold text-[var(--bg)]">
                            All Done!
                        </h1>
                        <p class="text-sm text-[var(--bg)]/70">
                            Nice work — you finished the studying
                        </p>
                    </div>
                `;

                // confetti !!!! https://preline.co/docs/confetti.html 
                confetti({
                    particleCount: 100,
                    spread: 80,
                    origin: {
                        y: 0.6
                    },
                    colors: ['#5b5a76', '#d95242', '#fcba63']
                });
            
            }
        });

        // bookmark toggling to save and unsave study sets
        const bookmark = document.querySelector('.bookmark')
        // get set id
        let setID = bookmark.dataset.set;

        // false if not filled, true if filled 

        bookmark.addEventListener('click',  () => {

            fetch(`/study/${setID}/saveSet`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                }
            })
            
            .then(res => res.json())
            .then(data => {
                console.log(data);
                console.log(bookmark.classList.toString());
                // if saving the set
                if (data.saved) {
                    // add fill
                    bookmark.classList.remove('bi-bookmark');
                    bookmark.classList.add('bi-bookmark-fill');
                } else {
                    // remove fill if unsaving
                    bookmark.classList.remove('bi-bookmark-fill');
                    bookmark.classList.add('bi-bookmark');
                }


            })
            .catch(err => console.error(err));
        });

        // shuffle functions for flashcards
        // do later on eventually,on

        changeCards();
        



    </script>
</x-layout>

