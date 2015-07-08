<?php

/* * ********* GESTOR CONTENIDO ********** */

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
    const LISTAR_CARACTERISTICAS = "SELECT * FROM caracteristicas WHERE borrado = 0";
    const LISTAR_TODO_CARACTERISTICAS = "SELECT * FROM caracteristicas";
    const AGREGAR_CARACTERISTICA = "INSERT INTO caracteristicas(denominacion_caracteristica) VALUES(?)";
    const MODIFICAR_CARACTERISTICA = "UPDATE caracteristicas SET denominacion_caracteristica = ? WHERE id_caracteristicas = ?";
    const ULTIMA_CARACTERISTICA = "SELECT MAX(id_caracteristicas) AS id FROM caracteristicas";
    const NOMBRE_CARACTERISTICA = "SELECT denominacion_caracteristica AS nombre FROM caracteristicas WHERE id_caracteristicas = ?";
    const ELIMINAR_CARACTERISTICA = "UPDATE caracteristicas SET borrado = 1 WHERE id_caracteristicas = ?";
    //LOG CARACTERISTICAS
    const NUEVO_LOG_CARACTERISTICA = "INSERT INTO log_caracteristicas(`fecha_log_caracteristica`,`hora_log_caracteristica`, caracteristica_nombre_anterior_log_caracteristica, caracteristica_nombre_nuevo_log_caracteristica,`id_accion_log_caracteristica`,`id_caracteristica_log_caracteristica`,`id_usuario_log_caracteristica`) VALUES(CURDATE(),CURTIME(),?,?,?,?,?)";
    const LISTAR_LOG_CARACTERISTICA = "SELECT fecha_log_caracteristica AS fecha, hora_log_caracteristica AS hora, caracteristica_nombre_anterior_log_caracteristica AS nombreCaracteristicaAnterior, caracteristica_nombre_nuevo_log_caracteristica AS nombreCaracteristicaNuevo, nombre_accion AS accion, denominacion_caracteristica AS nombreActual, nombre_usuario AS usuario FROM log_caracteristicas INNER JOIN acciones ON id_accion = id_accion_log_caracteristica INNER JOIN caracteristicas ON id_caracteristica_log_caracteristica = id_caracteristicas INNER JOIN usuario ON id_usuario_log_caracteristica = id_usuario";
    //AUTORES
    const LISTAR_AUTORES = "SELECT * FROM autores where borrado = 0";
    const LISTAR_AUTORES_X_USUARIO = "SELECT id_autor, nombre_autor FROM autores INNER JOIN log_autores ON id_autor = id_autor_log_autor WHERE borrado = 0 AND id_usuario_log_autor = ? AND id_accion_log_autor = 1;";
    const LISTAR_TODO_AUTORES = "SELECT * FROM autores";
    const LISTAR_TODO_AUTORES_X_USUARIO = "SELECT id_autor, nombre_autor FROM autores INNER JOIN log_autores ON id_autor = id_autor_log_autor WHERE id_usuario_log_autor = ? AND id_accion_log_autor = 1;";
    const AGREGAR_AUTOR = "INSERT INTO autores (nombre_autor) VALUES(?)";
    const MODIFICAR_AUTOR = "UPDATE autores SET nombre_autor = ? WHERE id_autor = ?";
    const ULTIMO_ID_AUTOR = "SELECT MAX(id_autor) FROM autores;";
    const ELIMINAR_AUTOR = "UPDATE autores SET borrado = 1 WHERE id_autor = ?;";
    //LOG AUTORES
    const LOG_AGREGAR_AUTORES = "INSERT INTO log_autores(`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) VALUES(CURDATE(),CURTIME(),1,?,?);";
    const LOG_MODIFICAR_AUTORES = "INSERT INTO log_autores(`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) VALUES(CURDATE(),CURTIME(),3,?,?);";
    const LOG_ELIMINAR_AUTORES = "INSERT INTO log_autores(`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) VALUES(CURDATE(),CURTIME(),2,?,?);";
    const LOG_LISTAR_AUTORES = "SELECT fecha_log_autor AS fecha, hora_log_autor AS hora, nombre_autor AS autor, nombre_usuario AS usuario, nombre_accion AS accion FROM log_autores INNER JOIN acciones ON id_accion_log_autor = id_accion INNER JOIN autores ON id_autor_log_autor = id_autor INNER JOIN usuario ON id_usuario_log_autor = id_usuario";
    //USUARIOS
    const LISTAR_USUARIOS = "SELECT id_usuario, nombre_usuario, descripcion_usuario AS tipo_usuario FROM usuario INNER JOIN tipos_usuario ON id_tipo_tipo_usuario = id_tipo_usuario WHERE borrado = 0";
    const LISTAR_TODO_USUARIOS = "SELECT id_usuario, nombre_usuario, descripcion_usuario AS tipo_usuario FROM usuario INNER JOIN tipos_usuario ON id_tipo_tipo_usuario = id_tipo_usuario";
    const MODIFICAR_USUARIO = "UPDATE usuario SET nombre_usuario = ?, clave_usuario = ? WHERE id_usuario = ?";
    const AGREGAR_USUARIO = "INSERT INTO usuario (nombre_usuario,clave_usuario,fecha_alta_usuario,id_tipo_tipo_usuario) VALUES(?,?,CURDATE(),1)";
    const ULTIMO_ID_USUARIO = "SELECT MAX(id_usuario) FROM usuario;";
    const ELIMINAR_USUARIO = "UPDATE usuario SET borrado = 1, fecha_baja_usuario = CURDATE() WHERE id_usuario = ?;";
    const CAMBIAR_PASSWORD = "UPDATE usuario SET clave_usuario = ? WHERE id_usuario = ?";
    //CLASIFICACIONES
    const LISTAR_CLASIFICACIONES = "SELECT id_clasificacion AS id, id_clasificacion_padre AS parent, denominacion_clasificacion AS 'text' FROM clasificaciones WHERE borrado = 0";
    const LISTAR_CLASIFICACIONES_X_USUARIO = "SELECT id_clasificacion AS id, id_clasificacion_padre AS parent, denominacion_clasificacion AS 'text' FROM clasificaciones INNER JOIN log_clasificaciones ON id_clasificacion = id_clasificacion_log_clasificacion WHERE borrado = 0 AND ((id_usuario_log_clasificacion = ? AND id_accion_log_clasificacion = 1) OR ISNULL(id_clasificacion_padre));";
    const LISTAR_TODO_CLASIFICACIONES = "SELECT id_clasificacion AS id, id_clasificacion_padre AS parent, denominacion_clasificacion AS 'text' FROM clasificaciones";
    const LISTAR_TODO_CLASIFICACIONES_X_USUARIO = "SELECT id_clasificacion AS id, id_clasificacion_padre AS parent, denominacion_clasificacion AS 'text' FROM clasificaciones INNER JOIN log_clasificaciones ON id_clasificacion = id_clasificacion_log_clasificacion WHERE ((id_usuario_log_clasificacion = ? AND id_accion_log_clasificacion = 1) OR ISNULL(id_clasificacion_padre));";
    const AGREGAR_CLASIFICACION = "INSERT INTO clasificaciones (denominacion_clasificacion,id_clasificacion_padre) VALUES(?,?)";
    const ULTIMO_ID_CLASIFICACION = "SELECT MAX(id_clasificacion) FROM clasificaciones;";
    const MODIFICAR_CLASIFICACION = "UPDATE clasificaciones SET denominacion_clasificacion = ?, id_clasificacion_padre = ? WHERE id_clasificacion = ?";
    const ELIMINAR_CLASIFICACION = "UPDATE clasificaciones SET borrado = 1 WHERE id_clasificacion = ?;";
    //LOG CLASIFICACIONES
    const LOG_AGREGAR_CLASIFICACION = "INSERT INTO log_clasificaciones(`fecha_log_clasificacion`,`hora_log_clasificacion`,`id_accion_log_clasificacion`,`id_clasificacion_log_clasificacion`,`id_usuario_log_clasificacion`) VALUES(CURDATE(),CURTIME(),1,?,?);";
    const LOG_MODIFICAR_CLASIFICACION = "INSERT INTO log_clasificaciones(`fecha_log_clasificacion`,`hora_log_clasificacion`,`id_accion_log_clasificacion`,`id_clasificacion_log_clasificacion`,`id_usuario_log_clasificacion`) VALUES(CURDATE(),CURTIME(),3,?,?);";
    const LOG_ELIMINAR_CLASIFICACION = "INSERT INTO log_clasificaciones(`fecha_log_clasificacion`,`hora_log_clasificacion`,`id_accion_log_clasificacion`,`id_clasificacion_log_clasificacion`,`id_usuario_log_clasificacion`) VALUES(CURDATE(),CURTIME(),2,?,?);";
    const LOG_LISTAR_CLASIFICACIONES = "SELECT fecha_log_clasificacion AS fecha, hora_log_clasificacion AS hora, denominacion_clasificacion AS clasificacion, nombre_usuario AS usuario, nombre_accion AS accion FROM log_clasificaciones INNER JOIN acciones ON id_accion_log_clasificacion = id_accion INNER JOIN clasificaciones ON id_clasificacion_log_clasificacion = id_clasificacion INNER JOIN usuario ON id_usuario_log_clasificacion = id_usuario";
    //LIBROS
    const LISTAR_LIBROS = "SELECT id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor, id_autor_libro AS hidAutor, nombre_editorial AS editorial, id_editorial_libro AS hidEditorial, disponibilidad_libro AS 'disponible', destacado_libro AS 'destacado', ISBN_libro AS isbn, idioma_libro AS idioma, paginas_libro AS paginas, publicacion_libro AS 'publicacion' FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN editoriales ON id_editorial = id_editorial_libro where libro.borrado = 0";
    const LISTAR_LIBROS_X_USUARIO = "SELECT id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor, id_autor_libro AS hidAutor, nombre_editorial AS editorial, id_editorial_libro AS hidEditorial, disponibilidad_libro AS 'disponible', destacado_libro AS 'destacado', ISBN_libro AS isbn, idioma_libro AS idioma, paginas_libro AS paginas, publicacion_libro AS 'publicacion' FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN editoriales ON id_editorial = id_editorial_libro INNER JOIN log_libros ON id_log_libro = id_libro  where libro.borrado = 0 AND id_usuario_log_libro = ? AND id_accion_log_libro = 1;";
    const LISTAR_TODO_LIBROS = "SELECT id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor, id_autor_libro AS hidAutor, nombre_editorial AS editorial, id_editorial_libro AS hidEditorial, disponibilidad_libro AS 'disponible', destacado_libro AS 'destacado', ISBN_libro AS isbn, idioma_libro AS idioma, paginas_libro AS paginas, publicacion_libro AS 'publicacion' FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN editoriales ON id_editorial = id_editorial_libro";
    const LISTAR_TODO_LIBROS_X_USUARIO = "SELECT id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor, id_autor_libro AS hidAutor, nombre_editorial AS editorial, id_editorial_libro AS hidEditorial, disponibilidad_libro AS 'disponible', destacado_libro AS 'destacado', ISBN_libro AS isbn, idioma_libro AS idioma, paginas_libro AS paginas, publicacion_libro AS 'publicacion' FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN editoriales ON id_editorial = id_editorial_libro INNER JOIN log_libros ON id_log_libro = id_libro where id_usuario_log_libro = ? AND id_accion_log_libro = 1;";
    const AGREGAR_LIBRO = "INSERT INTO `biblioteca`.`libro` (`titulo_libro`,`ISBN_libro`,`paginas_libro`,`idioma_libro`,`publicacion_libro`,`disponibilidad_libro`,`destacado_libro`,`id_autor_libro`,`id_editorial_libro`) VALUES (?,?,?,?,?,?,?,?,?);";
    const ULTIMO_ID_LIBRO = "SELECT MAX(id_libro) FROM libro;";
    const MODIFICAR_LIBRO = "UPDATE `biblioteca`.`libro` SET  `titulo_libro` = ?,  `ISBN_libro` = ?,  `paginas_libro` = ?,  `idioma_libro` = ?,  `publicacion_libro` = ?,  `disponibilidad_libro` = ?,  `destacado_libro` = ?,  `id_autor_libro` = ?,  `id_editorial_libro` = ? WHERE `id_libro` = ?;";
    const ELIMINAR_LIBRO = "UPDATE libro SET borrado = 1 WHERE id_libro = ?;";
    //FOTOS EMMA
    const AGREGAR_FOTO = "INSERT INTO fotos (rutaArchivo_foto, id_libro_foto) VALUES(?, ?)";
    const MODIFICAR_FOTO = "UPDATE fotos SET rutaArchivo_foto = ? WHERE id_foto = ?";
    const LISTAR_FOTO_ORDER_LIBROS = "SELECT * FROM fotos INNER JOIN libro ON id_libro_foto = id_libro ORDER BY id_libro_foto";
    const LISTAR_FOTOS = "SELECT rutaArchivo_foto FROM fotos";
    const BUSCAR_FOTO = "SELECT rutaArchivo_foto AS ruta, id_foto AS id FROM fotos WHERE id_libro_foto = ?";
