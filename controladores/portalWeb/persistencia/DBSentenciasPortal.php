<?php

interface DBSentenciasPortal {
    const TRAER_LOG_CARACTERISTICAS = "SELECT fecha_log_caracteristica, hora_log_caracteristica FROM log_caracteristicas";
    const TOTAL_LOG = "SELECT COUNT(*) AS total FROM log_caracteristicas";
    const LOG_LIMIT = "SELECT fecha_log_caracteristica, hora_log_caracteristica FROM log_caracteristicas LIMIT ?, ?";
    
    const LISTAR_LIBROS_PORTADA = "SELECT rutaArchivo_foto , id_libro, titulo_libro , nombre_autor FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN fotos ON id_libro_foto = id_libro WHERE destacado_libro = 1";
    const TOTAL_LIBROS_PORTADA = "SELECT COUNT(*) AS total FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN fotos ON id_libro_foto = id_libro WHERE destacado_libro = 1";
    const LIBROS_PORTADA_LIMIT = "SELECT rutaArchivo_foto AS ruta, id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN fotos ON id_libro_foto = id_libro WHERE destacado_libro = 1 ORDER BY titulo_libro ASC LIMIT ?, ? ";
    const TRAER_LIBRO = "SELECT titulo_libro AS titulo, ISBN_libro AS isbn, paginas_libro AS paginas, idioma.nombre AS idioma, publicacion_libro AS publicacion, nombre_autor AS autor, nombre_editorial AS editorial, rutaArchivo_foto AS ruta FROM libro INNER JOIN autores ON id_autor = id_autor_libro INNER JOIN editoriales ON id_editorial = id_editorial_libro INNER JOIN fotos ON id_libro_foto = id_libro INNER JOIN idioma ON idioma.id_idioma = libro.idioma_libro WHERE id_libro = ?";
    
    const BUSCAR_LIBRO = "SELECT rutaArchivo_foto AS ruta, id_libro AS id, titulo_libro AS titulo, nombre_autor AS autor
FROM libro 
INNER JOIN autores ON id_autor = id_autor_libro 
INNER JOIN fotos ON id_libro_foto = id_libro 
INNER JOIN editoriales ON id_editorial = id_editorial_libro
INNER JOIN idioma ON idioma_libro = id_idioma
WHERE
titulo_libro LIKE ? OR nombre_autor LIKE ? LIMIT ?, ?";
    
    const TOTAL_LIBRO_ENCONTRADO = "SELECT COUNT(*) AS total
FROM libro 
INNER JOIN autores ON id_autor = id_autor_libro 
INNER JOIN fotos ON id_libro_foto = id_libro 
INNER JOIN editoriales ON id_editorial = id_editorial_libro
INNER JOIN idioma ON idioma_libro = id_idioma
WHERE
titulo_libro LIKE ? OR nombre_autor LIKE ?";
    
    const LISTAR_CLASIFICACIONES = "SELECT id_clasificacion AS id, id_clasificacion_padre AS parent, denominacion_clasificacion AS 'text' FROM clasificaciones WHERE borrado = 0";
    const LISTAR_CARACTERISTICAS = "SELECT denominacion_caracteristica AS text FROM caracteristicas WHERE borrado = 0";
    const LISTAR_LIBROS_DESTACADOS = "SELECT `titulo_libro` AS titulo,`nombre_autor` AS autor,`rutaArchivo_foto` AS ruta FROM `biblioteca`.`libro` INNER JOIN autores ON id_autor_libro = `id_autor` INNER JOIN fotos ON id_libro_foto = `id_libro` WHERE `destacado_libro` = 1 AND `libro`.`borrado` = 0 LIMIT 0, 8;";
    const LISTAR_ULTIMOS_LIBROS = "SELECT
  `titulo_libro` AS titulo,
  `nombre_autor` AS autor,
  `nombre_editorial` AS editorial,
  `rutaArchivo_foto` AS ruta
FROM `biblioteca`.`libro`
INNER JOIN autores ON id_autor_libro = `id_autor`
INNER JOIN `editoriales` ON `id_editorial` = `id_editorial_libro`
INNER JOIN fotos ON id_libro_foto = `id_libro`
INNER JOIN `log_libros` ON `id_libro_log_libro` = `id_libro`
WHERE `libro`.`borrado` = 0
ORDER BY `fecha_log_libro` ASC,`hora_log_libro` ASC
LIMIT 4;";
}
