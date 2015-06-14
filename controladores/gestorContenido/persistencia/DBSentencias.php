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
    
    //FOTOS
    const AGREGAR_FOTO = "INSERT INTO fotos (rutaArchivo_foto, id_libro_foto) VALUES(?, ?)";
    const MODIFICAR_FOTO = "UPDATE fotos SET rutaArchivo_foto = ? WHERE id_foto = ?";
    const LISTAR_FOTO_ORDER_LIBROS = "SELECT * FROM fotos INNER JOIN libro ON id_libro_foto = id_libro ORDER BY id_libro_foto";
    
    //AUTORES
    const LISTAR_AUTORES = "SELECT * FROM autores where borrado = 0";
    const LISTAR_TODO_AUTORES = "SELECT * FROM autores";
    const AGREGAR_AUTOR = "INSERT INTO autores (nombre_autor) VALUES(?)";
    const MODIFICAR_AUTOR = "UPDATE autores SET nombre_autor = ? WHERE id_autor = ?";
    
    //TIPOS USUARIOS
    const LISTAR_TIPOS_USUARIO = "SELECT * FROM tipos_usuario";
    
    //LOGIN
    const LOGIN = "SELECT `usuario`.`nombre_usuario` AS `nombre`,`usuario`.`clave_usuario`, `tipos_usuario`.`id_tipo_usuario` AS `value` FROM `biblioteca`.`usuario` INNER JOIN `biblioteca`.`tipos_usuario` ON (`usuario`.`id_tipo_tipo_usuario` = `tipos_usuario`.`id_tipo_usuario`)WHERE nombre_usuario = ? AND borrado = 0;";
}
