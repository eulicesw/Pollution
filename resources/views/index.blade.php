@extends('layouts.user')

{{-- Content --}}
@section('content')
<section class="contenedor seccion">
        <!-- <h2 class="fw-300 centrar-texto">About Project</h2> -->
        <div class="heading-text heading-section text-center">
            <h2>ABOUT PROJECT</h2>
        </div>
        <div class="iconos-nosotros">
            <div class="icono" style="padding:15px;">
                <!-- <img src="/img/icono1.svg" alt="Icono Seguridad"> -->
                <i style="color:#CC625B; margin-bottom: 15px;" class="fas fa-balance-scale-left fa-7x"></i>
                <h3 style="margin-bottom: 5px;">Problem</h3>
                <p> Air pollution has become a major concern due to natural disasters and problems caused by society, creating 
                pollution through the burning of products, excess garbage, etc. Pollution is a global problem and we must take the necessary measures.</p>
            </div>

            <div class="icono" style="padding:15px;">
                <i style="color:#C9CC5B; margin-bottom: 15px;"class="fas fa-shield-alt fa-7x"></i>
                <h3 style="margin-bottom: 5px;">Security</h3>
                <p>Air is an essential factor for life. It is necessary to manage and propose a model that responds to the 
                new scenarios to pay attention due to the complex problems of air quality management.</p>
            </div>

            <div class="icono" style="padding:15px;">
                <i style="color:#5BCC89; margin-bottom: 15px;"class="fas fa-clock fa-7x"></i>
                <h3 style="margin-bottom: 5px;">Solution</h3>
                <p>Create a system to measure the air quality index in Tijuana, allowing society to be informed about the 
                state of the city in real time, and thus be able to make a decision about its well-being.</p>
            </div>
        </div>
    </section>

    <main class="seccion contenedor">
        <!-- <h2 class="fw-300 centrar-texto">Affected Places</h2> -->
        <div class="heading-text heading-section text-center">
            <h2>AFFECTED PLACES</h2>
        </div>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <img src="/img/tijuana.jfif" alt="Tijuana">
                <div class="contenido-anuncio">
                    <h3>Tijuana</h3>
                    <p style="text-align: justify;">Tijuana has registered a higher percentage of air pollution compared to the city of Mexicali, 
                    a characteristic municipality for commonly registering high levels of air pollutants.</p>
                    <p class="precio"></p>
                    <!-- <ul class="iconos-caracteristicas">
                        <li>
                            <img src="img/icono_wc.svg" alt="icono wc">
                            <p>3</p>
                        </li>
                        <li>
                            <img src="img/icono_estacionamiento.svg" alt="icono autos">
                            <p>3</p>
                        </li>
                        <li>
                            <img src="img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p>4</p>
                        </li>
                    </ul> -->
                    <!-- Button to see more about this place. 
                    <a href="#" class="boton boton-amarillo d-block">See more</a> -->
                </div>
            </div>

            <div class="anuncio">
                <img src="/img/rosarito2.jfif" alt="Rosarito">
                <div class="contenido-anuncio">
                    <h3>Rosarito</h3>
                    <p style="text-align: justify;">The air quality is not favorable, as determined by the Ministry of Health and the municipal Civil Protection 
                        coordination due to the accidents that the winds of Santa Ana have left behind.</p>
                    <p class="precio"></p>
                    <!-- <ul class="iconos-caracteristicas">
                        <li>
                            <img src="img/icono_wc.svg" alt="icono wc">
                            <p>3</p>
                        </li>
                        <li>
                            <img src="img/icono_estacionamiento.svg" alt="icono autos">
                            <p>3</p>
                        </li>
                        <li>
                            <img src="img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p>4</p>
                        </li>
                    </ul> -->
                    <!-- Button to see more about this place. 
                    <a href="#" class="boton boton-amarillo d-block">See more</a> -->
                </div>
            </div>

            <div class="anuncio">
                <img src="/img/ensenada3.jpg" alt="Ensenada">
                <div class="contenido-anuncio">
                    <h3>Ensenada</h3>
                    <p>More than 90 percent of the population breathes toxic air in Ensenada every day, due to factories, 
                    cars, gas stations or electricity generation in the same city.</p>
                    <p class="precio"></p>
                    <!-- <ul class="iconos-caracteristicas">
                        <li>
                            <img src="img/icono_wc.svg" alt="icono wc">
                            <p>3</p>
                        </li>
                        <li>
                            <img src="img/icono_estacionamiento.svg" alt="icono autos">
                            <p>3</p>
                        </li>
                        <li>
                            <img src="img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p>4</p>
                        </li>
                    </ul> -->
                    <!-- Button to see more about this place. 
                    <a href="#" class="boton boton-amarillo d-block">See more</a> -->
                </div>
            </div>
        </div>
        <!-- Button for watch all places-->
        <!-- <div class="ver-todas">
            <a href="#" class="boton boton-verde">Ver Todas</a>
        </div> -->
    </main>
    <!-- <section class="contenedor seccion">
        <div class="container">
                    <div class="heading-text heading-section text-center">
                        <h2>MEET OUR TEAM</h2>
                        <p>We are seventh semester students who care about the environment.</p>
                    </div>
                    <div class="row team-members">
                        <div class="col-lg-4">
                            <div class="team-member">
                                <div class="team-image">
                                    <img src="/img/eulices2.jpg" alt="">
                                </div>
                                <div class="team-desc">
                                    <h3>Eulices Escalante</h3>
                                    <span>Software Developer</span>
                                    <p>A dedicated person, with encouragement to continue learning, technology lover and Star Wars.</br>&nbsp;</p>
                                    <div class="align-center">
                                        <a target="_blank" href="https://www.facebook.com/eulicesw" class="btn btn-xs btn-slide btn-light">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a target="_blank" href="https://twitter.com/EulicesEscalant" class="btn btn-xs btn-slide btn-light" data-width="100">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </a>
                                        <a target="_blank" href="https://www.instagram.com/eulices.php/" class="btn btn-xs btn-slide btn-light" data-width="118">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </a>
                                        <a target="_blank" href="#" class="btn btn-xs btn-slide btn-light" data-width="80">
                                            <i class="far fa-envelope"></i>
                                            <span>Mail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="team-member">
                                <div class="team-image">
                                    <img src="/img/julio.jpg" alt="">
                                </div>
                                <div class="team-desc">
                                    <h3>Julio Gastelum</h3>
                                    <span>Software Developer</span>
                                    <p>A guy who is always learning and wasting his time in videogames and TV series.</br>&nbsp;</p>
                                    <div class="align-center">
                                        <a target="_blank" href="https://www.facebook.com/julioarmando.gastelummartinez.73" class="btn btn-xs btn-slide btn-light">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-slide btn-light" data-width="100">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-slide btn-light" data-width="118">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-slide btn-light" data-width="80">
                                            <i class="far fa-envelope"></i>
                                            <span>Mail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="team-member">
                                <div class="team-image">
                                    <img src="/img/chris.jpg" alt="">
                                </div>
                                <div class="team-desc">
                                    <h3>Christopher A.</h3>
                                    <span>Networks & Telecommunications</span>
                                    <p>A guy who is always learning and wasting his time drinking with friends.</br>&nbsp;</p>
                                    <div class="align-center">
                                        <a target="_blank" href="https://www.facebook.com/chris.gonzalez.96558" class="btn btn-xs btn-slide btn-light">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-slide btn-light" data-width="100">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-slide btn-light" data-width="118">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </a>
                                        <a href="#" class="btn btn-xs btn-slide btn-light" data-width="80">
                                            <i class="far fa-envelope"></i>
                                            <span>Mail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('a[href="/dashboard"]').removeClass("active");
        $('a[href="/"]').addClass("active");
    });
</script>
@stop