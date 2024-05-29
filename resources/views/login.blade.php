@extends('template.index')

@section('content')
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('store.user') }}" method="POST">
                @csrf
                @method("POST")
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name" name="name" />
                @error('name')
                    <strong class="text text_danger">{{ $message }}</strong>
                @enderror
                <input type="email" placeholder="Email" name="email" />
                @error('email')
                    <strong class="text text_danger">{{ $message }}</strong>
                @enderror
                <input type="password" placeholder="Password" name="password" />
                @error('password')
                    <strong class="text text_danger">{{ $message }}</strong>
                @enderror
                <button type="submit">Sign Up</button>
            </form>
            
        </div>
        <div class="form-container sign-in-container">
            <form action="{{ route("login.user") }}" method="POST">
                @csrf
                @method("POST")
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus />
                {{-- @error('email')
                    <strong class="text text_danger">{{ $message }}</strong>
                @enderror --}}
                <input type="password" placeholder="Password" name="password" required />
                {{-- @error('password')
                    <strong class="text text_danger">{{ $message }}</strong>
                @enderror --}}
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start the journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="https://florin-pop.com">Florin Pop</a>
            - Read how I created this and how you can join the challenge
            <a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
        </p>
    </footer>
@endsection
