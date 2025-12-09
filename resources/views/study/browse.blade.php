
<x-layout>
    
    <div class="m-12">
        <div class="flex mx-auto justify-center flex-col max-w-200 bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70
            py-10 px-4 rounded-xl">
            <h1 class="text-2xl font-bold text-[#F8F8F8]/90 mb-2 text-center">Browse All Sets</h1>
            
                <!-- use either livewire or htmx for searching stuff  /-->
                <div class="mx-2 p-4">
                        <input
                        name="search-bar"
                        class="text-[var(--primary)] bg-[#F8F8F8] w-full py-3 pl-5 px-2 rounded-4xl border-none focus:outline-none"
                        type="search" placeholder=" 🔍︎ Search by title, creator, or subject"
                        
                        hx-get="{{ route('search') }}"
                        hx-trigger="keyup changed delay:300ms"
                        hx-target="#study-sets"
                        hx-swap="outerHTML"
                        >
                </div>
            

            
        </div>
    </div>

    <div class=" p-1 m-1 my-8 text-[#5b5a76] text-center">
    <div class="bg-black/3 m-2 mb-8 p-8 rounded-xl">

        <!-- the linsk to each flashcard is obv not real
        i will have one page that will load relevant flashcard data 🐱
        -->
        @fragment('study-search')
        <div id="study-sets" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 study-sets">
            <!-- card 1-->
            @foreach($sets as $set)
                @auth
                <a href="{{ route('study.show', ['studySet' =>$set->id]) }}" class="stretched-link">
                @endauth
                @guest
                    <a href="{{ route('register', ['studySet' =>$set->id]) }}" class="stretched-link">
                @endguest

                    <div
                    class="bg-white rounded-2xl
                    p-6 shadow-md hover:shadow-lg
                    transition-all duration ease-in-out transform hover:translate-x-1 hover:scale-105
                    text-[var(--primary)]
                    min-w-[300px] border-none text-left relative">

                    <div class="flex items-start justify-between mb-4 group-hover:text-[#d95242] ">
                        <div class="flex-1">
                            <h3 class="font-bold text-2xl mb-2  text-[var(--secondary)]/80">{{ $set['title'] }}</h3>
                            <div class="card-content">
                                @if ($set->user)
                                    <p class="text-sm mb-1 text-[var(--primary)]/60 flex items-center gap-1">
                                        <i class="bi bi-person-circle"></i>
                                        <span>{{ $set->user->name }}</span>
                                    </p>
                                @endif
                                
                            </div>
                            <p class="text-[var(--primary)]/80 mb-2 min-h-10">{{ $set['description'] }}</p>
                            <hr class="my-3 border-[var(--secondary)]/60 mb-4"/>
                            
                            
                            <div class="flex items-center justify-between px-2">
                                <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                    <i class="bi bi-layers-fill text-[#d95242]/70"></i>
                                    <span class="text-sm font-medium">{{ $set->flashcards->count() }} cards</span>
                                </div>
                                <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                    <i class="bi bi-bookmark-check-fill text-[var(--primary)]/80"></i>
                                    <span class="text-sm font-medium">{{ $set['num_studies'] }} studies</span> <!-- make this number dynamic /-->
                                </div>
                                <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                    <i class="bi bi-star-fill text-[var(--secondary)]/60"></i>
                                    <span class="text-sm font-medium">{{ $set['num_saved']}} saves</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
                </a>
            @endforeach
        </div>
        @endfragment
        

    </div>
</div>
</x-layout>