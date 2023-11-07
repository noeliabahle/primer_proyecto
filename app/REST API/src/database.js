import mysqlConnection from'mysql2/promise';

// Configuración de la conexión a la base de datos
const properties = {
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'bahle_noelia'
};
export const pool = mysqlConnection.createPool(properties);