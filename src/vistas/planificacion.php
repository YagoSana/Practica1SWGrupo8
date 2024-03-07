<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../src/logica/header.php"); ?>
        <title>Planificación Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("../src/logica/cabecera.php"); ?>
            <?php include("../src/logica/lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>PLANIFICACIÓN</h2>
                        <p>A continuación, se expone cómo estará planificado el proyecto, separado en las distintas tareas a realizar y la fecha límite de entrega de cada una. El trabajo de dichas tareas será repartido entre todos los integrantes del grupo de manera equitativa. Para ver el diagrama de Gantt de las diferentes tareas y sus fechas de realización, pulse <a href = "#ap6">aquí</a>.</p>
                        <table>
                            <caption>Fechas de terminación de las tareas</caption>
                            <tr>
                                <td></td>
                                <th>Tarea</th>
                                <th>Fecha de entrega</th>
                            </tr>
                            <tr>
                                <th>Etapa 0</th>
                                <td><a href = "#ap1">Sales pitch</a></td>
                                <td>05/02/2024</td>
                            </tr>
                            <tr>
                                <th>Práctica 1</th>
                                <td><a href = "#ap2">Descripción del proyecto</a></td>
                                <td>23/02/2024</td>
                            </tr>
                            <tr>
                                <th>Práctica 2</th>
                                <td><a href = "#ap3">Diseño de la aplicación</a></td>
                                <td>08/03/2024</td>
                            </tr>
                            <tr>
                                <th>Práctica 3</th>
                                <td><a href = "#ap4">Diseño de la apariencia</a></td>
                                <td>12/04/2024</td>
                            </tr>
                            <tr>
                                <th>Entrega final</th>
                                <td><a href = "#ap5">Proyecto completo</a></td>
                                <td>16/05/2024</td>
                            </tr>
                        </table>

                        <h2 id="ap1">Etapa 0: Sales pitch</h2>
                        <p>Redacción breve sobre una primera propuesta del proyecto a realizar que conste de: un título, corto y pegadizo; los autores, nombre y apellidos de los participantes; el concepto, presentación de la idea en menos de 150 palabras; y los usuarios y tareas, quiénes son los distintos usuarios y lo que podrá realizar cada uno en la web.</p>
                        <h2 id="ap2">Práctica 1: Descripción del proyecto.</h2>
                        <p>Presentación detallada del proyecto a desarrollar dividido en las siguientes secciones:</p>
                        <ul>
                            <li><strong>index.html:</strong> presentación inicial de la propuesta.</li>
                            <li><strong>detalles.html:</strong> descripción extendida.</li>
                            <li><strong>bocetos.html:</strong> bocetos de la página web dibujados en papel y explicaciones.</li>
                            <li><strong>miembros.html:</strong> datos de los miembros del grupo.</li>
                            <li><strong>planificacion.html:</strong> plan detallado para el desarrollo del proyecto.</li>
                            <li><strong>contacto.html:</strong> formulario de contacto para pedir más información.</li>       
                        </ul>
                        <h2 id="ap3">Práctica 2: Diseño de la aplicación.</h2>
                        <p>Esta práctica constará del diseño y arquitectura de nuestra aplicación web. Una primera versión simple del proyecto.</p>
                        <h2 id="ap4">Práctica 3: Diseño de la apariencia.</h2>
                        <p>Ampliación del proyecto. Diseño de la apariencia de la aplicación usando hojas de estilos sobre la entrega anterior e incrementando su funcionalidad. A esta altura estará realizado el entre el 40-50% del proyecto total.</p>
                        <h2 id="ap5">Entrega final: Proyecto completo</h2>
                        <p>Última fase. Realización del proyecto al completo.</p>

                        <h2 id="ap6">Diagrama de Gantt</h2>
                        <img src="../img/gantt.jpg" alt="Diagrama de gantt" width="1000px">
                    </section>
                </article>
            </main>
            <?php include("../src/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>