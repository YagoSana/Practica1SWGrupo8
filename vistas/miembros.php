<?php
    require_once '../logica/config.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(RUTA_APP ."/logica/header.php"); ?>
        <title>Miembros Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include(RUTA_APP ."/logica/cabecera.php"); ?>
            <?php include(RUTA_APP ."/logica/lateralIzq.php"); ?>

            <main>
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
                        <img src="<?php echo RUTA_APP?>/img/AlvaroFelix.jpg" alt="Foto de Alvaro">
                        <p>Correo: alfelix@ucm.es</p>
                        <p>Intereses: Me gusta la música electronica, el trap y el rock, ademas toco el bajo</p>
                    </section>
                    <section> 
                        <h2 id="miembro2">Mohamed El Farissi</h2>
                        <img src="<?php echo RUTA_APP?>/img/MohamedElFarissi.jpg" alt="Foto de Mohamed">
                        <p>Correo: melfaris@ucm.es</p>
                        <p>Intereses: Soy amante del rock y toco la guitarra en mi tiempo libre.</p>
                    </section>
                    <section>
                        <h2 id="miembro3">Laura Reyes</h2>
                        <img src="<?php echo RUTA_APP?>/img/LauraReyes.jpg" alt="Foto de Laura">
                        <p>Correo: laurreye@ucm.es</p>
                        <p>Intereses: Me encanta el pop y canto en un coro de voces femeninas.</p>
                    </section>
                    <section>
                        <h2 id="miembro4">Yago Sanabria</h2>
                        <img src="<?php echo RUTA_APP?>/img/YagoSanabria.jpg" alt="Foto de Yago">
                        <p>Correo: yagosana@ucm.es</p>
                        <p>Intereses: Me apasiona el jazz y soy baterista en una banda local.</p>
                    </section>
                </article>
            </main>
            <?php include(RUTA_APP ."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
