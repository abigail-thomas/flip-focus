<div class="px-6 py-16 lg:py-24 text-[#5b5a76]">
        <div class="max-w-7xl mx-auto">    

        <div class="flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16 mb-16">
            
            <!-- header and subhead -->
            <div class="flex-1 text-center lg:text-left">
                <h1 class="text-5xl lg:text-6xl font-bold text-[var(--primary)] mb-6 leading-tight" style="font-family: 'Roboto Condensed';">
                    Master Your Learning with Flip Focus
                </h1>
                <p class="text-xl lg:text-2xl text-[var(--accent)]/80">
                    Create, study, and share flashcard sets with students worldwide.
                </p>
            </div>
            
            <!-- img of mr penguin -->
            <div class="flex-1 flex justify-center lg:justify-end">
                <img src="{{ asset('images/hero.png') }}" alt="penguin" class="sm:w-56 md:w-80 lg:w-80 max-w-full">
            </div>

        </div>

        <!-- button -->
        <div class="text-center mb-20">
            <div class="btn uppercase text-lg font-bold py-6 inline-block" >
                @auth
                    <a href="{{ route('study.create') }}" class="px-8">Create New Set</a>
                @endauth
                @guest
                    <a href="{{ route('register') }}" class="px-8">Create Your First Set</a>
                @endguest
            </div>
        </div>

        <!-- buncha fake stats bc i can-->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-4xl font-bold text-[#d95242]/80 mb-2">10K+</div>
                <div class="text-[#5b5a76] font-medium">Study Sets</div>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-4xl font-bold text-[#d95242]/80 mb-2">50K+</div>
                <div class="text-[#5b5a76] font-medium">Active Learners</div>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-4xl font-bold text-[#d95242]/80 mb-2">1M+</div>
                <div class="text-[#5b5a76] font-medium">Cards Studied</div>
            </div>
        </div>

    </div>
</div>