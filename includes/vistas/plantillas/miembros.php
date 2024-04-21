<?php
require '../../config.php';

$ruta = RUTA_APP;
$titulo = 'Miembros de Back Music';
$contenido = <<<EOS
        <article>
            <section>
                <h2>Miembros de BackMusic</h2>

                <p>Los miembros del grupo 8 de sw somos:</p>
                <p>
                    <a href="#miembro1">Álvaro Félix</a>
                    <a href="#miembro2">Mohamed El Farissi</a>
                    <a href="#miembro3">Laura Reyes</a>
                    <a href="#miembro4">Yago Sanabria</a>
                </p>
                <section>
                    <h2 id="miembro1">Álvaro Félix</h2>
                    <img src="$ruta/img/AlvaroFelix.jpg" alt="Foto de Alvaro">
                    <p>Correo: alfelix@ucm.es</p>
                    <p>Intereses: Me gusta la música electronica, el trap y el rock, ademas toco el bajo</p>
                </section>
                <section>
                    <h2 id="miembro2">Mohamed El Farissi</h2>
                    <img src="$ruta/img/MohamedElFarissi.jpg" alt="Foto de Mohamed">
                    <p>Correo: melfaris@ucm.es</p>
                    <p>Intereses: Soy amante del rock y toco la guitarra en mi tiempo libre.</p>
                </section>
                <section>
                    <h2 id="miembro3">Laura Reyes</h2>
                    <img src="$ruta/img/LauraReyes.jpg" alt="Foto de Laura">
                    <p>Correo: laurreye@ucm.es</p>
                    <p>Intereses: Me encanta el pop y canto en un coro de voces femeninas.</p>
                </section>
                <section>
                    <h2 id="miembro4">Yago Sanabria</h2>
                    <img src="$ruta/img/YagoSanabria.jpg" alt="Foto de Yago">
                    <p>Correo: yagosana@ucm.es</p>
                    <p>Intereses: Me apasiona el jazz y soy baterista en una banda local.</p>
                </section>
        </article>
        EOS;
        require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
