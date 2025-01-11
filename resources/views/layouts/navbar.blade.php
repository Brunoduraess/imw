<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('assets/images/logo.png') }}" alt="">
    </div>
    <div class="nome">
        <a href="{{ route('home') }}"><p>Igreja Metodista Wesleyana <br> em Vila Elmira</p></a>
        
    </div>
    <div class="links">
        <a href="{{ route('about') }}">Sobre</a>
        <a href="{{ route('projects') }}">Nossos projetos</a>
        <a href="{{ route('events') }}">Agenda</a>
        <a href="{{ route('contact') }}">Contato</a>
    </div>
</nav>
