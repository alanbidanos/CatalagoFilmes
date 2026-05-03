<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - Filmoteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <header class="siteheader">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="/" class="logolink">
                <div class="logobox">
                    {{-- Substitua pela sua <img> depois --}}
                    <span class="logotexto">Filmoteca</span>
                </div>
            </a>

            <nav class="d-flex align-items-center gap-2">
                <a href="{{ route('diretores.index') }}"
                    class="navbtn {{ request()->routeIs('diretores.*') ? 'navbtn-ativo' : '' }}">
                    Diretores
                </a>
                <a href="{{ route('filmes.index') }}"
                    class="navbtn {{ request()->routeIs('filmes.*') ? 'navbtn-ativo' : '' }}">
                    Filmes
                </a>
                <a href="{{ route('avaliacoes.index') }}"
                    class="navbtn {{ request()->routeIs('avaliacoes.*') ? 'navbtn-ativo' : '' }}">
                    Avaliações
                </a>

                <a href="{{ route('premiacoes.index') }}"
                    class="navbtn {{ request()->routeIs('premiacoes.*') ? 'navbtn-ativo' : '' }}">
                    Premiações
                </a>

                <a href="{{ route('estudios.index') }}"
                    class="navbtn {{ request()->routeIs('estudios.*') ? 'navbtn-ativo' : '' }}">
                    Estudios
                </a>

                <div class="dropdown">
                    <a class="navbtn dropdown-toggle {{ request()->routeIs('filmes.chart*') ? 'navbtn-ativo' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown">
                        Gráficos
                    </a>
                    <ul class="dropdown-menu dropmenucustom">
                        <li>
                            <a class="dropdown-item dropmenuitem" href="{{ route('filmes.chartdiretor') }}">
                                Filmes por Diretor
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item dropmenuitem" href="{{ route('filmes.chartnotas') }}">
                                Distribuição de notas
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ url('sobre') }}" class="navbtn {{ request()->is('sobre') ? 'navbtn-ativo' : '' }}">
                    Sobre
                </a>
            </nav>

        </div>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row">
                @if ($errors->any())
                    <div class="alertaerro mb-3">
                        <p class="mb-1 fw-semibold">Por favor, verifique os erros abaixo:</p>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                @yield('conteudo')
            </div>
        </div>
    </main>

    <footer class="sitefooter">
        <div class="container text-center">
            <span>Filmoteca</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>

<style>
    .dropmenucustom {
        background: #1e1e35;
        border: 1px solid #2a2a45;
        border-radius: 10px;
        padding: 0.4rem;
        min-width: 180px;
    }

    .dropmenuitem {
        color: #9090aa;
        font-size: 0.88rem;
        font-weight: 600;
        border-radius: 7px;
        padding: 0.45rem 0.9rem;
        transition: background 0.15s, color 0.15s;
    }

    .dropmenuitem:hover {
        background: #2a2a45;
        color: #e2b96f;
    }

    body {
        background-color: #0f0f1a;
        color: #e0e0e0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }


    .siteheader {
        background: #12121f;
        border-bottom: 1px solid #2a2a45;
        padding: 0.85rem 0;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .logolink {
        text-decoration: none;
    }

    .logobox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .logotexto {
        font-size: 1.2rem;
        font-weight: 800;
        color: #e2b96f;
        letter-spacing: 0.04em;
    }

    .navbtn {
        text-decoration: none;
        color: #9090aa;
        font-size: 0.88rem;
        font-weight: 600;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        border: 1px solid transparent;
        transition: color 0.18s, border-color 0.18s, background 0.18s;
        letter-spacing: 0.02em;
    }

    .navbtn:hover {
        color: #e2b96f;
        border-color: #2a2a45;
        background: #1e1e35;
    }

    .navbtn-ativo {
        color: #e2b96f;
        border-color: #e2b96f;
        background: rgba(226, 185, 111, 0.08);
    }


    .alertaerro {
        background: #2a1a1a;
        border: 1px solid #c0392b;
        border-radius: 10px;
        padding: 0.9rem 1.2rem;
        color: #e8a0a0;
        font-size: 0.88rem;
    }


    .sitefooter {
        background: #12121f;
        border-top: 1px solid #2a2a45;
        padding: 1rem 0;
        font-size: 0.8rem;
        color: #6060aa;
        margin-top: 3rem;
    }


    .titulopagina {
        color: #e2b96f;
        letter-spacing: 0.05em;
    }

    .barrapesquisa {
        background: #16162a;
        border: 1px solid #2a2a45;
        border-radius: 12px;
        padding: 1rem 1.25rem;
    }

    .campoinput {
        background-color: #1e1e35 !important;
        border-color: #2a2a45 !important;
        color: #e0e0e0 !important;
    }

    .campoinput::placeholder {
        color: #6060aa;
    }

    .campoinput:focus {
        border-color: #e2b96f !important;
        box-shadow: 0 0 0 0.2rem rgba(226, 185, 111, 0.15) !important;
    }

    .form-label {
        color: #9090aa;
    }

    .btnbuscar {
        background: #e2b96f;
        border-color: #e2b96f;
        color: #1a1a2e;
        font-weight: 600;
    }

    .btnbuscar:hover {
        background: #f0d090;
        border-color: #f0d090;
        color: #1a1a2e;
    }

    .btnnovo {
        background: transparent;
        border: 1px solid #e2b96f;
        color: #e2b96f;
        font-weight: 600;
    }

    .btnnovo:hover {
        background: #e2b96f;
        color: #1a1a2e;
    }
</style>
