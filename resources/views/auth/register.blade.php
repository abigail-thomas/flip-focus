<x-layout>
    <div class="mt-3 p-[20px] m-[40px] text-[#5b5a76] text-center">
            <div class=" bg-gradient-to-br from-black/5 to-black/2 rounded-xl p-10 w-[75%] md:w-[60%] lg:w-[50%] flex flex-col justify-center gap-4 mx-auto">
            
            <div class="flex justify-center items-align mx-auto  text-3xl rounded-full
                pt-3 w-16 h-16 text-[#f8f8f8]
                bg-gradient-to-br from-[var(--accent)]/50 to-[var(--secondary)]/70">
                <i class="bi bi-person-add"></i>
            </div>
                
            <h1 class="text-3xl font-bold p-1">Get Started Now</h1>
            <p class="text-xl text-[var(--accent)]/70 mb-6">Sign up to start your learning. </p>

            <form action="{{ route('register') }}" method="POST"
            class="flex flex-col items-center">
                @csrf
                <input
                    type="text"
                    name="name"
                    placeholder="Name"
                    value="{{ old("name") }}"
                    class="w-full px-4 mb-4 py-3 border border-gray-200 rounded-xl focus:none transition duration-200 bg-[#f8f8f8] focus:bg-white"
                    required>

                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old("email") }}"
                    class="w-full px-4 mb-4 py-3 border border-gray-200 rounded-xl focus:none transition duration-200 bg-[#f8f8f8] focus:bg-white"
                    required>

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="w-full px-4 mb-4 py-3 border border-gray-200 rounded-xl focus:none transition duration-200 bg-[#f8f8f8] focus:bg-white"
                    required>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    class="w-full px-4 mb-4 py-3 border border-gray-200 rounded-xl focus:none transition duration-200 bg-[#f8f8f8] focus:bg-white"
                    required>

                <button type="submit"
                class="btn mt-4 !w-30"
                >Register</button>

                <!-- validation errors -->
                @if ($errors->any())
                    <ul class="mt-4 px-4 py-2 bg-red-100 rounded-xl">
                        @foreach ($errors->all() as $error)
                            <li class="my-2 text-red-600">
                                {{ $error }}
                            </li>
                            @endforeach
                    </ul>
                @endif

            </form>

            <div class="text-center">
                <p class="text-[var(--accent)]">Already have an account?
                    <a class="font-semibold hover:scale-105 transition-colors duration-200" href="login">Login</a>
                </p>
            </div>

        </div>
    </div>

</x-layout>