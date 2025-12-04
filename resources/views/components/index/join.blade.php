<div class="mt-16 text-[#5b5a76] text-center">

    <div class="bg-gradient-to-br from-black/5 to-black/2  m-2 mb-8 p-8 rounded-xl">
            
        <div class="inline-flex items-center justify-center w-18 h-18 bg-gradient-to-r from-[var(--primary)] to-[var(--primary)]/70 rounded-full mb-8 shadow-md">
                <i class="bi bi-mortarboard-fill text-white text-3xl"></i>
        </div>

            <h1 class="text-3xl lg:text-4xl font-bold text-[var(--primary)] mb-4 text-center">Ready to try <span class="text-[var(--secondary)]/80">Flip Focus?</span></h1>
            <p class="text-xl text-[var(--primary)]/70 mb-8 pb-4">Join hundreds of students who have committed optimizing their study methods.</p>
            
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-4 lg-gap-2 xl:gap-1 mb-12">
                    <div class="flex flex-col items-center gap-3 md:gap-2 lg:gap-1">
                        <div class="w-12 h-12 bg-[var(--secondary)]/20 rounded-full flex items-center justify-center
                                 hover:scale-102 hover:translate-y-1 hover:shadow-md transform duration-300 ease-in-out">
                            <i class="bi bi-lightning-charge-fill text-[var(--accent)]/80  text-xl"></i>
                        </div>
                        <span class="text-[var(--primary)] font-medium">Quick Setup</span>
                    </div>
                    <div class="flex flex-col items-center  gap-3 md:gap-2 lg:gap-1">
                        <div class="w-12 h-12 bg-[var(--secondary)]/20 rounded-full flex items-center justify-center
                         hover:scale-102 hover:translate-y-1 hover:shadow-md transform duration-300 ease-in-out">
                            <i class="bi bi-infinity text-[var(--accent)]/80 text-xl"></i>
                        </div>
                        <span class="text-[var(--primary)] font-medium">Unlimited Sets</span>
                    </div>
                    <div class="flex flex-col items-center  gap-3 md:gap-2 lg:gap-1">
                        <div class="w-12 h-12 bg-[var(--secondary)]/20 rounded-full flex items-center justify-center
                         hover:scale-102 hover:translate-y-1 hover:shadow-md transform duration-300 ease-in-out">
                            <i class="bi bi-people-fill text-[var(--accent)]/80  text-xl"></i>
                        </div>
                        <span class="text-[var(--primary)] font-medium">Study Together</span>
                    </div>
                </div>

            <div class="mt-8 mx-auto">
                <!-- if alr a user /-->
                    @auth
                    <a href="{{ route('study.create') }}" class="btn inline-flex items-center gap-2 ">
                        <span>Create <i class="bi bi-plus"></i></span>
                    </a>
                    @endauth
                </div>
                

                @guest
                <div class="p-8 gap-4
                flex div-row mx-auto align-center justify-center ">
                    <!-- guest or not signed in/-->
                    <a href="{{ route('register') }}" class="btn">
                            <i class="bi bi-rocket-takeoff-fill"></i>
                            <span>Get Started Free</span>
                    </a>
                        <a href="{{ route('login') }}" class="btn">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Sign In</span>
                        </a>
                </div>
                    
                @endguest

                <div class="mt-10 pt-8 border-t border-[var(--primary)]/20">
                    <p class="text-sm text-[var(--primary)]/70 flex items-center justify-center gap-2">
                        <i class="bi bi-shield-check text-[var(--accent)]"></i>
                        <span>Free forever. No ads ever.</span>
                    </p>
                </div>
                <div class="mt-12 flex flex-wrap justify-center items-center gap-6 opacity-70">
                    <div class="text-[var(--secondary)]">
                        <div class="text-xl md:text-3xl font-bold">10k+</div>
                        <div class="text-sm">Study Sets</div>
                    </div>
                    <div class="h-12 w-px bg-[var(--primary)]/20"></div>
                    <div class="text-[var(--secondary)]">
                        <div class="text-xl md:text-3xl font-bold">50k+</div>
                        <div class="text-sm">Active Learners</div>
                    </div>
                    <div class="h-12 w-px bg-[var(--primary)]/20"></div>
                    <div class="text-[var(--secondary)]">
                        <div class="text-xl md:text-3xl font-bold">1M</div>
                        <div class="text-sm">Cards Studied</div>
                    </div>
        </div>
            </div>
            </div>

            
            
        </div>

    </div>

</div>