<?php
/*********** GESTOR CONTENIDO ***********/
interface DBSentencias {
    //Eliminaciones logicas
    const ELIMINAR = "UPDATE ? SET borrado = TRUE WHERE ? = ?"; //Tabla editoriales
    
    //EDITORIALES
    const LISTAR_EDITORIALES = "SELECT * FROM editoriales";
    const AGREGAR_EDITORIAL = "INSERT INTO editoriales (nombre_editorial) VALUES(?)";
    const MODIFICAR_EDITORIAL = "UPDATE editoriales SET nombre_editorial = ? WHERE id_editorial = ?";
    
    //CARACTERISTICAS
    const LISTAR_CARACTERISTICAS = "SELECT * FROM caracteristicas";
    const AGREGAR_CARACTERISTICA = "INSERT INTO caracteristicas(denominacion_caracteristica) VALUES(?)";
    const MODIFICAR_CARACTERISTICA = "UPDATE caracteristicas SET denominacion_caracteristica = ? WHERE id_caracteristicas = ?";
    
    
    
}
