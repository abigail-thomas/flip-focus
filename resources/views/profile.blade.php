<x-layout>
    <!-- welcome user section /-->
    <div class="mx-12">
        <div class="flex mx-auto justify-center flex-col max-w-200 bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70
            py-10 px-4 rounded-xl">
        <h1 class="text-xl font-bold text-[#F8F8F8]/90 mb-2">Welcome back, {{ $user->name }}!</h1>
        <p class="text-xl text-[#F8F8F8]/70">Jump back into old study sets, refresh recent cards, or create a start learning new material! </p>
    </div>
    <!-- buttons for quick start /-->
        <!-- i dont like the colors here for the buttons /-->
        <div class="p-8 gap-4
        flex div-row mx-auto align-center justify-center ">
            <!-- guest or not signed in/-->

            <a href="{{ route('study.create') }}" class="btn ">
                <span>Create <i class="bi bi-plus"></i></span>
            </a>
            <a href="{{ route('study.browse') }}" class="btn ">
                <i class="bi bi-search pr-1"></i>
                <span>Browse All</span>
            </a>
        </div>
    </div>

    <!-- user stats stuff /-->

    
    
    <div class="max-auto px-1 my-8 text-[#5b5a76] text-center">
    <div class="bg-black/3 m-2 mb-8 p-8 rounded-xl">
        <!-- featured sets will be top 5 highest rated in past week
        ... i dont think that shoudl be too difficult to implement-->
        <h1 class="mb-2 py-8 text-3xl lg:text-5xl font-bold text-[var(--primary)] text-center"
            >Your Study Sets</h1>
        <!-- add category (language, history, etc..) /-->
            

        <!-- the linsk to each flashcard is obv not real
        i will have one page that will load relevant flashcard data 🐱
        -->
        @if($studySets->count() > 0)

        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- card 1-->

                @foreach($studySets as $set)
                    

                        <div
                        class="bg-white rounded-2xl
                        p-6 shadow-md hover:shadow-lg
                        transition-all duration-300 ease-in-out transform hover:translate-x-1 hover:scale-105
                        text-[var(--primary)]
                        border-none text-left relative
                        ">
                            
                        <form
                            action="{{ route('set.destroy', ['studySet' => $set->id]) }}"
                            method="POST"
                            class="absolute top-4 right-4 z-20 p-2 hover:bg-[var(--accent)]/30 rounded-xl"
                            onsubmit="return confirm('Are you sure you want to delete this set?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="focus:outline-none">
                                <i class="bi bi-trash text-[var(--accent)] text-lg"></i>
                            </button>
                        </form>
                        
                        <a href="{{ route('study.show', ['studySet' =>$set->id]) }}" class="stretched-link">
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
                                <hr class="my-3 border-[var(--primary)]/20 mb-4"/>
                                
                                
                                <div class="flex items-center justify-between px-2">
                                    <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                        <i class="bi bi-layers-fill text-[#d95242]/70"></i>
                                        <span class="text-sm font-medium">{{ $set->flashcards->count() }} cards</span>
                                    </div>
                                    <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                        <i class="bi bi-bookmark-check-fill text-[var(--primary)]/80"></i>
                                        <span class="text-sm font-medium">{{ $set['num_studies'] }} studies</span>
                                    </div>
                                    <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                        <i class="bi bi-star-fill text-[var(--secondary)]/60"></i>
                                        <span class="text-sm font-medium">0.0</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                          </a>  
                    </div>
                    
                @endforeach

        </div>

        <!-- no study sets yet /-->
        @else
            <hr class=" border-[var(--accent)]/60 mb-4 max-w-100 mx-auto"/>

            <div class="flex sm:flex-col lg:flex-row justify-center items-center mx-auto py-8 gap-2">
                
                <!-- text and button /-->
                <div class="flex-1 flex flex-col space-y-6 p-4 lg:pl-10 gap-4 lg:gap-10 mx-auto justify-center">
                    <div class="inline-flex items-center justify-center w-18 h-18 bg-gradient-to-r from-[var(--secondary)] to-[var(--secondary)]/70 rounded-full mb-6 shadow-md mx-auto">
                        <i class="bi bi-inbox text-white text-3xl"></i>
                    </div>
                    <p class="text-2xl font-semibold text-[var(--primary)]/70 mb-1">Nothing here yet...</p>
                    <p class="text-xl text-[var(--primary)]/70 mb-6">
                        Get started by creating your first study set. Build flashcards, learn efficiently, and track your progress!</p>

                    <a href="{{ route('study.create') }}" class="btn mx-auto mb-8">
                        <span>Start Creating Now <i class="bi bi-plus"></i></span>
                    </a>
                </div>

                <!--image  /-->
                <div class="flex-1 flex justify-center lg:justify-center">
                    <img src="{{ asset('images/cat.png') }}" alt="penguin" class="relative w-72 h-72 lg:w-80 lg:h-80 rotate-y-180">
                </div>
            </div>

                
            @endif

                    

    </div>
</div>
    

        <div class="p-8 m-8 flex">
            <a href="{{ route('logout') }}" class="btn mx-auto">Sign Out</a>
        </div>
</x-layout>