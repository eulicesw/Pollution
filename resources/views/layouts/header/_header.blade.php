<div class="contenedor contenido-header">
    <div id="nav" class="barra">
        <a id="logo" onclick="goHome()" style="cursor: pointer;">
            <img src="/img/logoAcaWhiteCutted.png" alt="Logotipo project">
        </a>
        <div class="mobile-menu" onclick="menu()">
            <a href="#navegacion">
                <img src="/img/barras.svg" alt="Icono Menu">
            </a>
        </div>
        <nav id="navegacion" class="navegacion">
            <a href="/">Home</a>
            <a href="/dashboard">Dashboard</a>
            <a class="logout rounded" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </nav>
    </div>
    <h1 id="textHeader">Pollution in our country</h1>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a> 
<script type="text/javascript">
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    console.log(isMobile.any());
    function goHome() {
        window.location.href = "/";
    }

    function menu() {
        var x = document.getElementById('navegacion');
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
