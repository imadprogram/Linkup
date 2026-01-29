<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Profile Picture --}}
        <div>
            @if ($user->pfp)
                <img src="{{ asset('storage/' . $user->pfp) }}" class="w-20 h-20 rounded-full object-cover mb-4">
            @endif
            <div class="flex gap-4 items-center">
                <img id="pfp-preview" class="w-20 h-20 rounded-full object-cover mb-4 hidden" src="">
                <label id="hint" for="pfp-preview" class="hidden">Click <span class="bg-black font-semibold text-sm px-2 py-1 text-white rounded-lg">save</span> to save this picture</label>
            </div>
            <label for="pfp"
                class="block text-sm font-medium text-gray-700 hover:bg-gray-400 w-fit py-1 px-2 rounded-md"><i
                    class="fas fa-cloud-arrow-up"></i> Upload Profile Picture</label>
            <input type="file" id="pfp" name="pfp" accept="image/*" class="mt-1 w-full hidden">
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <script>
        const input = document.getElementById('pfp');
        const preview = document.getElementById('pfp-preview');
        const hint = document.getElementById('hint');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                preview.src = url;
                preview.classList.remove('hidden');
                hint.classList.remove('hidden');
            }
        });
    </script>
</section>
