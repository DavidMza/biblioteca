<?php
/*********** GESTOR CONTENIDO ***********/
interface DBSentencias {
    //Eliminaciones logicas
    const ELIMINAR = "UPDATE ? SET borrado = TRUE WHERE ? = ?"; //Tabla editoriales
    
    //EDITORIALES
    const AGREGAR_EDITORIAL = "INSERT INTO editoriales (nombre_editorial) VALUES(?)";
    const MODIFICAR_EDITORIAL = "UPDATE editoriales SET nombre_editorial = ? WHERE id_editorial = ?";
}