//FOTOS
    //const AGREGAR_FOTO = "INSERT INTO `biblioteca`.`fotos`(`rutaArchivo_foto`,`id_libro_foto`) VALUES (?,?);";
    
//LIBROS-CLASIFICACION
    const AGREGAR_LIBRO_CLASIFICACION = "INSERT INTO `biblioteca`.`libro_clasificacion`(`fk_clasificacion`,`fk_libro`) VALUES (?,?);";
    const BUSCAR_LIBRO_CLASIFICACION = "SELECT fk_clasificacion AS id, denominacion_clasificacion AS text FROM libro_clasificacion INNER JOIN clasificaciones ON fk_clasificacion = id_clasificacion WHERE fk_libro = ?";
    const ELIMINAR_LIBRO_CLASIFICACION = "DELETE FROM `biblioteca`.`libro_clasificacion` WHERE `fk_libro` = ?;";
    //LIBROS-CARACTERISTICAS
    const AGREGAR_LIBRO_CARACTERISTICA = "INSERT INTO `biblioteca`.`libro_caracteristica`(`fk_caracteristica`,`fk_libro`) VALUES (?,?);";
    const BUSCAR_LIBRO_CARACTERISTICA = "SELECT fk_caracteristica AS id, denominacion_caracteristica AS text FROM libro_caracteristica INNER JOIN caracteristicas ON fk_caracteristica = id_caracteristicas WHERE fk_libro = ?";
    const ELIMINAR_LIBRO_CARACTERISTICA = "DELETE FROM `biblioteca`.`libro_caracteristica` WHERE `fk_libro` = ?;";

