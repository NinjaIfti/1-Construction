<div>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="text-center">
                <span class="text-red-600 text-4xl font-bold">1</span>
                <div class="inline-block ml-1">
                    <div class="text-xl font-bold text-gray-900">CONTRACTOR</div>
                    <div class="text-2xl font-bold -mt-1 text-gray-900">SOLUTIONS</div>
                </div>
            </div>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form wire:submit="login" class="space-y-6">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input wire:model="form.email" id="email" name="email" type="email" autocomplete="email" required 
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="mt-1 text-sm text-red-600">@error('form.email') {{ $message }} @enderror</div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-red-600 hover:text-red-500">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <div class="mt-2">
                        <input wire:model="form.password" id="password" name="password" type="password" autocomplete="current-password" required 
                            class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="mt-1 text-sm text-red-600">@error('form.password') {{ $message }} @enderror</div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input wire:model="form.remember" id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-600">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>

                <div>
                    <button type="submit" 
                        class="flex w-full justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 
                        text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 
                        focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member? 
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-red-600 hover:text-red-500">
                    Register now
                </a>
            </p>
        </div>
    </div>
</div> 