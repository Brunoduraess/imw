@extends('layouts.main')

@section('title')
    <title>Conheça nossa história</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="container sobre">
        <p class="titulo">Sobre nós</p>
        <img src="{{ asset('assets/images/sobre.png') }}" alt="" class="topo">
        <p class="historia">A Igreja Metodista Wesleyana é fruto de um avivamento que nasceu no coração de homens e mulheres
            desejosos de
            viver uma fé cristã autêntica e transformadora. Sua história remonta ao século XVIII, com o movimento metodista
            liderado por John Wesley, um pastor anglicano que impactou gerações com sua ênfase na santidade, na pregação da
            Palavra e no compromisso com o amor ao próximo.
            <br><br>
            No Brasil, a história da Igreja Metodista Wesleyana começou oficialmente em 1967, marcada pelo desejo de
            retornar às raízes do metodismo clássico. Desde então, ela tem sido um lugar de acolhimento, adoração e
            crescimento espiritual para milhares de famílias.
            <br><br>
            Nossa igreja se caracteriza pela busca fervorosa de uma vida de santidade e pela missão de proclamar o Evangelho
            de Jesus Cristo com integridade, unindo tradição e relevância em um mundo em constante transformação. Seguimos o
            legado wesleyano, enfatizando a centralidade das Escrituras, a graça salvadora de Deus, a ação do Espírito Santo
            e o chamado para servir a sociedade com amor e compaixão.
            <br><br>
            Ao longo dos anos, temos crescido e alcançado diversas comunidades, sempre com a visão de ser uma igreja
            comprometida com a transformação de vidas e a edificação de uma fé sólida. Por meio de cultos, discipulados,
            projetos sociais e ações missionárias, buscamos refletir o amor de Deus e promover o bem-estar espiritual,
            emocional e social de todos os que se conectam conosco.
            <br>
            Convidamos você a fazer parte desta história de fé, compromisso e transformação. Juntos, continuamos escrevendo
            novos capítulos, confiando na fidelidade de Deus para guiar nossos passos e ampliar nosso alcance para Sua
            glória.
        </p>
    </section>

    @include('layouts.footer')
@endsection