//LOGS LIBROS
    const LOG_AGREGAR_LIBROS = "INSERT INTO log_libros(`fecha_log_libro`,`hora_log_libro`,`id_accion_log_libro`,`id_libro_log_libro`,`id_usuario_log_libro`) VALUES(CURDATE(),CURTIME(),1,?,?);";
    const LOG_MODIFICAR_LIBROS = "INSERT INTO log_libros(`fecha_log_libro`,`hora_log_libro`,`id_accion_log_libro`,`id_libro_log_libro`,`id_usuario_log_libro`) VALUES(CURDATE(),CURTIME(),3,?,?);";
    const LOG_ELIMINAR_LIBROS = "INSERT INTO log_libros(`fecha_log_libro`,`hora_log_libro`,`id_accion_log_libro`,`id_libro_log_libro`,`id_usuario_log_libro`) VALUES(CURDATE(),CURTIME(),2,?,?);";
    const LOG_LISTAR_LIBROS = "SELECT fecha_log_libro AS fecha, hora_log_libro AS hora, titulo_libro AS libro, nombre_usuario AS usuario, nombre_accion AS accion FROM log_libros INNER JOIN acciones ON id_accion_log_libro = id_accion INNER JOIN libro ON id_libro_log_libro = id_libro INNER JOIN usuario ON id_usuario_log_libro = id_usuario";
    //IDIOMA
    const LISTAR_IDIOMAS = "SELECT * FROM idioma";
    //LOGIN
    const LOGIN = "SELECT `usuario`.`id_usuario` AS `usuario`,`usuario`.`nombre_usuario` AS `nombre`,`usuario`.`clave_usuario`, `tipos_usuario`.`id_tipo_usuario` AS `value` FROM `biblioteca`.`usuario` INNER JOIN `biblioteca`.`tipos_usuario` ON (`usuario`.`id_tipo_tipo_usuario` = `tipos_usuario`.`id_tipo_usuario`)WHERE nombre_usuario = ? AND borrado = 0;";

}
