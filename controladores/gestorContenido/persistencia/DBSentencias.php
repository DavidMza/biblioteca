<?php
/*********** GESTOR CONTENIDO ***********/
interface DBSentencias {
    //Eliminaciones logicas
    const ELIMINAR = "UPDATE ? SET borrado = 1 WHERE ? = ?;"; // no funca T-T
    
    //EDITORIALES
    const LISTAR_EDITORIALES = "SELECT * FROM editoriales WHERE borrado = 0";
    const LISTAR_TODO_EDITORIALES = "SELECT * FROM editoriales";
    const AGREGAR_EDITORIAL = "INSERT INTO editoriales (nombre_editorial) VALUES(?)";
    const MODIFICAR_EDITORIAL = "UPDATE editoriales SET nombre_editorial = ? WHERE id_editorial = ?";
    const ELIMINAR_EDITORIAL = "UPDATE editoriales SET borrado = 1 WHERE id_editorial = ?";
    const ULTIMA_EDITORIAL = "SELECT MAX(id_editorial) AS id FROM editoriales";
    const NOMBRE_EDITORIAL = "SELECT nombre_editorial AS nombre FROM editoriales WHERE id_editorial = ?";
    
    //LOG EDITORIALES
    const NUEVO_LOG_EDITORIAL = "INSERT INTO log_editoriales(`fecha_log_editorial`,`hora_log_editorial`, editorial_nombre_anterior_log_editorial, editorial_nombre_nuevo_log_editorial,`id_accion_log_editorial`,`id_editorial_log_editorial`,`id_usuario_log_editorial`) VALUES(CURDATE(),CURTIME(),?,?,?,?,?)";
    const LISTAR_LOG_EDITORIAL = "SELECT fecha_log_editorial AS fecha, hora_log_editorial AS hora, editorial_nombre_anterior_log_editorial AS nombreEditorialAnterior, editorial_nombre_nuevo_log_editorial AS nombreEditorialNuevo, nombre_accion AS accion, nombre_editorial AS nombreActual, nombre_usuario AS usuario FROM log_editoriales INNER JOIN acciones ON id_accion = id_accion_log_editorial INNER JOIN editoriales ON id_editorial_log_editorial = id_editorial INNER JOIN usuario ON id_usuario_log_editorial = id_usuario";
    
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
    const LISTAR_AUTORES_X_USUARIO = "SELECT id_autor, nombre_autor FROM autores INNER JOIN log_autores ON id_autor = id_autor_log_autor WHERE borrado = 0 AND id_usuario_log_autor = ? AND id_accion_log_autor = 1;";
    const LISTAR_TODO_AUTORES = "SELECT * FROM autores";
    const LISTAR_TODO_AUTORES_X_USUARIO = "SELECT id_autor, nombre_autor FROM autores INNER JOIN log_autores ON id_autor = id_autor_log_autor WHERE id_usuario_log_autor = ? AND id_accion_log_autor = 1;";
    const AGREGAR_AUTOR = "INSERT INTO autores (nombre_autor) VALUES(?)";
    const MODIFICAR_AUTOR = "UPDATE autores SET nombre_autor = ? WHERE id_autor = ?";
    const ULTIMO_ID = "SELECT MAX(id_autor) FROM autores;";
    const ELIMINAR_AUTOR = "UPDATE autores SET borrado = 1 WHERE id_autor = ?;";
    
    //LOG AUTORES
    const LOG_AGREGAR_AUTORES = "INSERT INTO log_autores(`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) VALUES(CURDATE(),CURTIME(),1,?,?);";
    const LOG_MODIFICAR_AUTORES = "INSERT INTO log_autores(`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) VALUES(CURDATE(),CURTIME(),3,?,?);";
    const LOG_ELIMINAR_AUTORES = "INSERT INTO log_autores(`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) VALUES(CURDATE(),CURTIME(),2,?,?);";
    
    //TIPOS USUARIOS
    const LISTAR_TIPOS_USUARIO = "SELECT * FROM tipos_usuario";
    
    //LOGIN
    const LOGIN = "SELECT `usuario`.`id_usuario` AS `usuario`,`usuario`.`nombre_usuario` AS `nombre`,`usuario`.`clave_usuario`, `tipos_usuario`.`id_tipo_usuario` AS `value` FROM `biblioteca`.`usuario` INNER JOIN `biblioteca`.`tipos_usuario` ON (`usuario`.`id_tipo_tipo_usuario` = `tipos_usuario`.`id_tipo_usuario`)WHERE nombre_usuario = ? AND borrado = 0;";
}
