<?php

interface DBSentencias {
    const TRAER_LOG_CARACTERISTICAS = "SELECT fecha_log_caracteristica, hora_log_caracteristica FROM log_caracteristicas";
    const TOTAL_LOG = "SELECT COUNT(*) AS total FROM log_caracteristicas";
    const LOG_LIMIT = "SELECT fecha_log_caracteristica, hora_log_caracteristica FROM log_caracteristicas LIMIT ?, ?";
}
