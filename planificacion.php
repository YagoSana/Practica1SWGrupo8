<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("header.php"); ?>
        <title>Planificaci&oacute;n Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("cabecera.php"); ?>
            <?php include("lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>PLANIFICACI&Oacute;N</h2>
                        <p>A continuaci&oacute;n, se expone c&oacute;mo estar&aacute; planificado el proyecto, separado en las distintas tareas a realizar y la fecha límite de entrega de cada una. El trabajo de dichas tareas será repartido entre todos los integrantes del grupo de manera equitativa. Para ver el diagrama de Gantt de las diferentes tareas y sus fechas de realizaci&oacute;n, pulse <a href = "#ap6">aqu&iacute;</a>.</p>
                        <table>
                            <caption>Fechas de terminaci&oacute;n de las tareas</caption>
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
                                <th>Pr&aacute;ctica 1</th>
                                <td><a href = "#ap2">Descripci&oacute;n del proyecto</a></td>
                                <td>23/02/2024</td>
                            </tr>
                            <tr>
                                <th>Pr&aacute;ctica 2</th>
                                <td><a href = "#ap3">Dise&ntilde;o de la aplicaci&oacute;n</a></td>
                                <td>08/03/2024</td>
                            </tr>
                            <tr>
                                <th>Pr&aacute;ctica 3</th>
                                <td><a href = "#ap4">Dise&ntilde;o de la apariencia</a></td>
                                <td>12/04/2024</td>
                            </tr>
                            <tr>
                                <th>Entrega final</th>
                                <td><a href = "#ap5">Proyecto completo</a></td>
                                <td>16/05/2024</td>
                            </tr>
                        </table>

                        <h2 id="ap1">Etapa 0: Sales pitch</h2>
                        <p>Redacci&oacute;n breve sobre una primera propuesta del proyecto a realizar que conste de: un t&iacute;tulo, corto y pegadizo; los autores, nombre y apellidos de los participantes; el concepto, presentaci&oacute;n de la idea en menos de 150 palabras; y los usuarios y tareas, qui&eacute;nes son los distintos usuarios y lo que podr&aacute; realizar cada uno en la web.</p>
                        <h2 id="ap2">Pr&aacute;ctica 1: Descripci&oacute;n del proyecto.</h2>
                        <p>Presentaci&oacute;n detallada del proyecto a desarrollar dividido en las siguientes secciones:</p>
                        <ul>
                            <li><strong>index.html:</strong> presentaci&oacute;n inicial de la propuesta.</li>
                            <li><strong>detalles.html:</strong> descripci&oacute;n extendida.</li>
                            <li><strong>bocetos.html:</strong> bocetos de la p&aacute;gina web dibujados en papel y explicaciones.</li>
                            <li><strong>miembros.html:</strong> datos de los miembros del grupo.</li>
                            <li><strong>planificacion.html:</strong> plan detallado para el desarrollo del proyecto.</li>
                            <li><strong>contacto.html:</strong> formulario de contacto para pedir m&aacute;s informaci&oacute;n.</li>       
                        </ul>
                        <h2 id="ap3">Pr&aacute;ctica 2: Dise&ntilde;o de la aplicaci&oacute;n.</h2>
                        <p>Esta práctica constar&aacute; del dise&ntilde;o y arquitectura de nuestra aplicaci&oacute;n web. Una primera versi&oacute;n simple del proyecto.</p>
                        <h2 id="ap4">Pr&aacute;ctica 3: Dise&ntilde;o de la apariencia.</h2>
                        <p>Ampliaci&oacute;n del proyecto. Dise&ntilde;o de la apariencia de la aplicaci&oacute;n usando hojas de estilos sobre la entrega anterior e incrementando su funcionalidad. A esta altura estar&aacute; realizado el entre el 40-50% del proyecto total.</p>
                        <h2 id="ap5">Entrega final: Proyecto completo</h2>
                        <p>&Uacute;ltima fase. Realizaci&oacute;n del proyecto al completo.</p>

                        <h2 id="ap6">Diagrama de Gantt</h2>
                        <img src="../img/gantt.jpg" alt="Diagrama de gantt" width="1000px">
                    </section>
                </article>
            </main>
            <?php include("pieDePagina.php"); ?>
        </div>
    </body>
</html>