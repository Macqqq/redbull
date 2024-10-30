<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Boutique en ligne')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Assurez-vous d'avoir un fichier CSS pour le style -->
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="{{ url('/') }}" class="navbar-brand">Ma Boutique</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link">Panier</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.profile') }}" class="nav-link">Mon Compte</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Ma Boutique. Tous droits réservés.</p>
            <ul class="footer-links">
                <li><a href="{{ url('/terms') }}">Conditions d'utilisation</a></li>
                <li><a href="{{ url('/privacy') }}">Politique de confidentialité</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> <!-- Lien vers le JavaScript -->
</body>
</html>
