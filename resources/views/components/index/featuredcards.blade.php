

<div class="max-auto p-1 my-8 text-[#5b5a76] text-center">
    <div class="bg-gradient-to-br from-black/5 to-black/2  m-2 mb-8 p-8 rounded-xl">
        <!-- featured sets will be top 5 highest rated in past week
        ... i dont think that shoudl be too difficult to implement-->
        <h1 class="text-4xl lg:text-5xl font-bold text-[var(--primary)] mb-4 text-center"
            >Featured Study Sets</h1>
        <!-- add category (language, history, etc..) /-->
            <p class="text-xl text-[var(--primary)]/70 mb-6">Popular sets from our community</p>

        <!-- the linsk to each flashcard is obv not real
        i will have one page that will load relevant flashcard data 🐱
        -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                    transition-all duration-300 ease-in-out transform hover:translate-x-1 hover:scale-105
                    text-[var(--primary)]
                    border-none text-left relative">

                    <div class="flex items-start justify-between mb-4 group-hover:text-[#d95242] ">
                        <div class="flex-1">
                            <h3 class="font-bold text-2xl mb-2 text-[var(--accent)]/80">{{ $set['title'] }}</h3>
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
                                    <i class="bi bi-layers-fill text-[#d95242]/60"></i>
                                    <span class="text-sm font-medium">{{ $set->flashcards->count() }} cards</span>
                                </div>
                                <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                    <i class="bi bi-book-half text-[var(--primary)]/60"></i>
                                    <span class="text-sm font-medium">{{ $set['num_studies'] }} studies</span>
                                </div>
                                <div class="flex items-center gap-1 text-[var(--primary)]/70">
                                    <i class="bi bi-bookmark-fill text-[var(--secondary)]/60"></i>
                                    <span class="text-sm font-medium">{{ $set['num_saved']}} saves</span>
                                </div>
                            </div>

                        </div>
                    </div>
                        
                </div>
                </a>
            @endforeach
        </div>
        
        <!-- broswe arrow /-->
        <div class="mt-20 animate-bounce w-30 mx-auto">
            @auth
                <a href="{{ route('study.browse') }}">
            @endauth
            @guest
                <a href="{{ route('register') }}">
            @endguest
            <p class="text-lg font-bold text-[var(--primary)]/80 ">Browse All</p>
            <i class=" pt-4 text-3xl font-bold bi bi-arrow-down text-[var(--primary)]/80 "></i>
        </a>
        </div>
        

    </div>
</div>