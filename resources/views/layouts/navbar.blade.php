<nav class="navbar">
    <div class="dados">
        <div class="logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="">
        </div>
        <div class="nome">
            <a href="{{ route('home') }}">
                <p>Igreja Metodista Wesleyana <br> em Vila Elmira</p>
            </a>
        </div>
        <div class="mobile-menu-icon">
            <button class="btn open" onclick="menuShow()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg></button>
            <button class="btn close" onclick="menuClose()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg></button>
        </div>
    </div>

    <div class="links">
        <a href="{{ route('events') }}">
            <p class="emoji">▶️</p> Agenda
        </a>
        <a href="{{ route('projects') }}">
            <p class="emoji">▶️</p> Nossos projetos
        </a>
        <a href="{{ route('about') }}">
            <p class="emoji">▶️</p> Nossa história
        </a>
        <a href="https://www.youtube.com/@imwvetv">
            <p class="emoji">▶️</p> Assista online
        </a>
        <a href="{{ route('contact') }}">
            <p class="emoji">▶️</p> Fale Conosco
        </a>
        <a href="{{ route('login') }}">
            <button class="btn btn-primary">Login 👨🏻‍💻</button>
        </a>
    </div>
</nav>
