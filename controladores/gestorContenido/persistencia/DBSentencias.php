<?php

/* * ********* GESTOR CONTENIDO ********** */

interface DBSentencias {

//AUTORES
    const LISTAR_AUTORES = "SELECT id_autor AS id, nombre_autor AS nombre FROM autores";
    const AGREGAR_AUTOR = "INSERT INTO autores (nombre_autor) VALUES(?);";
    const MODIFICAR_AUTOR = "UPDATE autores SET nombre_autor = ? WHERE id_autor = ?";
    const ULTIMO_ID_AUTOR = "SELECT MAX(id_autor) FROM autores;";
    const ELIMINAR_AUTOR = "DELETE FROM autores WHERE id_autor = ?;";
    const CONTAR_AUTORES_CARGADOS = "SELECT COUNT(*) AS autores FROM autores";
    const NOMBRE_AUTORES = "SELECT nombre_autor AS nombre FROM autores WHERE id_autor = ?";
//CARACTERISTICAS
    const LISTAR_CARACTERISTICAS = "SELECT `id_caracteristicas` AS id, `denominacion_caracteristica` AS denominacion FROM caracteristicas";
    const AGREGAR_CARACTERISTICA = "INSERT INTO caracteristicas(denominacion_caracteristica) VALUES(?)";
    const MODIFICAR_CARACTERISTICA = "UPDATE caracteristicas SET denominacion_caracteristica = ? WHERE id_caracteristicas = ?";
    const ULTIMA_CARACTERISTICA = "SELECT MAX(id_caracteristicas) AS id FROM caracteristicas";
    const NOMBRE_CARACTERISTICA = "SELECT denominacion_caracteristica AS nombre FROM caracteristicas WHERE id_caracteristicas = ?";
    const ELIMINAR_CARACTERISTICA = "DELETE FROM caracteristicas WHERE id_caracteristicas = ?";
//CLASIFICACIONES
    const LISTAR_CLASIFICACIONES = "SELECT id_clasificacion AS id, id_clasificacion_padre AS parent, denominacion_clasificacion AS 'text' FROM clasificaciones";
    const AGREGAR_CLASIFICACION = "INSERT INTO clasificaciones (denominacion_clasificacion,id_clasificacion_padre) VALUES(?,?)";
    const ULTIMO_ID_CLASIFICACION = "SELECT MAX(id_clasificacion) FROM clasificaciones;";
    const MODIFICAR_CLASIFICACION = "UPDATE clasificaciones SET denominacion_clasificacion = ?, id_clasificacion_padre = ? WHERE id_clasificacion = ?";
    const ELIMINAR_CLASIFICACION = "DELETE FROM clasificaciones WHERE id_clasificacion = ?;";
    const NOMBRE_CLASIFICACION = "SELECT denominacion_clasificacion AS nombre FROM clasificaciones WHERE id_clasificacion = ?";
//EDITORIALES
    const LISTAR_EDITORIALES = "SELECT `id_editorial` AS id, `nombre_editorial` AS nombre FROM editoriales";
    const AGREGAR_EDITORIAL = "INSERT INTO editoriales (nombre_editorial) VALUES(?)";
    const MODIFICAR_EDITORIAL = "UPDATE editoriales SET nombre_editorial = ? WHERE id_editorial = ?";
    const ELIMINAR_EDITORIAL = "DELETE FROM editoriales WHERE id_editorial = ?";
    const ULTIMA_EDITORIAL = "SELECT MAX(id_editorial) AS id FROM editoriales";
    const NOMBRE_EDITORIAL = "SELECT nombre_editorial AS nombre FROM editoriales WHERE id_editorial = ?";
    const CONTAR_EDITORIALES_CARGADAS = "SELECT COUNT(*) AS editoriales FROM editoriales";
//FOTOS EMMA
    const AGREGAR_FOTO = "INSERT INTO fotos (rutaArchivo_foto, id_libro_foto) VALUES(?, ?)";
    const MODIFICAR_FOTO = "UPDATE fotos SET rutaArchivo_foto = ? WHERE id_foto = ?";
    const LISTAR_FOTO_ORDER_LIBROS = "SELECT * FROM fotos INNER JOIN libro ON id_libro_foto = id_libro ORDER BY id_libro_foto";
    const LISTAR_FOTOS = "SELECT rutaArchivo_foto FROM fotos";
    const BUSCAR_FOTO = "SELECT rutaArchivo_foto AS ruta, id_foto AS id FROM fotos WHERE id_libro_foto = ?";
//FOTOS
    //const AGREGAR_FOTO = "INSERT INTO `biblioteca`.`fotos`(`rutaArchivo_foto`,`id_libro_foto`) VALUES (?,?);";
//IDIOMA
    const LISTAR_IDIOMAS = "SELECT * FROM idioma";
//LIBROS
    const NOMBRE_LIBROS = "SELECT titulo_libro AS nombre FROM libro WHERE id_libro = ?";
    const LISTAR_LIBROS = "SELECT id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor, id_autor_libro AS hidAutor, nombre_editorial AS editorial, id_editorial_libro AS hidEditorial, disponibilidad_libro AS 'disponible', destacado_libro AS 'destacado', ISBN_libro AS isbn, idioma_libro AS idioma, paginas_libro AS paginas, publicacion_libro AS 'publicacion', resumen_libro AS 'resumen' FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN editoriales ON id_editorial = id_editorial_libro";
    const AGREGAR_LIBRO = "INSERT INTO `biblioteca`.`libro` (`titulo_libro`,`ISBN_libro`,`paginas_libro`,`idioma_libro`,`publicacion_libro`,`disponibilidad_libro`,`destacado_libro`,`id_autor_libro`,`id_editorial_libro`) VALUES (?,?,?,?,?,?,?,?,?);";
    const ULTIMO_ID_LIBRO = "SELECT MAX(id_libro) FROM libro;";
    const MODIFICAR_LIBRO = "UPDATE `biblioteca`.`libro` SET  `titulo_libro` = ?,  `ISBN_libro` = ?,  `paginas_libro` = ?,  `idioma_libro` = ?,  `publicacion_libro` = ?,  `disponibilidad_libro` = ?,  `destacado_libro` = ?,  `id_autor_libro` = ?,  `id_editorial_libro` = ?, `resumen_libro` = ? WHERE `id_libro` = ?;";
    const ELIMINAR_LIBRO = "DELETE FROM libro WHERE id_libro = ?;";
    const CONTAR_LIBROS_CARGADOS = "SELECT COUNT(*) AS libros FROM libro";
//LIBROS-CARACTERISTICAS
    const AGREGAR_LIBRO_CARACTERISTICA = "INSERT INTO `biblioteca`.`libro_caracteristica`(`fk_caracteristica`,`fk_libro`) VALUES (?,?);";
    const BUSCAR_LIBRO_CARACTERISTICA = "SELECT fk_caracteristica AS id, denominacion_caracteristica AS text FROM libro_caracteristica INNER JOIN caracteristicas ON fk_caracteristica = id_caracteristicas WHERE fk_libro = ?";
    const ELIMINAR_LIBRO_CARACTERISTICA = "DELETE FROM `biblioteca`.`libro_caracteristica` WHERE `fk_libro` = ?;";
//LIBROS-CLASIFICACION
    const AGREGAR_LIBRO_CLASIFICACION = "INSERT INTO `biblioteca`.`libro_clasificacion`(`fk_clasificacion`,`fk_libro`) VALUES (?,?);";
    const BUSCAR_LIBRO_CLASIFICACION = "SELECT fk_clasificacion AS id, denominacion_clasificacion AS text FROM libro_clasificacion INNER JOIN clasificaciones ON fk_clasificacion = id_clasificacion WHERE fk_libro = ?";
    const ELIMINAR_LIBRO_CLASIFICACION = "DELETE FROM `biblioteca`.`libro_clasificacion` WHERE `fk_libro` = ?;";
//LOGIN
    const LOGIN = "SELECT `usuario`.`id_usuario` AS `usuario`,`usuario`.`nombre_usuario` AS `nombre`,`usuario`.`clave_usuario`, `tipos_usuario`.`id_tipo_usuario` AS `value`, definirPass AS pass FROM `biblioteca`.`usuario` INNER JOIN `biblioteca`.`tipos_usuario` ON (`usuario`.`id_tipo_tipo_usuario` = `tipos_usuario`.`id_tipo_usuario`)WHERE nombre_usuario = ? AND borrado = 0;";
//LOG GENERAL
    const LOG_LISTAR = "SELECT fecha_log AS fecha, hora_log AS hora, nombre_objeto AS nombre, nombre_usuario AS usuario, nombre_accion AS accion FROM log INNER JOIN acciones ON id_accion_log = id_accion INNER JOIN usuario ON id_usuario_log = id_usuario WHERE id_entidad_log = ? order by fecha_log, hora_log desc";
    const LOG_REGISTRAR = "INSERT INTO `biblioteca`.`log`(`fecha_log`,`hora_log`,`id_accion_log`,`id_entidad_log`,`id_usuario_log`,`nombre_objeto`)VALUES (CURDATE(),CURTIME(),?,?,?,?);";
//USUARIOS
    const LISTAR_USUARIOS = "SELECT id_usuario AS id, nombre_usuario AS nombre, descripcion_usuario AS usuario FROM usuario INNER JOIN tipos_usuario ON id_tipo_tipo_usuario = id_tipo_usuario WHERE borrado = 0";
    const LISTAR_TODO_USUARIOS = "SELECT id_usuario AS id, nombre_usuario AS nombre, descripcion_usuario AS usuario FROM usuario INNER JOIN tipos_usuario ON id_tipo_tipo_usuario = id_tipo_usuario";
    const MODIFICAR_USUARIO = "UPDATE usuario SET nombre_usuario = ? WHERE id_usuario = ?";
    const AGREGAR_USUARIO = "INSERT INTO usuario (nombre_usuario,clave_usuario,fecha_alta_usuario,id_tipo_tipo_usuario,definirPass) VALUES(?,?,CURDATE(),1,1)";
    const ULTIMO_ID_USUARIO = "SELECT MAX(id_usuario) FROM usuario;";
    const ELIMINAR_USUARIO = "UPDATE usuario SET borrado = 1, fecha_baja_usuario = CURDATE() WHERE `id_tipo_tipo_usuario` != ? AND id_usuario = ?;";
    const CAMBIAR_PASSWORD = "UPDATE usuario SET clave_usuario = ?, definirPass = 0 WHERE id_usuario = ?";
    const REINICIAR_PASSWORD = "UPDATE usuario SET clave_usuario = '25d55ad283aa400af464c76d713c07ad', definirPass = 1 WHERE id_usuario = ?";
    const OBTENER_PASSWORD = "SELECT clave_usuario FROM usuario WHERE id_usuario = ?";
    const TRAER_TIPO_USUARIO = "SELECT id_tipo_tipo_usuario AS tipo FROM `biblioteca`.`usuario`  WHERE id_usuario = ?;";
//CONTACTOS
    const LISTAR_CONTACTOS = "SELECT * FROM `biblioteca`.`consultas` WHERE borrado = 0;";
    const ELIMINAR_CONTACTO = "DELETE FROM  `biblioteca`.`consultas` WHERE `id_consultas` = ?;";
    
    
}
