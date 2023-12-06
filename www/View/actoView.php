<?php
class ActoView {
    public function mostrarActos($actos) {
        // Aquí puedes personalizar la presentación de los actos en HTML
        echo "<h2>Listado de Actos</h2>";
        foreach ($actos as $acto) {
            echo "<div>";
            echo "<h3>{$acto['Titulo']}</h3>";
            echo "<p>{$acto['Descripcion_corta']}</p>";
            echo "<p>Fecha: {$acto['Fecha']}</p>";
            echo "<p>Hora: {$acto['Hora']}</p>";
            echo "<p>Asistentes: {$acto['Num_asistentes']}</p>";
            echo "</div>";
            echo "<hr>";
        }
    }
}
?>
