import { pool } from './database.js';

class ProductoController {
  async getAll(req, res) {
    try {
      const [result] = await pool.query('SELECT * FROM productos');
      res.json(result);
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Error al obtener la lista de productos' });
    }
  }

  async add(req, res) {
    const producto = req.body;
    try {
      const [result] = await pool.query(
        `INSERT INTO Productos(producto, categoria_id, precio, precio_venta, stock, stock_min, eliminado) VALUES (?, ?, ?, ?, ?)`,
        [producto.nombreProd, producto.categoria_id, producto.precio, producto.stock, producto.stock_min, producto.eliminado]
      );
      res.json({ "Id insertado": result.insertId });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Error al insertar el producto' });
    }
  }

  async delete(req, res) {
    const producto = req.body;
    try {
      const [result] = await pool.query(`DELETE FROM Productos WHERE ID=(?)`, [producto.ID]);
      res.json({ "registros eliminados": result.affectedRows });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Error al eliminar el producto' });
    }
  }

  async update(req, res) {
    const producto = req.body;
    try {
      const [result] = await pool.query(
        `UPDATE productos SET producto=(2), categoria_id=(2), precio=(2), precio_venta=(2), stock=(2), stock_min=(2), eliminado=(2)`,
        [producto.nombreProd, producto.imagen, producto.categoria_id, producto.precio, producto.stock, producto.stock_min, producto.eliminado]
      );
      res.json({ "registros actualizados": result.changedRows });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Error al actualizar el producto' });
    }
  }
}

export const producto = new ProductoController();
